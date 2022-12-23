<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelurahan extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_kecamatans',
        'kelurahan'
    ];

    public function Kecamatan(){
        return $this->belongsTo(kecamatan::class,'id_kecamatans');
    }

    public function Laporan(){
        return $this->hasMany(laporan::class,'id_kelurahans');
    }
}
