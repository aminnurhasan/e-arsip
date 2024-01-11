<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;
    public $table = 'arsip';
    protected $timestamp = false;

    protected $fillable = [
        'pengelola',
        'jenis_dokumen',
        'tanggal_dokumen',
        'nomor_dokumen',
        'asal_dokumen',
        'perihal',
        'file_path',
    ];
}
