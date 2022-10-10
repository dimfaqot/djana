<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksis extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'no_nota', 'tgl', 'penerima_order', 'pj_order', 'produk', 'harga', 'qty', 'jumlah', 'catatan', 'progres', 'uang_modal', 'tgl_uangkeluar', 'uang_keluar', 'ket_uangkeluar', 'pj_uangkeluar', 'nota_uangkeluar', 'tgl_uangmasuk', 'uang_masuk', 'penerima_uangmasuk', 'ket_uangmasuk', 'tgl_diterimabendahara', 'ket'];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function cols()
    {
        return $this->allowedFields;
    }
}
