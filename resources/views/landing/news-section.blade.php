<section id="news" class="py-24 bg-white relative">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16 reveal">
      <h2 class="text-xs font-bold text-brand-600 uppercase tracking-widest mb-3">Warta Veritas</h2>
      <h3 class="text-3xl md:text-4xl font-black text-gray-900">Berita & Artikel Terbaru</h3>
    </div>

    <!-- News Grid -->
    <div id="news-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-10 mb-16 relative z-10 reveal"
      style="transition-delay: 0.2s">
      <!-- Generated via JS -->
    </div>

    <div class="text-center reveal" id="load-more-container" style="transition-delay: 0.4s">
      <button id="show-more"
        class="px-8 py-4 bg-white text-gray-700 border border-gray-200 rounded-2xl font-bold text-sm hover:bg-gray-50 hover:border-brand-200 transition-all flex items-center justify-center gap-2 mx-auto active:scale-95">
        Lihat Selengkapnya
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
    </div>
  </div>
</section>

<!-- Modal -->
<div id="news-modal"
  class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm hidden items-center justify-center z-[100] p-4 animate-fade-in">
  <div class="bg-white rounded-[2.5rem] max-w-2xl w-full overflow-hidden relative shadow-2xl border border-white/20">
    <button id="modal-close"
      class="absolute top-6 right-6 z-20 w-10 h-10 bg-white shadow-lg rounded-xl flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    <div class="h-64 sm:h-80 overflow-hidden">
      <img id="modal-img" src="" alt="News" class="w-full h-full object-cover">
    </div>

    <div class="p-8 sm:p-12 space-y-6">
      <div class="flex items-center gap-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
        <span id="modal-category" class="text-brand-600"></span>
        <span>•</span>
        <span id="modal-date"></span>
      </div>

      <h3 id="modal-title" class="text-2xl font-black text-gray-900 leading-tight"></h3>
      <p id="modal-desc" class="text-gray-600 leading-relaxed text-sm max-h-48 overflow-y-auto pr-2"></p>
    </div>
  </div>
</div>

<script>
  (function () {
    const newsData = [
      {
        img: "https://images.pexels.com/photos/4145193/pexels-photo-4145193.jpeg?auto=compress&cs=tinysrgb&w=800",
        category: "Ekstrakurikuler",
        title: "Pengenalan Ekstrakurikuler Baru: Coding & AI Foundations",
        desc: "Veritas School meluncurkan program ekstrakurikuler baru yang berfokus pada teknologi masa depan. Siswa akan belajar dasar-dasar pemrograman dan logika kecerdasan buatan dalam lingkungan yang interaktif dan menyenangkan.",
        date: "28 Jan 2026"
      },
      {
        img: "https://images.pexels.com/photos/4145793/pexels-photo-4145793.jpeg?auto=compress&cs=tinysrgb&w=800",
        category: "Prestasi",
        title: "Siswa Veritas Menjuarai Olimpiade Sains Nasional",
        desc: "Kebanggaan bagi Veritas School atas pencapaian tim sains kami yang berhasil meraih medali emas pada ajang nasional tahun ini. Prestasi ini merupakan buah dari kerja keras dan bimbingan intensif tim pengajar kami.",
        date: "20 Jan 2026"
      },
      {
        img: "https://images.pexels.com/photos/4145232/pexels-photo-4145232.jpeg?auto=compress&cs=tinysrgb&w=800",
        category: "Kunjungan",
        title: "Field Trip Edukatif: Eksplorasi Ekosistem Pesisir",
        desc: "Dalam rangka mata pelajaran Geografi dan Biologi, siswa kelas X melakukan kunjungan lapangan ke pesisir pantai untuk mempelajari ekosistem secara langsung. Kegiatan ini melatih kepekaan siswa terhadap lingkungan hidup.",
        date: "15 Jan 2026"
      }
    ];

    const grid = document.getElementById('news-grid');
    const modal = document.getElementById('news-modal');
    const mImg = document.getElementById('modal-img');
    const mTitle = document.getElementById('modal-title');
    const mDesc = document.getElementById('modal-desc');
    const mCat = document.getElementById('modal-category');
    const mDate = document.getElementById('modal-date');
    const mClose = document.getElementById('modal-close');

    function render() {
      if (!grid) return;
      grid.innerHTML = '';
      newsData.forEach((item, i) => {
        const card = document.createElement('div');
        card.className = 'group cursor-pointer space-y-6 reveal';
        card.style.transitionDelay = (0.1 * (i + 1)) + 's';
        card.innerHTML = `
        <div class="h-64 rounded-[2rem] overflow-hidden shadow-lg border-4 border-white">
          <img src="${item.img}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
        <div class="space-y-3 px-2">
          <div class="flex items-center gap-3 text-xs font-bold text-gray-400 uppercase tracking-widest">
            <span class="text-brand-600">${item.category}</span>
            <span>${item.date}</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 leading-tight group-hover:text-brand-600 transition-colors">${item.title}</h3>
          <p class="text-sm text-gray-500 leading-relaxed line-clamp-2">${item.desc}</p>
        </div>
      `;
        card.onclick = () => {
          mImg.src = item.img;
          mTitle.innerText = item.title;
          mDesc.innerText = item.desc;
          mCat.innerText = item.category;
          mDate.innerText = item.date;
          modal.classList.remove('hidden');
          modal.classList.add('flex');
          document.body.style.overflow = 'hidden';
        };
        grid.appendChild(card);
      });
    }

    if (mClose) {
      mClose.onclick = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
      };
    }

    if (modal) {
      modal.onclick = (e) => { if (e.target === modal) mClose.onclick(); };
    }

    render();
  })();
</script>