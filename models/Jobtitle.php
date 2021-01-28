<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_jobtitle".
 *
 * @property int $id
 * @property string $posisi
 * @property int $departemen
 */
class Jobtitle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_jobtitle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['posisi', 'departemen'], 'required'],
            [['departemen'], 'integer'],
            [['posisi'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'posisi' => 'Jabatan',
            'departemen' => 'Departemen',
        ];
    }

    public function getDepartement()
    {
        return $this->hasOne(Departemen::className(), ['id' => 'departemen']);
    }
}
