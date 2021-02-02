<?php

namespace app\controllers;

use Yii;
use app\models\Karyawan;
use app\models\search\KaryawanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * KaryawanController implements the CRUD actions for Karyawan model.
 */
class KaryawanController extends Controller
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
     * Lists all Karyawan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KaryawanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Karyawan model.
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

    /**
     * Creates a new Karyawan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Karyawan();

        if ($model->load(Yii::$app->request->post())) 
        {
            //process
            $model->tanggal_lahir=Yii::$app->formatter->asDate($_POST['Karyawan']['tanggal_lahir'],'yyyy-MM-dd');
            $model->tanggal_masuk=Yii::$app->formatter->asDate($_POST['Karyawan']['tanggal_masuk'],'yyyy-MM-dd');
            $model->status_aktif = 'Aktif';

            $uploadedFile = UploadedFile::getInstance($model, 'foto_karyawan');
            if(!empty($uploadedFile))
            {
                $fileName= uniqid()."{$uploadedFile}";
                $model->foto_karyawan=$fileName;
                if($model->save()){
                    $uploadedFile->saveAs('photos/employee/'.$fileName);
                }
            }
            else
            {
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Karyawan model.
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
            $model->tanggal_lahir=Yii::$app->formatter->asDate($_POST['Karyawan']['tanggal_lahir'],'yyyy-MM-dd');
            $model->tanggal_masuk=Yii::$app->formatter->asDate($_POST['Karyawan']['tanggal_masuk'],'yyyy-MM-dd');
            
            $uploadedFile = UploadedFile::getInstance($model, 'foto_karyawan');
            $query=Karyawan::findOne($id);
            $current_file=$query->foto_karyawan;
            if(!empty($uploadedFile))
            {
                $fileName= uniqid()."{$uploadedFile}";
                $model->foto_karyawan=$fileName;
                
                if($model->save()){
                    $uploadedFile->saveAs('photos/employee/'.$fileName);
                }
            }
            else
            {
                $model->foto_karyawan=$current_file;
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Karyawan model.
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
     * Finds the Karyawan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Karyawan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Karyawan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
