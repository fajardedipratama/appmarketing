<?php

namespace app\controllers;

use Yii;
use app\models\SalaryReport;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SalaryreportController implements the CRUD actions for SalaryReport model.
 */
class SalaryreportController extends Controller
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
     * Lists all SalaryReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SalaryReport::find(),
            'pagination'=>array('pageSize'=>12),
            'sort'=>['defaultOrder'=>['awal_cutoff'=>SORT_DESC]]
        ]);

        $model = new SalaryReport();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->awal_cutoff=Yii::$app->formatter->asDate($_POST['SalaryReport']['awal_cutoff'],'yyyy-MM-dd');
            $model->akhir_cutoff=Yii::$app->formatter->asDate($_POST['SalaryReport']['akhir_cutoff'],'yyyy-MM-dd');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single SalaryReport model.
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

    public function actionPreview($period,$dept)
    {
        if($dept == 1){
            return $this->render('prev_management', [
                'model' => $this->findModel($period),
            ]);
        }elseif($dept == 2){
            return $this->render('prev_marketing', [
                'model' => $this->findModel($period),
            ]);
        }
    }
    public function actionPreviewabsen($period)
    {
        
        return $this->render('prev_absensi', [
            'model' => $this->findModel($period),
        ]);
    }

    /**
     * Creates a new SalaryReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SalaryReport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SalaryReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->awal_cutoff=Yii::$app->formatter->asDate($_POST['SalaryReport']['awal_cutoff'],'yyyy-MM-dd');
            $model->akhir_cutoff=Yii::$app->formatter->asDate($_POST['SalaryReport']['akhir_cutoff'],'yyyy-MM-dd');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SalaryReport model.
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
     * Finds the SalaryReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalaryReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalaryReport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
