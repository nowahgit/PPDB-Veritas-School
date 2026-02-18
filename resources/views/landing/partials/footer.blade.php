<footer class="bg-slate-900 border-t border-slate-800 pt-24 pb-12 font-hubot">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-20">
            <!-- Brand -->
            <div class="space-y-8">
                <a href="#hero" class="flex items-center gap-3">
                    <img src="{{ asset('image/icon/icon.png') }}" alt="Veritas"
                        class="w-10 h-10 object-contain brightness-0 invert">
                    <span class="font-gabarito text-2xl font-bold text-white">Veritas School</span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed max-w-xs">
                    Mentoring future leaders through high-impact education, character building, and innovative global
                    curriculum.
                </p>
            </div>

            <!-- Links -->
            <div class="lg:pl-16">
                <h4 class="text-white font-bold text-xs uppercase tracking-[0.2em] mb-8 opacity-40">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="#hero" class="text-slate-400 hover:text-white text-sm transition-colors">Beranda</a>
                    </li>
                    <li><a href="#about" class="text-slate-400 hover:text-white text-sm transition-colors">Tentang
                            Kami</a></li>
                    <li><a href="#alur" class="text-slate-400 hover:text-white text-sm transition-colors">Alur PPDB</a>
                    </li>
                    <li><a href="#testimoni"
                            class="text-slate-400 hover:text-white text-sm transition-colors">Testimoni</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-[0.2em] mb-8 opacity-40">Kontak Kami</h4>
                <ul class="space-y-6">
                    <li class="flex gap-4 items-start">
                        <div
                            class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-blue-500 shrink-0 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Jl. Pendidikan No. 45, <br>Jakarta Selatan, 12345
                        </p>
                    </li>
                    <li class="flex gap-4 items-center">
                        <div
                            class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-blue-500 shrink-0 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-slate-400 text-sm">hello@veritas.sch.id</p>
                    </li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div class="bg-slate-800/40 p-8 rounded-3xl border border-slate-800 flex flex-col justify-between">
                <div>
                    <h4 class="text-white font-bold text-lg mb-2">Pendaftaran Terbuka</h4>
                    <p class="text-slate-500 text-xs font-medium leading-relaxed">Berikan masa depan terbaik untuk
                        putra-putri Anda bersama Veritas.</p>
                </div>
                <a href="/register"
                    class="mt-6 block w-full py-3 bg-white text-slate-900 rounded-xl text-center text-sm font-bold hover:bg-blue-600 hover:text-white transition-all active:scale-95">
                    Daftar Sekarang
                </a>
            </div>
        </div>

        <!-- Copyright -->
        <div
            class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] font-bold text-slate-600 uppercase tracking-widest">
            <p>&copy; {{ date('Y') }} Veritas School. All rights reserved.</p>
            <div class="flex gap-8">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>