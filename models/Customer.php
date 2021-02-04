<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_customer".
 *
 * @property int $id
 * @property string $perusahaan
 * @property string $lokasi
 * @property string $alamat_lengkap
 * @property string $pic
 * @property string $telfon
 * @property string $email
 * @property string $catatan
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perusahaan', 'lokasi', 'alamat_lengkap', 'pic', 'telfon', 'email', 'catatan'], 'required'],
            [['perusahaan', 'lokasi', 'pic', 'telfon', 'email'], 'string', 'max' => 100],
            [['alamat_lengkap', 'catatan'], 'string', 'max' => 1000],
            [['perusahaan'], 'unique'],
            [['telfon'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perusahaan' => 'Perusahaan',
            'lokasi' => 'Lokasi',
            'alamat_lengkap' => 'Alamat Lengkap',
            'pic' => 'Pic',
            'telfon' => 'Telfon',
            'email' => 'Email',
            'catatan' => 'Catatan',
        ];
    }
}
