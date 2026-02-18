<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Formulir Pendaftaran - {{ $user->nama_pendaftar }}</title>

<style>
    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 12pt;
        color: #000;
        margin: 40px;
        line-height: 1.6;
    }

    .kop-surat {
        text-align: center;
        border-bottom: 3px solid #000;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .kop-surat h1 {
        font-size: 16pt;
        margin: 0;
        font-weight: bold;
        text-transform: uppercase;
    }

    .kop-surat p {
        margin: 2px 0;
        font-size: 11pt;
    }

    .nomor-surat {
        margin-bottom: 20px;
    }

    .nomor-surat table {
        width: 100%;
    }

    .judul {
        text-align: center;
        font-weight: bold;
        text-decoration: underline;
        margin: 20px 0;
    }

    table.data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table.data-table td {
        padding: 5px 0;
        vertical-align: top;
    }

    table.data-table td:first-child {
        width: 35%;
    }

    .section-title {
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 5px;
        text-decoration: underline;
    }

    .nilai-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .nilai-table th,
    .nilai-table td {
        border: 1px solid #000;
        padding: 6px;
        text-align: center;
    }

    .ttd {
        margin-top: 60px;
        width: 100%;
    }

    .ttd td {
        text-align: center;
        padding-top: 60px;
    }

</style>
</head>

<body>

<div class="kop-surat">
    <h1>VERITAS SCHOOL</h1>
    <p>Lembaga Pendidikan Terpercaya</p>
    <p>Jl. Alfabeta No. 123, Surakarta, Jawa Tengah 57100</p>
    <p>Telp: (0271) 123-4567 | Email: info@veritasschool.sch.id</p>
</div>

<div class="nomor-surat">
    <table>
        <tr>
            <td width="70%">
                Nomor : REG/{{ date('Y') }}/{{ str_pad($user->id ?? '001', 5, '0', STR_PAD_LEFT) }}<br>
                Lampiran : -<br>
                Perihal : Formulir Pendaftaran Siswa Baru
            </td>
            <td width="30%" style="text-align:right;">
                Surakarta, {{ date('d F Y') }}
            </td>
        </tr>
    </table>
</div>

<div class="judul">
    FORMULIR PENDAFTARAN SISWA BARU<br>
    TAHUN AJARAN {{ date('Y') }}/{{ date('Y')+1 }}
</div>

<div class="section-title">A. Status Pendaftaran</div>
<table class="data-table">
    <tr>
        <td>Status Pendaftaran</td>
        <td>: {{ ucfirst($user->status ?? 'Pending') }}</td>
    </tr>
    <tr>
        <td>Status Seleksi</td>
        <td>: {{ $user->status_seleksi ?? '-' }}</td>
    </tr>
</table>

<div class="section-title">B. Data Pendaftar</div>
<table class="data-table">
    <tr>
        <td>Nama Lengkap</td>
        <td>: {{ $user->nama_pendaftar ?? '-' }}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: {{ $user->jenis_kelamin ?? '-' }}</td>
    </tr>
    <tr>
        <td>NISN</td>
        <td>: {{ $user->nisn_pendaftar ?? '-' }}</td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td>
        <td>: {{ $user->tanggallahir_pendaftar ?? '-' }}</td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>: {{ $user->agama ?? '-' }}</td>
    </tr>
    <tr>
        <td>Alamat Lengkap</td>
        <td>: {{ $user->alamat_pendaftar ?? '-' }}</td>
    </tr>
</table>

<div class="section-title">C. Data Orang Tua / Wali</div>
<table class="data-table">
    <tr>
        <td>Nama Orang Tua / Wali</td>
        <td>: {{ $user->nama_ortu ?? '-' }}</td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>: {{ $user->pekerjaan_ortu ?? '-' }}</td>
    </tr>
    <tr>
        <td>Nomor HP</td>
        <td>: {{ $user->no_hp_ortu ?? '-' }}</td>
    </tr>
</table>

<div class="section-title">D. Nilai Rapor Semester</div>

@php 
    $total = 0; 
    $count = 0;
@endphp

<table class="nilai-table">
    <tr>
        <th>Semester</th>
        <th>Nilai</th>
    </tr>

    @for($i=1; $i<=5; $i++)
        @php
            $nilai = $user->{'nilai_smt'.$i} ?? 0;
            $total += $nilai;
            if($nilai > 0) $count++;
        @endphp
        <tr>
            <td>Semester {{ $i }}</td>
            <td>{{ $nilai ?: '-' }}</td>
        </tr>
    @endfor

    <tr>
        <th>Rata-rata</th>
        <th>{{ $count > 0 ? number_format($total/$count, 2) : '-' }}</th>
    </tr>
</table>

<br><br>

<p>
Demikian formulir pendaftaran ini dibuat dengan sebenar-benarnya untuk digunakan sebagaimana mestinya.
</p>

<table class="ttd">
    <tr>
        <td>
            Orang Tua / Wali<br><br><br>
            ( {{ $user->nama_ortu ?? '_________________' }} )
        </td>
        <td>
            Pendaftar<br><br><br>
            ( {{ $user->nama_pendaftar ?? '_________________' }} )
        </td>
        <td>
            Petugas Pendaftaran<br><br><br>
            ( _____________________ )
        </td>
    </tr>
</table>

</body>
</html>
