<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\todo;
class toDoController extends Controller
{
    public function index()
    {
        $data = todo::orderBy('created_at', "DESC")->paginate(10);
        return response()->json([
            "status" => "sukses",
            "data" => $data
        ]);
    }
}
