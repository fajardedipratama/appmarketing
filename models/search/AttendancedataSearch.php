<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AttendanceData;

/**
 * AttendancedataSearch represents the model behind the search form of `app\models\AttendanceData`.
 */
class AttendancedataSearch extends AttendanceData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'karyawan_id'], 'integer'],
            [['work_day', 'work_date', 'schedule_in', 'schedule_out', 'real_in', 'real_out'], 'safe'],
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
        $query = AttendanceData::find();

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
            'karyawan_id' => $this->karyawan_id,
            'work_date' => $this->work_date,
            'schedule_in' => $this->schedule_in,
            'schedule_out' => $this->schedule_out,
            'real_in' => $this->real_in,
            'real_out' => $this->real_out,
        ]);

        $query->andFilterWhere(['like', 'work_day', $this->work_day]);

        return $dataProvider;
    }
}
