<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_karyawan".
 *
 * @property int $id
 * @property string $badge
 * @property string $nama
 * @property string $gender
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $no_hp
 * @property string $no_ktp
 * @property string $alamat_ktp
 * @property string $alamat_rumah
 * @property string $pendidikan
 * @property string $status_kawin
 * @property string $tanggal_masuk
 * @property int $posisi
 * @property int $departemen
 * @property string $bank
 * @property int $no_rekening
 * @property string $nama_rekening
 * @property int $status_aktif
 */
class Karyawan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_karyawan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['badge', 'nama', 'gender', 'tempat_lahir', 'tanggal_lahir', 'no_hp', 'no_ktp', 'alamat_ktp', 'alamat_rumah', 'pendidikan', 'status_kawin', 'tanggal_masuk', 'posisi', 'departemen', 'bank', 'no_rekening', 'nama_rekening', 'status_aktif'], 'required'],
            [['tanggal_lahir', 'tanggal_masuk'], 'safe'],
            [['posisi', 'departemen', 'no_rekening', 'status_aktif'], 'integer'],
            [['badge', 'nama', 'gender', 'tempat_lahir', 'no_hp', 'no_ktp', 'pendidikan', 'status_kawin', 'bank', 'nama_rekening'], 'string', 'max' => 100],
            [['alamat_ktp', 'alamat_rumah'], 'string', 'max' => 1000],
            [['badge'], 'unique'],
            [['no_ktp'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'badge' => 'Badge',
            'nama' => 'Nama',
            'gender' => 'Gender',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'no_hp' => 'No Hp',
            'no_ktp' => 'No Ktp',
            'alamat_ktp' => 'Alamat Ktp',
            'alamat_rumah' => 'Alamat Rumah',
            'pendidikan' => 'Pendidikan',
            'status_kawin' => 'Status Kawin',
            'tanggal_masuk' => 'Tanggal Masuk',
            'posisi' => 'Posisi',
            'departemen' => 'Departemen',
            'bank' => 'Bank',
            'no_rekening' => 'No Rekening',
            'nama_rekening' => 'Nama Rekening',
            'status_aktif' => 'Status Aktif',
        ];
    }
}
