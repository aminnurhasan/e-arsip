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
        'laporan',
        'dp2',
        'dp3',
        'dp4',
    ];

    public static $disposisiLabels = [
        2 => 'Kepala Badan',
        3 => 'Sekretaris',
        4 => 'Bidang Anggaran',
        5 => 'Bidang Perbendaharaan',
        6 => 'Bidang Akuntansi',
        7 => 'Bidang Aset',
        8 => 'SubBag Perencanaan & Evaluasi',
        9 => 'SubBag Keuangan',
        10 => 'SubBag Umum & Kepegawaian',
        11 => 'SubBid Anggaran Pendapatan & Pembiayaan',
        12 => 'SubBid Anggaran Belanja',
        13 => 'SubBid Pengelolaan Kas',
        14 => 'SubBid Administrasi Perbendahaan',
        15 => 'SubBid Pembukuan & Pelaporan',
        16 => 'SubBid Verifikasi',
        17 => 'SubBid Perencanaan & Penatausahaan',
        18 => 'SubBid Penggunaan dan Pemanfaatan'
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}
