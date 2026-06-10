<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class OrderController extends Controller
{
    use ApiResponser;
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string',
            'nomor_wa' => 'required|string',
            'email' => 'required|email',
            'nama_produk' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $order = Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'nomor_wa' => $request->nomor_wa,
            'email' => $request->email,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'status' => 'baru',
        ]);

        return $this->success($order, 'Pesanan berhasil dibuat!', 201);
    }
}