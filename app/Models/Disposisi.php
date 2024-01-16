<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'disposisi';
    public $timestamps = false;

    protected $fillable = [
        'agenda_id',
        'disposisi',
        'catatan',
        'laporan'
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}
