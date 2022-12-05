<?php

namespace App\Http\Controllers;

use App\Models\SearchLog;
use DataTables;

class SearchLogController extends Controller
{
    public function index()
    {

        return DataTables::of(SearchLog::query()->orderBy('created_at', 'desc'))
        ->addColumn('created_at', function ($search) {
            return $search->created_at->format('Y-m-d');
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['created_at'])
        ->make(true);

    }
}
