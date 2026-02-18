<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hasil Seleksi Siswa Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        /* ===== UMUM ===== */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }

        /* ===== HALAMAN ===== */
        .page-break {
            page-break-after: always;
        }

        /* ===== KOP SURAT ===== */
        .kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .kop h2 {
            margin: 0;
            font-size: 18px;
        }

        .kop p {
            margin: 3px 0;
            font-size: 11px;
        }

        /* ===== SURAT ===== */
        .judul-surat {
            text-align: center;
            margin: 30px 0 10px;
        }

        .judul-surat h3 {
            text-decoration: underline;
            margin: 0;
        }

        .isi-surat {
            margin-top: 25px;
            line-height: 1.8;
            text-align: justify;
        }

        /* ===== TTD ===== */
        .ttd {
            margin-top: 50px;
            width: 100%;
        }

        .ttd .kanan {
            width: 40%;
            float: right;
            text-align: center;
        }

        /* ===== TABEL ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .lulus { color: green; font-weight: bold; }
        .tidak-lulus { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <!-- ================= HALAMAN 1 ================= -->
    <div class="kop">
        <h2>SEKOLAH XXXXX</h2>
        <p>Alamat Sekolah • Telp • Email</p>
    </div>

    <div class="judul-surat">
        <h3>SURAT KETERANGAN</h3>
        <p>Nomor: {{ $nomor_surat ?? '-' }}</p>
    </div>

    <div class="isi-surat">
        <p>
            Yang bertanda tangan di bawah ini, Kepala Sekolah XXXXX, menerangkan bahwa
            peserta didik yang tercantum dalam daftar hasil seleksi pada halaman berikutnya
            telah mengikuti proses <strong>Seleksi Penerimaan Siswa Baru</strong>
            Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}.
        </p>

        <p>
            Berdasarkan hasil seleksi yang telah dilaksanakan secara objektif dan transparan,
            peserta dinyatakan <strong>LULUS</strong> atau <strong>TIDAK LULUS</strong>
            sesuai dengan nilai akhir yang diperoleh.
        </p>

        <p>
            Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <div class="ttd">
        <div class="kanan">
            <p>Solo, {{ date('d F Y') }}</p>
            <p>Kepala Sekolah</p>

            <br><br>

            <!-- TANDA TANGAN DIGITAL -->
            <p class="bold">
                Elnoah Agustinus Markus Manalu, S.Tr.T.
            </p>
            <p>NIP: -</p>
        </div>
    </div>

    <div style="clear: both;"></div>

    <div class="page-break"></div>

    <!-- ================= HALAMAN 2 ================= -->
    <h3 class="text-center">HASIL SELEKSI PENERIMAAN SISWA BARU</h3>
    <p class="text-center">
        Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
    </p>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Lengkap</th>
                <th class="text-center">NISN</th>
                <th class="text-center">Rata-rata</th>
                <th class="text-center">Poin Prestasi</th>
                <th class="text-center">Nilai Total</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftar as $index => $user)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $user->nama_pendaftar ?? '-' }}</td>
                <td class="text-center">{{ $user->nisn_pendaftar ?? '-' }}</td>
                <td class="text-center">{{ $user->avg }}</td>
                <td class="text-center">+{{ $user->poin_prestasi }}</td>
                <td class="text-center"><strong>{{ $user->nilai_total }}</strong></td>
                <td class="text-center {{ $user->status_seleksi === 'Lulus' ? 'lulus' : 'tidak-lulus' }}">
                    {{ $user->status_seleksi }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="text-right" style="margin-top:20px;">
        Dicetak pada: {{ date('d F Y H:i:s') }}
    </p>

</body>
</html>
