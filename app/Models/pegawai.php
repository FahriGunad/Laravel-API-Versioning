<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;
    protected $table = "pegawai";
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'nip',
        'alamat',
    ];
}
