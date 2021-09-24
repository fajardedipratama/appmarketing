<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_permit".
 *
 * @property int $id
 * @property int|null $karyawan_id
 * @property string $kategori
 * @property string|null $tgl_mulai
 * @property string|null $tgl_selesai
 * @property string|null $jam_masuk
 * @property string|null $jam_keluar
 * @property string $alasan
 * @property string $status
 * @property string|null $created_time
 */
class Permit extends \yii\db\ActiveRecord
{
    public $set_awal,$set_akhir;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_permit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['karyawan_id'], 'integer'],
            [['kategori', 'alasan','tgl_mulai', 'tgl_selesai'], 'required'],
            [['tgl_mulai', 'tgl_selesai', 'jam_masuk', 'jam_keluar', 'created_time','set_awal','set_akhir'], 'safe'],
            [['kategori', 'status'], 'string', 'max' => 30],
            [['alasan'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'karyawan_id' => 'Karyawan',
            'kategori' => 'Kategori',
            'tgl_mulai' => 'Tanggal Izin',
            'tgl_selesai' => 'Tanggal Selesai',
            'jam_masuk' => 'Jam Masuk/Kembali',
            'jam_keluar' => 'Jam Keluar',
            'alasan' => 'Alasan',
            'status' => 'Status',
            'created_time' => 'Created Time',
            'set_awal'=> 'Dari',
            'set_akhir'=> 'Sampai',
        ];
    }
    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id' => 'karyawan_id']);
    }
    public function beforeSave($options = array()) {
        if(strtotime($this->tgl_mulai) > strtotime($this->tgl_selesai)){
            echo Yii::$app->getSession()->setFlash('error','Tanggal Izin melebihi Tanggal Selesai');  
        }else{
            return true;
        }
    }
}
