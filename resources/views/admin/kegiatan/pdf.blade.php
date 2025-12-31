<!DOCTYPE html>
<html>
<head>
    <title>Data Peserta</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { margin: 0; }
        .meta { margin-bottom: 20px; font-size: 14px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN DATA PESERTA</h2>
        <p>Portal Kepemudaan Desa</p>
    </div>

    <div class="meta">
        <strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }} <br>
        <strong>Lokasi:</strong> {{ $kegiatan->lokasi }} <br>
        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th>Nama Lengkap</th>
                <th>No. WhatsApp</th>
                <th>Waktu Mendaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatan->pendaftarans as $index => $peserta)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $peserta->nama_peserta }}</td>
                <td>{{ $peserta->no_hp }}</td>
                <td>{{ $peserta->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
            
            @if($kegiatan->pendaftarans->isEmpty())
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada peserta terdaftar.</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: right; font-size: 12px;">
        dicetak pada: {{ date('d-m-Y H:i') }}
    </div>

</body>
</html>