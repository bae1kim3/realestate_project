<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->query('keyword'); // 검색어 가져오기

        // 검색어를 활용하여 데이터베이스에서 검색 수행
        $results = DB::table('s_info')
            ->where('s_add', 'like', "%$keyword%")
            ->orWhere('s_stai', 'like', "%$keyword%")
            ->get();

        return response()->json(['properties' => $results]);
    }

}
