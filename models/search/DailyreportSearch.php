<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dailyreport;

/**
 * DailyreportSearch represents the model behind the search form of `app\models\Dailyreport`.
 */
class DailyreportSearch extends Dailyreport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sales', 'perusahaan'], 'integer'],
            [['waktu', 'keterangan', 'volume', 'jarak_ambil', 'catatan', 'pengingat'], 'safe'],
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
        $query = Dailyreport::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'sales' => $this->sales,
            'waktu' => $this->waktu,
            'perusahaan' => $this->perusahaan,
            'pengingat' => $this->pengingat,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'jarak_ambil', $this->jarak_ambil])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
