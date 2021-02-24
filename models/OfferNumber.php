<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_offer_number".
 *
 * @property int $id
 * @property int|null $nomor
 * @property string $inisial
 */
class OfferNumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_offer_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor'], 'integer'],
            [['inisial'], 'required'],
            [['inisial'], 'string', 'max' => 100],
            [['nomor'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor' => 'Nomor',
            'inisial' => 'Inisial',
        ];
    }
}
