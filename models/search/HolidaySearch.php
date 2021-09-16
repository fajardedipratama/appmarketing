<?php

namespace app\models\search;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Holiday;

/**
 * HolidaySearch represents the model behind the search form of `app\models\Holiday`.
 */
class HolidaySearch extends Holiday
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nama_hari', 'tanggal'], 'safe'],
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
        $query = Holiday::find();

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
        ]);
        if(!empty($this->tanggal)){    
            $query->andFilterWhere([
                'tanggal' => Yii::$app->formatter->asDate($this->tanggal,'yyyy-MM-dd'),
            ]);
        }

        $query->andFilterWhere(['like', 'nama_hari', $this->nama_hari]);

        return $dataProvider;
    }
}
