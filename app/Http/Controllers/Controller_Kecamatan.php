<?php

namespace App\Http\Controllers;

use App\Models\kecamatan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Controller_Kecamatan extends Controller
{
    /**
     * fungsi index berfungsi untuk menampilkan semua data 
     */
    public function index()
    {
        $kecamatan = kecamatan::orderBy('id','ASC')->with('kelurahan')->get();

        $response=[
            'message'=>'List kecamatan order by id',
            'data'=>$kecamatan
        ];

        return response()->json($response,Response::HTTP_OK);
    }

    /**
     * fungsi store berfungsi untuk menambahkan data
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kecamatan'=>['required']
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $kecamatan=kecamatan::create($request->all());
            $response=[
                'message'=>'Data berhasil dibuat',
                'data'=>$kecamatan
            ];

            return response()->json($response,Response::HTTP_CREATED);

        } catch (QueryException $e) {
            
            return response()->json([
               'message'=> "gagal" . $e->errorInfo
            ]);

        }
    }

    /**
     * fungsi show untuk menampilkan data yang spesifik berdasarkan id
     */
    public function show($id)
    {
        $kecamatan=kecamatan::findOrFail($id);

        $response=[
            'message'=>'Data Kecamatan',
            'data'=>$kecamatan
        ];

        return response()->json($response,Response::HTTP_OK);

    }

    /**
     * fungsi update berguna untuk mlakukan edit atau update 
     * data berdasarkan id
     */
    public function update(Request $request, $id)
    {
        $kecamatan=kecamatan::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'kecamatan'=>['required']
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $kecamatan->update($request->all());

            $response=[
                'message'=>'Data berhasil diubah',
                'data'=>$kecamatan
            ];

            return response()->json($response,Response::HTTP_OK);

        } catch (QueryException $e) {
            
            return response()->json([
               'message'=> "gagal" . $e->errorInfo
            ]);

        }
    }

    /**
     * destroy berguna untuk menghapus data berdasarkan id
     */
    public function destroy($id)
    {
        $kecamatan=kecamatan::findOrFail($id);

       
        try {
            $kecamatan->delete();

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
