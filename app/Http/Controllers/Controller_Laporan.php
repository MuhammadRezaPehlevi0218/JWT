<?php

namespace App\Http\Controllers;

use App\Models\laporan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Controller_laporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = laporan::orderBy('id','ASC')->with('Kelurahan','jenis_datas')->get();

        $response=[
            'message'=>'List Laporan order by id',
            'data'=>$laporan
        ];

        return response()->json($response,Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_kelurahans'=>['required','numeric'],
            'tahun'=>['required'],
            'semester'=>['required'],
            'id_jenis_datas'=>['required','numeric'],
            'keterangan'=>['required'],
            'value'=>['required']
        ]);
        
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $laporan=laporan::create($request->all());
            $response=[
                'message'=>'Data berhasil dibuat',
                'data'=>$laporan
            ];

            return response()->json($response,Response::HTTP_CREATED);

        } catch (QueryException $e) {
            
            return response()->json([
                'message'=> "gagal" . $e->errorInfo
             ]);
 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan=laporan::findOrFail($id);

        $response=[
            'message'=>'Data Laporan',
            'data'=>$laporan
        ];

        return response()->json($response,Response::HTTP_OK);

    }


    public function filter($request)
    {
        $response = new laporan();

        return response()->json($response->Search($request),Response::HTTP_OK);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $laporan=laporan::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'id_kelurahans'=>['required'],
            'tahun'=>['required'],
            'semester'=>['required'],
            'id_jenis_datas'=>['required'],
            'keterangan'=>['required'],
            'value'=>['required'],
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $laporan->update($request->all());

            $response=[
                'message'=>'Data berhasil diubah',
                'data'=>$laporan
            ];

            return response()->json($response,Response::HTTP_OK);

        } catch (QueryException $e) {
            
            return response()->json([
               'message'=> "gagal" . $e->errorInfo
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laporan=laporan::findOrFail($id);

       
        try {
            $laporan->delete();

            $response=[
                'message'=>'Data berhasil dihapus',
            ];

            return response()->json($response,Response::HTTP_OK);

        } catch (QueryException $e) {
            
            return response()->json([
               'message'=> "gagal" . $e->errorInfo
            ]);

        }
    }
}
