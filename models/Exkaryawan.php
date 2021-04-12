<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_exkaryawan".
 *
 * @property int $id
 * @property int $id_employee
 * @property string $alasan
 * @property string $tgl_resign
 */
class Exkaryawan extends \yii\db\ActiveRecord
{
    public $nama_karyawan;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_exkaryawan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'alasan', 'tgl_resign'], 'required'],
            [['id_employee'], 'integer'],
            [['tgl_resign'], 'safe'],
            [['alasan'], 'string', 'max' => 1000],
            [['id_employee'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_employee' => 'ID',
            'alasan' => 'Alasan',
            'tgl_resign' => 'Tanggal Resign',
            'nama_karyawan' => 'Nama Karyawan',
        ];
    }

    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id' => 'id_employee']);
    }

}
