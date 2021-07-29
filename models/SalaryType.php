<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_type".
 *
 * @property int $id
 * @property string $type
 * @property int|null $prorate

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
            [['type'], 'required'],
            [['prorate'], 'integer'],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Tipe Gaji',
            'prorate' => 'Prorate ?',
        ];
    }
}
