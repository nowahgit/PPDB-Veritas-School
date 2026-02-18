<nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-gray-100 transition-all duration-300">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-20">
      <a href="{{ url('/') }}#hero" class="flex items-center gap-2 group">
        <div
          class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center group-hover:rotate-6 transition-transform">
          <img src="{{ asset('image/icon/icon.png') }}" alt="Veritas School"
            class="w-7 h-7 object-contain brightness-0 invert">
        </div>
        <span class="font-bold text-xl tracking-tight text-gray-900">Veritas<span
            class="text-brand-600">School</span></span>
      </a>

      <div class="hidden md:flex items-center gap-8">
        <a href="{{ url('/') }}#hero"
          class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors relative group">
          Beranda
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="{{ url('/') }}#about"
          class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors relative group">
          Tentang
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="{{ url('/') }}#alur"
          class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors relative group">
          Alur PPDB
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="{{ url('/') }}#info"
          class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors relative group">
          Informasi
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="{{ url('/') }}#testimoni"
          class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors relative group">
          Testimoni
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-600 transition-all group-hover:w-full"></span>
        </a>
      </div>

      <div class="hidden md:flex items-center gap-4">
        @guest
          <a href="{{ url('login') }}"
            class="text-sm font-semibold text-gray-700 hover:text-brand-600 transition-colors">Login</a>
          @if(isset($periodeAktif) && $periodeAktif)
            <a href="{{ url('register') }}"
              class="px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 hover:shadow-lg hover:shadow-brand-200 transition-all active:scale-95 shadow-md shadow-brand-100">Daftar
              PPDB</a>
          @else
            <span
              class="px-5 py-2.5 bg-gray-100 text-gray-400 text-sm font-semibold rounded-xl cursor-not-allowed border border-gray-200"
              title="Pendaftaran saat ini ditutup">Pendaftaran Ditutup</span>
          @endif
        @endguest
        @auth
          <a href="{{ url(strtoupper(Auth::user()->role) === 'ADMIN' ? 'admin/dashboard' : 'pendaftar/dashboard') }}"
            class="px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 transition-all shadow-md shadow-brand-100">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
              class="text-sm font-semibold text-gray-500 hover:text-red-600 transition-colors ml-2">Logout</button>
          </form>
        @endauth
      </div>

      <button type="button" id="mobile-menu-btn"
        class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors" aria-label="Menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  <div id="mobile-menu" class="hidden md:hidden glass border-t border-gray-100 px-4 py-6 space-y-4 animate-fade-in">
    <a href="{{ url('/') }}#hero" class="block py-2 font-medium text-gray-700 hover:text-brand-600">Beranda</a>
    <a href="{{ url('/') }}#about" class="block py-2 font-medium text-gray-700 hover:text-brand-600">Tentang</a>
    <a href="{{ url('/') }}#alur" class="block py-2 font-medium text-gray-700 hover:text-brand-600">Alur PPDB</a>
    <a href="{{ url('/') }}#info" class="block py-2 font-medium text-gray-700 hover:text-brand-600">Informasi</a>
    <a href="{{ url('/') }}#testimoni" class="block py-2 font-medium text-gray-700 hover:text-brand-600">Testimoni</a>
    <div class="pt-4 border-t border-gray-100 space-y-3">
      @guest
        <a href="{{ url('login') }}"
          class="block py-3 text-center border border-gray-200 rounded-xl font-semibold text-gray-700 hover:bg-gray-50 transition-colors">Login</a>
        @if(isset($periodeAktif) && $periodeAktif)
          <a href="{{ url('register') }}"
            class="block py-3 text-center bg-brand-600 text-white rounded-xl font-bold shadow-lg shadow-brand-100">Daftar
            PPDB</a>
        @else
          <span
            class="block py-3 text-center bg-gray-100 text-gray-400 rounded-xl font-semibold cursor-not-allowed">Pendaftaran
            Ditutup</span>
        @endif
      @endguest
      @auth
        <a href="{{ url(strtoupper(Auth::user()->role) === 'ADMIN' ? 'admin/dashboard' : 'pendaftar/dashboard') }}"
          class="block py-3 text-center bg-brand-600 text-white rounded-xl font-bold">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"
            class="block w-full py-3 text-center text-gray-500 font-semibold hover:text-red-600">Logout</button></form>
      @endauth
    </div>
  </div>
</nav>
<script>
  (function () {
    var btn = document.getElementById('mobile-menu-btn');
    var menu = document.getElementById('mobile-menu');
    if (btn && menu) btn.addEventListener('click', function () { menu.classList.toggle('hidden'); });
  })();
</script>