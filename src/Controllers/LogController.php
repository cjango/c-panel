<?php

namespace cjango\CPanel\Controllers;

use cjango\CPanel\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $logs = Log::when($keyword, function ($query) use ($keyword) {
            return $query->whereHas('user', function ($query) use ($keyword) {
                return $query->where('username', $keyword);
            });
        })->orderBy('id', 'desc')->paginate();
        return view('CPanel::logs.index', compact('logs'));
    }
}
