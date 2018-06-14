<?php

namespace cjango\CPanel\Controllers;

use cjango\CPanel\Models\AdminOperationLog;
use Illuminate\Http\Request;

class LogController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $logs = AdminOperationLog::when($keyword, function ($query) use ($keyword) {
            return $query->whereHas('user', function ($query) use ($keyword) {
                return $query->where('username', $keyword);
            });
        })->with('admin')->orderBy('id', 'desc')->paginate();
        return view('CPanel::logs.index', compact('logs'));
    }
}
