(function () {
  // Navbar: bayangan saat scroll + menu mobile
  var nav = document.querySelector('.nav');
  if (nav) {
    var onScroll = function () { nav.classList.toggle('scrolled', window.scrollY > 8); };
    onScroll(); window.addEventListener('scroll', onScroll, { passive: true });
  }
  var burger = document.querySelector('.burger');
  if (burger) burger.addEventListener('click', function () {
    document.querySelector('.nav-links').classList.toggle('open');
  });

  // Efek slide-in halus saat section masuk layar
  var els = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.15 });
    els.forEach(function (el) { io.observe(el); });
  } else { els.forEach(function (el) { el.classList.add('in'); }); }

  // Slider horizontal (jurusan & fasilitas)
  document.querySelectorAll('.slider-wrap').forEach(function (w) {
    var s = w.querySelector('.slider');
    var step = function () { var c = s.querySelector('.slide-card'); return c ? c.offsetWidth + 20 : 300; };
    w.querySelector('.s-next').addEventListener('click', function () {
      if (s.scrollLeft + s.clientWidth >= s.scrollWidth - 4) s.scrollTo({ left: 0 }); else s.scrollBy({ left: step() });
    });
    w.querySelector('.s-prev').addEventListener('click', function () { s.scrollBy({ left: -step() }); });
  });

  // Pratinjau foto sebelum diunggah
  document.querySelectorAll('input[type=file][data-preview]').forEach(function (inp) {
    inp.addEventListener('change', function () {
      var box = document.querySelector(inp.dataset.preview); box.innerHTML = '';
      Array.from(inp.files).slice(0, 3).forEach(function (f) {
        var img = document.createElement('img'); img.src = URL.createObjectURL(f); box.appendChild(img);
      });
    });
  });

  // Lightbox untuk foto laporan
  var lb = document.createElement('div'); lb.className = 'lightbox'; lb.innerHTML = '<img alt="">';
  document.body.appendChild(lb);
  lb.addEventListener('click', function () { lb.classList.remove('on'); });
  document.querySelectorAll('.gallery img').forEach(function (img) {
    img.addEventListener('click', function () { lb.querySelector('img').src = img.src; lb.classList.add('on'); });
  });

  // Kolom biaya hanya relevan saat status selesai/diproses
  var st = document.querySelector('[name=status][data-toggle]');
  if (st) {
    var sync = function () { document.querySelectorAll('.only-done').forEach(function (e) { e.style.opacity = ['diproses', 'selesai'].includes(st.value) ? 1 : .55; }); };
    st.addEventListener('change', sync); sync();
  }

  // Animasi bar
  document.querySelectorAll('.bar i[data-w]').forEach(function (b) { setTimeout(function () { b.style.width = b.dataset.w + '%'; }, 200); });
})();
