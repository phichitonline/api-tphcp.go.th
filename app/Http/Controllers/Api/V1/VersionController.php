<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->limit == NULL) {
            $data_limit = 5000;
        } else {
            $data_limit = intval($request->limit);
        }

        if ($request->perpage == NULL) {
            $perpage = 10;
            $perpage2 = "f";
        } else {
            $perpage = intval($request->perpage);
            $perpage2 = "t";
        }

        $page_count = ceil($data_limit / $perpage);

        if ($request->page < $page_count) {
            $last_page = $perpage;
        } else if ($request->page == $page_count) {
            $last_page = $data_limit - (($request->page - 1) * $perpage);
        } else {
            $last_page = 0;
        }

        if ($request->page == NULL) {
            $pagestart = 0;
            $page = 1;
            $page2 = "not defined";
            $page_limit = "LIMIT ".$data_limit."";
            $perpage3 = "not defined";
        } else {
            if ($perpage2 == "f") {
                $perpage3 = 10;
            } else {
                $perpage3 = intval($request->perpage);
            }

            $pagestart = ($request->page - 1) * $perpage;
            $page = intval($request->page);
            $page2 = intval($request->page);
            $page_limit = "LIMIT ".$pagestart.",".$last_page."";
        }

        $patient = DB::connection('mysql_his')->select('
        SELECT hn,pname,fname,lname FROM patient ORDER BY hn ASC '.$page_limit.'
        ');

        return [
            'version' => "1.2",
            'last_updated' => "2022-07-01",
            'limit' => $data_limit,
            'page' => $page2,
            'perpage' => $perpage3,
            'page_count' => $page_count,
            'current_data_count' => $last_page,
            'data' => $patient,
        ];

        // return Patient::orderBy('hn', 'desc')->paginate(25);
    }


}
