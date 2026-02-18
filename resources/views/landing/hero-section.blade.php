<section id="hero" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-white overflow-hidden">
  <!-- Subtle natural texture or very faint grid could go here if needed, but keeping it clean for now -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row items-center gap-12 xl:gap-24">

      <!-- Content -->
      <div class="flex-1 text-center lg:text-left space-y-8 animate-fade-in-up">
        <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-50 border border-slate-200 rounded-full">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
          <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Registrasi Terbuka TA
            2025/2026</span>
        </div>

        <div class="space-y-6">
          <h1
            class="font-gabarito text-5xl md:text-6xl xl:text-7xl font-bold text-slate-900 leading-[1.1] tracking-tight">
            Membangun Generasi <br>
            <span class="text-blue-600">Berkarakter & Unggul</span>
          </h1>
          <p class="font-hubot text-lg md:text-xl text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
            Veritas School berkomitmen memberikan pendidikan terbaik yang mengintegrasikan kecerdasan akademik dengan
            kekuatan integritas pribadi.
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
          @guest
            @if(isset($periodeAktif))
              <a href="/register"
                class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-lg hover:bg-slate-900 transition-all shadow-lg shadow-blue-600/10 flex items-center justify-center gap-3">
                Daftar Sekarang
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
              </a>
            @else
              <button disabled
                class="w-full sm:w-auto px-8 py-4 bg-slate-100 text-slate-400 rounded-xl font-bold text-lg cursor-not-allowed">
                Pendaftaran Ditutup
              </button>
            @endif
          @endguest

          @auth
            <a href="{{ strtoupper(Auth::user()->role) === 'ADMIN' ? url('admin/dashboard') : url('pendaftar/dashboard') }}"
              class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-lg hover:bg-slate-900 transition-all flex items-center justify-center gap-3">
              Ke Dashboard Saya
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </a>
          @endauth

          <a href="#about"
            class="w-full sm:w-auto px-8 py-4 bg-white text-slate-900 border border-slate-200 rounded-xl font-bold text-lg hover:bg-slate-50 transition-all flex items-center justify-center">
            Kenali Veritas
          </a>
        </div>

        <!-- Trust Indicator -->
        <div
          class="flex flex-wrap items-center justify-center lg:justify-start gap-8 pt-6 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
          <div class="flex items-center gap-2">
            <span class="text-2xl font-bold text-slate-900">A+</span>
            <span class="text-[10px] font-bold text-slate-500 uppercase leading-none">Akreditasi<br>Sekolah
              Unggul</span>
          </div>
          <div class="flex items-center gap-2 font-gabarito">
            <span class="text-2xl font-bold text-slate-900">ISO</span>
            <span class="text-[10px] font-bold text-slate-500 uppercase leading-none">Standardisasi<br>Pendidikan</span>
          </div>
        </div>
      </div>

      <!-- Imagery -->
      <div class="flex-1 relative w-full max-w-[540px] lg:max-w-none">
        <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl">
          <img src="{{ asset('image/landing/hero-person.png') }}" alt="Student at Veritas"
            class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-[2s]">
        </div>
        <!-- Subtle floating card -->
        <div
          class="absolute -bottom-10 -left-6 md:-left-12 bg-white p-6 rounded-3xl shadow-2xl border border-slate-100 max-w-[240px] animate-fade-in-up hidden md:block">
          <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">Kurikulum Internasional</p>
          <p class="text-sm font-bold text-slate-800">Menyiapkan siswa untuk tantangan global masa depan.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
  @keyframes fade-in-up {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in-up {
    animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }
</style>