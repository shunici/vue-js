<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use Illuminate\Support\Facades\DB;
class dataController extends Controller
{
    public function index ()
    {
        $data = data::all();
        return response()->json($data);
        
    }

    public function store(Request $request)
    {
        
        data::create([
            'judul' => $request->params['judul'],
            'data' => $request->params['data']
        ]);
        return response()->json('data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = data::find($id);
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $data = data::find($id);
        $data->update([
            'judul' => $request->params['judul'],
            'data' => $request->params['data']
        ]);
        return response()->json(['data' => $data]);
    }


}
