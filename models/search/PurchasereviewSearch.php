<?php

namespace app\models\search;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PurchaseReview;
use app\models\PurchaseOrder;

/**
 * PurchasereviewSearch represents the model behind the search form of `app\models\PurchaseReview`.
 */
class PurchasereviewSearch extends PurchaseReview
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perusahaan_id', 'jarak_ambil', 'review_by'], 'integer'],
            [['waktu_ambil', 'catatan_kirim', 'catatan_berkas', 'catatan_bayar', 'catatan_lain', 'kendala'], 'safe'],
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
            'perusahaan_id' => $this->perusahaan_id,
            'jarak_ambil' => $this->jarak_ambil,
            'review_by' => $this->review_by,
        ]);

        $query->andFilterWhere(['like', 'waktu_ambil', $this->waktu_ambil])
            ->andFilterWhere(['like', 'catatan_kirim', $this->catatan_kirim])
            ->andFilterWhere(['like', 'catatan_berkas', $this->catatan_berkas])
            ->andFilterWhere(['like', 'catatan_bayar', $this->catatan_bayar])
            ->andFilterWhere(['like', 'catatan_lain', $this->catatan_lain])
            ->andFilterWhere(['like', 'kendala', $this->kendala]);

        return $dataProvider;
    }
}
