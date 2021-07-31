<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_additional".
 *
 * @property int $id
 * @property int|null $karyawan_id
 * @property int|null $komponen_id
 * @property string|null $tanggal
 * @property int|null $nilai
 * @property string $catatan
 */
class SalaryAdditional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_additional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nilai'], 'required'],
            [['karyawan_id', 'komponen_id', 'nilai'], 'integer'],
            [['tanggal'], 'safe'],
            [['catatan'], 'string', 'max' => 100],
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
            'komponen_id' => 'Komponen',
            'tanggal' => 'Tanggal',
            'nilai' => 'Nilai',
            'catatan' => 'Catatan',
        ];
    }
    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id' => 'karyawan_id']);
    }
    public function getKomponen()
    {
        return $this->hasOne(SalaryCategory::className(), ['id' => 'komponen_id']);
    }
}
