<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_employee".
 *
 * @property int $id
 * @property int|null $karyawan_id
 * @property int|null $komponen_id
 * @property int|null $nilai
 */
class SalaryEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['karyawan_id', 'komponen_id', 'nilai'], 'integer'],
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
            'komponen_id' => 'Komponen Gaji',
            'nilai' => 'Nilai',
        ];
    }
}
