<?php

namespace app\models\search;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalaryAdditional;

/**
 * SalaryadditionalSearch represents the model behind the search form of `app\models\SalaryAdditional`.
 */
class SalaryadditionalSearch extends SalaryAdditional
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'karyawan_id', 'komponen_id', 'nilai'], 'integer'],
            [['tanggal'], 'safe'],
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
        $query = SalaryAdditional::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>array('pageSize'=>30),
            'sort'=>['defaultOrder'=>['tanggal'=>SORT_DESC]]
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
            'komponen_id' => $this->komponen_id,
            'nilai' => $this->nilai,
        ]);
        if(!empty($this->tanggal)){    
            $query->andFilterWhere([
                'tanggal' => Yii::$app->formatter->asDate($this->tanggal,'yyyy-MM-dd'),
            ]);
        }

        $query->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
