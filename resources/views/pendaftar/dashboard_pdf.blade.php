<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Formulir Pendaftaran - {{ $user->nama_pendaftar }}</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #ffffff;
      color: #1a1a1a;
      line-height: 1.6;
    }

    .page {
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto;
      background: white;
      padding: 0;
      page-break-after: always;
      position: relative;
    }

    @media print {
      body { background: white !important; }
      .page { margin: 0; box-shadow: none; }
    }

    /* Header dengan garis biru */
    .header {
      background: linear-gradient(to right, #0047AB 0%, #1E90FF 100%);
      height: 8mm;
    }

    .header-content {
      background: white;
      padding: 25px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid #0047AB;
    }

    .logo-section {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .logo-box {
      width: 55px;
      height: 55px;
      background: #0047AB;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      font-size: 22px;
      flex-shrink: 0;
    }

    .school-info h1 {
      font-size: 20px;
      font-weight: 600;
      color: #0047AB;
      margin-bottom: 4px;
      line-height: 1.2;
    }

    .school-info p {
      font-size: 11px;
      color: #666;
      line-height: 1.3;
    }

    .doc-info {
      text-align: right;
    }

    .doc-number {
      font-size: 11px;
      color: #666;
      margin-bottom: 5px;
    }

    .doc-date {
      font-size: 14px;
      font-weight: 600;
      color: #0047AB;
    }

    /* Metadata bar */
    .metadata-bar {
      background: #f0f0f0;
      padding: 10px 40px;
      font-size: 10px;
      color: #666;
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
    }

    /* Content */
    .content {
      padding: 40px;
    }

    .form-title {
      text-align: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #e0e0e0;
    }

    .form-title h2 {
      font-size: 18px;
      font-weight: 600;
      color: #0047AB;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Section Styling */
    .section {
      margin-bottom: 25px;
    }

    .section-header {
      background: #f8f9fa;
      padding: 10px 15px;
      border-left: 5px solid #0047AB;
      margin-bottom: 15px;
    }

    .section-header h3 {
      font-size: 12px;
      font-weight: 600;
      color: #0047AB;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Table-like form */
    .form-table {
      width: 100%;
      border-collapse: collapse;
    }

    .form-table tr {
      border-bottom: 1px solid #e8e8e8;
    }

    .form-table tr:last-child {
      border-bottom: none;
    }

    .form-table td {
      padding: 12px 15px;
      font-size: 12px;
      vertical-align: top;
    }

    .form-table td:first-child {
      width: 38%;
      color: #666;
      font-weight: 500;
    }

    .form-table td.separator {
      width: 2%;
      text-align: center;
      color: #999;
    }

    .form-table td:last-child {
      width: 60%;
      color: #1a1a1a;
      font-weight: 400;
    }

    /* Status badges */
    .status-badge {
      display: inline-block;
      padding: 5px 15px;
      border-radius: 4px;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .status-pending {
      background: #FFF3CD;
      color: #856404;
      border: 1px solid #FFC107;
    }

    .status-approved {
      background: #D4EDDA;
      color: #155724;
      border: 1px solid #28A745;
    }

    .status-rejected {
      background: #F8D7DA;
      color: #721C24;
      border: 1px solid #DC3545;
    }

    /* Info box */
    .info-box {
      background: #E3F2FD;
      border: 2px solid #0047AB;
      padding: 15px 20px;
      border-radius: 6px;
      font-size: 12px;
      color: #0047AB;
      font-weight: 500;
      line-height: 1.5;
    }

    .warning-box {
      background: #FFF3CD;
      border: 2px solid #FFA000;
      padding: 15px 20px;
      border-radius: 6px;
      font-size: 12px;
      color: #856404;
      font-weight: 500;
      line-height: 1.5;
    }

    /* Grid layout untuk nilai */
    .nilai-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px;
    }

    .nilai-item {
      border: 2px solid #e0e0e0;
      padding: 15px;
      border-radius: 6px;
      background: #fafafa;
      text-align: center;
    }

    .nilai-label {
      font-size: 10px;
      color: #666;
      text-transform: uppercase;
      margin-bottom: 8px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .nilai-value {
      font-size: 24px;
      font-weight: 700;
      color: #0047AB;
    }

    .rata-rata-box {
      background: linear-gradient(135deg, #0047AB 0%, #1E90FF 100%);
      color: white;
      padding: 15px;
      border-radius: 6px;
      text-align: center;
      box-shadow: 0 3px 10px rgba(0,71,171,0.3);
    }

    .rata-rata-box .label {
      font-size: 10px;
      margin-bottom: 8px;
      opacity: 0.95;
      font-weight: 600;
      letter-spacing: 1px;
    }

    .rata-rata-box .value {
      font-size: 28px;
      font-weight: 700;
    }

    /* Signature section */
    .signature-section {
      margin-top: 40px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      padding-top: 30px;
      border-top: 2px solid #e0e0e0;
    }

    .signature-box {
      text-align: center;
    }

    .signature-label {
      font-size: 11px;
      color: #666;
      margin-bottom: 60px;
      font-weight: 500;
    }

    .signature-name {
      border-top: 2px solid #000;
      padding-top: 8px;
      font-size: 11px;
      font-weight: 600;
      color: #1a1a1a;
    }

    /* Footer */
    .footer {
      background: #f8f9fa;
      padding: 20px 40px;
      border-top: 3px solid #0047AB;
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 10px;
      color: #666;
      line-height: 1.6;
    }

    .footer-left {
      flex: 1;
    }

    .footer-right {
      text-align: right;
    }

    /* Lampiran Page Styles */
    .lampiran-title {
      text-align: center;
      margin-bottom: 40px;
      padding: 25px;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-radius: 10px;
      border: 2px solid #0047AB;
    }

    .lampiran-title h2 {
      font-size: 20px;
      font-weight: 600;
      color: #0047AB;
      margin-bottom: 10px;
      letter-spacing: 1px;
    }

    .lampiran-subtitle {
      font-size: 13px;
      color: #666;
      font-weight: 500;
    }

    .document-frame {
      border: 3px solid #0047AB;
      padding: 30px;
      border-radius: 10px;
      background: #fafafa;
      min-height: 600px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .document-preview {
      max-width: 100%;
      max-height: 700px;
      border: 2px solid #ddd;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      object-fit: contain;
    }

    .document-placeholder {
      text-align: center;
      color: #999;
      font-size: 14px;
      line-height: 2;
    }

    .document-placeholder p:first-child {
      font-size: 48px;
      margin-bottom: 10px;
    }

    .document-info {
      margin-top: 25px;
      text-align: center;
      padding: 15px;
      background: white;
      border-radius: 6px;
      border: 1px solid #e0e0e0;
    }

    .document-info-label {
      font-size: 10px;
      color: #666;
      margin-bottom: 8px;
      text-transform: uppercase;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .document-info-value {
      font-size: 13px;
      font-weight: 600;
      color: #0047AB;
      word-break: break-all;
    }

    @media print {
      .page {
        box-shadow: none;
        margin: 0;
      }
      
      body {
        background: white;
      }
    }
  </style>
</head>
<body>

  <!-- HALAMAN UTAMA -->
  <div class="page">
    <div class="header"></div>

    <div class="header-content">
      <div class="logo-section">
        <div class="logo-box">VS</div>
        <div class="school-info">
          <h1>VERITAS SCHOOL</h1>
          <p>Lembaga Pendidikan Terpercaya</p>
        </div>
      </div>

      <div class="doc-info">
        <div class="doc-number">No. Dokumen: REG/{{ date('Y') }}/{{ str_pad($user->id ?? '001', 5, '0', STR_PAD_LEFT) }}</div>
        <div class="doc-date">{{ date('d F Y') }}</div>
      </div>
    </div>

    <div class="metadata-bar">
      <span>Form: Pendaftaran Siswa Baru</span>
      <span>Tahun Ajaran: {{ date('Y') }}/{{ date('Y')+1 }}</span>
    </div>

    <div class="content">
      
      <div class="form-title">
        <h2>Formulir Pendaftaran Siswa Baru</h2>
      </div>

      <!-- Status Section -->
      <div class="section">
        <div class="section-header">
          <h3>Status Pendaftaran</h3>
        </div>
        <table class="form-table">
          <tr>
            <td>Status Pendaftaran</td>
            <td class="separator">:</td>
            <td>
              <span class="status-badge status-{{ strtolower($user->status ?? 'pending') }}">
                {{ ucfirst($user->status ?? 'Pending') }}
              </span>
            </td>
          </tr>
          <tr>
            <td>Status Seleksi</td>
            <td class="separator">:</td>
            <td>{{ $user->status_seleksi ?? '-' }}</td>
          </tr>
        </table>
      </div>

      <!-- Data Pendaftar -->
      <div class="section">
        <div class="section-header">
          <h3>Informasi Pendaftar</h3>
        </div>
        <table class="form-table">
          <tr>
            <td>Nama Lengkap</td>
            <td class="separator">:</td>
            <td><strong>{{ $user->nama_pendaftar ?? '-' }}</strong></td>
          </tr>
          <tr>
            <td>NISN</td>
            <td class="separator">:</td>
            <td>{{ $user->nisn_pendaftar ?? '-' }}</td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td class="separator">:</td>
            <td>{{ $user->tanggallahir_pendaftar ?? '-' }}</td>
          </tr>
          <tr>
            <td>Agama</td>
            <td class="separator">:</td>
            <td>{{ $user->agama ?? '-' }}</td>
          </tr>
          <tr>
            <td>Alamat Lengkap</td>
            <td class="separator">:</td>
            <td>{{ $user->alamat_pendaftar ?? '-' }}</td>
          </tr>
        </table>
      </div>

      <!-- Data Orang Tua -->
      <div class="section">
        <div class="section-header">
          <h3>Informasi Orang Tua / Wali</h3>
        </div>
        <table class="form-table">
          <tr>
            <td>Nama Orang Tua / Wali</td>
            <td class="separator">:</td>
            <td><strong>{{ $user->nama_ortu ?? '-' }}</strong></td>
          </tr>
          <tr>
            <td>Pekerjaan</td>
            <td class="separator">:</td>
            <td>{{ $user->pekerjaan_ortu ?? '-' }}</td>
          </tr>
          <tr>
            <td>Nomor HP</td>
            <td class="separator">:</td>
            <td>{{ $user->no_hp_ortu ?? '-' }}</td>
          </tr>
        </table>
      </div>

     

      <!-- Nilai Rapor -->
      <div class="section">
        <div class="section-header">
          <h3>Nilai Rapor Semester</h3>
        </div>
        
        @php 
          $total = 0; 
          $count = 0;
        @endphp

        <div class="nilai-grid">
          @for($i=1; $i<=5; $i++)
            @php
              $nilai = $user->{'nilai_smt'.$i} ?? 0;
              $total += $nilai;
              if($nilai > 0) $count++;
            @endphp
            <div class="nilai-item">
              <div class="nilai-label">Semester {{ $i }}</div>
              <div class="nilai-value">{{ $nilai ?: '-' }}</div>
            </div>
          @endfor
          
          <div class="rata-rata-box">
            <div class="label">RATA-RATA</div>
            <div class="value">{{ $count > 0 ? number_format($total/$count, 2) : '-' }}</div>
          </div>
        </div>
      </div>

      <!-- Tanda Tangan -->
      <div class="signature-section">
        <div class="signature-box">
          <div class="signature-label">Orang Tua / Wali</div>
          <div class="signature-name">{{ $user->nama_ortu ?? '( _____________ )' }}</div>
        </div>
        
        <div class="signature-box">
          <div class="signature-label">Pendaftar</div>
          <div class="signature-name">{{ $user->nama_pendaftar ?? '( _____________ )' }}</div>
        </div>
        
        <div class="signature-box">
          <div class="signature-label">Petugas Pendaftaran</div>
          <div class="signature-name">( _____________ )</div>
        </div>
      </div>

    </div>

    <div class="footer">
      <div class="footer-content">
        <div class="footer-left">
          <strong>VERITAS SCHOOL</strong><br>
          Jl. Alfabeta No. 123, Surakarta, Jawa Tengah 57100<br>
          Telp: (0271) 123-4567 | Email: info@veritasschool.sch.id
        </div>
        <div class="footer-right">
          <strong>www.veritasschool.sch.id</strong><br>
          © {{ date('Y') }} Veritas School<br>
          Terakreditasi A
        </div>
      </div>
    </div>

  </div>

  

</body>
</html>