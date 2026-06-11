<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.5rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
            border-radius: 6px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-5 px-4 px-lg-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0 text-dark"><i class="bi bi-grid-1x2-fill text-primary me-2"></i>Dashboard
                    Pesanan</h3>
                <p class="text-muted mb-0 mt-1">Kelola semua pesanan masuk dari landing page</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">TANGGAL</th>
                            <th>PELANGGAN</th>
                            <th>KONTAK</th>
                            <th>PRODUK</th>
                            <th class="text-center">JML</th>
                            <th>STATUS</th>
                            <th class="text-end pe-4">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($orders as $order)
                            <tr>
                                <td class="ps-4 text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $order->created_at->format('d M Y') }}<br>
                                    <i class="bi bi-clock me-1"></i> {{ $order->created_at->format('H:i') }}
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $order->nama_pemesan }}</span>
                                </td>
                                <td>
                                    <div class="small"><i class="bi bi-whatsapp text-success me-1"></i>
                                        {{ $order->nomor_wa }}</div>
                                    <div class="small text-muted"><i class="bi bi-envelope me-1"></i> {{ $order->email }}
                                    </div>
                                </td>
                                <td>{{ $order->nama_produk }}</td>
                                <td class="text-center fw-bold">{{ $order->jumlah }}</td>
                                <td>
                                    @if($order->status == 'baru')
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle"><i
                                                class="bi bi-star-fill me-1"></i> Baru</span>
                                    @elseif($order->status == 'diproses')
                                        <span
                                            class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle"><i
                                                class="bi bi-arrow-repeat me-1"></i> Diproses</span>
                                    @else
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success border border-success-subtle"><i
                                                class="bi bi-check-circle-fill me-1"></i> Selesai</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                        class="btn btn-light btn-action text-primary border shadow-sm me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                        class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn btn-light btn-action text-danger border shadow-sm btn-delete"
                                            title="Hapus">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada pesanan yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Tangkap session success dari controller dan jadikan toast notification
        @if(session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        // Konfirmasi Hapus Data bergaya modern
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.form-delete');
                Swal.fire({
                    title: 'Hapus Pesanan?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>