<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_calculate".
 *
 * @property int $id
 * @property int|null $bulan
 * @property int|null $tahun
 * @property string|null $begin_date
 * @property string|null $end_date
 * @property string|null $begin_absen
 * @property string|null $end_absen
 * @property string|null $date_calculate
 * @property int|null $user_calculate
 */
class SalaryCalculate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_calculate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bulan', 'tahun', 'user_calculate'], 'integer'],
            [['begin_date','end_date','begin_absen','end_absen','date_calculate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bulan' => 'Bulan',
            'tahun' => 'Tahun',
            'begin_date' => 'Tanggal PO Awal',
            'end_date' => 'Tanggal PO Akhir',
            'begin_absen' => 'Tanggal Awal Absensi',
            'end_absen' => 'Tanggal Akhir Absensi',
            'date_calculate' => 'Date Calculate',
            'user_calculate' => 'User Calculate',
        ];
    }
}
