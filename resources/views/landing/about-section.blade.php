<section id="about" class="py-24 bg-slate-50 relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">

      <!-- Visual Composition -->
      <div class="lg:w-1/2 grid grid-cols-2 gap-4">
        <div class="space-y-4">
          <div class="rounded-3xl overflow-hidden shadow-sm">
            <img src="{{ asset('image/landing/teacher-with-student.png') }}" alt="Learning"
              class="w-full h-auto object-cover grayscale-[0.2] hover:grayscale-0 transition-all duration-700">
          </div>
          <div class="rounded-3xl overflow-hidden shadow-sm">
            <img src="{{ asset('image/landing/student-with-computer.png') }}" alt="Tech"
              class="w-full h-64 object-cover grayscale-[0.2] hover:grayscale-0 transition-all duration-700">
          </div>
        </div>
        <div class="space-y-4 pt-12">
          <div class="rounded-3xl overflow-hidden shadow-sm">
            <img src="{{ asset('image/landing/student-jump-happy.png') }}" alt="Happy"
              class="w-full h-80 object-cover grayscale-[0.2] hover:grayscale-0 transition-all duration-700">
          </div>
          <div class="rounded-3xl overflow-hidden shadow-sm">
            <img src="{{ asset('image/landing/two-student-smile.png') }}" alt="Friends"
              class="w-full h-auto object-cover grayscale-[0.2] hover:grayscale-0 transition-all duration-700">
          </div>
        </div>
      </div>

      <!-- Text Content -->
      <div class="lg:w-1/2 space-y-10">
        <div class="space-y-6">
          <span class="text-xs font-bold text-blue-600 uppercase tracking-[0.3em]">Visi & Misi</span>
          <h2 class="font-gabarito text-4xl md:text-5xl font-bold text-slate-900 leading-tight">
            Lebih dari Sekadar <span class="text-blue-600">Pendidikan.</span>
          </h2>
          <p class="font-hubot text-lg text-slate-600 leading-relaxed">
            Kami percaya bahwa setiap siswa memiliki keunikan yang harus dipupuk melalui pendekatan yang seimbang antara
            keunggulan akademik dan kecerdasan emosional. Veritas School hadir untuk mendampingi putra-putri Anda
            menjadi pribadi yang tangguh di dunia modern.
          </p>
        </div>

        <div class="grid sm:grid-cols-2 gap-10">
          <div class="space-y-3">
            <div class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
            <h4 class="font-gabarito font-bold text-slate-900">Kurikulum Holistik</h4>
            <p class="text-sm text-slate-500 leading-relaxed font-medium">Bukan hanya menghafal, tapi memahami dan
              menerapkan dalam kehidupan nyata.</p>
          </div>
          <div class="space-y-3">
            <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <h4 class="font-gabarito font-bold text-slate-900">Komunitas Suportif</h4>
            <p class="text-sm text-slate-500 leading-relaxed font-medium">Lingkungan belajar yang ramah dan inklusif
              untuk tumbuh kembang optimal.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>