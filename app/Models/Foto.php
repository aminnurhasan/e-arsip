<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table = 'foto';
    protected $fillable = [
        'dokumentasi_id',
        'file',
    ];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class);
    }
}
