<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_dailyreport".
 *
 * @property int $id
 * @property int $sales
 * @property string $waktu
 * @property int $perusahaan
 * @property string $keterangan
 * @property string $catatan
 * @property string|null $pengingat
 * @property string $con_used
 */
class Dailyreport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_dailyreport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan'], 'required'],
            [['sales', 'perusahaan'], 'integer'],
            [['waktu', 'pengingat'], 'safe'],
            [['keterangan','con_used'], 'string', 'max' => 100],
            [['catatan'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales' => 'Sales',
            'waktu' => 'Waktu',
            'perusahaan' => 'Perusahaan',
            'keterangan' => 'Keterangan',
            'catatan' => 'Catatan',
            'pengingat' => 'Hub.Balik',
            'con_used' => 'Kontak Via',
        ];
    }

    public function beforeSave($options = array()) {
        $time_now=date('Y-m-d H:i:s');
        $this->waktu=$time_now;

        if(!empty($this->pengingat)){
            $this->pengingat = Yii::$app->formatter->asDate($_POST['Dailyreport']['pengingat'],'yyyy-MM-dd');
        }else{
            $this->pengingat = null;
        }

        return true;
    }
}
