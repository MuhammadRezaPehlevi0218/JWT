<?php

namespace App\Http\Controllers;

use App\Models\jenis_data;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class Controller_JenisData extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_data = jenis_data::orderBy('id','ASC')->get();

        $response=[
            'message'=>'List Jenis data order by id',
            'data'=>$jenis_data
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
            'jenis'=>['required']
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $jenis_data=jenis_data::create($request->all());
            $response=[
                'message'=>'Data berhasil dibuat',
                'data'=>$jenis_data
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
        $jenis_data=jenis_data::findOrFail($id);

        $response=[
            'message'=>'Data jenis data',
            'data'=>$jenis_data
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
        $jenis_data=jenis_data::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'jenis'=>['required']
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        try {
            $jenis_data->update($request->all());

            $response=[
                'message'=>'Data berhasil diubah',
                'data'=>$jenis_data
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
        $jenis_data=jenis_data::findOrFail($id);

       
        try {
            $jenis_data->delete();

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
