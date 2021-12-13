<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_kas_akun".
 *
 * @property int $id
 * @property int|null $kode
 * @property string $kategori
 */
class KasAkun extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_kas_akun';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode'], 'integer'],
            [['kategori'], 'required'],
            [['kategori'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'kategori' => 'Kategori',
        ];
    }
}
