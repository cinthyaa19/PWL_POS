<?php

namespace App\Http\Controllers;

use illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;

/* use Illuminate\Support\Facades\DB; */

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];
        // DB::table('m_kategoris')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategoris')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.' baris';

        // $row = DB::table('m_kategoris')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row.' baris';

        // $data = DB::table('m_kategoris')->get();
        // return view('kategori', ['data' => $data]);

        return $dataTable->render('kategori.index');
    }

    public function create(): View
    {
        return view('kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_kode' => 'required',
            'kategori_nama' => 'required',
        ]);
        KategoriModel::create($validated);
        return redirect('/kategori');
    }

    public function edit($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function edit_simpan(Request $request, $id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->kategori_kode = $request->kodeKategori;
        $kategori->kategori_nama = $request->namaKategori;
        $kategori->save();
        return redirect('/kategori');
    }

    public function hapus($id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();

        return redirect('/kategori');
    }
}
