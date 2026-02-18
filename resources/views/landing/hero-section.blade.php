<section id="hero" class="relative pt-32 pb-20 md:pt-48 md:pb-32 bg-mesh overflow-hidden">
  <!-- Decorative elements -->
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full -z-10 opacity-30 pointer-events-none">
    <div class="absolute top-20 left-10 w-72 h-72 bg-brand-200 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-100 rounded-full blur-3xl animate-float"
      style="animation-delay: 2s"></div>
  </div>

  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="text-center lg:text-left animate-fade-in-up">
        <div
          class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-xs font-bold uppercase tracking-wider mb-6">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
          </span>
          Portal Pendaftaran Peserta Didik Baru
        </div>
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-[1.1] mb-6">
          Bangun Masa Depan <br>
          <span class="text-gradient">Di Veritas School</span>
        </h1>
        <p class="text-gray-600 text-lg md:text-xl max-w-xl mx-auto lg:mx-0 mb-10 leading-relaxed">
          Pendidikan berkualitas dengan landasan karakter yang kuat. Bergabunglah bersama kami untuk mencetak generasi
          cerdas dan berintegritas.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
          @guest
            @if(isset($periodeAktif) && $periodeAktif)
              <a href="{{ url('register') }}"
                class="group inline-flex items-center justify-center px-8 py-4 bg-brand-600 text-white font-bold rounded-2xl hover:bg-brand-700 hover:shadow-xl hover:shadow-brand-200 transition-all active:scale-95">
                Daftar Sekarang
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
              </a>
            @else
              <span
                class="inline-flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-400 font-bold rounded-2xl border border-gray-200 cursor-not-allowed">
                Pendaftaran Ditutup
              </span>
            @endif
          @endguest
          @auth
            <a href="{{ url(strtoupper(Auth::user()->role) === 'ADMIN' ? 'admin/dashboard' : 'pendaftar/dashboard') }}"
              class="inline-flex items-center justify-center px-8 py-4 bg-brand-600 text-white font-bold rounded-2xl hover:bg-brand-700 hover:shadow-xl transition-all shadow-lg active:scale-95">
              Masuk Dashboard
            </a>
          @endauth
          <a href="#alur"
            class="inline-flex items-center justify-center px-8 py-4 bg-white border border-gray-200 text-gray-700 font-bold rounded-2xl hover:bg-gray-50 transition-all hover:border-brand-200">
            Lihat Alur PPDB
          </a>
        </div>

        <div class="mt-12 flex items-center justify-center lg:justify-start gap-6 text-sm text-gray-500 font-medium">
          <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
            </svg>
            Terakreditasi A
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
            </svg>
            Kurikulum Unggul
          </div>
        </div>
      </div>

      <div class="relative animate-fade-in group" style="animation-delay: 0.3s">
        <!-- Background decorative shape -->
        <div
          class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-brand-100/50 rounded-full blur-[80px] -z-10 group-hover:bg-brand-200/50 transition-colors duration-700">
        </div>

        <div class="relative z-10">
          @if(file_exists(public_path('image/landing/hero-person.png')))
            <img src="{{ asset('image/landing/hero-person.png') }}" alt="Student"
              class="w-full h-auto object-contain transform hover:scale-105 transition-transform duration-700 pointer-events-none drop-shadow-2xl">
          @elseif(file_exists(public_path('image/landing/hero-sekolah.jpg')))
            <div
              class="relative rounded-[2rem] overflow-hidden bg-gray-100 border-8 border-white shadow-2xl aspect-[4/3]">
              <img src="{{ asset('image/landing/hero-sekolah.jpg') }}" alt="Veritas School"
                class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
            </div>
          @else
            <div
              class="relative rounded-[2rem] overflow-hidden bg-brand-50 border-8 border-white shadow-2xl aspect-[4/3] flex items-center justify-center">
              <svg class="w-24 h-24 text-brand-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
          @endif
        </div>

        <!-- Floating UI element -->
        <div
          class="absolute -bottom-6 -left-6 md:left-0 right-0 md:right-auto bg-white/95 backdrop-blur-md p-5 rounded-3xl shadow-2xl border border-white/50 animate-float z-20"
          style="animation-duration: 4s">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-brand-100 flex items-center justify-center text-brand-600">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
              </svg>
            </div>
            <div>
              <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Pendaftar</p>
              <p class="text-2xl font-black text-gray-900 leading-none mt-1">1.200+</p>
            </div>
            <div class="ml-4">
              <div class="flex -space-x-2">
                <div class="w-8 h-8 rounded-full border-2 border-white bg-blue-400"></div>
                <div class="w-8 h-8 rounded-full border-2 border-white bg-brand-500"></div>
                <div
                  class="w-8 h-8 rounded-full border-2 border-white bg-indigo-400 flex items-center justify-center text-[10px] text-white font-bold">
                  +</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>