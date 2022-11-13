<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index()
    {
        return Patient::orderBy('hn', 'asc')->paginate(25);
    }

}
