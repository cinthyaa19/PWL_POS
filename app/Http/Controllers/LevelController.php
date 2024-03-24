<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LevelController extends Controller
{
    public function index()
    {
        // DB::insert('insert into m_levels(level_kode, level_nama, created_at) values(?, ?, ?)', ['cus', 'Pelanggan', now()]);
        // return 'insert data baru berhasil';

        // $row = DB::update('update m_levels set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.' baris';

        // $row = DB::delete('delete from m_levels where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row.' baris';

        $data = DB::select('select * from m_levels');
        return view('level', ['data' => $data]);
    }

    // public function store(Request $request)
    // {
    //     // Validasi data
    //     $validatedData = $request->validate([
    //         'level_name' => 'required|unique:levels|max:255',
    //         'level_kode' => 'required|max:255',
    //     ]);

    //     // Simpan data ke database
    //     $level = new Level();
    //     $level->level_name = $request->level_name;
    //     $level->level_kode = $request->level_kode;
    //     $level->save();

    //     // Redirect atau tampilkan pesan sukses
    //     return redirect()->back()->with('success', 'Level created successfully!');
    // }

    public function create()
    {
        return view('level_form');
    }

    public function store(Request $request){
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);
        return redirect('/level');
    }
}
