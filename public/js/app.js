(function () {
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ---------- Navbar publik: bayangan saat scroll, progress bar, menu mobile ----------
  var nav = document.querySelector('.nav');
  var bar = document.querySelector('.progress i');
  var burger = document.querySelector('.burger');
  var links = document.querySelector('.nav-links');
  if (burger && links) {
    burger.addEventListener('click', function () {
      var open = links.classList.toggle('open');
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    links.addEventListener('click', function (e) { if (e.target.closest('a')) links.classList.remove('open'); });
  }

  // ---------- Panel: sidebar laci di layar kecil ----------
  var body = document.body;
  document.querySelectorAll('[data-menu-open]').forEach(function (b) {
    b.addEventListener('click', function () { body.classList.add('menu-open'); });
  });
  document.querySelectorAll('[data-menu-close]').forEach(function (b) {
    b.addEventListener('click', function () { body.classList.remove('menu-open'); });
  });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') body.classList.remove('menu-open'); });
  var side = document.getElementById('side');
  if (side) side.addEventListener('click', function (e) { if (e.target.closest('nav a')) body.classList.remove('menu-open'); });
  window.addEventListener('resize', function () { if (window.innerWidth > 900) body.classList.remove('menu-open'); });

  // ---------- Scroll: navbar, progress bar, parallax hero ----------
  var hero = document.querySelector('.hero');
  var heroBg = hero && hero.querySelector('[data-parallax="bg"]');
  var heroIn = hero && hero.querySelector('[data-parallax="content"]');
  var ticking = false;

  function onScroll() {
    var y = window.scrollY || window.pageYOffset;
    if (nav) nav.classList.toggle('scrolled', y > 8);
    if (bar) {
      var max = document.documentElement.scrollHeight - window.innerHeight;
      bar.style.width = (max > 0 ? Math.min(100, (y / max) * 100) : 0) + '%';
    }
    if (hero && !reduce) {
      var h = hero.offsetHeight;
      if (y < h) {
        if (heroBg) heroBg.style.transform = 'translate3d(0,' + (y * 0.28).toFixed(1) + 'px,0)';
        if (heroIn) {
          heroIn.style.transform = 'translate3d(0,' + (y * -0.1).toFixed(1) + 'px,0)';
          heroIn.style.opacity = Math.max(0, 1 - y / (h * 0.85)).toFixed(2);
        }
      }
    }
    ticking = false;
  }
  window.addEventListener('scroll', function () {
    if (!ticking) { ticking = true; window.requestAnimationFrame(onScroll); }
  }, { passive: true });
  onScroll();

  // ---------- Parallax mouse untuk lapisan melayang ----------
  if (!reduce && window.matchMedia('(hover: hover)').matches) {
    document.querySelectorAll('.hero, .cta').forEach(function (zone) {
      var layers = zone.querySelectorAll('[data-depth]');
      if (!layers.length) return;
      zone.addEventListener('mousemove', function (e) {
        var r = zone.getBoundingClientRect();
        var x = (e.clientX - r.left) / r.width - 0.5;
        var y = (e.clientY - r.top) / r.height - 0.5;
        layers.forEach(function (l) {
          var d = parseFloat(l.getAttribute('data-depth')) || 0.5;
          l.style.transform = 'translate3d(' + (x * d * -46).toFixed(1) + 'px,' + (y * d * -46).toFixed(1) + 'px,0)';
        });
      });
      zone.addEventListener('mouseleave', function () {
        layers.forEach(function (l) { l.style.transform = ''; });
      });
    });
  }

  // ---------- Efek muncul saat scroll + hitung angka ----------
  function countUp(el) {
    var target = parseInt(el.getAttribute('data-count'), 10);
    if (isNaN(target) || reduce) return;
    var start = null, dur = 1200;
    function step(ts) {
      if (start === null) start = ts;
      var p = Math.min(1, (ts - start) / dur);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased).toLocaleString('id-ID');
      if (p < 1) window.requestAnimationFrame(step);
    }
    el.textContent = '0';
    window.requestAnimationFrame(step);
  }

  var els = document.querySelectorAll('.reveal');
  function show(el) {
    el.classList.add('in');
    el.querySelectorAll('[data-count]').forEach(countUp);
    if (el.hasAttribute('data-tilt')) setTimeout(function () { el.classList.add('done'); }, 1200);
  }
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { show(e.target); io.unobserve(e.target); } });
    }, { threshold: 0.15 });
    els.forEach(function (el) { io.observe(el); });
  } else {
    els.forEach(show);
  }

  // ---------- Kartu miring mengikuti kursor ----------
  if (!reduce && window.matchMedia('(hover: hover)').matches) {
    document.querySelectorAll('[data-tilt]').forEach(function (card) {
      card.addEventListener('mousemove', function (e) {
        var r = card.getBoundingClientRect();
        var x = (e.clientX - r.left) / r.width - 0.5;
        var y = (e.clientY - r.top) / r.height - 0.5;
        card.style.transform = 'perspective(800px) rotateX(' + (y * -7).toFixed(2) + 'deg) rotateY(' + (x * 9).toFixed(2) + 'deg) translateY(-4px)';
      });
      card.addEventListener('mouseleave', function () { card.style.transform = ''; });
    });
  }

  // ---------- Slider horizontal (jurusan & fasilitas) ----------
  document.querySelectorAll('.slider-wrap').forEach(function (w) {
    var s = w.querySelector('.slider');
    var step = function () { var c = s.querySelector('.slide-card'); return c ? c.offsetWidth + 20 : 300; };
    w.querySelector('.s-next').addEventListener('click', function () {
      if (s.scrollLeft + s.clientWidth >= s.scrollWidth - 4) s.scrollTo({ left: 0 }); else s.scrollBy({ left: step() });
    });
    w.querySelector('.s-prev').addEventListener('click', function () { s.scrollBy({ left: -step() }); });
  });

  // ---------- Pratinjau foto sebelum diunggah ----------
  document.querySelectorAll('input[type=file][data-preview]').forEach(function (inp) {
    inp.addEventListener('change', function () {
      var box = document.querySelector(inp.dataset.preview); box.innerHTML = '';
      Array.from(inp.files).slice(0, 3).forEach(function (f) {
        var img = document.createElement('img'); img.src = URL.createObjectURL(f); box.appendChild(img);
      });
    });
  });

  // ---------- Lightbox untuk foto laporan ----------
  var lb = document.createElement('div'); lb.className = 'lightbox'; lb.innerHTML = '<img alt="">';
  document.body.appendChild(lb);
  lb.addEventListener('click', function () { lb.classList.remove('on'); });
  document.querySelectorAll('.gallery img').forEach(function (img) {
    img.addEventListener('click', function () { lb.querySelector('img').src = img.src; lb.classList.add('on'); });
  });

  // ---------- Kolom biaya paling relevan saat Diverifikasi / Selesai ----------
  var st = document.querySelector('[name=status][data-toggle]');
  if (st) {
    var sync = function () {
      document.querySelectorAll('.only-done').forEach(function (e) {
        e.style.opacity = ['diverifikasi', 'selesai'].includes(st.value) ? 1 : .55;
      });
    };
    st.addEventListener('change', sync); sync();
  }

  // ---------- Animasi bar ----------
  document.querySelectorAll('.bar i[data-w]').forEach(function (b) { setTimeout(function () { b.style.width = b.dataset.w + '%'; }, 200); });
})();
