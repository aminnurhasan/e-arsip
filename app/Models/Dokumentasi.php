<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table = 'dokumentasi';
    protected $fillable = [
        'tanggal_kegiatan',
        'nama_kegiatan',
    ];

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }
}
