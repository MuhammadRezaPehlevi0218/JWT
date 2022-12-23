<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class laporan extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_kelurahans',
        'tahun',
        'semster',
        'id_jenis_data',
        'keterangan',
        'value',
    ];

    public function Kelurahan(){
        return $this->belongsTo(kelurahan::class,'id_kelurahans');
    }

    public function jenis_datas(){
        return $this->belongsTo(jenis_data::class,'id_jenis_datas');
    }

    
    public function Search($request)
    {

        $laporan=laporan::where('keterangan','like',$request)
                 ->orWhere('id_jenis_datas','like',$request)
                 ->with('Kelurahan')->with('jenis_datas')->get();

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

    public function DataKelurahan()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 1');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

     public function DataPenduduk()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 2');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

     public function DataPenganutKepercayaan()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 3');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

     public function DataJenisKelamin()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 4');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

     public function DataStatusPerkawinan()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 5');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

     public function DataKelompokUsia()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 6');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

     public function DataPertumbuhanPenduduk()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 7');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

     public function DataUsiaPendidikan()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 8');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }
    public function DataTingkatPendidikan()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 9');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

    public function DataGolonganDarah()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 10');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

    public function DataStatusPekerjaan()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 11');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

    public function Data()
    {

        $laporan=DB::select('select * from laporans WHERE id_jenis_datas = 12');

        $response=[
            'message'=>'Data Kelurahan',
            'data'=>[$laporan]
        ];
        
        return $response;

    }

}
