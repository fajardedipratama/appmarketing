<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_type".
 *
 * @property int $id
 * @property string $tipe_gaji
 */
class SalaryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipe_gaji'], 'required'],
            [['tipe_gaji'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipe_gaji' => 'Tipe Gaji',
        ];
    }
}
