<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - Veritas School PPDB</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('image/icon/icon.png') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            hubot: ['"Hubot Sans"', 'sans-serif'],
            gabarito: ['"Gabarito"', 'sans-serif'],
          },
          colors: {
            primary: { 50: '#eff6ff', 100: '#dbeafe', 500: '#2563eb', 600: '#1d4ed8', 700: '#1d40af' },
            slate: { 850: '#172033' },
          },
        },
      },
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Hubot+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body {
      font-family: 'Hubot Sans', sans-serif;
    }

    .input-focus-ring:focus {
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .btn-primary {
      background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #1d4ed8 0%, #1d40af 100%);
      box-shadow: 0 4px 14px rgba(29, 78, 216, 0.4);
    }

    .panel-right {
      background: linear-gradient(160deg, #1e3a5f 0%, #0f172a 50%, #020617 100%);
    }

    .card-form {
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04);
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(12px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-up {
      animation: fadeUp 0.5s ease-out forwards;
    }

    .animate-fade-up-1 {
      animation-delay: 0.05s;
      opacity: 0;
    }

    .animate-fade-up-2 {
      animation-delay: 0.1s;
      opacity: 0;
    }

    .animate-fade-up-3 {
      animation-delay: 0.15s;
      opacity: 0;
    }

    .animate-fade-up-4 {
      animation-delay: 0.2s;
      opacity: 0;
    }

    .animate-fade-up-5 {
      animation-delay: 0.25s;
      opacity: 0;
    }

    .animate-fade-up-6 {
      animation-delay: 0.3s;
      opacity: 0;
    }
  </style>
</head>

<body class="bg-slate-50 min-h-screen overflow-x-hidden">

  <!-- Preloader -->
  <div x-data="{ loading: true }" x-init="window.addEventListener('load', () => setTimeout(() => loading = false, 400))"
    x-show="loading" x-transition:leave="transition ease-out duration-300"
    class="fixed inset-0 bg-white z-[9999] flex flex-col items-center justify-center">
    <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="w-20 h-20 mb-6 object-contain">
    <div class="w-10 h-10 border-2 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
  </div>

  <div class="min-h-screen flex flex-col lg:flex-row lg:h-screen lg:overflow-hidden">
    <!-- Left: Form - satu layar desktop, no scroll -->
    <div class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8 lg:overflow-auto">
      <div class="w-full max-w-md lg:max-w-lg">
        <a href="{{ url('/') }}"
          class="inline-flex items-center gap-2 text-slate-600 hover:text-primary-600 transition-colors mb-4 lg:mb-5">
          <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="h-9 w-9 object-contain">
          <span class="font-gabarito font-semibold">Veritas School</span>
        </a>

        <div class="card-form bg-white rounded-2xl p-5 sm:p-6 lg:p-6 animate-fade-up">
          <h1
            class="font-gabarito text-xl sm:text-2xl font-bold text-slate-800 mb-0.5 animate-fade-up animate-fade-up-1">
            Buat akun baru</h1>
          <p class="text-slate-500 text-xs sm:text-sm mb-4 animate-fade-up animate-fade-up-2">Isi data berikut untuk
            mendaftar PPDB.</p>

          <form method="POST" action="{{ route('register') }}" class="animate-fade-up animate-fade-up-3">
            @csrf

            @if ($errors->any())
              <div class="rounded-lg bg-red-50 border border-red-100 px-3 py-2 text-xs text-red-700 mb-3">
                @foreach ($errors->all() as $err)
                  <p>{{ $err }}</p>
                @endforeach
              </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-3">
              <div>
                <label for="username" class="block text-xs font-medium text-slate-700 mb-1">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                  class="w-full px-3 py-2.5 text-sm border rounded-lg input-focus-ring outline-none transition {{ $errors->has('username') ? 'border-red-400 bg-red-50/50' : 'border-slate-200 hover:border-slate-300' }} text-slate-800 placeholder-slate-400"
                  placeholder="Pilih username">
                @error('username')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label for="email" class="block text-xs font-medium text-slate-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                  class="w-full px-3 py-2.5 text-sm border rounded-lg input-focus-ring outline-none transition {{ $errors->has('email') ? 'border-red-400 bg-red-50/50' : 'border-slate-200 hover:border-slate-300' }} text-slate-800 placeholder-slate-400"
                  placeholder="email@contoh.com">
                @error('email')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="no_hp" class="block text-xs font-medium text-slate-700 mb-1">Nomor HP</label>
              <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp') }}" required
                class="w-full px-3 py-2.5 text-sm border rounded-lg input-focus-ring outline-none transition {{ $errors->has('no_hp') ? 'border-red-400 bg-red-50/50' : 'border-slate-200 hover:border-slate-300' }} text-slate-800 placeholder-slate-400"
                placeholder="08xxxxxxxxxx">
              @error('no_hp')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-4">
              <div>
                <label for="password" class="block text-xs font-medium text-slate-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                  class="w-full px-3 py-2.5 text-sm border rounded-lg input-focus-ring outline-none transition {{ $errors->has('password') ? 'border-red-400 bg-red-50/50' : 'border-slate-200 hover:border-slate-300' }} text-slate-800 placeholder-slate-400"
                  placeholder="Min. 6 karakter">
                @error('password')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label for="password_confirmation"
                  class="block text-xs font-medium text-slate-700 mb-1">Konfirmasi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                  class="w-full px-3 py-2.5 text-sm border rounded-lg input-focus-ring outline-none transition border-slate-200 hover:border-slate-300 text-slate-800 placeholder-slate-400"
                  placeholder="Ulangi password">
                @error('password_confirmation')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <button type="submit"
              class="w-full py-3 px-4 btn-primary text-white text-sm font-semibold rounded-xl transition-all duration-200 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
              Daftar Sekarang
            </button>
          </form>

          <p class="text-center text-slate-500 text-xs mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-semibold">Masuk di
              sini</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Right: Branding panel -->
    <div class="hidden lg:flex lg:w-[48%] panel-right items-center justify-center p-12 relative">
      <div class="relative z-10 text-center max-w-sm">
        <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="h-24 w-24 mx-auto mb-6 opacity-90">
        <h2 class="font-gabarito text-2xl font-bold text-white mb-3">Bergabung dengan Veritas School</h2>
        <p class="text-slate-300 text-sm leading-relaxed">Daftar sekali, lengkapi data, dan ikuti proses seleksi PPDB
          dengan mudah.</p>
      </div>
    </div>
  </div>

  @if(!isset($periodeAktif) || !$periodeAktif)
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[99999] flex items-center justify-center p-4">
      <div class="bg-white rounded-2xl p-6 sm:p-8 max-w-sm w-full shadow-2xl animate-fade-up">
        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-5 mx-auto">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
            </path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-center text-slate-800 mb-2">Pendaftaran Ditutup</h3>
        <p class="text-sm text-center text-slate-600 mb-6">Tidak bisa mendaftar akun dikarenakan tidak ada periode
          pendaftaran aktif. Silakan hubungi admin sekolah.</p>
        <a href="{{ url('/') }}"
          class="block w-full text-center py-3 px-4 bg-slate-800 hover:bg-slate-900 text-white rounded-xl transition-all shadow-lg shadow-slate-200 font-semibold text-sm">Kembali
          ke Beranda</a>
      </div>
    </div>
  @endif

</body>

</html>