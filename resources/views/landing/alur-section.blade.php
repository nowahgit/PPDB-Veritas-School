<section id="alur" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-20 space-y-4">
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.4em]">Panduan PPDB</span>
            <h2 class="font-gabarito text-4xl md:text-5xl font-bold text-slate-900 leading-tight">Alur Pendaftaran</h2>
            <p class="font-hubot text-slate-500 font-medium leading-relaxed">Proses pendaftaran yang mudah dan
                transparan untuk calon siswa Veritas School.</p>
        </div>

        <!-- Steps Timeline -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="relative space-y-6 group">
                <div
                    class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center font-bold text-lg shadow-lg shadow-slate-900/10 group-hover:bg-blue-600 transition-colors">
                    01</div>
                <h3 class="font-gabarito text-xl font-bold text-slate-900 leading-tight">Registrasi Online</h3>
                <p class="font-hubot text-sm text-slate-500 leading-relaxed font-medium">Buat akun pada portal PPDB
                    untuk mendapatkan akses ke dashboard pendaftaran Anda.</p>
            </div>

            <!-- Step 2 -->
            <div class="relative space-y-6 group">
                <div
                    class="w-12 h-12 bg-slate-100 text-slate-900 rounded-2xl flex items-center justify-center font-bold text-lg group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    02</div>
                <h3 class="font-gabarito text-xl font-bold text-slate-900 leading-tight">Pengisian Data</h3>
                <p class="font-hubot text-sm text-slate-500 leading-relaxed font-medium">Lengkapi formulir pendaftaran
                    dan unggah scan dokumen persyaratan (Rapor, KK, Akta).</p>
            </div>

            <!-- Step 3 -->
            <div class="relative space-y-6 group">
                <div
                    class="w-12 h-12 bg-slate-100 text-slate-900 rounded-2xl flex items-center justify-center font-bold text-lg group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    03</div>
                <h3 class="font-gabarito text-xl font-bold text-slate-900 leading-tight">Verifikasi & Seleksi</h3>
                <p class="font-hubot text-sm text-slate-500 leading-relaxed font-medium">Tim kami akan melakukan
                    verifikasi berkas dan proses seleksi otomatis berdasarkan kriteria nilai.</p>
            </div>

            <!-- Step 4 -->
            <div class="relative space-y-6 group">
                <div
                    class="w-12 h-12 bg-slate-100 text-slate-900 rounded-2xl flex items-center justify-center font-bold text-lg group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    04</div>
                <h3 class="font-gabarito text-xl font-bold text-slate-900 leading-tight">Pengumuman Hasil</h3>
                <p class="font-hubot text-sm text-slate-500 leading-relaxed font-medium">Cek hasil seleksi melalui
                    dashboard Anda dan lakukan daftar ulang sesuai instruksi.</p>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-20 p-8 md:p-12 bg-slate-50 rounded-[2.5rem] flex flex-col lg:flex-row gap-12 items-center">
            <div class="lg:w-1/2 space-y-6 text-center lg:text-left">
                <h3 class="font-gabarito text-3xl font-bold text-slate-900">Siapkan Berkas Anda</h3>
                <p class="font-hubot text-slate-600 font-medium">Proses pendaftaran akan jauh lebih cepat jika Anda
                    telah menyiapkan dokumen digital berikut:</p>
                <div class="flex flex-wrap justify-center lg:justify-start gap-3">
                    <span
                        class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700">Scan
                        Rapor</span>
                    <span
                        class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700">Kartu
                        Keluarga</span>
                    <span
                        class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700">Akta
                        Kelahiran</span>
                    <span
                        class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700">Pas
                        Foto</span>
                </div>
            </div>
            <div class="lg:w-1/2 w-full lg:pl-12 border-t lg:border-t-0 lg:border-l border-slate-200 pt-8 lg:pt-0">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-600"></div>
                    <span class="text-xs font-bold text-slate-900 uppercase tracking-widest">Periode Pendaftaran</span>
                </div>
                @if(isset($periodeAktif))
                    <div class="space-y-2">
                        <p class="text-2xl font-bold text-slate-900">{{ $periodeAktif->nama_periode }}</p>
                        <p class="text-slate-500 font-medium">Berakhir pada <span
                                class="text-slate-900 font-bold underline decoration-blue-200">{{ $periodeAktif->tanggal_selesai->format('d F Y') }}</span>
                        </p>
                    </div>
                @else
                    <p class="text-slate-400 font-bold italic text-lg leading-relaxed">Belum ada periode pendaftaran aktif
                        saat ini. Mohon pantau terus informasi dari kami.</p>
                @endif
            </div>
        </div>
    </div>
</section>