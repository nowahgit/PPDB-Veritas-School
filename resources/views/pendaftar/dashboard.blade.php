<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pendaftar</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/icon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            hubot: ['"Hubot Sans"', 'sans-serif'],
            gabarito: ['"Gabarito"', 'sans-serif'],
            dmserif: ['"DM Serif Text"', 'serif'],
          },
        },
      },
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Hubot+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
    [x-cloak] { display: none !important; }
    
    /* Print Styles */
    @media print {
      .no-print { display: none !important; }
      body { background: white !important; }
      .page { padding: 0 !important; }
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .animate-fade-in { animation: fadeIn 0.2s ease-in; }
  </style>
</head>

<body class="bg-gray-50 font-hubot">

  <!-- Topbar -->
  <header class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 z-40 no-print">
    <div class="flex items-center justify-between px-4 md:px-6 h-16">
      <div class="flex items-center gap-4">
        <button id="sidebarToggle" class="md:hidden p-2 hover:bg-gray-100 rounded-lg">
          <i class="fas fa-bars text-gray-700"></i>
        </button>
        <div class="flex items-center gap-3">
          <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="w-8 h-8">
          <div>
            <h1 class="text-lg font-bold text-gray-800">PPDB System</h1>
            <p class="text-xs text-gray-500">Dashboard Pendaftar</p>
          </div>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <div class="hidden md:flex items-center gap-3 px-4 py-2 bg-gray-50 rounded-lg">
          <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
            {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->username ?? 'User' }}</p>
            <p class="text-xs text-gray-500">Pendaftar</p>
          </div>
        </div>
        <button onclick="openLogoutModal()" class="p-2 hover:bg-gray-100 rounded-lg text-gray-600">
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </div>
    </div>
  </header>

  <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

  <div class="flex h-screen pt-16">
    <!-- Sidebar -->
    <aside id="sidebar"
      class="fixed md:static top-16 md:top-0 left-0 w-64 bg-white border-r border-gray-200 h-[calc(100vh-4rem)] md:h-screen flex flex-col transform -translate-x-full md:translate-x-0 transition-transform z-50 no-print">

    <nav class="flex-1 p-4 overflow-y-auto">
      <ul class="space-y-1">
        <li>
          <button onclick="showPage('dashboard', this)"
            class="nav-btn flex items-center w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors bg-blue-50 text-blue-700">
            <i class="fas fa-home w-5 mr-3"></i>
            <span class="font-medium">Dashboard</span>
          </button>
        </li>


        <li>
          <button onclick="toggleDropdown()"
            class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
            <div class="flex items-center">
              <i class="fas fa-folder-open w-5 text-gray-500 mr-3"></i>
              <span class="font-medium">Data Pendaftar</span>
            </div>
            <i id="dropdownIcon" class="fas fa-chevron-down text-xs text-gray-400 transition-transform"></i>
          </button>
          <ul id="dropdownMenu" class="ml-8 mt-1 space-y-1 hidden">
            <li>
              <button onclick="showPage('identitas', this)"
                class="nav-btn flex items-center w-full text-left px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-600 text-sm transition-colors">
                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-3"></span>
                Identitas
              </button>
            </li>
            <li>
              <button onclick="showPage('prestasi', this)"
                class="nav-btn flex items-center w-full text-left px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-600 text-sm transition-colors">
                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-3"></span>
                Prestasi
              </button>
            </li>
            <li>
              <button onclick="showPage('berkas', this)"
                class="nav-btn flex items-center w-full text-left px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-600 text-sm transition-colors">
                <span class="w-1.5 h-1.5 bg-purple-500 rounded-full mr-3"></span>
                Berkas
              </button>
            </li>
          </ul>
        </li>

        <li>
          <button onclick="showPage('seleksi', this)"
            class="nav-btn flex items-center w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
            <i class="fas fa-clipboard-check w-5 text-gray-500 mr-3"></i>
            <span class="font-medium">Seleksi</span>
          </button>
        </li>

        <li>
          <button onclick="showPage('panduan', this)"
            class="nav-btn flex items-center w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
            <i class="fas fa-book-open w-5 text-gray-500 mr-3"></i>
            <span class="font-medium">Panduan</span>
          </button>
        </li>

        <li>
          <button onclick="showPage('profile', this)"
            class="nav-btn flex items-center w-full text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 transition-colors">
            <i class="fas fa-user w-5 text-gray-500 mr-3"></i>
            <span class="font-medium">Profile</span>
          </button>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 overflow-y-auto min-w-0">


  <div id="logoutModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-96 p-6 relative animate-fadeIn">

      <button onclick="closeLogoutModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
        <i class="fa-solid fa-xmark text-xl"></i>
      </button>

      <div class="text-center mt-2">
        <i class="fa-solid fa-circle-exclamation text-red-500 text-4xl mb-3"></i>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Konfirmasi Logout</h3>
        <p class="text-gray-600 mb-6">
          Apakah kamu ingin logout, <span class="font-semibold text-gray-800">{{ Auth::user()->username }}</span>?
        </p>

        <div class="flex justify-center gap-3">
          <button onclick="closeLogoutModal()"
            class="border border-gray-400 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
          </button>

          <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
              <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const sidebar = document.querySelector('aside');
      const toggleBtn = document.getElementById('sidebarToggle');

      if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
          sidebar.classList.toggle('-translate-x-full');
        });
      }

      // Close sidebar when clicking outside on mobile
      document.addEventListener('click', (e) => {
        if (window.innerWidth < 768 &&
          sidebar &&
          !sidebar.contains(e.target) &&
          toggleBtn &&
          !toggleBtn.contains(e.target)) {
          sidebar.classList.add('-translate-x-full');
        }
      });
    });

    function toggleDropdown() {
      const menu = document.getElementById('dropdownMenu');
      const icon = document.getElementById('dropdownIcon');
      menu.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    }

    function openLogoutModal() {
      const modal = document.getElementById('logoutModal');
      modal.classList.remove('hidden');
      // Prevent scroll
      document.body.style.overflow = 'hidden';
    }

    function closeLogoutModal() {
      const modal = document.getElementById('logoutModal');
      modal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    function showPage(pageId, btn) {
      document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));
      document.getElementById(pageId).classList.remove('hidden');
      document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('bg-gray-200', 'active'));

      // Find button if not passed directly (for mobile or quick links)
      if (!btn) {
        btn = document.querySelector(`[onclick*="showPage('${pageId}'"]`);
      }

      if (btn) btn.classList.add('bg-gray-200', 'active');

      // Close sidebar on mobile after selection
      if (window.innerWidth < 768) {
        const sidebar = document.querySelector('aside');
        if (sidebar) sidebar.classList.add('-translate-x-full');
      }

      // Scroll to top
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  </script>


  <style>
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fadeIn {
      animation: fadeIn 0.25s ease-in-out;
    }
  </style>




    <div id="dashboard" class="page p-6">



      <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">
        Selamat Datang, {{ $user->username }}
      </h1>
      <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6">
        {{ $user->nama_pendaftar}}, Sudah siap menjadi bagian dari Veritas School?
      </p>


      @php
        $statusSeleksi = $user->seleksi ? $user->seleksi->status : ($user->status_seleksi ?? 'Belum Diseleksi');
        $statusPendaftaran = $user->status ?? 'pending';
        $statusPendaftaranDisplay = match($statusPendaftaran) {
          'lolos' => 'approved',
          'tidak_lolos' => 'rejected',
          default => $statusPendaftaran,
        };
      @endphp

      <!-- Notifikasi Penting -->
      @if($statusPendaftaranDisplay === 'rejected')
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6 animate-fadeIn">
          <div class="flex items-start">
            <i class="fa-solid fa-circle-exclamation text-red-500 text-xl mr-3 mt-0.5"></i>
            <div class="flex-1">
              <h3 class="font-semibold text-red-800 mb-1">Pendaftaran Ditolak</h3>
              <p class="text-sm text-red-700">Pendaftaran Anda telah ditolak. Silakan hubungi admin untuk informasi lebih lanjut atau perbaiki data yang diperlukan.</p>
            </div>
          </div>
        </div>
      @elseif($statusPendaftaranDisplay === 'approved' && !$user->berkas_locked)
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mb-6 animate-fadeIn">
          <div class="flex items-start">
            <i class="fa-solid fa-info-circle text-blue-500 text-xl mr-3 mt-0.5"></i>
            <div class="flex-1">
              <h3 class="font-semibold text-blue-800 mb-1">Lengkapi Berkas</h3>
              <p class="text-sm text-blue-700">Pendaftaran Anda telah disetujui. Silakan lengkapi upload berkas yang diperlukan untuk melanjutkan proses seleksi.</p>
            </div>
          </div>
        </div>
      @endif

      <!-- Status Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-4 md:mb-6">
        <!-- Status Pendaftaran -->
        <div class="bg-white shadow-lg rounded-xl p-4 md:p-6 border border-gray-100">
          <h2 class="text-sm md:text-base font-semibold mb-3 text-gray-800 flex items-center">
            <i class="fa-solid fa-file-circle-check text-blue-500 mr-2"></i> Status Pendaftaran
          </h2>
          <div class="flex items-center gap-2 mb-2">
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs md:text-sm font-semibold border
              {{ $statusPendaftaranDisplay === 'approved' ? 'bg-green-100 text-green-700 border-green-400' :
                 ($statusPendaftaranDisplay === 'rejected' ? 'bg-red-100 text-red-700 border-red-400' :
                   'bg-yellow-100 text-yellow-700 border-yellow-400') }}">
              {{ $statusPendaftaran === 'lolos' ? 'Diterima' : ($statusPendaftaran === 'tidak_lolos' ? 'Ditolak' : 'Menunggu Verifikasi') }}
            </span>
          </div>
          @if($statusPendaftaranDisplay === 'approved')
            <p class="text-xs text-gray-600 mt-2">
              <i class="fa-solid fa-check-circle text-green-500 mr-1"></i>
              Data Anda telah diverifikasi
            </p>
          @elseif($statusPendaftaranDisplay === 'rejected')
            <p class="text-xs text-red-600 mt-2">
              <i class="fa-solid fa-times-circle text-red-500 mr-1"></i>
              Perlu perbaikan data
            </p>
          @else
            <p class="text-xs text-yellow-600 mt-2">
              <i class="fa-solid fa-clock text-yellow-500 mr-1"></i>
              Menunggu verifikasi admin
            </p>
          @endif
        </div>

        <!-- Status Seleksi -->
        <div class="bg-white shadow-lg rounded-xl p-4 md:p-6 border border-gray-100">
          <h2 class="text-sm md:text-base font-semibold mb-3 text-gray-800 flex items-center">
            <i class="fa-solid fa-clipboard-list text-indigo-500 mr-2"></i> Status Seleksi
          </h2>
          <div class="flex items-center gap-2 mb-2">
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs md:text-sm font-semibold border
              {{ $statusSeleksi === 'Lulus' ? 'bg-green-100 text-green-700 border-green-500' :
                 ($statusSeleksi === 'Tidak Lulus' ? 'bg-red-100 text-red-700 border-red-500' :
                   ($statusSeleksi === 'Dipertimbangkan' ? 'bg-yellow-100 text-yellow-700 border-yellow-500' :
                     'bg-gray-100 text-gray-700 border-gray-400')) }}">
              {{ $statusSeleksi }}
            </span>
          </div>
          @if($user->seleksi && $user->seleksi->updated_at)
            <p class="text-xs text-gray-600 mt-2">
              <i class="fa-solid fa-calendar text-gray-500 mr-1"></i>
              Diperbarui: {{ $user->seleksi->updated_at->format('d/m/Y H:i') }}
            </p>
          @elseif($statusSeleksi === 'Belum Diseleksi')
            <p class="text-xs text-gray-600 mt-2">
              <i class="fa-solid fa-info-circle text-gray-500 mr-1"></i>
              Proses seleksi belum dimulai
            </p>
          @endif
        </div>

        <!-- Verifikasi Berkas -->
        <div class="bg-white shadow-lg rounded-xl p-4 md:pb-6 border border-gray-100">
          <h2 class="text-sm md:text-base font-semibold mb-3 text-gray-800 flex items-center">
            <i class="fa-solid fa-file-check text-purple-500 mr-2"></i> Verifikasi Berkas
          </h2>
          <div class="flex items-center gap-2 mb-2">
            @if($user->berkas_locked)
              <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs md:text-sm font-semibold
                {{ $user->berkas_approved ? 'bg-green-100 text-green-700 border border-green-500' : 'bg-yellow-100 text-yellow-700 border border-yellow-500' }}">
                {{ $user->berkas_approved ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
              </span>
            @else
              <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs md:text-sm font-semibold bg-gray-100 text-gray-700 border border-gray-400">
                Belum Dikunci
              </span>
            @endif
          </div>
          @if($user->berkas_locked)
            @if($user->berkas_approved)
              <p class="text-xs text-green-600 mt-2">
                <i class="fa-solid fa-check-circle text-green-500 mr-1"></i>
                Berkas telah diverifikasi admin
              </p>
            @else
              <p class="text-xs text-yellow-600 mt-2">
                <i class="fa-solid fa-clock text-yellow-500 mr-1"></i>
                Menunggu verifikasi admin
              </p>
            @endif
          @else
            <p class="text-xs text-gray-600 mt-2">
              <i class="fa-solid fa-upload text-gray-500 mr-1"></i>
              Upload berkas untuk dikunci
            </p>
          @endif
        </div>

        <!-- Verifikasi Prestasi -->
        <div class="bg-white shadow-lg rounded-xl p-4 md:p-6 border border-gray-100">
          <h2 class="text-sm md:text-base font-semibold mb-3 text-gray-800 flex items-center">
            <i class="fa-solid fa-trophy text-amber-500 mr-2"></i> Verifikasi Prestasi
          </h2>
          <div class="flex items-center gap-2 mb-2">
            @if($user->prestasi_locked)
              <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs md:text-sm font-semibold
                {{ $user->prestasi_approved ? 'bg-green-100 text-green-700 border border-green-500' : 'bg-yellow-100 text-yellow-700 border border-yellow-500' }}">
                {{ $user->prestasi_approved ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
              </span>
            @else
              <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs md:text-sm font-semibold bg-gray-100 text-gray-700 border border-gray-400">
                Belum Dikunci
              </span>
            @endif
          </div>
          @if($user->prestasi_locked)
            @if($user->prestasi_approved)
              <p class="text-xs text-green-600 mt-2">
                <i class="fa-solid fa-check-circle text-green-500 mr-1"></i>
                Prestasi telah diverifikasi admin
              </p>
            @else
              <p class="text-xs text-yellow-600 mt-2">
                <i class="fa-solid fa-clock text-yellow-500 mr-1"></i>
                Menunggu verifikasi admin
              </p>
            @endif
          @else
            <p class="text-xs text-gray-600 mt-2">
              <i class="fa-solid fa-plus-circle text-gray-500 mr-1"></i>
              Tambah prestasi untuk dikunci
            </p>
          @endif
        </div>
      </div>


      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 
            gap-3 md:gap-4 lg:gap-6 mb-6 md:mb-8">

        <a href="{{ route('pendaftar.dashboard.pdf') }}" target="_blank"
          class="card flex flex-col items-center justify-center hover:shadow-lg transition-all no-print">
          <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-3">
            <i class="fas fa-file-pdf text-red-600 text-2xl"></i>
          </div>
          <span class="font-semibold text-gray-800 text-center">Download PDF</span>
          <span class="text-xs text-gray-500 mt-1">Data Pendaftaran</span>
        </a>


        <button id="termsBtn"
          class="bg-green-600 text-white rounded-xl shadow-lg p-6 flex flex-col items-center justify-center hover:bg-green-700 transition">
          <i class="fa-solid fa-file-contract text-4xl mb-2"></i>
          <span class="font-semibold text-lg text-center">Persyaratan & Ketentuan</span>
        </button>

        <button onclick="showPage('identitas', this)"
          class="bg-purple-600 text-white rounded-xl shadow-lg p-6 flex flex-col items-center justify-center hover:bg-purple-700 transition">
          <i class="fa-solid fa-clipboard text-4xl mb-2"></i>
          <span class="font-semibold text-lg text-center">Data Pendaftaran</span>
        </button>


        <a href="javascript:void(0)" onclick="showPage('profile', document.querySelector('[onclick*=profile]'))"
          class="bg-orange-500 text-white rounded-xl shadow-lg p-6 flex flex-col items-center justify-center hover:bg-orange-600 transition">
          <i class="fa-solid fa-user text-4xl mb-2"></i>
          <span class="font-semibold text-lg text-center">Profil</span>
        </a>

      </div>

      <div class="bg-white shadow-lg rounded-xl p-4 md:p-6 mb-6 md:mb-8 border border-gray-100">
        <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4 text-gray-800 flex items-center">
          <i class="fa-solid fa-user text-teal-500 mr-2"></i> Data Pendaftar
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4 text-sm md:text-base">
          <div>
            <p class="text-gray-500 text-xs md:text-sm">Nama Lengkap</p>
            <p class="font-semibold text-gray-800">{{ $user->nama_pendaftar ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500 text-xs md:text-sm">NISN</p>
            <p class="font-semibold text-gray-800">{{ $user->nisn_pendaftar ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500 text-xs md:text-sm">Tanggal Lahir</p>
            <p class="font-semibold text-gray-800">{{ $user->tanggallahir_pendaftar ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500 text-xs md:text-sm">Agama</p>
            <p class="font-semibold text-gray-800">{{ $user->agama ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500 text-xs md:text-sm">Alamat</p>
            <p class="font-semibold text-gray-800">{{ $user->alamat_pendaftar ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500 text-xs md:text-sm">Nama Orang Tua</p>
            <p class="font-semibold text-gray-800">{{ $user->nama_ortu ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500 text-xs md:text-sm">Pekerjaan Orang Tua</p>
            <p class="font-semibold text-gray-800">{{ $user->pekerjaan_ortu ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500 text-xs md:text-sm">Nomor HP Orang Tua</p>
            <p class="font-semibold text-gray-800">{{ $user->no_hp_ortu ?? '-' }}</p>
          </div>
        </div>
      </div>


      <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
          <i class="fa-solid fa-folder-open text-purple-500 mr-2"></i> Berkas yang Diupload
        </h2>

        @if ($berkas)
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
              <p class="text-gray-500">Ijazah / SKHUN</p>
              <button onclick="showFile('{{ asset('storage/' . $berkas->ijazah_skhun) }}')"
                class="text-blue-600 hover:underline">Lihat File</button>
            </div>
            <div>
              <p class="text-gray-500">Akta Kelahiran</p>
              <button onclick="showFile('{{ asset('storage/' . $berkas->akta_kelahiran) }}')"
                class="text-blue-600 hover:underline">Lihat File</button>
            </div>
            <div>
              <p class="text-gray-500">Kartu Keluarga</p>
              <button onclick="showFile('{{ asset('storage/' . $berkas->kk) }}')"
                class="text-blue-600 hover:underline">Lihat File</button>
            </div>
            <div>
              <p class="text-gray-500">Pas Foto</p>
              <img src="{{ asset('storage/' . $berkas->pas_foto) }}" alt="Pas Foto"
                class="w-20 h-24 object-cover rounded-lg border cursor-pointer"
                onclick="showFile('{{ asset('storage/' . $berkas->pas_foto) }}')">
            </div>
          </div>
        @else
          <p class="text-gray-500 italic">Belum ada berkas yang diupload.</p>
        @endif
      </div>


      <div id="fileModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-3/4 lg:w-1/2 relative p-4">
          <button onclick="closeFile()"
            class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>


          <div id="fileContainer" class="flex justify-center items-center max-h-[80vh] overflow-auto"></div>
        </div>
      </div>

      <script>
        function showFile(url) {
          const container = document.getElementById('fileContainer');
          container.innerHTML = '';

          const ext = url.split('.').pop().toLowerCase();
          let content;

          if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {

            content = document.createElement('img');
            content.src = url;
            content.className = 'max-h-[70vh] max-w-full rounded-lg shadow';
          } else {

            content = document.createElement('iframe');
            content.src = url;
            content.className = 'w-full h-[80vh] rounded-lg';
          }

          container.appendChild(content);
          document.getElementById('fileModal').classList.remove('hidden');
        }

        function closeFile() {
          document.getElementById('fileModal').classList.add('hidden');
          document.getElementById('fileContainer').innerHTML = '';
        }
      </script>



      <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
          <i class="fa-solid fa-trophy text-yellow-500 mr-2"></i> Prestasi yang Diupload
        </h2>

        @if ($prestasis->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($prestasis as $prestasi)
              <div class="border rounded-xl p-4 shadow-sm bg-gray-50">
                @if ($prestasi->foto_prestasi)
                  <img src="{{ asset('storage/' . $prestasi->foto_prestasi) }}" alt="Foto Prestasi"
                    class="w-full h-40 object-cover rounded-lg mb-3">
                @endif
                <p class="font-semibold text-gray-800">{{ $prestasi->nama_prestasi }}</p>
                <p class="text-gray-600 text-sm">{{ $prestasi->tingkat }}</p>
                <p class="text-gray-500 text-xs mt-1">Tahun: {{ $prestasi->tahun ?? '-' }}</p>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-gray-500 italic">Belum ada prestasi yang diupload.</p>
        @endif
      </div>


      <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-100">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
          <i class="fa-solid fa-chart-line text-orange-500 mr-2"></i> Nilai Rapor
        </h2>

        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 rounded-lg text-sm">
            <thead class="bg-gray-100">
              <tr>
                <th class="py-2 px-4 text-left">Semester</th>
                <th class="py-2 px-4 text-left">Nilai</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 1; $i <= 5; $i++)
                <tr class="border-t">
                  <td class="py-2 px-4 font-medium">Semester {{ $i }}</td>
                  <td class="py-2 px-4">{{ $user->{'nilai_smt' . $i} ?? '-' }}</td>
                </tr>
              @endfor
            </tbody>
          </table>
        </div>
      </div>


      <div id="termsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 max-h-[90vh] overflow-y-auto rounded-xl p-8 relative">
          <button id="closeModal"
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>

          <h2 class="text-3xl font-dmserif font-bold mb-4 text-gray-800">Persyaratan & Ketentuan Veritas School</h2>
          <p class="text-lg font-gabarito opacity-90 mb-6">Veritas School — Sekolah Unggulan dengan Komitmen pada
            Integritas dan Keunggulan Akademik</p>

          <div class="space-y-6 text-gray-700 leading-relaxed">

            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">1. Pendaftaran dan Penerimaan Siswa</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>Pendaftaran dilakukan secara daring melalui laman resmi Veritas School atau secara langsung di
                  kantor administrasi sekolah.</li>
                <li>Calon siswa wajib mengisi data pribadi dengan benar, lengkap, dan sesuai dokumen resmi.</li>
                <li>Seleksi penerimaan siswa dilakukan berdasarkan hasil tes akademik, wawancara, dan evaluasi
                  administrasi.</li>
                <li>Sekolah berhak menolak pendaftaran apabila data yang diberikan tidak valid atau tidak memenuhi
                  persyaratan.</li>
              </ul>
            </div>


            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">2. Kewajiban dan Tata Tertib Siswa</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>Siswa wajib hadir tepat waktu dan mengikuti seluruh kegiatan belajar mengajar sesuai jadwal yang
                  ditetapkan.</li>
                <li>Siswa wajib mengenakan seragam lengkap dan rapi sesuai ketentuan sekolah.</li>
                <li>Menjaga sikap sopan santun, menghormati guru, staf, serta sesama siswa.</li>
                <li>Dilarang membawa barang terlarang, senjata tajam, atau perangkat elektronik yang mengganggu proses
                  belajar.</li>
                <li>Setiap pelanggaran terhadap tata tertib akan dikenai sanksi sesuai peraturan sekolah.</li>
              </ul>
            </div>


            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">3. Biaya dan Pembayaran</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>Biaya pendidikan meliputi uang pendaftaran, uang pangkal, dan biaya SPP bulanan.</li>
                <li>Seluruh pembayaran dilakukan melalui rekening resmi sekolah yang tercantum di sistem pendaftaran.
                </li>
                <li>Uang yang telah dibayarkan tidak dapat dikembalikan kecuali dalam kondisi tertentu yang disetujui
                  oleh pihak sekolah.</li>
                <li>Keterlambatan pembayaran dapat dikenai denda sesuai kebijakan keuangan sekolah.</li>
              </ul>
            </div>


            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">4. Perlindungan Data dan Privasi</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>Data pribadi siswa dan orang tua akan digunakan hanya untuk keperluan administrasi dan kegiatan
                  akademik.</li>
                <li>Sekolah berkomitmen menjaga kerahasiaan data sesuai dengan kebijakan privasi yang berlaku.</li>
                <li>Veritas School tidak akan membagikan data kepada pihak ketiga tanpa izin tertulis dari orang
                  tua/wali siswa.</li>
              </ul>
            </div>


            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">5. Kegiatan Akademik dan Non-Akademik</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>Siswa wajib mengikuti kegiatan akademik sesuai kurikulum nasional dan kurikulum tambahan Veritas
                  School.</li>
                <li>Kegiatan non-akademik seperti ekstrakurikuler, retret, dan kegiatan sosial bersifat wajib untuk
                  pengembangan karakter.</li>
                <li>Sekolah berhak melakukan perubahan jadwal atau kegiatan dengan pemberitahuan terlebih dahulu.</li>
              </ul>
            </div>


            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">6. Hak dan Tanggung Jawab Orang Tua/Wali</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>Orang tua/wali wajib memberikan informasi yang benar terkait kondisi siswa (kesehatan, akademik, dan
                  sosial).</li>
                <li>Orang tua diharapkan aktif berpartisipasi dalam kegiatan sekolah dan komunikasi dengan pihak
                  guru/wali kelas.</li>
                <li>Pihak sekolah berhak memberikan sanksi atau pemutusan hubungan belajar apabila siswa melakukan
                  pelanggaran berat.</li>
              </ul>
            </div>


            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">7. Perubahan Ketentuan</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>Veritas School berhak memperbarui atau mengubah persyaratan dan ketentuan ini sewaktu-waktu.</li>
                <li>Setiap perubahan akan diumumkan melalui website resmi atau media komunikasi sekolah lainnya.</li>
              </ul>
            </div>


            <div>
              <h3 class="text-xl font-semibold mb-2 text-gray-800">8. Pernyataan Persetujuan</h3>
              <p>
                Dengan melanjutkan proses pendaftaran dan bersekolah di Veritas School, orang tua/wali dan siswa
                menyatakan telah membaca,
                memahami, dan menyetujui seluruh persyaratan dan ketentuan yang berlaku di sekolah ini.
              </p>
            </div>
          </div>

          <div class="text-right mt-8">
            <button id="closeModalBtn" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
              Tutup
            </button>
          </div>
        </div>
      </div>


      <script>
        const modal = document.getElementById('termsModal');
        const btn = document.getElementById('termsBtn');
        const closeBtns = [document.getElementById('closeModal'), document.getElementById('closeModalBtn')];

        btn.addEventListener('click', () => {
          modal.classList.remove('hidden');
          modal.classList.add('flex');
        });

        closeBtns.forEach(button => {
          button.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
          });
        });

        modal.addEventListener('click', (e) => {
          if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
          }
        });
      </script>

    </div>


    <div id="seleksi" class="page hidden">
      <div class="bg-white p-6 rounded-xl shadow mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
          <div>
            <h2 class="text-2xl font-semibold mb-2">Hasil Seleksi Saya</h2>
            <p class="text-gray-600">Berikut adalah hasil penilaian dan status seleksi Anda</p>
          </div>
          @if($user->periode)
            <div class="mt-4 md:mt-0">
              <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700 border border-blue-300">
                <i class="fa-solid fa-calendar-alt mr-2"></i>
                Periode: {{ $user->periode->nama_periode }}
              </span>
            </div>
          @endif
        </div>

        @php
          // Hitung rata-rata nilai
          $avg = 0;
          $poinPrestasi = 0;
          $nilaiTotal = 0;
          $statusSeleksi = $user->seleksi ? $user->seleksi->status : ($user->status_seleksi ?? 'Belum Diseleksi');
          $nilaiTotalSeleksi = $user->seleksi ? $user->seleksi->nilai_total : null;

          if (
            $user->nilai_smt1 && $user->nilai_smt2 && $user->nilai_smt3 &&
            $user->nilai_smt4 && $user->nilai_smt5
          ) {
            $avg = round(($user->nilai_smt1 + $user->nilai_smt2 + $user->nilai_smt3 +
              $user->nilai_smt4 + $user->nilai_smt5) / 5, 2);

            // Hitung poin prestasi
            foreach ($user->prestasis as $prestasi) {
              $poinPrestasi += match (strtolower($prestasi->tingkat)) {
                'internasional' => 10,
                'nasional' => 7,
                'provinsi' => 5,
                'kota', 'kabupaten' => 3,
                'sekolah' => 1,
                default => 0,
              };
            }

            $nilaiTotal = round($avg + $poinPrestasi, 2);
          }
        @endphp

        <!-- Card Info Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
          <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 hover:shadow-md transition-shadow">
            <div class="text-sm text-blue-600 font-medium mb-1">Rata-rata Nilai</div>
            <div class="text-2xl font-bold text-blue-700">{{ $avg > 0 ? $avg : '-' }}</div>
            @if($avg > 0)
              <div class="text-xs text-blue-600 mt-1">Dari 5 semester</div>
            @endif
          </div>

          <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 hover:shadow-md transition-shadow">
            <div class="text-sm text-purple-600 font-medium mb-1">Poin Prestasi</div>
            <div class="text-2xl font-bold text-purple-700">+{{ $poinPrestasi }}</div>
            <div class="text-xs text-purple-600 mt-1">{{ $user->prestasis->count() }} prestasi</div>
          </div>

          <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 hover:shadow-md transition-shadow">
            <div class="text-sm text-indigo-600 font-medium mb-1">Nilai Total</div>
            <div class="text-2xl font-bold text-indigo-700">{{ $nilaiTotal > 0 ? $nilaiTotal : '-' }}</div>
            @if($nilaiTotalSeleksi && $nilaiTotalSeleksi != $nilaiTotal)
              <div class="text-xs text-indigo-600 mt-1">Nilai resmi: {{ $nilaiTotalSeleksi }}</div>
            @endif
          </div>

          <div class="bg-{{ $statusSeleksi === 'Lulus' ? 'green' : ($statusSeleksi === 'Tidak Lulus' ? 'red' : ($statusSeleksi === 'Dipertimbangkan' ? 'yellow' : 'gray')) }}-50 
                    border border-{{ $statusSeleksi === 'Lulus' ? 'green' : ($statusSeleksi === 'Tidak Lulus' ? 'red' : ($statusSeleksi === 'Dipertimbangkan' ? 'yellow' : 'gray')) }}-200 
                    rounded-lg p-4 hover:shadow-md transition-shadow">
            <div class="text-sm text-{{ $statusSeleksi === 'Lulus' ? 'green' : ($statusSeleksi === 'Tidak Lulus' ? 'red' : ($statusSeleksi === 'Dipertimbangkan' ? 'yellow' : 'gray')) }}-600 font-medium mb-1">
              Status Seleksi
            </div>
            <div class="text-xl md:text-2xl font-bold text-{{ $statusSeleksi === 'Lulus' ? 'green' : ($statusSeleksi === 'Tidak Lulus' ? 'red' : ($statusSeleksi === 'Dipertimbangkan' ? 'yellow' : 'gray')) }}-700">
              {{ $statusSeleksi }}
            </div>
            @if($user->seleksi && $user->seleksi->updated_at)
              <div class="text-xs text-{{ $statusSeleksi === 'Lulus' ? 'green' : ($statusSeleksi === 'Tidak Lulus' ? 'red' : ($statusSeleksi === 'Dipertimbangkan' ? 'yellow' : 'gray')) }}-600 mt-1">
                Diperbarui: {{ $user->seleksi->updated_at->format('d/m/Y') }}
              </div>
            @endif
          </div>
        </div>

        <!-- Catatan dari Admin -->
        @if($user->seleksi && $user->seleksi->catatan)
          <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mb-6">
            <div class="flex items-start">
              <i class="fa-solid fa-sticky-note text-blue-500 text-lg mr-3 mt-0.5"></i>
              <div class="flex-1">
                <h4 class="font-semibold text-blue-800 mb-1">Catatan dari Admin</h4>
                <p class="text-sm text-blue-700">{{ $user->seleksi->catatan }}</p>
              </div>
            </div>
          </div>
        @endif

        <!-- Detail Data -->
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
          <h3 class="text-lg font-semibold mb-4 text-gray-800">Detail Penilaian</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Data Pribadi -->
            <div>
              <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Data Pribadi</h4>
              <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                  <span class="text-gray-600">NISN:</span>
                  <span class="font-medium">{{ $user->nisn_pendaftar ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Nama Lengkap:</span>
                  <span class="font-medium">{{ $user->nama_pendaftar ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Tanggal Lahir:</span>
                  <span
                    class="font-medium">{{ $user->tanggallahir_pendaftar ? \Carbon\Carbon::parse($user->tanggallahir_pendaftar)->format('d F Y') : '-' }}</span>
                </div>
              </div>
            </div>

            <!-- Nilai Semester -->
            <div>
              <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Nilai Per Semester</h4>
              <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                  <span class="text-gray-600">Semester 1:</span>
                  <span class="font-medium">{{ $user->nilai_smt1 ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Semester 2:</span>
                  <span class="font-medium">{{ $user->nilai_smt2 ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Semester 3:</span>
                  <span class="font-medium">{{ $user->nilai_smt3 ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Semester 4:</span>
                  <span class="font-medium">{{ $user->nilai_smt4 ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-600">Semester 5:</span>
                  <span class="font-medium">{{ $user->nilai_smt5 ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-t pt-2 mt-2">
                  <span class="text-gray-800 font-semibold">Rata-rata:</span>
                  <span class="font-bold text-blue-600">{{ $avg }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Daftar Prestasi -->
        <div class="bg-white rounded-lg border p-6 mb-6">
          <h3 class="text-lg font-semibold mb-4 text-gray-800">Prestasi yang Dinilai</h3>

          @if($user->prestasis->count() > 0)
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama Prestasi</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Tingkat</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Tahun</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Poin</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  @foreach($user->prestasis as $index => $prestasi)
                    @php
                      $poin = match (strtolower($prestasi->tingkat)) {
                        'internasional' => 10,
                        'nasional' => 7,
                        'provinsi' => 5,
                        'kota', 'kabupaten' => 3,
                        'sekolah' => 1,
                        default => 0,
                      };
                    @endphp
                    <tr class="hover:bg-gray-50">
                      <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                      <td class="px-4 py-3 text-sm">{{ $prestasi->nama_prestasi }}</td>
                      <td class="px-4 py-3 text-sm text-center">
                        <span
                          class="px-2 py-1 rounded-full text-xs font-medium
                                                {{ strtolower($prestasi->tingkat) === 'internasional' ? 'bg-purple-100 text-purple-700' : '' }}
                                                {{ strtolower($prestasi->tingkat) === 'nasional' ? 'bg-blue-100 text-blue-700' : '' }}
                                                {{ strtolower($prestasi->tingkat) === 'provinsi' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ in_array(strtolower($prestasi->tingkat), ['kota', 'kabupaten']) ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                {{ strtolower($prestasi->tingkat) === 'sekolah' ? 'bg-gray-100 text-gray-700' : '' }}">
                          {{ ucfirst($prestasi->tingkat) }}
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm text-center">{{ $prestasi->tahun }}</td>
                      <td class="px-4 py-3 text-sm text-center font-bold text-purple-600">+{{ $poin }}</td>
                    </tr>
                  @endforeach
                  <tr class="bg-purple-50 font-semibold">
                    <td colspan="4" class="px-4 py-3 text-right text-sm">Total Poin Prestasi:</td>
                    <td class="px-4 py-3 text-center text-sm font-bold text-purple-700">+{{ $poinPrestasi }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          @else
            <div class="text-center py-8 text-gray-500">
              <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <p class="font-medium">Tidak ada prestasi yang terdaftar</p>
              <p class="text-sm mt-1">Poin prestasi: 0</p>
            </div>
          @endif
        </div>

        <!-- Keterangan Poin -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
          <h4 class="font-medium text-blue-800 mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd" />
            </svg>
            Keterangan Poin Prestasi
          </h4>
          <div class="grid grid-cols-2 md:grid-cols-5 gap-3 text-sm">
            <div class="flex items-center">
              <span class="w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
              <span>Internasional: <strong>+10</strong></span>
            </div>
            <div class="flex items-center">
              <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
              <span>Nasional: <strong>+7</strong></span>
            </div>
            <div class="flex items-center">
              <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
              <span>Provinsi: <strong>+5</strong></span>
            </div>
            <div class="flex items-center">
              <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
              <span>Kota/Kab: <strong>+3</strong></span>
            </div>
            <div class="flex items-center">
              <span class="w-3 h-3 bg-gray-500 rounded-full mr-2"></span>
              <span>Sekolah: <strong>+1</strong></span>
            </div>
          </div>
        </div>

        <!-- Info Status -->
        @if($statusSeleksi === 'Lulus')
          <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mt-6 animate-fadeIn">
            <div class="flex items-start">
              <i class="fa-solid fa-check-circle text-green-600 text-xl mr-3 mt-0.5"></i>
              <div class="flex-1">
                <h4 class="font-semibold text-green-800 mb-1">Selamat! Anda Lulus Seleksi</h4>
                <p class="text-sm text-green-700 mb-2">Anda berhasil memenuhi kriteria seleksi. Silakan tunggu informasi lebih lanjut mengenai tahap berikutnya.</p>
                @if($user->seleksi && $user->seleksi->updated_at)
                  <p class="text-xs text-green-600">
                    <i class="fa-solid fa-calendar mr-1"></i>
                    Pengumuman: {{ $user->seleksi->updated_at->format('d F Y, H:i') }}
                  </p>
                @endif
              </div>
            </div>
          </div>
        @elseif($statusSeleksi === 'Tidak Lulus')
          <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mt-6 animate-fadeIn">
            <div class="flex items-start">
              <i class="fa-solid fa-times-circle text-red-600 text-xl mr-3 mt-0.5"></i>
              <div class="flex-1">
                <h4 class="font-semibold text-red-800 mb-1">Mohon Maaf</h4>
                <p class="text-sm text-red-700 mb-2">Anda belum memenuhi kriteria seleksi pada tahap ini. Terima kasih atas partisipasi Anda.</p>
                @if($user->seleksi && $user->seleksi->updated_at)
                  <p class="text-xs text-red-600">
                    <i class="fa-solid fa-calendar mr-1"></i>
                    Diperbarui: {{ $user->seleksi->updated_at->format('d F Y, H:i') }}
                  </p>
                @endif
              </div>
            </div>
          </div>
        @elseif($statusSeleksi === 'Dipertimbangkan')
          <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4 mt-6 animate-fadeIn">
            <div class="flex items-start">
              <i class="fa-solid fa-hourglass-half text-yellow-600 text-xl mr-3 mt-0.5"></i>
              <div class="flex-1">
                <h4 class="font-semibold text-yellow-800 mb-1">Status: Dipertimbangkan</h4>
                <p class="text-sm text-yellow-700 mb-2">Data Anda sedang dalam proses pertimbangan lebih lanjut oleh tim seleksi.</p>
                @if($user->seleksi && $user->seleksi->updated_at)
                  <p class="text-xs text-yellow-600">
                    <i class="fa-solid fa-calendar mr-1"></i>
                    Diperbarui: {{ $user->seleksi->updated_at->format('d F Y, H:i') }}
                  </p>
                @endif
              </div>
            </div>
          </div>
        @else
          <div class="bg-gray-50 border-l-4 border-gray-400 rounded-lg p-4 mt-6">
            <div class="flex items-start">
              <i class="fa-solid fa-clock text-gray-600 text-xl mr-3 mt-0.5"></i>
              <div class="flex-1">
                <h4 class="font-semibold text-gray-800 mb-1">Status: Belum Diseleksi</h4>
                <p class="text-sm text-gray-700">Proses seleksi belum dimulai atau data Anda belum lengkap. Pastikan semua data dan berkas telah lengkap dan terkunci.</p>
                @if(!$user->berkas_locked || !$user->identitas_locked)
                  <div class="mt-2 text-xs text-gray-600">
                    <p class="font-medium mb-1">Lengkapi data berikut:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                      @if(!$user->identitas_locked) <li>Data identitas belum dikunci</li> @endif
                      @if(!$user->berkas_locked) <li>Berkas belum diupload dan dikunci</li> @endif
                    </ul>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif

        <!-- TAMBAHKAN INI: Daftar Semua Pendaftar yang Sedang Diseleksi -->
        <div class="bg-white rounded-lg border p-6 mt-8">
          <div class="flex justify-between items-center mb-4">
            <div>
              <h3 class="text-lg font-semibold text-gray-800">Daftar Pendaftar yang Sedang Diseleksi</h3>
              <p class="text-sm text-gray-600 mt-1">Ranking berdasarkan nilai total tertinggi</p>
            </div>
            <div class="flex items-center gap-2 text-sm">
              <span class="px-3 py-1 bg-gray-100 rounded-full font-medium">
                Total: {{ \App\Models\User::where('role', 'PENDAFTAR')->count() }} Pendaftar
              </span>
            </div>
          </div>

          @php
            // Ambil semua pendaftar dan hitung nilainya
            $allPendaftar = \App\Models\User::where('role', 'PENDAFTAR')
              ->with('prestasis')
              ->get()
              ->map(function ($pendaftar) {
                // Hitung rata-rata
                if (
                  $pendaftar->nilai_smt1 && $pendaftar->nilai_smt2 && $pendaftar->nilai_smt3 &&
                  $pendaftar->nilai_smt4 && $pendaftar->nilai_smt5
                ) {

                  $avg = round(($pendaftar->nilai_smt1 + $pendaftar->nilai_smt2 + $pendaftar->nilai_smt3 +
                    $pendaftar->nilai_smt4 + $pendaftar->nilai_smt5) / 5, 2);

                  // Hitung poin prestasi
                  $poinPrestasi = 0;
                  foreach ($pendaftar->prestasis as $prestasi) {
                    $poinPrestasi += match (strtolower($prestasi->tingkat)) {
                      'internasional' => 10,
                      'nasional' => 7,
                      'provinsi' => 5,
                      'kota', 'kabupaten' => 3,
                      'sekolah' => 1,
                      default => 0,
                    };
                  }

                  $pendaftar->_avg = $avg;
                  $pendaftar->_poin = $poinPrestasi;
                  $pendaftar->_total = round($avg + $poinPrestasi, 2);
                } else {
                  $pendaftar->_avg = 0;
                  $pendaftar->_poin = 0;
                  $pendaftar->_total = 0;
                }

                return $pendaftar;
              })
              ->sortByDesc('_total')
              ->values();

            // Cari ranking user yang login
            $myRank = $allPendaftar->search(function ($p) use ($user) {
              return $p->id === $user->id;
            }) + 1;
          @endphp

          <!-- Info Ranking User -->
          <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <svg class="w-6 h-6 text-indigo-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <div>
                  <span class="font-semibold text-indigo-800">Ranking Anda: #{{ $myRank }}</span>
                  <span class="text-sm text-indigo-600 ml-2">dari {{ $allPendaftar->count() }} pendaftar</span>
                </div>
              </div>
              <div class="text-right">
                <div class="text-sm text-indigo-600">Nilai Total Anda</div>
                <div class="text-xl font-bold text-indigo-800">{{ $nilaiTotal }}</div>
              </div>
            </div>
          </div>

          <!-- Tabel Pendaftar -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-16">
                    Rank
                  </th>
                  <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Nama Lengkap
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Tanggal Lahir
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Rata-rata
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Poin Prestasi
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Nilai Total
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($allPendaftar as $index => $pendaftar)
                  <tr
                    class="hover:bg-gray-50 {{ $pendaftar->id === $user->id ? 'bg-indigo-50 border-l-4 border-indigo-500' : '' }}">
                    <td class="px-4 py-3 text-center">
                      @if($index < 3)
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold text-white
                                                {{ $index === 0 ? 'bg-yellow-500' : '' }}
                                                {{ $index === 1 ? 'bg-gray-400' : '' }}
                                                {{ $index === 2 ? 'bg-orange-600' : '' }}">
                          {{ $index + 1 }}
                        </span>
                      @else
                        <span class="text-sm font-semibold text-gray-600">{{ $index + 1 }}</span>
                      @endif
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center">
                        @if($pendaftar->id === $user->id)
                          <svg class="w-5 h-5 text-indigo-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd" />
                          </svg>
                        @endif
                        <div>
                          <div class="text-sm font-medium text-gray-900">
                            {{ $pendaftar->nama_pendaftar ?? '-' }}
                            @if($pendaftar->id === $user->id)
                              <span class="ml-2 text-xs font-semibold text-indigo-600">(Anda)</span>
                            @endif
                          </div>
                          <div class="text-xs text-gray-500">NISN: {{ $pendaftar->nisn_pendaftar ?? '-' }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-center text-sm text-gray-600">
                      {{ $pendaftar->tanggallahir_pendaftar ? \Carbon\Carbon::parse($pendaftar->tanggallahir_pendaftar)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-3 text-center text-sm font-medium text-blue-600">
                      {{ $pendaftar->_avg }}
                    </td>
                    <td class="px-4 py-3 text-center text-sm font-medium text-purple-600">
                      +{{ $pendaftar->_poin }}
                    </td>
                    <td class="px-4 py-3 text-center text-sm font-bold text-indigo-700">
                      {{ $pendaftar->_total }}
                    </td>
                    <td class="px-4 py-3 text-center">
                      @php
                        $statusP = $pendaftar->seleksi ? $pendaftar->seleksi->status : ($pendaftar->status_seleksi ?? 'Belum Diseleksi');
                      @endphp
                      <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                      {{ $statusP === 'Lulus' ? 'bg-green-100 text-green-800' : '' }}
                                      {{ $statusP === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : '' }}
                                      {{ $statusP === 'Belum Diseleksi' ? 'bg-gray-100 text-gray-800' : '' }}
                                      {{ $statusP === 'Dipertimbangkan' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                        {{ $statusP }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- Legend -->
          <div class="mt-4 pt-4 border-t border-gray-200">
            <div class="flex flex-wrap gap-4 text-xs text-gray-600">
              <div class="flex items-center">
                <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                <span>Ranking 1 (Emas)</span>
              </div>
              <div class="flex items-center">
                <span class="w-3 h-3 bg-gray-400 rounded-full mr-2"></span>
                <span>Ranking 2 (Perak)</span>
              </div>
              <div class="flex items-center">
                <span class="w-3 h-3 bg-orange-600 rounded-full mr-2"></span>
                <span>Ranking 3 (Perunggu)</span>
              </div>
              <div class="flex items-center">
                <span class="w-3 h-3 bg-indigo-500 rounded-full mr-2"></span>
                <span>Data Anda</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>





    <div id="identitas" class="page hidden">
      <div class="bg-white p-4 md:p-6 rounded-xl shadow mb-8 mt-4 md:mt-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-semibold">Data Diri Pendaftar</h2>
          @if($user->identitas_locked)
            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium flex items-center">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd" />
              </svg>
              Data Terkunci
            </span>
          @endif
        </div>

        <!-- Alert jika data sudah terkunci -->
        @if($user->identitas_locked)
          <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm text-yellow-700">
                  <strong>Data identitas Anda telah dikunci.</strong><br>
                  Data tidak dapat diubah lagi. Jika terdapat kesalahan input, silakan hubungi operator melalui:
                  <br>
                  <span class="font-semibold">WhatsApp: 0812-3456-7890</span> atau
                  <span class="font-semibold">Email: operator@sekolah.sch.id</span>
                </p>
                <p class="text-xs text-yellow-600 mt-2">
                  Dikunci pada:
                  {{ $user->identitas_submitted_at ? \Carbon\Carbon::parse($user->identitas_submitted_at)->format('d F Y, H:i') : '-' }}
                </p>
              </div>
            </div>
          </div>
        @endif

        <form action="{{ route('pendaftar.update') }}" method="POST" class="space-y-6" x-data="{ loading: false }"
          @submit="loading = true">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block font-semibold mb-1">NISN</label>
              <input type="text" name="nisn_pendaftar"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('nisn_pendaftar') border-red-500 @enderror"
                value="{{ old('nisn_pendaftar', $user->nisn_pendaftar) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
              @error('nisn_pendaftar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block font-semibold mb-1">Nama Lengkap</label>
              <input type="text" name="nama_pendaftar"
                class="w-full border rounded p-2 capitalize-name {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('nama_pendaftar') border-red-500 @enderror"
                value="{{ old('nama_pendaftar', $user->nama_pendaftar) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
              @error('nama_pendaftar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block font-semibold mb-1">Jenis Kelamin</label>
              <div class="flex gap-4 mt-2">
                <label class="flex items-center gap-2 cursor-pointer {{ $user->identitas_locked ? 'opacity-70' : '' }}">
                  <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'Laki-laki' ? 'checked' : '' }} {{ $user->identitas_locked ? 'disabled' : 'required' }} class="rounded-full border-gray-300 text-blue-600 focus:ring-blue-500">
                  <span>Laki-laki</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer {{ $user->identitas_locked ? 'opacity-70' : '' }}">
                  <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'Perempuan' ? 'checked' : '' }} {{ $user->identitas_locked ? 'disabled' : '' }} class="rounded-full border-gray-300 text-blue-600 focus:ring-blue-500">
                  <span>Perempuan</span>
                </label>
              </div>
              @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block font-semibold mb-1">Tanggal Lahir</label>
              <input type="date" name="tanggallahir_pendaftar"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('tanggallahir_pendaftar') border-red-500 @enderror"
                value="{{ old('tanggallahir_pendaftar', $user->tanggallahir_pendaftar) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
              @error('tanggallahir_pendaftar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block font-semibold mb-1">Agama</label>
              <input type="text" name="agama"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('agama') border-red-500 @enderror"
                value="{{ old('agama', $user->agama) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
              @error('agama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="col-span-2">
              <label class="block font-semibold mb-1">Alamat</label>
              <textarea name="alamat_pendaftar"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('alamat_pendaftar') border-red-500 @enderror"
                {{ $user->identitas_locked ? 'readonly' : 'required' }}>{{ old('alamat_pendaftar', $user->alamat_pendaftar) }}</textarea>
              @error('alamat_pendaftar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
          </div>

          <hr class="my-4">
          <h2 class="text-2xl font-semibold mb-4">Data Orang Tua</h2>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block font-semibold mb-1">Nama Orang Tua</label>
              <input type="text" name="nama_ortu"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('nama_ortu') border-red-500 @enderror"
                value="{{ old('nama_ortu', $user->nama_ortu) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
              @error('nama_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block font-semibold mb-1">Pekerjaan</label>
              <input type="text" name="pekerjaan_ortu"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('pekerjaan_ortu') border-red-500 @enderror"
                value="{{ old('pekerjaan_ortu', $user->pekerjaan_ortu) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
              @error('pekerjaan_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="block font-semibold mb-1">No HP</label>
              <input type="text" name="no_hp_ortu"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('no_hp_ortu') border-red-500 @enderror"
                value="{{ old('no_hp_ortu', $user->no_hp_ortu) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
              @error('no_hp_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="col-span-2">
              <label class="block font-semibold mb-1">Alamat Orang Tua</label>
              <textarea name="alamat_ortu"
                class="w-full border rounded p-2 {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('alamat_ortu') border-red-500 @enderror"
                {{ $user->identitas_locked ? 'readonly' : 'required' }}>{{ old('alamat_ortu', $user->alamat_ortu) }}</textarea>
              @error('alamat_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
          </div>

          <hr class="my-4">
          <h2 class="text-2xl font-semibold mb-4">Nilai Semester</h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
            @for ($i = 1; $i <= 5; $i++)
              <div>
                <label class="block font-semibold mb-1">SMT {{ $i }}</label>
                <input type="number" name="nilai_smt{{ $i }}" step="0.01" min="0" max="100"
                  class="w-full border rounded p-2 text-center {{ $user->identitas_locked ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('nilai_smt' . $i) border-red-500 @enderror"
                  value="{{ old('nilai_smt' . $i, $user->{'nilai_smt' . $i}) }}" {{ $user->identitas_locked ? 'readonly' : 'required' }}>
                @error('nilai_smt' . $i) <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
            @endfor
          </div>

          @if(!$user->identitas_locked)
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mt-6">
              <div class="flex">
                <div class="flex-shrink-0">
                  <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="ml-3">
                  <p class="text-sm text-blue-700">
                    <strong>Perhatian!</strong> Setelah menekan tombol "Simpan Data", data identitas Anda akan
                    <strong>terkunci</strong> dan tidak dapat diubah lagi. Pastikan semua data yang Anda input sudah
                    benar.
                  </p>
                </div>
              </div>
            </div>

            <div class="text-right mt-6">
              <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-semibold inline-flex items-center gap-2"
                :disabled="loading">
                <span x-show="loading"
                  class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span>
                <span x-text="loading ? 'Memproses...' : 'Simpan & Kunci Data'"></span>
              </button>
            </div>
          @else
            <div class="text-center mt-6 text-gray-500">
              <p>Data tidak dapat diubah. Hubungi operator jika ada kesalahan.</p>
            </div>
          @endif
        </form>
      </div>
    </div>


    <div id="prestasi" class="page hidden">
      <div class="bg-white p-6 rounded-xl shadow mb-8">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-semibold">Upload Prestasi</h2>
          @if($user->prestasi_locked)
            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium flex items-center">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd" />
              </svg>
              Prestasi Terkunci
            </span>
          @endif
        </div>

        @if($user->prestasi_locked)
          <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm text-yellow-700">
                  <strong>Data prestasi telah dikunci.</strong><br>
                  Data tidak dapat diubah lagi. Jika terdapat kesalahan, silakan hubungi operator.
                </p>
                @if($user->prestasi_submitted_at)
                  <p class="text-xs text-yellow-600 mt-2">
                    Dikunci pada: {{ $user->prestasi_submitted_at->format('d F Y, H:i') }}
                  </p>
                @endif
              </div>
            </div>
          </div>
        @endif

        <!-- Form Tambah Prestasi -->
        @if(!$user->prestasi_locked)
          <form action="{{ route('pendaftar.uploadPrestasi') }}" method="POST" enctype="multipart/form-data" class="mb-8"
            x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="col-span-2">
                <label class="block font-semibold mb-2">Nama Prestasi</label>
                <input type="text" name="nama_prestasi"
                  class="w-full border rounded p-2 @error('nama_prestasi') border-red-500 @enderror" required>
                @error('nama_prestasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block font-semibold mb-2">Tingkat</label>
                <select name="tingkat" class="w-full border rounded p-2 @error('tingkat') border-red-500 @enderror"
                  required>
                  <option value="">Pilih Tingkat</option>
                  <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional (+10
                    poin)</option>
                  <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional (+7 poin)</option>
                  <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi (+5 poin)</option>
                  <option value="Kota" {{ old('tingkat') == 'Kota' ? 'selected' : '' }}>Kota (+3 poin)</option>
                  <option value="Kabupaten" {{ old('tingkat') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten (+3 poin)
                  </option>
                  <option value="Sekolah" {{ old('tingkat') == 'Sekolah' ? 'selected' : '' }}>Sekolah (+1 poin)</option>
                </select>
                @error('tingkat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block font-semibold mb-2">Tahun</label>
                <input type="number" name="tahun" min="2000" max="{{ date('Y') }}"
                  class="w-full border rounded p-2 @error('tahun') border-red-500 @enderror" required
                  value="{{ old('tahun') }}">
                @error('tahun') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>

              <div class="col-span-2">
                <label class="block font-semibold mb-2">Foto Prestasi (Opsional)</label>
                <input type="file" name="foto_prestasi" accept="image/*"
                  class="w-full border rounded p-2 @error('foto_prestasi') border-red-500 @enderror">
                @error('foto_prestasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
              </div>
            </div>

            <div class="text-right mt-4">
              <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 inline-flex items-center gap-2"
                :disabled="loading">
                <span x-show="loading"
                  class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span>
                <span x-text="loading ? 'Menambahkan...' : 'Tambah Prestasi'"></span>
              </button>
            </div>
          </form>
        @endif

        <!-- Daftar Prestasi -->
        <div class="border-t pt-6">
          <h3 class="text-xl font-semibold mb-4">Daftar Prestasi Anda</h3>

          @if($user->prestasis->count() > 0)
            <div class="space-y-4">
              @foreach($user->prestasis as $index => $prestasi)
                @php
                  $poin = match (strtolower($prestasi->tingkat)) {
                    'internasional' => 10,
                    'nasional' => 7,
                    'provinsi' => 5,
                    'kota', 'kabupaten' => 3,
                    'sekolah' => 1,
                    default => 0,
                  };
                @endphp
                <div class="border-2 rounded-lg p-4 flex justify-between items-start hover:shadow-md transition-shadow {{ $user->prestasi_approved && $prestasi->id ? 'border-green-200 bg-green-50/30' : '' }}">
                  <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                      <h4 class="font-semibold text-gray-800">{{ $prestasi->nama_prestasi }}</h4>
                      @if($user->prestasi_approved)
                        <span class="text-xs text-green-600">
                          <i class="fa-solid fa-check-circle"></i> Terverifikasi
                        </span>
                      @endif
                    </div>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                      <span>
                        <i class="fa-solid fa-trophy text-amber-500 mr-1"></i>
                        Tingkat: <strong>{{ $prestasi->tingkat }}</strong>
                      </span>
                      <span>
                        <i class="fa-solid fa-calendar text-blue-500 mr-1"></i>
                        Tahun: <strong>{{ $prestasi->tahun }}</strong>
                      </span>
                      <span class="px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                        +{{ $poin }} poin
                      </span>
                    </div>
                    @if($prestasi->foto_prestasi)
                      <a href="{{ asset('storage/' . $prestasi->foto_prestasi) }}" target="_blank"
                        class="text-blue-600 text-xs hover:underline mt-2 inline-flex items-center">
                        <i class="fa-solid fa-image mr-1"></i> Lihat Foto Prestasi
                      </a>
                    @endif
                  </div>
                  @if(!$user->prestasi_locked)
                    <form action="{{ route('pendaftar.hapusPrestasi', $prestasi->id) }}" method="POST" class="ml-4" 
                      x-data="{ loading: false }" @submit="loading = true">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded hover:bg-red-50 transition-colors"
                        :disabled="loading"
                        onclick="return confirm('Yakin ingin menghapus prestasi ini? Data yang sudah dihapus tidak dapat dikembalikan.')">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  @endif
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
              <i class="fa-solid fa-trophy text-4xl text-gray-400 mb-3"></i>
              <p class="text-gray-600 font-medium mb-1">Belum ada prestasi yang ditambahkan</p>
              <p class="text-sm text-gray-500">Tambahkan prestasi Anda untuk meningkatkan nilai seleksi</p>
            </div>
          @endif

          <!-- Tombol Kunci Prestasi -->
          @if(!$user->prestasi_locked)
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mt-6">
              <div class="flex">
                <div class="flex-shrink-0">
                  <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="ml-3">
                  <p class="text-sm text-blue-700">
                    <strong>Selesai menambahkan prestasi?</strong> Klik tombol di bawah untuk mengunci data prestasi.
                    Setelah dikunci, data tidak dapat diubah lagi.
                  </p>
                </div>
              </div>
            </div>

            <form action="{{ route('pendaftar.lockPrestasi') }}" method="POST" class="text-center mt-4"
              x-data="{ loading: false }" @submit="loading = true">
              @csrf
              <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-semibold inline-flex items-center gap-2"
                onclick="return confirm('Apakah Anda yakin ingin mengunci data prestasi? Data tidak dapat diubah lagi setelah dikunci.')"
                :disabled="loading">
                <span x-show="loading"
                  class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span>
                <span x-text="loading ? 'Mengunci...' : 'Kunci Data Prestasi'"></span>
              </button>
            </form>
          @endif
        </div>
      </div>
    </div>


    <div id="berkas" class="page hidden">
      <div class="bg-white p-6 rounded-xl shadow mb-8">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-semibold">Upload Berkas</h2>
          @if($user->berkas_locked)
            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium flex items-center">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd" />
              </svg>
              Berkas Terkunci
            </span>
          @endif
        </div>

        @if($user->berkas_locked)
          <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm text-yellow-700">
                  <strong>Berkas telah dikunci.</strong><br>
                  Berkas tidak dapat diubah lagi. Jika terdapat kesalahan, silakan hubungi operator.
                </p>
                @if($user->berkas_submitted_at)
                  <p class="text-xs text-yellow-600 mt-2">
                    Dikunci pada: {{ $user->berkas_submitted_at->format('d F Y, H:i') }}
                  </p>
                @endif
              </div>
            </div>
          </div>
        @endif

        <form action="{{ route('pendaftar.uploadBerkas') }}" method="POST" enctype="multipart/form-data"
          x-data="{ loading: false }" @submit="loading = true">
          @csrf
          
          <!-- Informasi Format File -->
          @if(!$user->berkas_locked)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
              <div class="flex items-start">
                <i class="fa-solid fa-info-circle text-blue-500 text-lg mr-3 mt-0.5"></i>
                <div class="flex-1">
                  <h4 class="font-semibold text-blue-800 mb-2">Petunjuk Upload Berkas</h4>
                  <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
                    <li>Format file yang diterima: PDF, JPG, JPEG, PNG</li>
                    <li>Ukuran maksimal per file: 2 MB</li>
                    <li>Pastikan file jelas dan mudah dibaca</li>
                    <li>Setelah upload, berkas akan terkunci otomatis dan tidak dapat diubah</li>
                  </ul>
                </div>
              </div>
            </div>
          @endif

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block font-semibold mb-2 text-gray-700">
                Ijazah / SKHUN <span class="text-red-500">*</span>
              </label>
              <input type="file" name="ijazah_skhun" accept="image/*,application/pdf"
                class="w-full border-2 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition {{ $user->berkas_locked ? 'bg-gray-100 cursor-not-allowed' : 'hover:border-gray-400' }} @error('ijazah_skhun') border-red-500 bg-red-50 @enderror"
                {{ $user->berkas_locked ? 'disabled' : 'required' }}>
              @error('ijazah_skhun')
                <p class="text-red-600 text-xs mt-1.5 flex items-center">
                  <i class="fa-solid fa-exclamation-circle mr-1"></i>
                  {{ $message }}
                </p>
              @enderror
              @if ($berkas && $berkas->ijazah_skhun)
                <div class="mt-2">
                  <a href="{{ asset('storage/' . $berkas->ijazah_skhun) }}" target="_blank"
                    class="text-blue-600 text-sm hover:text-blue-800 hover:underline inline-flex items-center">
                    <i class="fa-solid fa-eye mr-1"></i> Lihat Ijazah
                  </a>
                  @if($user->berkas_approved)
                    <span class="ml-2 text-xs text-green-600">
                      <i class="fa-solid fa-check-circle"></i> Terverifikasi
                    </span>
                  @endif
                </div>
              @endif
            </div>

            <div>
              <label class="block font-semibold mb-2 text-gray-700">
                Akta Kelahiran <span class="text-red-500">*</span>
              </label>
              <input type="file" name="akta_kelahiran" accept="image/*,application/pdf"
                class="w-full border-2 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition {{ $user->berkas_locked ? 'bg-gray-100 cursor-not-allowed' : 'hover:border-gray-400' }} @error('akta_kelahiran') border-red-500 bg-red-50 @enderror"
                {{ $user->berkas_locked ? 'disabled' : 'required' }}>
              @error('akta_kelahiran')
                <p class="text-red-600 text-xs mt-1.5 flex items-center">
                  <i class="fa-solid fa-exclamation-circle mr-1"></i>
                  {{ $message }}
                </p>
              @enderror
              @if ($berkas && $berkas->akta_kelahiran)
                <div class="mt-2">
                  <a href="{{ asset('storage/' . $berkas->akta_kelahiran) }}" target="_blank"
                    class="text-blue-600 text-sm hover:text-blue-800 hover:underline inline-flex items-center">
                    <i class="fa-solid fa-eye mr-1"></i> Lihat Akta
                  </a>
                  @if($user->berkas_approved)
                    <span class="ml-2 text-xs text-green-600">
                      <i class="fa-solid fa-check-circle"></i> Terverifikasi
                    </span>
                  @endif
                </div>
              @endif
            </div>

            <div>
              <label class="block font-semibold mb-2 text-gray-700">
                Kartu Keluarga <span class="text-red-500">*</span>
              </label>
              <input type="file" name="kk" accept="image/*,application/pdf"
                class="w-full border-2 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition {{ $user->berkas_locked ? 'bg-gray-100 cursor-not-allowed' : 'hover:border-gray-400' }} @error('kk') border-red-500 bg-red-50 @enderror"
                {{ $user->berkas_locked ? 'disabled' : 'required' }}>
              @error('kk')
                <p class="text-red-600 text-xs mt-1.5 flex items-center">
                  <i class="fa-solid fa-exclamation-circle mr-1"></i>
                  {{ $message }}
                </p>
              @enderror
              @if ($berkas && $berkas->kk)
                <div class="mt-2">
                  <a href="{{ asset('storage/' . $berkas->kk) }}" target="_blank"
                    class="text-blue-600 text-sm hover:text-blue-800 hover:underline inline-flex items-center">
                    <i class="fa-solid fa-eye mr-1"></i> Lihat KK
                  </a>
                  @if($user->berkas_approved)
                    <span class="ml-2 text-xs text-green-600">
                      <i class="fa-solid fa-check-circle"></i> Terverifikasi
                    </span>
                  @endif
                </div>
              @endif
            </div>

            <div>
              <label class="block font-semibold mb-2 text-gray-700">
                Pas Foto <span class="text-red-500">*</span>
              </label>
              <input type="file" name="pas_foto" accept="image/*"
                class="w-full border-2 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition {{ $user->berkas_locked ? 'bg-gray-100 cursor-not-allowed' : 'hover:border-gray-400' }} @error('pas_foto') border-red-500 bg-red-50 @enderror"
                {{ $user->berkas_locked ? 'disabled' : 'required' }}>
              @error('pas_foto')
                <p class="text-red-600 text-xs mt-1.5 flex items-center">
                  <i class="fa-solid fa-exclamation-circle mr-1"></i>
                  {{ $message }}
                </p>
              @enderror
              @if ($berkas && $berkas->pas_foto)
                <div class="mt-2">
                  <a href="{{ asset('storage/' . $berkas->pas_foto) }}" target="_blank"
                    class="text-blue-600 text-sm hover:text-blue-800 hover:underline inline-flex items-center">
                    <i class="fa-solid fa-eye mr-1"></i> Lihat Pas Foto
                  </a>
                  @if($user->berkas_approved)
                    <span class="ml-2 text-xs text-green-600">
                      <i class="fa-solid fa-check-circle"></i> Terverifikasi
                    </span>
                  @endif
                </div>
              @endif
            </div>
          </div>

          @if(!$user->berkas_locked)
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 mt-6 rounded-r-lg">
              <div class="flex items-start">
                <i class="fa-solid fa-exclamation-triangle text-amber-500 text-lg mr-3 mt-0.5"></i>
                <div class="flex-1">
                  <p class="text-sm text-amber-800 font-medium mb-1">Peringatan Penting!</p>
                  <p class="text-sm text-amber-700">
                    Setelah menekan tombol "Upload & Kunci Berkas", semua berkas akan <strong>terkunci otomatis</strong> dan tidak dapat diubah lagi. Pastikan semua file sudah benar sebelum mengupload.
                  </p>
                </div>
              </div>
            </div>

            <div class="text-right mt-6">
              <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold inline-flex items-center gap-2 shadow-md hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="loading">
                <span x-show="loading"
                  class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span>
                <span x-show="!loading">
                  <i class="fa-solid fa-upload mr-1"></i> Upload & Kunci Berkas
                </span>
                <span x-show="loading" x-cloak>Mengupload...</span>
              </button>
            </div>
          @endif
        </form>
      </div>
    </div>





    <div id="panduan" class="page hidden  mx-auto">
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-8 sm:px-8 sm:py-10">
          <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-3 text-center">
            Panduan Pendaftaran Siswa Baru
          </h2>
          <p class="text-blue-100 text-center text-sm sm:text-base max-w-2xl mx-auto">
            Ikuti langkah-langkah berikut untuk melengkapi proses pendaftaran secara online dengan benar dan mudah
          </p>
        </div>

        <!-- Content -->
        <div class="px-4 py-6 sm:px-8 sm:py-10">
          <div class="space-y-6 sm:space-y-8">

            <!-- Step 1 -->
            <div class="flex gap-4 sm:gap-5 group">
              <div class="flex-shrink-0">
                <div
                  class="bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-base sm:text-lg shadow-lg group-hover:scale-110 transition-transform">
                  1
                </div>
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">
                  Login atau Buat Akun
                </h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                  Masuk ke sistem menggunakan akun yang telah dibuat. Jika belum memiliki akun, silakan lakukan
                  registrasi terlebih dahulu dengan mengisi formulir pendaftaran akun baru.
                </p>
              </div>
            </div>

            <div class="border-l-2 border-gray-200 ml-5 sm:ml-6 h-4"></div>

            <!-- Step 2 -->
            <div class="flex gap-4 sm:gap-5 group">
              <div class="flex-shrink-0">
                <div
                  class="bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-base sm:text-lg shadow-lg group-hover:scale-110 transition-transform">
                  2
                </div>
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">
                  Lengkapi Data Diri
                </h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                  Isi seluruh data pribadi, data orang tua, dan informasi kontak dengan benar. Pastikan tidak ada kolom
                  yang terlewat.
                </p>
              </div>
            </div>

            <div class="border-l-2 border-gray-200 ml-5 sm:ml-6 h-4"></div>

            <!-- Step 3 -->
            <div class="flex gap-4 sm:gap-5 group">
              <div class="flex-shrink-0">
                <div
                  class="bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-base sm:text-lg shadow-lg group-hover:scale-110 transition-transform">
                  3
                </div>
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">
                  Upload Dokumen
                </h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-3">
                  Unggah dokumen berikut dengan format yang sesuai:
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                  <div class="flex items-center gap-2 text-gray-700">
                    <span class="text-blue-500">✓</span> Akta kelahiran
                  </div>
                  <div class="flex items-center gap-2 text-gray-700">
                    <span class="text-blue-500">✓</span> Kartu keluarga
                  </div>
                  <div class="flex items-center gap-2 text-gray-700">
                    <span class="text-blue-500">✓</span> Rapor terakhir
                  </div>
                  <div class="flex items-center gap-2 text-gray-700">
                    <span class="text-blue-500">✓</span> Pas foto
                  </div>
                </div>
              </div>
            </div>

            <div class="border-l-2 border-gray-200 ml-5 sm:ml-6 h-4"></div>

            <!-- Step 4 -->
            <div class="flex gap-4 sm:gap-5 group">
              <div class="flex-shrink-0">
                <div
                  class="bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-base sm:text-lg shadow-lg group-hover:scale-110 transition-transform">
                  4
                </div>
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">
                  Upload Prestasi <span class="text-sm font-normal text-gray-500">(Opsional)</span>
                </h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                  Jika memiliki prestasi, unggah sertifikat atau foto sebagai bukti untuk menambah nilai pendaftaran
                  Anda.
                </p>
              </div>
            </div>

            <div class="border-l-2 border-gray-200 ml-5 sm:ml-6 h-4"></div>

            <!-- Step 5 -->
            <div class="flex gap-4 sm:gap-5 group">
              <div class="flex-shrink-0">
                <div
                  class="bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-base sm:text-lg shadow-lg group-hover:scale-110 transition-transform">
                  5
                </div>
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">
                  Periksa dan Simpan Data
                </h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                  Pastikan semua data telah benar sebelum menekan tombol <strong class="text-blue-600">"Kirim
                    Pendaftaran"</strong>. Data yang sudah dikirim tidak dapat diubah.
                </p>
              </div>
            </div>

            <div class="border-l-2 border-gray-200 ml-5 sm:ml-6 h-4"></div>

            <!-- Step 6 -->
            <div class="flex gap-4 sm:gap-5 group">
              <div class="flex-shrink-0">
                <div
                  class="bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-base sm:text-lg shadow-lg group-hover:scale-110 transition-transform">
                  6
                </div>
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">
                  Konfirmasi dan Cetak Bukti
                </h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                  Setelah berhasil mengirimkan, sistem akan menampilkan <strong class="text-blue-600">bukti
                    pendaftaran</strong>. Simpan atau cetak bukti tersebut untuk keperluan verifikasi.
                </p>
              </div>
            </div>

          </div>

          <!-- Tips Section -->
          <div
            class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-5 sm:p-6 mt-8 sm:mt-10">
            <div class="flex items-start gap-3 mb-4">
              <span class="text-2xl sm:text-3xl">💡</span>
              <h4 class="font-bold text-blue-800 text-lg sm:text-xl pt-1">Tips Penting</h4>
            </div>
            <div class="space-y-3">
              <div class="flex items-start gap-3">
                <span class="text-blue-600 font-bold flex-shrink-0 mt-0.5">•</span>
                <p class="text-blue-700 text-sm sm:text-base">Gunakan foto dan dokumen dengan resolusi jelas (minimal
                  300 DPI)</p>
              </div>
              <div class="flex items-start gap-3">
                <span class="text-blue-600 font-bold flex-shrink-0 mt-0.5">•</span>
                <p class="text-blue-700 text-sm sm:text-base">Pastikan koneksi internet stabil saat upload dokumen</p>
              </div>
              <div class="flex items-start gap-3">
                <span class="text-blue-600 font-bold flex-shrink-0 mt-0.5">•</span>
                <p class="text-blue-700 text-sm sm:text-base">Simpan perubahan setiap kali mengedit data untuk
                  menghindari kehilangan informasi</p>
              </div>
              <div class="flex items-start gap-3">
                <span class="text-blue-600 font-bold flex-shrink-0 mt-0.5">•</span>
                <p class="text-blue-700 text-sm sm:text-base">Jika ada kendala teknis, hubungi panitia melalui menu
                  "Kontak Panitia"</p>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Footer Note -->
      <p class="text-center text-gray-600 text-xs sm:text-sm mt-6">
        Pastikan semua informasi yang diisi adalah benar dan valid
      </p>
    </div>


    <div id="profile" class="page hidden">
      <div class="page-hidden bg-white p-6 rounded-xl shadow mb-8">

        <h2 class="text-3xl font-semibold mb-6 text-center md:text-left">Profil Pendaftar</h2>


        @if(session('success'))
          <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-center">
            {{ session('success') }}
          </div>
        @endif


        <div class="flex flex-col md:flex-row gap-6 mb-8">


          <div class="flex-shrink-0">
            @if($berkas && $berkas->pas_foto)
              <img src="{{ asset('storage/' . $berkas->pas_foto) }}" alt="Pas Foto"
                class="w-48 h-60 object-cover rounded-lg border shadow">
            @else
              <div
                class="w-48 h-60 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 border text-lg font-semibold">
                Belum ada foto
              </div>
            @endif
          </div>


          <div class="flex-1 flex flex-col justify-center gap-4">
            <div>
              <p class="text-gray-500">Nama Lengkap</p>
              <p class="font-semibold text-gray-800 text-lg">{{ $user->nama_pendaftar ?? '-' }}</p>
            </div>
            <div>
              <p class="text-gray-500">Jenis Kelamin</p>
              <p class="font-semibold text-gray-800 text-lg">{{ $user->jenis_kelamin ?? '-' }}</p>
            </div>
            <div>
              <p class="text-gray-500">NISN</p>
              <p class="font-semibold text-gray-800 text-lg">{{ $user->nisn_pendaftar ?? '-' }}</p>
            </div>
            <div>
              <p class="text-gray-500">Nomor HP</p>
              <p class="font-semibold text-gray-800 text-lg">{{ $user->no_hp_ortu ?? '-' }}</p>
            </div>
          </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm mb-8">
          <div>
            <p class="text-gray-500">Tanggal Lahir</p>
            <p class="font-semibold text-gray-800">{{ $user->tanggallahir_pendaftar ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500">Agama</p>
            <p class="font-semibold text-gray-800">{{ $user->agama ?? '-' }}</p>
          </div>
          <div class="col-span-2">
            <p class="text-gray-500">Alamat</p>
            <p class="font-semibold text-gray-800">{{ $user->alamat_pendaftar ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500">Nama Orang Tua</p>
            <p class="font-semibold text-gray-800">{{ $user->nama_ortu ?? '-' }}</p>
          </div>
          <div>
            <p class="text-gray-500">Pekerjaan Orang Tua</p>
            <p class="font-semibold text-gray-800">{{ $user->pekerjaan_ortu ?? '-' }}</p>
          </div>
        </div>


        <div class="border-t pt-6 mt-6">
          <h3 class="text-xl font-semibold mb-4">Edit Akun Login</h3>

          <form action="{{ route('pendaftar.updateProfile') }}" method="POST" class="space-y-4 max-w-md">
            @csrf
            @method('PUT')

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
              <input type="text" name="username" value="{{ old('username', $user->username) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
              @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
              @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <hr class="my-4">

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (opsional)</label>
              <input type="password" name="password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
              @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
              <input type="password" name="password_confirmation"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit"
              class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
              Simpan Perubahan
            </button>
          </form>
        </div>


        <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded-md">
          <p class="font-medium">Catatan:</p>
          <p class="text-sm mt-1">
            Jika Anda ingin <span class="font-semibold">mengedit data pendaftar (bukan akun login)</span>,
            silakan isi ulang <a href="{{ route('pendaftar.update') }}"
              class="underline font-semibold text-yellow-700 hover:text-yellow-800">form pendaftaran</a>.
          </p>
        </div>
      </div>
    </div>
    </div>




  </main>

  <script>
    // Mobile menu toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if (sidebarToggle && sidebar && overlay) {
      sidebarToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        document.body.style.overflow = sidebar.classList.contains('-translate-x-full') ? 'auto' : 'hidden';
      });

      overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
      });
    }

    function showPage(pageId, btn) {
      document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));
      const page = document.getElementById(pageId);
      if (page) {
        page.classList.remove('hidden');
        page.classList.add('animate-fade-in');
      }

      document.querySelectorAll('.nav-btn').forEach(b => {
        b.classList.remove('bg-blue-50', 'text-blue-700');
        b.classList.add('text-gray-700');
      });
      
      if (btn) {
        btn.classList.remove('text-gray-700');
        btn.classList.add('bg-blue-50', 'text-blue-700');
      }

      if (window.innerWidth < 768 && sidebar && overlay) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
      }

      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function toggleDropdown() {
      const menu = document.getElementById('dropdownMenu');
      const icon = document.getElementById('dropdownIcon');
      if (menu && icon) {
        menu.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
      }
    }

    // Default halaman awal
    document.addEventListener("DOMContentLoaded", () => {
      const firstNavBtn = document.querySelector('.nav-btn');
      if (firstNavBtn) {
        showPage('dashboard', firstNavBtn);
      }
    });
  </script>

  <script>
    // Centralized Notification Handler dengan feedback yang lebih jelas
    document.addEventListener('DOMContentLoaded', function () {
      @if(session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: "{{ session('success') }}",
          timer: 4000,
          timerProgressBar: true,
          showConfirmButton: true,
          confirmButtonText: 'OK',
          confirmButtonColor: '#10b981',
          toast: false,
          position: 'top-end'
        });
      @endif

      @if(session('error'))
        Swal.fire({
          icon: 'error',
          title: 'Terjadi Kesalahan',
          html: '<div class="text-left"><p class="mb-2">' + "{{ session('error') }}" + '</p><p class="text-sm text-gray-600">Jika masalah berlanjut, silakan hubungi admin.</p></div>',
          confirmButtonText: 'Mengerti',
          confirmButtonColor: '#ef4444',
          showCloseButton: true
        });
      @endif

      @if($errors->any())
        let errorList = '<ul class="text-left list-disc pl-4 text-sm space-y-1">';
        @foreach($errors->all() as $error)
          errorList += '<li class="text-red-700">' + "{{ addslashes($error) }}" + '</li>';
        @endforeach
        errorList += '</ul>';
        
        Swal.fire({
          icon: 'error',
          title: 'Kesalahan Input',
          html: '<div class="text-left">' + errorList + '<p class="text-xs text-gray-600 mt-3">Periksa kembali data yang Anda masukkan.</p></div>',
          confirmButtonText: 'Mengerti',
          confirmButtonColor: '#ef4444',
          showCloseButton: true,
          width: '500px'
        });
      @endif
    });
  </script>
</body>

</html>