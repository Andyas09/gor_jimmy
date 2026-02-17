<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Jenis;

class Booking extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'booking';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'kode',
        'nama',
        'whatsapp',
        'jenis',
        'lapangan',
        'jadwal',
        'hari',
        'tanggal',
        'dp',
        'total_bayar',
        'status',
        'bukti',
        'invoice',
    ];
    public function lap()
    {
        return $this->belongsTo(Lapangan::class, foreignKey: 'lapangan');
    }
    public function jad()
    {
        return $this->belongsTo(Jadwal::class, foreignKey: 'jadwal');
    }

}