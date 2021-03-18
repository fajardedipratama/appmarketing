<?php

namespace app\controllers;

use Yii;
use app\models\PurchaseOrder;
use app\models\search\PurchaseorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use app\models\Karyawan;
/**
 * PurchaseorderController implements the CRUD actions for PurchaseOrder model.
 */
class PurchaseorderController extends Controller
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
     * Lists all PurchaseOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseorderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sales = ArrayHelper::map(Karyawan::find()->where(['status_aktif'=>'Aktif'])->all(),'id',
                function($model){
                    return $model['nama_pendek'];
                });

        if(Yii::$app->user->identity->type == 'Marketing'){
            $customer = ArrayHelper::map(PurchaseOrder::find()->where(['sales'=>Yii::$app->user->identity->profilname])->all(),'perusahaan',
                function($model){
                $query=Customer::find()->where(['id'=>$model['perusahaan']])->all();
                  foreach ($query as $key){
                    return $key['perusahaan'];
                  }
                });
        }else{
            $customer = ArrayHelper::map(PurchaseOrder::find()->all(),'perusahaan',
                function($model){
                $query=Customer::find()->where(['id'=>$model['perusahaan']])->all();
                  foreach ($query as $key){
                    return $key['perusahaan'];
                  }
                });
        }

        return $this->render('index', [
            'sales' => $sales,
            'customer' => $customer,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurchaseOrder model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(isset($_POST['tolak'])){
            Yii::$app->db->createCommand()->update('id_purchase_order',
            ['alasan_tolak' => $_POST['PurchaseOrder']['alasan_tolak'],'status'=>'Ditolak'],
            ['id'=>$model->id])->execute();
            return $this->redirect(['view','id' => $model->id]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    public function actionAccpo($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_purchase_order',
        ['status'=>'Disetujui'],
        ['id'=>$model->id])->execute();

        return $this->redirect(['view','id' => $model->id]);
    }
    public function actionSendpo($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_purchase_order',
        ['status'=>'Terkirim'],
        ['id'=>$model->id])->execute();

        Yii::$app->db->createCommand()->update('id_customer',
        ['expired'=>'2070-01-01'],
        ['id'=>$model->perusahaan])->execute();

        return $this->redirect(['view','id' => $model->id]);
    }
    public function actionPaidpo($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_purchase_order',
        ['status'=>'Terbayar-Selesai'],
        ['id'=>$model->id])->execute();

        return $this->redirect(['view','id' => $model->id]);
    }
    public function actionPrint($id)
    {
        return $this->renderPartial('print', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new PurchaseOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurchaseOrder();

        if ($model->load(Yii::$app->request->post())) {
            //process
            $model->tgl_po=Yii::$app->formatter->asDate($_POST['PurchaseOrder']['tgl_po'],'yyyy-MM-dd');
            $model->tgl_kirim=Yii::$app->formatter->asDate($_POST['PurchaseOrder']['tgl_kirim'],'yyyy-MM-dd');
            $model->status='Pending';

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PurchaseOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //process
            $model->tgl_po=Yii::$app->formatter->asDate($_POST['PurchaseOrder']['tgl_po'],'yyyy-MM-dd');
            $model->tgl_kirim=Yii::$app->formatter->asDate($_POST['PurchaseOrder']['tgl_kirim'],'yyyy-MM-dd');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PurchaseOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PurchaseOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
