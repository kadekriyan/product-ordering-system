<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Edit Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan" class="form-control"
                                    value="{{ $order->nama_pemesan }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor WhatsApp</label>
                                <input type="text" name="nomor_wa" class="form-control" value="{{ $order->nomor_wa }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $order->email }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control"
                                    value="{{ $order->nama_produk }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" value="{{ $order->jumlah }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="baru" {{ $order->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>