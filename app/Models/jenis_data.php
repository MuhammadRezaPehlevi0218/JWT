<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_data extends Model
{
    use HasFactory;

    protected $fillable=[
        'jenis'
    ];

    public function Jenis_data(){
        return $this->hasMany(laporan::class,'id_jenis_datas');
    }

    public function Search($request)
    {

        $laporan=laporan::where('jenis','like',$request)
                 ->with('Jenis_data')->get();

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }
}
