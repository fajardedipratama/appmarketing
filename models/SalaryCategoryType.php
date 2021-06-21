<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_category_type".
 *
 * @property int $id
 * @property int $tipegaji_id
 * @property int $kategori_id
 */
class SalaryCategoryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_category_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipegaji_id', 'kategori_id'], 'required'],
            [['tipegaji_id', 'kategori_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipegaji_id' => 'Tipegaji ID',
            'kategori_id' => 'Kategori ID',
        ];
    }
}
