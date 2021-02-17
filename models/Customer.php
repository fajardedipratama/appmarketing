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
 * @property int|null $sales
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
            [['perusahaan', 'lokasi'], 'required'],
            [['perusahaan', 'lokasi', 'pic', 'telfon'], 'string', 'max' => 100],
            [['alamat_lengkap', 'catatan'], 'string', 'max' => 1000],
            [['sales'], 'integer'],
            [['perusahaan'], 'unique'],
            [['email'], 'email', 'message'=>'Penulisan alamat email tidak valid, pastikan ada @ dan diakhiri dengan domain'],
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
            'lokasi' => 'Kab/Kota',
            'alamat_lengkap' => 'Alamat',
            'pic' => 'PIC',
            'telfon' => 'Telfon',
            'email' => 'Email',
            'catatan' => 'Catatan',
            'sales' => 'Sales'
        ];
    }
    
    public function beforeSave($options = array()) {
        $this->perusahaan = strtoupper($this->perusahaan);

        return true;
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'lokasi']);
    }
     public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id' => 'sales']);
    }
}
