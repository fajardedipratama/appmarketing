<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_attendance_data".
 *
 * @property int $id
 * @property int $karyawan_id
 * @property string $work_day
 * @property string|null $work_date
 * @property string|null $schedule_in
 * @property string|null $schedule_out
 * @property string|null $real_in
 * @property string|null $real_out
 */
class AttendanceData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_attendance_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['karyawan_id', 'work_day'], 'required'],
            [['karyawan_id'], 'integer'],
            [['work_date', 'schedule_in', 'schedule_out', 'real_in', 'real_out'], 'safe'],
            [['work_day'], 'string', 'max' => 10],
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
            'work_day' => 'Hari',
            'work_date' => 'Tanggal',
            'schedule_in' => 'Jadwal Masuk',
            'schedule_out' => 'Jadwal Pulang',
            'real_in' => 'Absen Masuk',
            'real_out' => 'Absen Pulang',
        ];
    }
}
