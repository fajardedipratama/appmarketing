<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_offer".
 *
 * @property int $id
 * @property string $waktu
 * @property int|null $no_surat
 * @property int $perusahaan
 * @property string $pic
 * @property string $top
 * @property string $pajak
 * @property int|null $harga
 * @property string $catatan
 * @property int $sales
 * @property string $status
 * @property string $expired
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perusahaan', 'pic', 'top', 'pajak', 'harga'], 'required'],
            [['waktu', 'expired'], 'safe'],
            [['no_surat', 'perusahaan', 'harga', 'sales'], 'integer'],
            [['pic', 'top', 'pajak', 'status'], 'string', 'max' => 100],
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
            'waktu' => 'Waktu',
            'no_surat' => 'No.Surat',
            'perusahaan' => 'Perusahaan',
            'pic' => 'PIC',
            'top' => 'TOP',
            'pajak' => 'Pajak',
            'harga' => 'Harga',
            'catatan' => 'Catatan',
            'sales' => 'Sales',
            'status' => 'Status',
            'expired' => 'Expired',
        ];
    }
}
