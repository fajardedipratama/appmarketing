<?php

namespace app\models\search;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PurchaseOrder;

/**
 * PurchaseorderSearch represents the model behind the search form of `app\models\PurchaseOrder`.
 */
class PurchasereviewSearch extends PurchaseOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perusahaan', 'sales','kota_kirim'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if(Yii::$app->user->identity->type == 'Marketing'){
            $query =  PurchaseOrder::find()->select(['perusahaan'])->where(['sales'=>Yii::$app->user->identity->profilname])->andWhere(['status'=>['Terkirim','Terbayar-Selesai']])->andWhere(['eksternal'=>NULL])->distinct();
        }else{
            $query =  PurchaseOrder::find()->select(['perusahaan'])->where(['status'=>['Terkirim','Terbayar-Selesai']])->distinct();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>array('pageSize'=>30),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'perusahaan' => $this->perusahaan,
            'sales' => $this->sales,
            'kota_kirim' => $this->kota_kirim,
        ]);

        return $dataProvider;
    }
}
