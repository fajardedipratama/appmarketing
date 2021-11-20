<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_calculator".
 *
 * @property int $id
 * @property string $komponen
 * @property int|null $persentase
 */
class Calculator extends \yii\db\ActiveRecord
{
    public $dpp_value;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_calculator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persentase','dpp_value'], 'integer'],
            [['komponen'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'komponen' => 'Komponen',
            'persentase' => 'Persentase',
            'dpp_value' => 'Nominal DPP',
        ];
    }
}
