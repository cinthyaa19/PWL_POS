<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // Menampilkan halaman awal kategori
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        $kategori = KategoriModel::all(); // ambil data kategori

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Ambil data kategori dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama', 'created_at', 'updated_at');

        return DataTables::of($kategoris)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<a href="'.url('/kategori/'. $kategori->kategori_id. '/edit').'" class="btn btn-warning btn-sm">Edit</a>';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/kategori/'.$kategori->kategori_id).'">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                    return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah kategori
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        $kategori = KategoriModel::all(); // ambil data kategori

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|unique:m_kategoris,kategori_kode',
            'kategori_nama' => 'required|string|max:255',
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    // Menampilkan detail kategori
    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list'  => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit kategori
    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list'  => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kategori',
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('Kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page,  'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data kategori
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|unique:m_kategoris,kategori_kode,'.$id.',kategori_id',
            'kategori_nama' => 'required|string|max:255',
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    // Menghapus data kategori
    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {      // untuk mengecek apakah kategori dengan id yang dimaksud ada atau tidak
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try{
            KategoriModel::destroy($id);    // Hapus data kategori

            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

// namespace App\Http\Controllers;

// use illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\View\View;
// use App\DataTables\KategoriDataTable;
// use App\Models\KategoriModel;

/* use Illuminate\Support\Facades\DB; */

// class KategoriController extends Controller
// {
//     public function index(KategoriDataTable $dataTable)
//     {
//         // $data = [
//         //     'kategori_kode' => 'SNK',
//         //     'kategori_nama' => 'Snack/Makanan Ringan',
//         //     'created_at' => now()
//         // ];
//         // DB::table('m_kategoris')->insert($data);
//         // return 'Insert data baru berhasil';

//         // $row = DB::table('m_kategoris')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'camilan']);
//         // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.' baris';

//         // $row = DB::table('m_kategoris')->where('kategori_kode', 'SNK')->delete();
//         // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row.' baris';

//         // $data = DB::table('m_kategoris')->get();
//         // return view('kategori', ['data' => $data]);

//         return $dataTable->render('kategori.index');
//     }

//     public function create(): View
//     {
//         return view('kategori.create');
//     }

//     public function store(Request $request): RedirectResponse
//     {
//         $validated = $request->validate([
//             'kategori_kode' => 'required',
//             'kategori_nama' => 'required',
//         ]);
//         KategoriModel::create($validated);
//         return redirect('/kategori');
//     }

//     public function edit($id)
//     {
//         $kategori = KategoriModel::findOrFail($id);
//         return view('kategori.edit', compact('kategori'));
//     }

//     public function edit_simpan(Request $request, $id)
//     {
//         $kategori = KategoriModel::find($id);
//         $kategori->kategori_kode = $request->kodeKategori;
//         $kategori->kategori_nama = $request->namaKategori;
//         $kategori->save();
//         return redirect('/kategori');
//     }

//     public function hapus($id)
//     {
//         $kategori = KategoriModel::find($id);
//         $kategori->delete();

//         return redirect('/kategori');
//     }
// }
