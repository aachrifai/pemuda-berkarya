<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Agenda Kegiatan</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .navbar { background: linear-gradient(135deg, #4e54c8, #8f94fb); }
        .card-agenda {
            border: none; border-radius: 15px; overflow: hidden;
            background: white; transition: 0.3s; height: 100%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .card-agenda:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .img-wrapper { height: 200px; position: relative; overflow: hidden; }
        .img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        
        /* BADGE STYLING */
        .status-badge {
            position: absolute; top: 15px; right: 15px;
            padding: 6px 15px; border-radius: 30px;
            font-size: 0.75rem; font-weight: 700; color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-transform: uppercase; letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-arrow-left-circle me-2"></i> KEMBALI KE BERANDA
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold ls-2">ARSIP LENGKAP</h6>
            <h2 class="fw-bold display-6">Semua Agenda Kegiatan</h2>
            <div style="width: 60px; height: 3px; background: var(--primary-color); margin: 15px auto;"></div>
        </div>

        <div class="row g-4">
            @forelse($kegiatans as $kegiatan)
            <div class="col-md-4 col-sm-6">
                <div class="card-agenda d-flex flex-column">
                    
                    <div class="img-wrapper">
                        @if($kegiatan->gambar)
                            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->nama_kegiatan }}">
                        @else
                            <div class="bg-light d-flex justify-content-center align-items-center h-100 text-muted">
                                <i class="bi bi-image fs-1 opacity-25"></i>
                            </div>
                        @endif

                        @php
                            $tgl = \Carbon\Carbon::parse($kegiatan->tanggal);
                            $sekarang = \Carbon\Carbon::now()->startOfDay();
                            
                            // 1. Ambil status, bersihkan spasi, ubah ke huruf kecil
                            $st = strtolower(trim($kegiatan->status)); 

                            // 2. Cek apakah status mengandung kata 'buka' atau 'aktif'
                            // Jika DB = 'ditutup', maka ini hasilnya FALSE.
                            $isStatusOpen = (str_contains($st, 'buka') || str_contains($st, 'aktif'));

                            // 3. Cek Tanggal
                            $isDateValid = !$tgl->lt($sekarang);

                            // 4. Final Decision: 
                            // Tutup jika: BUKAN Info Saja DAN (Status BUKAN Open ATAU Tanggal Lewat)
                            $isClosed = ($kegiatan->buka_pendaftaran != 0) && (!$isStatusOpen || !$isDateValid);
                        @endphp

                        @if($kegiatan->buka_pendaftaran == 0)
                            <span class="status-badge bg-info text-dark"><i class="bi bi-info-circle-fill me-1"></i> Info</span>
                        @elseif($isClosed)
                            <span class="status-badge bg-danger"><i class="bi bi-lock-fill me-1"></i> Ditutup</span>
                        @else
                            <span class="status-badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Dibuka</span>
                        @endif
                        </div>

                    <div class="p-4 d-flex flex-column flex-grow-1">
                        <div class="mb-2">
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-calendar-event me-1 text-primary"></i> 
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M') }}
                                <small class="text-muted ms-1">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('Y') }}</small>
                            </span>
                        </div>
                        
                        <h5 class="fw-bold mb-2 text-dark">{{ $kegiatan->nama_kegiatan }}</h5>
                        
                        <p class="text-muted small mb-3 flex-grow-1">
                            {{ Str::limit($kegiatan->deskripsi, 80) }}
                        </p>

                        <div class="mt-auto">
                            <hr class="opacity-10 my-3">
                            <a href="{{ route('public.kegiatan.detail', $kegiatan->id) }}" class="btn btn-outline-primary w-100 rounded-pill fw-bold btn-sm">
                                Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted mb-3"><i class="bi bi-calendar-x display-1 opacity-25"></i></div>
                    <h5 class="text-muted">Belum ada kegiatan yang tersedia saat ini.</h5>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $kegiatans->links() }}
        </div>

    </div>

    <footer class="text-center py-4 text-muted mt-5 border-top bg-white">
        <small>&copy; 2025 Portal Kepemudaan. All rights reserved.</small>
    </footer>

</body>
</html>