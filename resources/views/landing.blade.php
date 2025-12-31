<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Kepemudaan</title>
    
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #4e54c8;
            --secondary-color: #8f94fb;
            --accent-color: #ff9f43;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* === NAVBAR ADJUSTMENT === */
        .navbar {
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
            /* UBAH DISINI: Padding dikurangi agar tidak terlalu tinggi */
            padding: 5px 0; 
            transition: all 0.4s ease;
        }
        
        .navbar.scrolled {
            background: #ffffff;
            /* Padding saat discroll juga disesuaikan */
            padding: 5px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            padding: 0;
        }

        /* UBAH DISINI: Ukuran Logo Diperbesar */
        .navbar-brand img {
            /* Tinggi diperbesar signifikan */
            height: 75px; 
            width: auto;
            transition: all 0.3s ease;
            /* Sedikit margin negatif agar lebih mepet atas-bawah */
            margin-top: -5px;
            margin-bottom: -5px;
        }

        /* Ukuran logo saat discroll juga diperbesar sedikit agar proporsional */
        .navbar.scrolled .navbar-brand img {
            height: 55px; 
        }
        /* ========================== */


        .nav-link { 
            color: rgba(255,255,255,0.9) !important; 
            font-weight: 500; 
            margin: 0 10px; 
            transition: 0.3s;
        }
        
        .navbar.scrolled .nav-link { 
            color: #333 !important; 
        }
        .navbar.scrolled .nav-link:hover { 
            color: var(--primary-color) !important; 
        }

        /* Tombol Login di Navbar */
        .btn-nav-login {
            border: 1px solid rgba(255,255,255,0.5);
            color: white;
            border-radius: 50px;
            padding: 5px 20px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-nav-login:hover {
            background: white;
            color: var(--primary-color);
        }
        
        .navbar.scrolled .btn-nav-login {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        .navbar.scrolled .btn-nav-login:hover {
            background: var(--primary-color);
            color: white;
        }


        /* HERO SLIDER */
        .carousel-item { height: 100vh; min-height: 600px; background-color: #000; position: relative; }
        
        .carousel-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1;
        }

        .carousel-item img {
            height: 100%; width: 100%; object-fit: cover;
        }
        .carousel-caption { bottom: 35%; z-index: 2; }
        
        .hero-title {
            font-size: 3.5rem; font-weight: 800; text-shadow: 0 4px 15px rgba(0,0,0,0.5);
            margin-bottom: 15px; animation: fadeInUp 0.8s ease-out;
        }
        .hero-desc {
            font-size: 1.2rem; margin-bottom: 30px; font-weight: 300; opacity: 0.9;
            animation: fadeInUp 1s ease-out;
        }
        .btn-cta {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none; padding: 12px 40px; border-radius: 50px; color: white;
            font-weight: 600; box-shadow: 0 8px 20px rgba(78, 84, 200, 0.4); transition: 0.3s;
        }
        .btn-cta:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(78, 84, 200, 0.5); color: white; }

        /* AGENDA CARD */
        .card-agenda {
            border: none; border-radius: 20px; overflow: hidden;
            background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease; height: 100%;
            display: flex; flex-direction: column; 
        }
        .card-agenda:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 15px 30px rgba(0,0,0,0.1); 
        }
        .agenda-img-wrapper { position: relative; height: 220px; overflow: hidden; flex-shrink: 0; }
        .agenda-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .card-agenda:hover .agenda-img-wrapper img { transform: scale(1.05); }
        
        .date-badge {
            position: absolute; top: 15px; left: 15px;
            background: white; border-radius: 12px;
            padding: 8px 15px; text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15); line-height: 1.1;
        }
        .date-day { font-size: 1.3rem; font-weight: 800; color: var(--primary-color); display: block; }
        .date-month { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #888; }
        
        .status-badge {
            position: absolute; top: 15px; right: 15px;
            padding: 6px 15px; border-radius: 20px;
            font-size: 0.75rem; font-weight: 700; color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        /* FORMULIR */
        .form-section { background: white; border-radius: 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.05); overflow: hidden; }
        .form-header { 
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
            padding: 50px 30px; color: white; 
        }
        .form-body { padding: 40px; }
        .input-group-text { background: #f8f9fa; border-right: none; color: var(--primary-color); border-radius: 10px 0 0 10px; }
        .form-control, .form-select { 
            border-left: none; padding: 12px; border-color: #ddd; background: #fff; border-radius: 0 10px 10px 0;
        }
        .form-control:focus, .form-select:focus { box-shadow: none; border-color: var(--primary-color); background: white; }
        .input-group { box-shadow: 0 2px 5px rgba(0,0,0,0.02); }

        /* ASPIRASI */
        .aspirasi-section { background: #2d3436; color: white; position: relative; }
        .aspirasi-card {
            background: rgba(255,255,255,0.08); backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 35px;
        }
        .aspirasi-icon-box {
            width: 60px; height: 60px; background: rgba(255,255,255,0.1);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px; font-size: 1.8rem; color: var(--accent-color);
        }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .section-padding { padding: 90px 0; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Pemuda Berkarya">
            </a>

            <button class="navbar-toggler navbar-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#agenda">Agenda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#daftar">Daftar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aspirasi">Aspirasi</a></li>
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-nav-login">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="beranda">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false">
            <div class="carousel-inner">
                @forelse($sliders as $key => $slide)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="4000">
                        <div class="carousel-overlay"></div> <img src="{{ asset('storage/' . $slide->gambar) }}" alt="Slide">
                        <div class="carousel-caption">
                            <h1 class="hero-title">{{ $slide->judul ?? 'Selamat Datang Pemuda!' }}</h1>
                            <p class="hero-desc">Bersatu, Berkarya, dan Membangun Desa Tercinta.</p>
                            <a href="#daftar" class="btn btn-cta">
                                Gabung Sekarang <i class="bi bi-arrow-right-circle ms-2"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active" data-bs-interval="4000">
                        <div class="carousel-overlay"></div>
                        <div style="height: 100vh; background: linear-gradient(135deg, #4e54c8, #8f94fb); width: 100%;"></div>
                        <div class="carousel-caption">
                            <h1 class="hero-title">Bangkit Pemuda!</h1>
                            <p class="hero-desc">Wadah kreativitas dan inovasi generasi penerus bangsa.</p>
                            <a href="#daftar" class="btn btn-light text-primary fw-bold rounded-pill px-5 py-3 shadow">Daftar Sekarang</a>
                        </div>
                    </div>
                @endforelse
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </section>

    <section id="agenda" class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase ls-2 mb-2">Kalender Kegiatan</h6>
                <h2 class="fw-bold display-6">Agenda Terkini</h2>
                <div style="width: 60px; height: 4px; background: var(--primary-color); margin: 15px auto; border-radius: 2px;"></div>
            </div>

            <div class="row g-4">
                @forelse($kegiatans as $kegiatan)
                <div class="col-md-4">
                    <div class="card-agenda h-100">
                        <div class="agenda-img-wrapper">
                            @if($kegiatan->gambar)
                                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->nama_kegiatan }}">
                            @else
                                <div class="bg-light d-flex justify-content-center align-items-center h-100 text-muted">
                                    <i class="bi bi-image fs-1 opacity-25"></i>
                                </div>
                            @endif
                            
                            <div class="date-badge">
                                <span class="date-day">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d') }}</span>
                                <span class="date-month">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('M') }}</span>
                            </div>

                            @php
                                $tgl = \Carbon\Carbon::parse($kegiatan->tanggal);
                                $sekarang = \Carbon\Carbon::now()->startOfDay();
                                $st = strtolower(trim($kegiatan->status)); 
                                
                                $isStatusOpen = (str_contains($st, 'buka') || str_contains($st, 'aktif'));
                                $isDateValid = !$tgl->lt($sekarang);
                                $isClosed = ($kegiatan->buka_pendaftaran != 0) && (!$isStatusOpen || !$isDateValid);
                            @endphp

                            <div style="position: absolute; top: 15px; right: 15px;">
                                @if($kegiatan->buka_pendaftaran == 0)
                                    <span class="status-badge bg-info text-dark"><i class="bi bi-megaphone-fill me-1"></i> Info</span>
                                @elseif($isClosed)
                                    <span class="status-badge bg-danger"><i class="bi bi-lock-fill me-1"></i> Ditutup</span>
                                @else
                                    <span class="status-badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Dibuka</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold mb-2 text-dark">{{ $kegiatan->nama_kegiatan }}</h5>
                            
                            <p class="text-muted small mb-3 flex-grow-1">
                                {{ Str::limit($kegiatan->deskripsi, 70) }}
                            </p>

                            <p class="text-muted small mb-4">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $kegiatan->lokasi }}
                            </p>
                            
                            <a href="{{ route('public.kegiatan.detail', $kegiatan->id) }}" class="btn btn-outline-primary w-100 rounded-pill btn-sm fw-bold mt-auto">
                                Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">Belum ada agenda kegiatan.</div>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('public.kegiatan.semua') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow">
                        Lihat Semua Agenda <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section id="daftar" class="section-padding bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    
                    @if(session('success_pemuda'))
                    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-4 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill fs-2 me-3"></i>
                        <div><strong>Pendaftaran Berhasil!</strong><br>{{ session('success_pemuda') }}</div>
                    </div>
                    @endif

                    <div class="form-section">
                        <div class="form-header text-center">
                            <i class="bi bi-person-lines-fill display-3 mb-3 text-white-50"></i>
                            <h3 class="fw-bold">Formulir Pendaftaran</h3>
                            <p class="mb-0 opacity-75">Lengkapi data di bawah ini untuk bergabung menjadi anggota resmi.</p>
                        </div>
                        <div class="form-body">
                            <form action="{{ route('pemuda.store') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label text-muted small fw-bold">NIK (Sesuai KTP)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                            <input type="number" name="nik" class="form-control" placeholder="Masukkan 16 digit NIK" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="text" name="nama_lengkap" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Nomor WhatsApp</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                                            <input type="text" name="no_hp" class="form-control" placeholder="08..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                            <input type="date" name="tanggal_lahir" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Jenis Kelamin</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                                            <select name="jenis_kelamin" class="form-select" required>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-muted small fw-bold">Alamat Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                            <textarea name="alamat" class="form-control" rows="2" placeholder="Jalan, RT/RW, Dusun..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">
                                            <i class="bi bi-send-fill me-2"></i>Kirim Data Pendaftaran
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="aspirasi" class="section-padding aspirasi-section">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-md-5 mb-5 mb-md-0">
                    <div class="aspirasi-icon-box">
                        <i class="bi bi-chat-quote-fill"></i>
                    </div>
                    <h2 class="fw-bold mb-3 display-6">Suara Anda Berharga</h2>
                    <p class="lead opacity-75 mb-4">Kami percaya bahwa kemajuan organisasi dimulai dari ide dan masukan anggotanya.</p>
                    
                    <ul class="list-unstyled opacity-75">
                        <li class="mb-3 d-flex"><i class="bi bi-check-circle-fill text-success me-3"></i> Ide kegiatan baru</li>
                        <li class="mb-3 d-flex"><i class="bi bi-check-circle-fill text-success me-3"></i> Kritik & Saran membangun</li>
                        <li class="mb-3 d-flex"><i class="bi bi-check-circle-fill text-success me-3"></i> Laporan kendala di desa</li>
                    </ul>
                </div>

                <div class="col-md-7">
                    @if(session('success_aspirasi'))
                        <div class="alert alert-success border-0 rounded-pill mb-3 text-center">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success_aspirasi') }}
                        </div>
                    @endif
                    
                    <div class="aspirasi-card">
                        <form action="{{ route('aspirasi.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="nama_pengirim" class="form-control border-0 py-3" placeholder="Nama (Opsional)">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="no_hp" class="form-control border-0 py-3" placeholder="WhatsApp (Opsional)">
                                </div>
                                <div class="col-12">
                                    <textarea name="pesan" class="form-control border-0 py-3" rows="3" placeholder="Tulis aspirasi Anda secara detail disini..." required></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-warning w-100 rounded-pill py-3 fw-bold text-dark shadow">
                                        Kirim Aspirasi <i class="bi bi-send ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black text-white-50 text-center py-4">
        <small>&copy; 2025 Portal Kepemudaan. Dibuat dengan sepenuh hati.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // SCRIPT UNTUK UBAH WARNA NAVBAR SAAT SCROLL
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>