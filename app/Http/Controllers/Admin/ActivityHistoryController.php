<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityHistoryController extends Controller
{
    public function index(){
        return view('admin.history.index');
    }
}
