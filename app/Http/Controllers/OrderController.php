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

    public function edit(Order $order)
    {
        return view('admin.edit_order', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'nama_pemesan' => 'required|string',
            'nomor_wa' => 'required|string',
            'email' => 'required|email',
            'nama_produk' => 'required|string',
            'jumlah' => 'required|integer',
            'status' => 'required|in:baru,diproses,selesai',
        ]);

        $order->update([
            'nama_pemesan' => $request->nama_pemesan,
            'nomor_wa' => $request->nomor_wa,
            'email' => $request->email,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Data pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Data pesanan berhasil dihapus!');
    }
}