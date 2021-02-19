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
 * @property string $volume
 * @property string $jarak_ambil
 * @property string $catatan
 * @property string $pengingat
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
            [['perusahaan', 'keterangan'], 'required'],
            [['sales', 'perusahaan'], 'integer'],
            [['waktu', 'pengingat'], 'safe'],
            [['keterangan', 'volume', 'jarak_ambil'], 'string', 'max' => 100],
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
            'volume' => 'Est.Volume',
            'jarak_ambil' => 'Est.Jarak Kebutuhan',
            'catatan' => 'Catatan',
            'pengingat' => 'Pengingat',
        ];
    }
}
