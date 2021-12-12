<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActicityHistory;

class ActivityHistoryController extends Controller
{
    public function index(){
        $listHistory = ActicityHistory::orderBy('id', 'DESC')->paginate();
        return view('admin.history.index', ['listHistory' => $listHistory]);
    }

    public function detail($id){
        $listHistory = ActicityHistory::where('user_id', $id)->orderBy('id', 'DESC')->paginate();
        return view('admin.history.detail', ['listHistory' => $listHistory]);
    }
}
