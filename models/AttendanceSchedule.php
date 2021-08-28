<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_attendance_schedule".
 *
 * @property int $id
 * @property string $hari
 * @property string|null $jam_masuk
 * @property string|null $jam_pulang
 * @property string $status
 */
class AttendanceSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_attendance_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hari', 'status'], 'required'],
            [['jam_masuk', 'jam_pulang'], 'safe'],
            [['hari', 'status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hari' => 'Hari',
            'jam_masuk' => 'Jam Masuk',
            'jam_pulang' => 'Jam Pulang',
            'status' => 'Status',
        ];
    }
}
