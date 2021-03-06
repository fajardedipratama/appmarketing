<?php

namespace app\controllers;
use Yii;
use app\models\Offer;
use app\models\Customer;
use app\models\Karyawan;
use app\models\City;
use app\models\search\OfferfailedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
class OfferfailedController extends \yii\web\Controller
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
        $searchModel = new OfferfailedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $customer = ArrayHelper::map(Offer::find()->where(['status'=>'Gagal Kirim'])->all(),'perusahaan',
                function($model){
                $query=Customer::find()->where(['id'=>$model['perusahaan']])->all();
                  foreach ($query as $key){
                    return $key['perusahaan'];
                  }
                });


        return $this->render('../offer/failed', [
            'customer' => $customer,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
