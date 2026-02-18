<section id="news" class="py-24 bg-white relative">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-20 space-y-4">
      <span class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.4em]">Warta Veritas</span>
      <h2 class="font-gabarito text-4xl md:text-5xl font-bold text-slate-900 leading-tight">Berita & Artikel</h2>
      <p class="font-hubot text-slate-500 font-medium leading-relaxed">Update terbaru mengenai prestasi, kegiatan, dan
        pengumuman resmi dari Veritas School.</p>
    </div>

    <!-- News Grid -->
    <div id="news-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 relative z-10">
      <!-- Generated via JS -->
    </div>

    <div class="text-center" id="load-more-container">
      <button id="show-more"
        class="px-8 py-4 bg-slate-50 text-slate-700 border border-slate-200 rounded-xl font-bold text-sm hover:bg-slate-100 transition-all flex items-center justify-center gap-2 mx-auto">
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
  class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
  <div class="bg-white rounded-[2rem] max-w-2xl w-full overflow-hidden relative shadow-2xl">
    <button id="modal-close"
      class="absolute top-6 right-6 z-20 w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-red-500 transition-colors">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    <div class="h-64 sm:h-80 overflow-hidden">
      <img id="modal-img" src="" alt="News" class="w-full h-full object-cover">
    </div>

    <div class="p-8 sm:p-12 space-y-6">
      <div class="flex items-center gap-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
        <span id="modal-category" class="text-blue-600"></span>
        <span>•</span>
        <span id="modal-date"></span>
      </div>

      <h3 id="modal-title" class="font-gabarito text-2xl font-bold text-slate-900 leading-tight"></h3>
      <p id="modal-desc" class="font-hubot text-slate-600 leading-relaxed text-sm max-h-48 overflow-y-auto"></p>
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
      grid.innerHTML = '';
      newsData.forEach((item, i) => {
        const card = document.createElement('div');
        card.className = 'group cursor-pointer space-y-6';
        card.innerHTML = `
        <div class="h-64 rounded-3xl overflow-hidden shadow-sm">
          <img src="${item.img}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
        <div class="space-y-3">
          <div class="flex items-center gap-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            <span class="text-blue-600">${item.category}</span>
            <span>${item.date}</span>
          </div>
          <h3 class="font-gabarito text-xl font-bold text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">${item.title}</h3>
          <p class="font-hubot text-sm text-slate-500 leading-relaxed line-clamp-2">${item.desc}</p>
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

    mClose.onclick = () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.body.style.overflow = 'auto';
    };

    modal.onclick = (e) => { if (e.target === modal) mClose.onclick(); };

    render();
  })();
</script>