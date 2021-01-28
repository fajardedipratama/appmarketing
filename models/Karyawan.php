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
 * @property int|null $departemen
 * @property string $bank
 * @property string $no_rekening
 * @property string $nama_rekening
 * @property string $foto_karyawan
 * @property string $status_aktif
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
            [['nama', 'gender', 'tempat_lahir', 'tanggal_lahir', 'no_hp', 'alamat_rumah', 'pendidikan', 'status_kawin', 'tanggal_masuk', 'posisi'], 'required'],
            [['tanggal_lahir', 'tanggal_masuk'], 'safe'],
            [['posisi', 'departemen'], 'integer'],
            [['badge', 'nama', 'gender', 'tempat_lahir', 'no_hp', 'no_ktp', 'pendidikan', 'status_kawin', 'bank','no_rekening',  'nama_rekening', 'status_aktif'], 'string', 'max' => 100],
            [['alamat_ktp', 'alamat_rumah'], 'string', 'max' => 1000],
             [['foto_karyawan'], 'file', 'extensions' => 'png, jpg, jpeg','mimeTypes'=>'image/jpeg,image/png', 'maxSize'=>1048576,'skipOnEmpty'=>true],
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
            'badge' => 'NIP',
            'nama' => 'Nama Lengkap',
            'gender' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'no_hp' => 'No.HP',
            'no_ktp' => 'No.KTP',
            'alamat_ktp' => 'Alamat KTP',
            'alamat_rumah' => 'Alamat Tempat Tinggal',
            'pendidikan' => 'Pendidikan',
            'status_kawin' => 'Status Nikah',
            'tanggal_masuk' => 'Tanggal Masuk',
            'posisi' => 'Jabatan',
            'departemen' => 'Departemen',
            'bank' => 'Bank',
            'no_rekening' => 'No. Rekening',
            'nama_rekening' => 'Nama Rekening',
            'foto_karyawan' => 'Foto Karyawan',
            'status_aktif' => 'Status Karyawan',
        ];
    }
}
