<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'agenda';
    public $timestamps = false;
    
    protected $fillable = [
        'jenis_dokumen',
        'tanggal_dokumen',
        'nomor_dokumen',
        'asal_dokumen',
        'perihal',
        'tanggal_kegiatan',
        'file_path',
        'tindak_lanjut',
        'status'
    ];

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class);
    }
}
