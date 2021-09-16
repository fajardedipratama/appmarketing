<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_holiday".
 *
 * @property int $id
 * @property string $nama_hari
 * @property string|null $tanggal
 */
class Holiday extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_holiday';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_hari'], 'required'],
            [['tanggal'], 'safe'],
            [['nama_hari'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_hari' => 'Nama Hari Libur',
            'tanggal' => 'Tanggal',
        ];
    }
}
