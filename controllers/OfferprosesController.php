<?php

namespace app\controllers;
use Yii;
use app\models\Offer;
use app\models\Customer;
use app\models\Karyawan;
use app\models\City;
use app\models\search\OfferprosesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
class OfferprosesController extends \yii\web\Controller
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

    public function actionIndex()
    {
        $searchModel = new OfferprosesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sales = ArrayHelper::map(Karyawan::find()->where(['posisi'=>6,'status_aktif'=>'Aktif'])->all(),'id',
                function($model){
                    return $model['nama_pendek'];
                });
        $kota = ArrayHelper::map(City::find()->all(),'id',
                function($model){
                    return $model['kota'];
                });

        return $this->render('../offer/proses', [
            'sales' => $sales,
            'kota' => $kota,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
