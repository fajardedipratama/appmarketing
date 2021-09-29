<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_report".
 *
 * @property int $id
 * @property int|null $bulan
 * @property int|null $tahun
 * @property string|null $awal_cutoff
 * @property string|null $akhir_cutoff
 * @property string $lock_report
 */
class SalaryReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bulan', 'tahun'], 'integer'],
            [['awal_cutoff', 'akhir_cutoff'], 'safe'],
            [['lock_report'], 'string', 'max' => 10],
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
            'awal_cutoff' => 'Awal Cutoff',
            'akhir_cutoff' => 'Akhir Cutoff',
            'lock_report' => 'Kunci Laporan',
        ];
    }
}
