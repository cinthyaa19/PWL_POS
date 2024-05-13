<?php

namespace App\Http\Controllers\Api;

use App\Models\PenjualanModel;
use App\Models\BarangModel;
use App\Models\StokModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        // All penjualan
        $penjualan = PenjualanModel::all();

        // Return Json Response
        return response()->json([
            'penjualan' => $penjualan
        ], 200);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = validator($request->all(), [
            'user_id' => 'required',
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'penjualan_tanggal' => 'required',
            'detail' => 'required|array',
            'detail[*].barang_id' => 'required',
            'detail[*].jumlah' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Create penjualan
            $penjualan = PenjualanModel::create([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => $request->penjualan_tanggal,
            ]);


            foreach ($request->detail as $key => $value) {
                $hargaBarang = (integer)BarangModel::find($value['barang_id'])->harga_jual;

                $penjualan->penjualanDetail()->create([
                    'barang_id' => $value['barang_id'],
                    'penjualan_id' => $penjualan->penjualan_id,
                    'harga' => $hargaBarang * $value['jumlah'],
                    'jumlah' => $value['jumlah'],
                ]);

                // dd($value);
                $stok = StokModel::where('barang_id', $value['barang_id'])->first();
                $stok->update([
                    'stok_jumlah' => $stok->stok_jumlah - $value['jumlah']
                ]);
            }

            DB::commit();
            // Return Json Response
            return response()->json([
                'success' => true,
                'penjualan' => $penjualan,
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            DB::rollBack();
            dd($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function show($id)
    {
        $penjualan = PenjualanModel::with('detail')->find($id);
        if ($penjualan) {
            return response()->json($penjualan, 200);
        } else {
            return response()->json(['message' => 'penjualan tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $validator = validator($request->all(), [
            'user_id' => 'required',
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'penjualan_tanggal' => 'required',
            'detail' => 'required|array',
            'detail.*.barang_id' => 'required',
            'detail.*.jumlah' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            // Find penjualan
            $penjualan = PenjualanModel::with('penjualanDetail')->find($id);
            if (!$penjualan) {
                return response()->json([
                    'message' => 'penjualan tidak ditemukan'
                ], 404);
            }

            $penjualan->user_id = $request->user_id;
            $penjualan->pembeli = $request->pembeli;
            $penjualan->penjualan_kode = $request->penjualan_kode;
            $penjualan->penjualan_tanggal = $request->penjualan_tanggal;

            foreach ($request->detail as $key => $value) {
                $harga = BarangModel::find($value['barang_id'])->harga_jual;
                $stok = StokModel::where('barang_id', $value['barang_id'])->first();

                if ($value['jumlah'] > $penjualan->penjualanDetail[$key]->jumlah) {
                    $stok->update([
                        'stok_jumlah' => $stok->stok_jumlah - ($value['jumlah'] - $penjualan->penjualanDetail[$key]->jumlah)
                    ]);
                } else if ($value['jumlah'] < $penjualan->penjualanDetail[$key]->jumlah) {
                    $stok->update([
                        'stok_jumlah' => $stok->stok_jumlah - ($penjualan->penjualanDetail[$key]->jumlah - $value['jumlah'])
                    ]);
                }

                $penjualan->penjualanDetail[$key]->update([
                    'barang_id' => $value['barang_id'],
                    'penjualan_id' => $penjualan->penjualan_id,
                    'harga' => $value['jumlah'] * $harga,
                    'jumlah' => $value['jumlah'],
                ]);
            }
            // Update penjualan
            $penjualan->save();

            // Return Json Response
            return response()->json([
                'success' => true,
                'penjualan' => $penjualan,
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            dd($e);
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Detail
            $penjualan = PenjualanModel::with('penjualanDetail')->find($id);
            if (!$penjualan) {
                return response()->json([
                    'message' => 'penjualan tidak ditemukan'
                ], 404);
            }

            foreach ($penjualan->penjualanDetail as $key => $value) {
                $penjualan->penjualanDetail[$key]->delete();
            }

            // Delete penjualan
            $penjualan->delete();

            // Return Json Response
            return response()->json([
                'success' => true,
                'message' => 'Data terhapus',
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'success' => false,
            ], 500);
        }
    }

}
