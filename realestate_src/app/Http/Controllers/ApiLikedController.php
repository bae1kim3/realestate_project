<?php

namespace App\Http\Controllers;

use App\Models\Jjim;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiLikedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log::debug('apiLikedStore : Start', ['id' =>$request->id, 'license' => $request->seller_license]);
        $arr['errorcode'] = '0';
        $arr['msg'] = 'success';
        
        if($request->id && !($request->seller_license)) {
            Jjim::create([
                's_no' => $request->s_no, 
                'id' => $request->id
            ]);
        return $arr;

        }
        else {
            $arr['errorcode'] = 'E01';
            $arr['msg'] = 'Not login';
            return response()->json($arr,HttpResponse::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $arr['errorcode'] = '0';
        $arr['msg'] = 'success';
        if($request->id && !($request->seller_license)) {
            // $query = " DELETE FROM jjims where s_no = $request->s_no AND id = $request->id ";
            // DB::delete($query);
            Jjim::where('s_no', $request->s_no)
                ->where('id', $request->id)
                ->delete();

        return $arr;

        }
        else {
            $arr['errorcode'] = 'E01';
            $arr['msg'] = 'Not login';
            return response()->json($arr,HttpResponse::HTTP_OK);
        }

    }
}
