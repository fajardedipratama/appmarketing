<?php

namespace app\models\search;
use Yii;
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
            [['waktu', 'keterangan','catatan', 'pengingat'], 'safe'],
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
            $query = Dailyreport::find()->where(['sales'=>Yii::$app->user->identity->profilname]);
        }else{
            $query = Dailyreport::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>array('pageSize'=>20),
            'sort'=>['defaultOrder'=>['waktu'=>SORT_DESC]]
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
            'perusahaan' => $this->perusahaan,
            'pengingat' => $this->pengingat,
        ]);

        if(!empty($this->waktu)){    
            $query->andFilterWhere([
                'like','waktu', Yii::$app->formatter->asDate($this->waktu,'yyyy-MM-dd'),
            ]);
        }

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
