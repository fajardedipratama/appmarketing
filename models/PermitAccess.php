<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_permit_access".
 *
 * @property int $id
 * @property int|null $karyawan_id
 * @property string $tipe_akses
 * @property string $tanda_tangan
 */
class PermitAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_permit_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['karyawan_id'], 'integer'],
            [['tipe_akses'], 'required'],
            [['tipe_akses'], 'string', 'max' => 100],
            [['tanda_tangan'], 'file', 'extensions' => 'jpg,jpeg,png','mimeTypes'=>'image/jpg,image/jpeg,image/png', 'maxSize'=>1048576,'skipOnEmpty'=>true],
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
            'tipe_akses' => 'Tipe Akses',
            'tanda_tangan' => 'Tanda Tangan',
        ];
    }

    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id' => 'karyawan_id']);
    }
}
