<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_permit".
 *
 * @property int $id
 * @property int|null $karyawan_id
 * @property string $kategori
 * @property string|null $tgl_izin
 * @property string|null $jam_masuk
 * @property string|null $jam_keluar
 * @property string $alasan
 * @property string $status
 * @property string|null $created_time
 */
class Permit extends \yii\db\ActiveRecord
{
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
            [['kategori', 'alasan'], 'required'],
            [['tgl_izin', 'jam_masuk', 'jam_keluar', 'created_time'], 'safe'],
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
            'tgl_izin' => 'Tanggal',
            'jam_masuk' => 'Jam Masuk',
            'jam_keluar' => 'Jam Keluar',
            'alasan' => 'Alasan',
            'status' => 'Status',
            'created_time' => 'Created Time',
        ];
    }
}
