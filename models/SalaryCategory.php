<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_salary_category".
 *
 * @property int $id
 * @property string $nama
 * @property string $jenis
 * @property string $status
 * @property string $keterangan
 */
class SalaryCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_salary_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'jenis'], 'required'],
            [['nama', 'jenis', 'status'], 'string', 'max' => 100],
            [['keterangan'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'jenis' => 'Jenis',
            'status' => 'Status',
            'keterangan' => 'Keterangan',
        ];
    }
}
