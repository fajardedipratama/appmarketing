<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_exkaryawan".
 *
 * @property int $id
 * @property int $badge
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
            [['badge', 'alasan', 'tgl_resign'], 'required'],
            [['badge'], 'integer'],
            [['tgl_resign'], 'safe'],
            [['alasan'], 'string', 'max' => 1000],
            [['badge'], 'unique'],
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
            'alasan' => 'Alasan',
            'tgl_resign' => 'Tanggal Resign',
            'nama_karyawan' => 'Nama Karyawan',
        ];
    }

}
