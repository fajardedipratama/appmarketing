<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_offer".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $waktu
 * @property int|null $no_surat
 * @property int $perusahaan
 * @property string $pic
 * @property string $top
 * @property string $pajak
 * @property int|null $harga
 * @property string $catatan
 * @property int $sales
 * @property string $status
 * @property string $is_new
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perusahaan', 'pic', 'top', 'pajak', 'harga'], 'required'],
            [['tanggal','waktu'], 'safe'],
            [['no_surat', 'perusahaan', 'harga', 'sales'], 'integer'],
            [['pic', 'top', 'pajak', 'status','is_new'], 'string', 'max' => 100],
            [['catatan'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'waktu' => 'Jam',
            'no_surat' => 'No.Surat',
            'perusahaan' => 'Perusahaan',
            'pic' => 'PIC',
            'top' => 'TOP',
            'pajak' => 'Pajak',
            'harga' => 'Harga',
            'catatan' => 'Catatan',
            'sales' => 'Sales',
            'status' => 'Status',
            'is_new' => 'Penawaran Baru ?'
        ];
    }

    public function beforeSave($options = array()) {
        $this->pic=ucwords(strtolower($this->pic));
        if($this->isNewRecord){
            $this->status='Pending';
            $this->tanggal=date('Y-m-d');
            $this->waktu=date('H:i:s');
        }

        $cek_new=Offer::find()->where(['sales'=>$this->sales,'perusahaan'=>$this->perusahaan])->count();
        if($cek_new>0){
            $this->is_new = 'no';
        }else{
            $this->is_new = 'yes';
        }

        return true;
    }
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'perusahaan']);
    }
    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id' => 'sales']);
    }
}
