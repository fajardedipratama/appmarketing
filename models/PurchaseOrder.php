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
 * @property int|null $kota_kirim
 * @property string $alamat_kirim
 * @property string $purchasing
 * @property string $keuangan
 * @property int $volume
 * @property string $termin
 * @property int $harga
 * @property int|null $cashback
 * @property string $pajak
 * @property string $pembayaran
 * @property int|null $bilyet_giro
 * @property string $status
 * @property string $catatan
 * @property string $alasan_tolak
 * @property string $penerima
 * @property int|null $penalti
 * @property string|null $jatuh_tempo
 * @property string|null $tgl_lunas
 * @property int|null $range_paid
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    public $set_awal,$set_akhir;
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
            [['perusahaan', 'no_po', 'tgl_po', 'tgl_kirim', 'alamat', 'kota_kirim', 'alamat_kirim', 'purchasing','volume', 'termin', 'harga', 'pajak', 'pembayaran','catatan'], 'required'],
            [['perusahaan', 'sales', 'kota_kirim', 'volume', 'harga', 'cashback','bilyet_giro','penalti','range_paid'], 'integer'],
            [['tgl_po', 'tgl_kirim','set_awal','set_akhir','jatuh_tempo','tgl_lunas'], 'safe'],
            [['no_po', 'purchasing', 'keuangan', 'termin', 'pajak', 'pembayaran', 'status','penerima'], 'string', 'max' => 100],
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
            'kota_kirim' => 'Kab/Kota Kirim',
            'alamat_kirim' => 'Alamat Kirim',
            'purchasing' => 'Purchasing',
            'keuangan' => 'Keuangan',
            'volume' => 'Volume(l)',
            'termin' => 'Pembayaran',
            'harga' => 'Harga/liter (Total)',
            'cashback' => 'Cashback',
            'pajak' => 'Pajak',
            'pembayaran' => 'Metode Bayar',
            'bilyet_giro' => 'Backup BG ?',
            'status' => 'Status',
            'catatan' => 'Catatan',
            'alasan_tolak' => 'Alasan Tolak',
            'penerima' => 'Penerima + No.Hp',
            'penalti' => 'Penalti',
            'set_awal'=> 'Dari',
            'set_akhir'=> 'Sampai',
            'jatuh_tempo' => 'Jatuh Tempo',
            'tgl_lunas' => 'Tanggal Lunas',
            'range_paid' => 'Kirim-Bayar',
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
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'kota_kirim']);
    }
}
