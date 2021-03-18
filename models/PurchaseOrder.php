<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_purchase_order".
 *
 * @property int $id
 * @property int $perusahaan
 * @property int $sales
 * @property string $no_po
 * @property string $tgl_po
 * @property string $tgl_kirim
 * @property string $alamat
 * @property string $alamat_kirim
 * @property string $purchasing
 * @property string $no_purchasing
 * @property string $keuangan
 * @property string $no_keuangan
 * @property int $volume
 * @property string $termin
 * @property int $harga
 * @property int|null $cashback
 * @property string $pajak
 * @property string $pembayaran
 * @property string $status
 * @property string $catatan
 * @property string $alasan_tolak
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_purchase_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perusahaan', 'no_po', 'tgl_po', 'tgl_kirim', 'alamat', 'alamat_kirim', 'purchasing', 'no_purchasing', 'volume', 'termin', 'harga', 'pajak', 'pembayaran'], 'required'],
            [['perusahaan', 'sales', 'volume', 'harga', 'cashback'], 'integer'],
            [['tgl_po', 'tgl_kirim'], 'safe'],
            [['no_po', 'purchasing', 'no_purchasing', 'keuangan', 'no_keuangan', 'termin', 'pajak', 'pembayaran', 'status'], 'string', 'max' => 100],
            [['alamat', 'alamat_kirim', 'catatan', 'alasan_tolak'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perusahaan' => 'Perusahaan',
            'sales' => 'Sales',
            'no_po' => 'No.PO',
            'tgl_po' => 'Tanggal PO',
            'tgl_kirim' => 'Tanggal Kirim',
            'alamat' => 'Alamat Perusahaan',
            'alamat_kirim' => 'Alamat Kirim',
            'purchasing' => 'Purchasing',
            'no_purchasing' => 'No.Purchasing',
            'keuangan' => 'Keuangan',
            'no_keuangan' => 'No.Keuangan',
            'volume' => 'Volume(l)',
            'termin' => 'Pembayaran',
            'harga' => 'Harga/liter (Total)',
            'cashback' => 'Cashback',
            'pajak' => 'Pajak',
            'pembayaran' => 'Metode Bayar',
            'status' => 'Status',
            'catatan' => 'Catatan',
            'alasan_tolak' => 'Alasan Tolak',
        ];
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
