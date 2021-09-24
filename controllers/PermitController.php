<?php

namespace app\controllers;

use Yii;
use app\models\Permit;
use app\models\Karyawan;
use app\models\search\PermitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
/**
 * PermitController implements the CRUD actions for Permit model.
 */
class PermitController extends Controller
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
     * Lists all Permit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $karyawan = ArrayHelper::map(Karyawan::find()->all(),'id',
        function($model){
            return $model['nama'];
        });

        $model = new Permit();
        if ($model->load(Yii::$app->request->post())) {
            $set_awal = Yii::$app->formatter->asDate($model->set_awal,'yyyy-MM-dd');
            $set_akhir = Yii::$app->formatter->asDate($model->set_akhir,'yyyy-MM-dd');
            
            return $this->redirect(['printreport','range'=>$set_awal.'x'.$set_akhir]);
        }

        return $this->render('index', [
            'karyawan' => $karyawan,
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Permit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPrint($id)
    {
        return $this->renderPartial('print', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPrintreport($range)
    {
        $model = new Permit();
        return $this->renderPartial('printreport', [
            'model' => $model,
        ]);
    }

    public function actionConfirmhrd($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_permit',
        ['status'=>'Konfirmasi-HRD'],
        ['id'=>$model->id])->execute();

        return $this->redirect(['view','id' => $model->id]);
    }

    public function actionConfirmkacab($id)
    {
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()->update('id_permit',
        ['status'=>'Terverifikasi'],
        ['id'=>$model->id])->execute();

        return $this->redirect(['view','id' => $model->id]);
    }

    /**
     * Creates a new Permit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Permit();

        if ($model->load(Yii::$app->request->post())) {
            $model->tgl_mulai=Yii::$app->formatter->asDate($_POST['Permit']['tgl_mulai'],'yyyy-MM-dd');
            $model->tgl_selesai=Yii::$app->formatter->asDate($_POST['Permit']['tgl_selesai'],'yyyy-MM-dd');
            $model->created_time=date('Y-m-d H:i:s');
            $model->status='Pending';
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Permit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->tgl_mulai=Yii::$app->formatter->asDate($_POST['Permit']['tgl_mulai'],'yyyy-MM-dd');
            $model->tgl_selesai=Yii::$app->formatter->asDate($_POST['Permit']['tgl_selesai'],'yyyy-MM-dd');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Permit model.
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
     * Finds the Permit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Permit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
