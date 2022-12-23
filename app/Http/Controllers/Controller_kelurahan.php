<?php

namespace App\Http\Controllers;

use App\Models\kelurahan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Controller_kelurahan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = kelurahan::orderBy('id','ASC')->with('Kecamatan')->get();

        $response=[
            'message'=>'List Kelurahan order by id',
            'data'=>$kelurahan
        ];

        return response()->json($response,Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'id_kecamatans'=>['required', 'numeric'],
            'kelurahan'=>['required']
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $kelurahan=kelurahan::create($request->all());
            $response=[
                'message'=>'Data berhasil dibuat',
                'data'=>$kelurahan
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
        $kelurahan=kelurahan::findOrFail($id);

        $response=[
            'message'=>'Data kelurahan',
            'data'=>$kelurahan
        ];

        return response()->json($response,Response::HTTP_OK);

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
        $kelurahan=kelurahan::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'kelurahan'=>['required']
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $kelurahan->update($request->all());

            $response=[
                'message'=>'Data berhasil diubah',
                'data'=>$kelurahan
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
        $kelurahan=kelurahan::findOrFail($id);

       
        try {
            $kelurahan->delete();

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
