<?php

namespace app\controllers;
use Yii;
use app\models\Offer;
use app\models\Customer;
use app\models\Karyawan;
use app\models\City;
use app\models\search\OfferfinishSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class OfferfinishController extends \yii\web\Controller
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
        $searchModel = new OfferfinishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sales = ArrayHelper::map(Karyawan::find()->where(['posisi'=>6,'status_aktif'=>'Aktif'])->all(),'id',
                function($model){
                    return $model['nama_pendek'];
                });
        $customer = ArrayHelper::map(Offer::find()->where(['status'=>'Terkirim'])->orWhere(['status'=>'Gagal Kirim'])->all(),'perusahaan',
                function($model){
                $query=Customer::find()->where(['id'=>$model['perusahaan']])->all();
                  foreach ($query as $key){
                    return $key['perusahaan'];
                  }
                });

        return $this->render('../offer/finish', [
            'sales' => $sales,
            'customer' => $customer,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
    EXPORT WITH OPENTBS
    */
    public function actionExportExcel2()
    {
        $query = Offer::find()->where(['status'=>'Terkirim'])->orWhere(['status'=>'Gagal Kirim']);;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=> false,
            'sort'=>['defaultOrder'=>['no_surat'=>SORT_ASC]]
        ]);
        
        // Initalize the TBS instance
        $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
        // Change with Your template kaka
        $template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/penawaran.xlsx';
        $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
        //$OpenTBS->VarRef['modelName']= "Mahasiswa";               
        $data = [];
        foreach($dataProvider->getModels() as $offer){
        $lokasi = City::find()->where(['id'=>$offer->customer->lokasi])->one();
            $data[] = [
                'tanggal'=>date('d/m/Y',strtotime($offer->tanggal)),
                'no_surat'=>$offer->no_surat,
                'perusahaan'=>$offer->customer->perusahaan,
                'lokasi'=>$lokasi['kota'],
                'pic'=>$offer->pic,
                'top'=>$offer->top,
                'pajak'=>$offer->pajak,
                'harga'=>$offer->harga,
                'sales'=>$offer->karyawan->nama_pendek,
                'catatan'=>$offer->catatan,
                'status'=>$offer->status,
                'is_new'=>$offer->is_new,
            ];
        }
        
        $OpenTBS->MergeBlock('data', $data);
        // Output the result as a file on the server. You can change output file
        $filename = 'Penawaran per '.date('d-m-y').'.xlsx';
        $OpenTBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.          
        exit;
    } 

}
