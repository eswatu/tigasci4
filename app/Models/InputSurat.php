<?php namespace App\Models;
use CodeIgniter\Model;
class InputSurat extends Model
{
protected $table = 'inputsurat';
protected $primaryKey = 'id';
protected $allowedFields = ['nomor_surat','tanggal_surat','pengirim','judul_surat'];
}
