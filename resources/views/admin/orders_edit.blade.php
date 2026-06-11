<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .card { border: none; border-radius: 12px; }
        .form-control, .form-select { border-radius: 8px; padding: 0.6rem 1rem; }
        .form-control:read-only { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light border shadow-sm rounded-circle me-3" style="width: 40px; height: 40px; padding: 0; line-height: 38px; text-align: center;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h4 class="fw-bold mb-0">Update Status Pesanan</h4>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <form id="editForm" action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Nama Pemesan</label>
                                    <input type="text" name="nama_pemesan" class="form-control fw-medium" value="{{ $order->nama_pemesan }}" required>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label text-muted small fw-semibold">No. WhatsApp</label>
                                    <input type="text" name="nomor_wa" class="form-control" value="{{ $order->nomor_wa }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $order->email }}" required>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <label class="form-label text-muted small fw-semibold">Produk Dipesan</label>
                                    <input type="text" name="nama_produk" class="form-control" value="{{ $order->nama_produk }}" required readonly>
                                </div>
                                <div class="col-md-4 mt-3 mt-md-0">
                                    <label class="form-label text-muted small fw-semibold">Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control text-center" value="{{ $order->jumlah }}" required readonly>
                                </div>
                            </div>

                            <hr class="text-muted opacity-25 mb-4">

                            <div class="mb-4 bg-light p-3 rounded-3 border">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-tags-fill text-primary me-2"></i>Status Saat Ini</label>
                                <select name="status" id="statusSelect" class="form-select form-select-lg" required>
                                    <option value="baru" {{ $order->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-semibold">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const statusVal = document.getElementById('statusSelect').value;
            const currentStatus = "{{ $order->status }}";

            // Jika status diubah menjadi "selesai" (dan sebelumnya bukan selesai), tampilkan alert spesial
            if (statusVal === 'selesai' && currentStatus !== 'selesai') {
                e.preventDefault(); // Hentikan form disubmit langsung
                
                Swal.fire({
                    title: 'Tandai Selesai?',
                    text: "Apakah pesanan ini sudah berhasil dikirim ke pelanggan?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-check-circle me-1"></i> Ya, Selesaikan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Lanjutkan submit jika dikonfirmasi
                    }
                });
            }
        });
    </script>
</body>
</html>