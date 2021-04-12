<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Exkaryawan;

/**
 * ExkaryawanSearch represents the model behind the search form of `app\models\Exkaryawan`.
 */
class ExkaryawanSearch extends Exkaryawan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_employee'], 'integer'],
            [['alasan', 'tgl_resign'], 'safe'],
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
        $query = Exkaryawan::find();

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
            'id_employee' => $this->id_employee,
            'tgl_resign' => $this->tgl_resign,
        ]);

        $query->andFilterWhere(['like', 'alasan', $this->alasan]);

        return $dataProvider;
    }
}
