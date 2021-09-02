<?php

namespace app\controllers;

use Yii;
use app\models\Offer;
use app\models\OfferExtra;
use app\models\Customer;
use app\models\Karyawan;
use app\models\City;
use app\models\OfferNumber;
use app\models\search\OfferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
/**
 * OfferController implements the CRUD actions for Offer model.
 */
class OfferController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=> [
                'class'=>AccessControl::className(),
                'only'=>['create','index','update','view'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Offer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sales = ArrayHelper::map(Karyawan::find()->where(['posisi'=>6,'status_aktif'=>'Aktif'])->all(),'id',
                function($model){
                    return $model['nama_pendek'];
                });
        $customer = ArrayHelper::map(Offer::find()->where(['status'=>'Pending'])->all(),'perusahaan',
                function($model){
                $query=Customer::find()->where(['id'=>$model['perusahaan']])->all();
                  foreach ($query as $key){
                    return $key['perusahaan'];
                  }
                });

        //update no_surat,periode,inisial
        $modelnumber = $this->findModel3();
        if ($modelnumber->load(Yii::$app->request->post()) && $modelnumber->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'sales' => $sales,
            'customer' => $customer,
            'modelnumber' => $modelnumber,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAccept($id)
    {
        $model = $this->findModel($id);

        //kondisi yes : penawaran perusahaan baru / penawaran perusahaan yg pernah dipegang sales lain
        //kondisi no  : penawaran ke-2&dst untuk perusahaan yg masih dipegang 
        $cek_new=Offer::find()->where(['perusahaan'=>$model->perusahaan])->andWhere(['<','id',$model->id])->limit(1)->orderBy(['id'=>SORT_DESC])->one();
        if($cek_new){
            if($cek_new['sales'] === $model->sales){
                Yii::$app->db->createCommand()->update('id_offer',
                ['is_new' => 'no'],['id'=>$model->id])->execute();
            }else{
                Yii::$app->db->createCommand()->update('id_offer',
                ['is_new' => 'yes'],['id'=>$model->id])->execute();
            }
        }else{
            Yii::$app->db->createCommand()->update('id_offer',
            ['is_new' => 'yes'],['id'=>$model->id])->execute();
        }

        $query = OfferNumber::find()->where(['id'=>1])->one();
        $number = $query['nomor']+1;
        //menambahkan no surat
        Yii::$app->db->createCommand()->update('id_offer',
        ['status' => 'Proses','no_surat'=>$number],
        ['id'=>$model->id])->execute();
        //update no.surat terakhir
        Yii::$app->db->createCommand()->update('id_offer_number',
        ['nomor' => $number],
        ['id'=> 1 ])->execute();
        //update customer terverifikasi
        Yii::$app->db->createCommand()->update('id_customer',
        ['verified' => 'yes'],
        ['id'=> $model->perusahaan ])->execute();
        //update expired perusahaan
        $date_now = date('Y-m-d');
        $check_exp = Customer::find()->where(['id'=>$model->perusahaan])->one();
        if($check_exp['expired']===NULL || strtotime($check_exp['expired']) < strtotime($date_now)){
            $expired=date('Y-m-d', strtotime('+30 days', strtotime($date_now)));
            Yii::$app->db->createCommand()->update('id_customer',
            ['expired' => $expired],
            ['id'=> $model->perusahaan ])->execute();
        }

        return $this->redirect(['index']);
    }
    public function actionDecline($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_offer',
        ['status' => 'Gagal Kirim'],
        ['id'=>$model->id])->execute();

        Yii::$app->db->createCommand()->update('id_customer',
        ['verified' => 'no'],
        ['id'=> $model->perusahaan ])->execute();

        return $this->redirect(['index']);
    }
    public function actionDuplicate($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->delete('id_customer',
        ['id'=> $model->perusahaan ])->execute();
        Yii::$app->db->createCommand()->delete('id_dailyreport',
        ['perusahaan'=> $model->perusahaan ])->execute();
        Yii::$app->db->createCommand()->delete('id_offer',
        ['perusahaan'=> $model->perusahaan ])->execute();


        return $this->redirect(['index']);
    }

    public function actionSuccess($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_offer',
        ['status' => 'Terkirim','tanggal'=>date('Y-m-d'),'waktu'=>date('H:i:s')],
        ['id'=>$model->id])->execute();

        return $this->redirect(['/offerproses']);
    }
    public function actionFailed($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_offer',
        ['status' => 'Gagal Kirim','tanggal'=>date('Y-m-d'),'waktu'=>date('H:i:s')],
        ['id'=>$model->id])->execute();

        return $this->redirect(['/offerproses']);
    }

    public function actionPrint($id)
    {
        return $this->renderPartial('print', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Offer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        if($model->sales==Yii::$app->user->identity->profilname || Yii::$app->user->identity->type!='Marketing'){

            $modelextra = new OfferExtra();
            if ($modelextra->load(Yii::$app->request->post()) && $modelextra->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelextra' => $modelextra,
            ]);
        }else{
            return $this->redirect(['selfcustomer/index']);
        }

        
    }

    /**
     * Creates a new Offer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $customer = $this->findModel2($id);

        //view
        if($customer->sales == Yii::$app->user->identity->profilname)
        {
            //create
            $model = new Offer();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['selfcustomer/view', 'id' => $customer->id]);
            }

            return $this->render('create', [
                'model' => $model,
                'customer' => $customer,
            ]);
            
        }else{
            return $this->redirect(['selfcustomer/index']);
        }
    }
    public function actionCreateadmin()
    {
        $model = new Offer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('createadmin', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Offer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Offer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->db->createCommand()->delete('id_offer_extra',['offer_id'=>$id])->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModel2($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModel3()
    {
        if (($model = OfferNumber::find()->where(['id'=>1])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
