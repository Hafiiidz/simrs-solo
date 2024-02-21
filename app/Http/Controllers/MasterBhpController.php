<?php

namespace App\Http\Controllers;

use App\Models\Bhp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MasterBhpController extends Controller
{
    public function index(Request $request){
        if(request()->ajax()){
            $query = Bhp::orderBy('nama_barang', 'asc');
            return DataTables::eloquent($query)
                ->addColumn('action', function($data){
                    $button = '<a href="'.route('edit.bhp', $data->id).'" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn'.' btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('bhp.index');
    }
    public function create(){
        return view('bhp.create');
    }
    public function store(Request $request){
        $bhp = Bhp::updateOrCreate(['id' => $request->id], ['nama_barang' => $request->nama_barang, 'jenis' => $request->jenis, 'satuan' => $request->satuan, 'harga' => $request->harga]);
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }
    public function edit($id){
        $bhp = Bhp::find($id);
        return view('bhp.edit', compact('bhp'));
    }
    public function destroy($id){
        $bhp = Bhp::find($id);
        $bhp->delete();
        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        // return redirect(route('index.bhp'))->with('success', 'Data berhasil dihapus');
    }

}
