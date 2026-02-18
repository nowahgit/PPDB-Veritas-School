<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Veritas School PPDB</title>
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
          },
        },
      },
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Hubot+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body { font-family: 'Hubot Sans', sans-serif; }
    .input-focus-ring:focus { box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15); }
    .btn-primary { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); }
    .btn-primary:hover { background: linear-gradient(135deg, #1d4ed8 0%, #1d40af 100%); box-shadow: 0 4px 14px rgba(29, 78, 216, 0.4); }
    .panel-right { background: linear-gradient(160deg, #1e3a5f 0%, #0f172a 50%, #020617 100%); }
    .card-form { box-shadow: 0 4px 24px rgba(0,0,0,0.06), 0 0 0 1px rgba(0,0,0,0.04); }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-up { animation: fadeUp 0.5s ease-out forwards; }
    .delay-1 { animation-delay: 0.05s; opacity: 0; }
    .delay-2 { animation-delay: 0.1s; opacity: 0; }
    .delay-3 { animation-delay: 0.15s; opacity: 0; }
    .delay-4 { animation-delay: 0.2s; opacity: 0; }
    .delay-5 { animation-delay: 0.25s; opacity: 0; }
  </style>
</head>
<body class="bg-slate-50 min-h-screen overflow-x-hidden">

  <div x-data="{ loading: true }"
       x-init="window.addEventListener('load', () => setTimeout(() => loading = false, 400))"
       x-show="loading"
       x-transition:leave="transition ease-out duration-300"
       class="fixed inset-0 bg-white z-[9999] flex flex-col items-center justify-center">
    <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="w-20 h-20 mb-6 object-contain">
    <div class="w-10 h-10 border-2 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
  </div>

  <div class="min-h-screen flex flex-col lg:flex-row">
    <div class="flex-1 flex items-center justify-center p-6 sm:p-8 lg:p-12">
      <div class="w-full max-w-md">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-blue-600 transition-colors mb-8">
          <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="h-10 w-10 object-contain">
          <span class="font-gabarito font-semibold text-lg">Veritas School</span>
        </a>

        <div class="card-form bg-white rounded-2xl p-8 sm:p-10 animate-fade-up">
          <h1 class="font-gabarito text-2xl sm:text-3xl font-bold text-slate-800 mb-1 animate-fade-up delay-1">Masuk ke akun</h1>
          <p class="text-slate-500 text-sm mb-6 animate-fade-up delay-2">Gunakan username dan password Anda untuk mengakses portal.</p>

          <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            @if ($errors->any())
              <div class="rounded-xl bg-red-50 border border-red-100 px-4 py-3 text-sm text-red-700 animate-fade-up delay-3">
                @foreach ($errors->all() as $err)
                  <p>{{ $err }}</p>
                @endforeach
              </div>
            @endif

            <div class="animate-fade-up delay-3">
              <label for="username" class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
              <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                       class="w-full pl-11 pr-4 py-3 border rounded-xl input-focus-ring outline-none transition {{ $errors->has('username') ? 'border-red-400 bg-red-50/50' : 'border-slate-200 hover:border-slate-300' }} text-slate-800 placeholder-slate-400"
                       placeholder="Masukkan username">
              </div>
              @error('username')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
              @enderror
            </div>

            <div class="animate-fade-up delay-4">
              <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
              <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </span>
                <input id="password" type="password" name="password" required
                       class="w-full pl-11 pr-4 py-3 border rounded-xl input-focus-ring outline-none transition {{ $errors->has('password') ? 'border-red-400 bg-red-50/50' : 'border-slate-200 hover:border-slate-300' }} text-slate-800 placeholder-slate-400"
                       placeholder="Masukkan password">
              </div>
              @error('password')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex items-center justify-between animate-fade-up delay-5">
              <label class="flex items-center gap-2 cursor-pointer text-sm text-slate-600">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500/30 cursor-pointer">
                <span>Ingat saya</span>
              </label>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 btn-primary text-white font-semibold rounded-xl transition-all duration-200 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
              Masuk
            </button>
          </form>

          <p class="text-center text-slate-500 text-sm mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Daftar sekarang</a>
          </p>
        </div>
      </div>
    </div>

    <div class="hidden lg:flex lg:w-[48%] panel-right items-center justify-center p-12 relative">
      <div class="relative z-10 text-center max-w-sm">
        <img src="{{ asset('image/icon/icon.png') }}" alt="Logo" class="h-24 w-24 mx-auto mb-6 opacity-90">
        <h2 class="font-gabarito text-2xl font-bold text-white mb-3">Portal PPDB Veritas School</h2>
        <p class="text-slate-300 text-sm leading-relaxed">Akses layanan pendaftaran dan informasi akademik dalam satu tempat.</p>
      </div>
    </div>
  </div>

</body>
</html>
