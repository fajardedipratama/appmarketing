<?php

namespace app\models\search;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Permit;

/**
 * PermitSearch represents the model behind the search form of `app\models\Permit`.
 */
class PermitSearch extends Permit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'karyawan_id'], 'integer'],
            [['kategori', 'tgl_mulai','tgl_selesai', 'jam_masuk', 'jam_keluar', 'alasan', 'status', 'created_time'], 'safe'],
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
        $query = Permit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['tgl_mulai'=>SORT_DESC]]
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
            'jam_masuk' => $this->jam_masuk,
            'jam_keluar' => $this->jam_keluar,
            'created_time' => $this->created_time,
        ]);

        if(!empty($this->tgl_mulai)){    
            $query->andFilterWhere([
                'tgl_mulai' => Yii::$app->formatter->asDate($this->tgl_mulai,'yyyy-MM-dd'),
            ]);
        }
        if(!empty($this->tgl_selesai)){    
            $query->andFilterWhere([
                'tgl_selesai' => Yii::$app->formatter->asDate($this->tgl_selesai,'yyyy-MM-dd'),
            ]);
        }

        $query->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'alasan', $this->alasan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}