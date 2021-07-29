<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_hubtype".
 *
 * @property int $id
 * @property int|null $salary_type
 * @property int|null $salary_category
 */
class SalaryHubtype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_hubtype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salary_type', 'salary_category'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salary_type' => 'Tipe Gaji',
            'salary_category' => 'Komponen Gaji',
        ];
    }
}
