<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan - {{ $kegiatan->nama_kegiatan }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body { background-color: #f3f4f6; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: linear-gradient(135deg, #4e54c8, #8f94fb); }
        .card-detail { border-radius: 15px; overflow: hidden; }
        .img-banner { width: 100%; height: 350px; object-fit: cover; }
        .sticky-card { position: sticky; top: 20px; z-index: 10; }
        .btn-gradient { background: linear-gradient(135deg, #4e54c8, #8f94fb); color: white; border: none; }
        .btn-gradient:hover { color: white; opacity: 0.9; }
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

    <div class="container mb-5">
        <div class="row g-4">
            
            <div class="col-md-8">
                <div class="card border-0 shadow-sm card-detail bg-white">
                    
                    @if($kegiatan->gambar)
                        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-banner" alt="{{ $kegiatan->nama_kegiatan }}">
                    @endif

                    <div class="card-body p-4 p-md-5">
                        <h2 class="fw-bold text-dark mb-3">{{ $kegiatan->nama_kegiatan }}</h2>
                        
                        <div class="mb-4">
                            @php
                                $tgl = \Carbon\Carbon::parse($kegiatan->tanggal);
                                $sekarang = \Carbon\Carbon::now()->startOfDay();
                                // Ubah status dari DB jadi huruf kecil semua biar aman
                                $st = strtolower(trim($kegiatan->status)); 
                            @endphp

                            @if($kegiatan->buka_pendaftaran == 0)
                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill"><i class="bi bi-info-circle-fill me-1"></i> Informasi</span>
                            @elseif($st == 'ditutup' || $st == 'selesai' || $tgl->lt($sekarang))
                                <span class="badge bg-danger px-3 py-2 rounded-pill"><i class="bi bi-lock-fill me-1"></i> Ditutup</span>
                            @else
                                <span class="badge bg-success px-3 py-2 rounded-pill"><i class="bi bi-check-circle-fill me-1"></i> Pendaftaran Dibuka</span>
                            @endif
                        </div>

                        <hr class="opacity-10">

                        <div class="row mt-4 mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="bi bi-calendar-event fs-4 me-3 text-primary"></i>
                                    <div>
                                        <small class="d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Tanggal Acara</small>
                                        <span class="text-dark fw-bold">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="bi bi-geo-alt-fill fs-4 me-3 text-danger"></i>
                                    <div>
                                        <small class="d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Lokasi</small>
                                        <span class="text-dark fw-bold">{{ $kegiatan->lokasi }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5 class="fw-bold border-start border-4 border-primary ps-3 mb-3">Deskripsi Lengkap</h5>
                            <p class="text-secondary" style="line-height: 1.8; text-align: justify;">
                                {!! nl2br(e($kegiatan->deskripsi)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                
                {{-- KASUS 1: HANYA INFO --}}
                @if($kegiatan->buka_pendaftaran == 0)
                    <div class="card border-0 shadow rounded-4 p-4 sticky-card text-center">
                        <div class="mb-3 text-info"><i class="bi bi-megaphone-fill display-4"></i></div>
                        <h4 class="fw-bold">Informasi</h4>
                        <p class="text-muted small">Kegiatan ini bersifat pengumuman. Tidak diperlukan pendaftaran peserta.</p>
                        <button disabled class="btn btn-secondary w-100 rounded-pill">Tanpa Pendaftaran</button>
                    </div>

                {{-- KASUS 2: PENDAFTARAN --}}
                @else
                    
                    @php
                        // --- LOGIKA KRITIS ---
                        $tgl = \Carbon\Carbon::parse($kegiatan->tanggal);
                        $sekarang = \Carbon\Carbon::now()->startOfDay();
                        
                        // 1. Ambil status, bersihkan spasi, jadikan huruf kecil
                        $st = strtolower(trim($kegiatan->status)); 

                        // 2. Cek apakah status mengandung kata 'buka' atau 'aktif'?
                        // Jika DB isinya 'ditutup', maka $isStatusOpen = FALSE.
                        $isStatusOpen = (str_contains($st, 'buka') || str_contains($st, 'aktif'));

                        // 3. Cek Tanggal
                        $isDateValid = !$tgl->lt($sekarang);

                        // 4. KEPUTUSAN: Tutup form jika Status BUKAN Open ATAU Tanggal Lewat
                        $isClosed = (!$isStatusOpen || !$isDateValid);
                    @endphp

                    @if($isClosed)
                        <div class="card border-0 shadow rounded-4 p-4 sticky-card text-center bg-white">
                            <div class="mb-3 text-secondary"><i class="bi bi-lock-fill display-4"></i></div>
                            <h4 class="fw-bold text-danger">Pendaftaran Ditutup</h4>
                            <p class="text-muted small mb-4">
                                Maaf, pendaftaran ditutup oleh panitia atau waktu telah berakhir.
                            </p>
                            
                            <div class="alert alert-light border small py-1 mb-3">
                                Status Database: <strong>{{ $kegiatan->status }}</strong>
                            </div>
                            
                            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-success w-100 fw-bold rounded-pill">
                                <i class="bi bi-whatsapp me-1"></i> Hubungi Admin
                            </a>
                        </div>
                    
                    @else
                        <div class="card border-0 shadow rounded-4 p-4 sticky-card bg-white">
                            <h4 class="fw-bold text-center mb-1">Daftar Sekarang</h4>
                            <p class="text-center text-muted small mb-4">Isi data diri untuk mengikuti acara.</p>
                            
                            @if(session('success'))
                                <div class="alert alert-success small mb-3"><i class="bi bi-check-circle me-1"></i> {{ session('success') }}</div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger small mb-3">
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('public.kegiatan.daftar', $kegiatan->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="fw-bold small text-muted mb-1">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                        <input type="text" name="nama_peserta" class="form-control" placeholder="Nama Anda" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="fw-bold small text-muted mb-1">Nomor WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-whatsapp"></i></span>
                                        <input type="number" name="no_hp" class="form-control" placeholder="08..." required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gradient py-2 fw-bold rounded-pill shadow-sm">
                                        KIRIM PENDAFTARAN <i class="bi bi-send-fill ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                @endif

            </div>

        </div>
    </div>

    <footer class="text-center py-4 text-muted mt-5 border-top">
        <small>&copy; 2025 Portal Kepemudaan. All rights reserved.</small>
    </footer>

</body>
</html>