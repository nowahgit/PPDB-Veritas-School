<!-- Refined Professional Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 font-gabarito">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-20">

      <!-- Brand -->
      <a href="#hero" class="flex items-center gap-3 transition-opacity hover:opacity-90">
        <img src="{{ asset('image/icon/icon.png') }}" alt="Veritas School" class="w-10 h-10 object-contain">
        <div class="flex flex-col">
          <span class="text-xl font-bold text-slate-900 leading-none">Veritas School</span>
          <span class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] mt-1">Foundations of
            Excellence</span>
        </div>
      </a>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="#hero" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Beranda</a>
        <a href="#about" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Tentang
          Kami</a>
        <a href="#alur" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Alur PPDB</a>
        <a href="#testimoni"
          class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Testimoni</a>
      </div>

      <!-- Auth Integration -->
      <div class="hidden md:flex items-center gap-4">
        @guest
          <a href="/login" class="text-sm font-bold text-slate-600 hover:text-blue-600 px-4 py-2 transition-colors">
            Login
          </a>
          <a href="/register"
            class="bg-slate-900 text-white text-sm font-bold px-6 py-2.5 rounded-full hover:bg-blue-600 transition-all shadow-sm active:scale-95">
            Daftar PPDB
          </a>
        @endguest

        @auth
          <div class="relative group" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-3 pl-4 border-l border-slate-200">
              <div class="flex flex-col items-end">
                <span class="text-xs font-bold text-slate-900 truncate max-w-[120px]">{{ Auth::user()->username }}</span>
                <span class="text-[10px] font-bold text-blue-600 uppercase">{{ Auth::user()->role }}</span>
              </div>
              <div
                class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 text-xs font-bold">
                {{ substr(Auth::user()->username, 0, 1) }}
              </div>
            </button>

            <!-- Professional Dropdown -->
            <div x-show="open" @click.away="open = false"
              class="absolute right-0 mt-3 w-48 bg-white border border-slate-100 shadow-xl rounded-2xl py-2 z-50">
              <a href="{{ strtoupper(Auth::user()->role) === 'ADMIN' ? url('admin/dashboard') : url('pendaftar/dashboard') }}"
                class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 font-semibold hover:text-blue-600">
                Dashboard
              </a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                  class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-semibold">
                  Logout
                </button>
              </form>
            </div>
          </div>
        @endauth
      </div>

      <!-- Mobile Menu Button -->
      <div class="md:hidden flex items-center">
        <button id="mobile-menu-toggle" class="text-slate-600 p-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu Content -->
  <div id="mobile-menu-overlay"
    class="hidden md:hidden bg-white border-t border-slate-100 px-4 py-6 space-y-4 shadow-xl font-gabarito">
    <a href="#hero" class="block text-sm font-semibold text-slate-600 hover:text-blue-600">Beranda</a>
    <a href="#about" class="block text-sm font-semibold text-slate-600 hover:text-blue-600">Tentang Kami</a>
    <a href="#alur" class="block text-sm font-semibold text-slate-600 hover:text-blue-600">Alur PPDB</a>
    <a href="#testimoni" class="block text-sm font-semibold text-slate-600 hover:text-blue-600">Testimoni</a>
    <div class="pt-4 border-t border-slate-100 flex flex-col gap-3">
      @guest
        <a href="/login"
          class="text-center py-3 text-sm font-bold text-slate-600 border border-slate-200 rounded-xl">Login</a>
        <a href="/register" class="text-center py-3 text-sm font-bold bg-slate-900 text-white rounded-xl">Daftar PPDB</a>
      @endguest
      @auth
        <a href="{{ strtoupper(Auth::user()->role) === 'ADMIN' ? url('admin/dashboard') : url('pendaftar/dashboard') }}"
          class="text-center py-3 text-sm font-bold bg-blue-600 text-white rounded-xl">Ke Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full py-3 text-sm font-bold text-red-500 bg-red-50 rounded-xl">Logout</button>
        </form>
      @endauth
    </div>
  </div>
</nav>

<script>
  (function () {
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu-overlay');
    toggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
    // Scroll handling for background transparency
    window.addEventListener('scroll', () => {
      const nav = document.querySelector('nav');
      if (window.scrollY > 20) {
        nav.classList.add('bg-white/95', 'shadow-md');
        nav.classList.remove('bg-white/80');
      } else {
        nav.classList.remove('bg-white/95', 'shadow-md');
        nav.classList.add('bg-white/80');
      }
    });
  })();
</script>