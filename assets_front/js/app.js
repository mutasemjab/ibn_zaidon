/* Zaidon EdTech — Front-end JavaScript */
(function () {
  'use strict';

  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

  /* ── Sticky Navbar ───────────────────────────────────── */
  const navbar = document.querySelector('.z-navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });
  }

  /* ── Mobile Menu Toggle ──────────────────────────────── */
  const toggle  = document.getElementById('mobileToggle');
  const mobMenu = document.getElementById('mobileMenu');
  if (toggle && mobMenu) {
    toggle.addEventListener('click', () => {
      toggle.classList.toggle('open');
      mobMenu.classList.toggle('open');
    });
    mobMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
      toggle.classList.remove('open');
      mobMenu.classList.remove('open');
    }));
  }

  /* ── Animated Counters ───────────────────────────────── */
  function runCounter(el) {
    const target   = parseInt(el.dataset.count, 10);
    const suffix   = el.dataset.suffix || '';
    const duration = 1800;
    let start = null;
    requestAnimationFrame(function step(ts) {
      if (!start) start = ts;
      const p = Math.min((ts - start) / duration, 1);
      const ease = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.floor(ease * target).toLocaleString('ar-EG') + suffix;
      if (p < 1) requestAnimationFrame(step);
    });
  }

  const counters = document.querySelectorAll('[data-count]');
  if (counters.length) {
    const obs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting && !e.target.dataset.ran) {
          e.target.dataset.ran = '1';
          runCounter(e.target);
        }
      });
    }, { threshold: 0.4 });
    counters.forEach(c => obs.observe(c));
  }

  /* ── Tab System ──────────────────────────────────────── */
  function initTabGroup(btnSel, panelSel) {
    const btns   = document.querySelectorAll(btnSel);
    const panels = document.querySelectorAll(panelSel);
    if (!btns.length) return;
    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        btns.forEach(b => b.classList.remove('active'));
        panels.forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        const target = document.getElementById(btn.dataset.target);
        if (target) target.classList.add('active');
      });
    });
  }
  initTabGroup('.svc-tab-btn', '.svc-panel');
  initTabGroup('.pay-tab',     '.pay-panel');

  /* ── Unit Accordion ──────────────────────────────────── */
  document.querySelectorAll('.unit-acc-btn').forEach((btn, i) => {
    const body = document.getElementById(btn.dataset.body);
    if (!body) return;
    if (i === 0) { body.classList.add('show'); }
    else { btn.classList.add('collapsed'); }
    btn.addEventListener('click', () => {
      const open = body.classList.contains('show');
      btn.classList.toggle('collapsed', open);
      body.classList.toggle('show', !open);
      const ic = btn.querySelector('.acc-ico');
      if (ic) ic.style.transform = open ? '' : 'rotate(180deg)';
    });
  });

  /* ── Option Selection (Exam) ─────────────────────────── */
  document.querySelectorAll('.opt-lbl').forEach(lbl => {
    lbl.addEventListener('click', () => {
      const radio = lbl.querySelector('input[type="radio"]');
      if (!radio) return;
      document.querySelectorAll(`input[name="${radio.name}"]`).forEach(r => {
        r.closest('.opt-lbl')?.classList.remove('chosen');
      });
      radio.checked = true;
      lbl.classList.add('chosen');
    });
  });

  /* ── Exam Timer ──────────────────────────────────────── */
  const timerEl  = document.getElementById('examTimerData');
  const timerTxt = document.getElementById('timerDisplay');
  const timerBox = document.querySelector('.exam-timer-box');
  if (timerEl && timerTxt) {
    let secs = parseInt(timerEl.dataset.seconds, 10) || 0;
    const initSecs = secs;
    const tick = setInterval(() => {
      secs--;
      if (secs <= 0) {
        clearInterval(tick);
        document.getElementById('examForm')?.submit();
        return;
      }
      const m = String(Math.floor(secs / 60)).padStart(2, '0');
      const s = String(secs % 60).padStart(2, '0');
      timerTxt.textContent = `${m}:${s}`;
      if (timerBox && secs <= 120) timerBox.classList.add('timer-warning');
    }, 1000);

    const examForm = document.getElementById('examForm');
    if (examForm) {
      examForm.addEventListener('submit', () => {
        const taken = initSecs - secs;
        const inp = examForm.querySelector('input[name="time_taken_seconds"]')
          || Object.assign(document.createElement('input'), { type: 'hidden', name: 'time_taken_seconds' });
        inp.value = taken;
        if (!inp.parentNode) examForm.appendChild(inp);
      });
    }
  }

  /* ── Card code input formatter ───────────────────────── */
  document.querySelector('.code-input')?.addEventListener('input', function () {
    this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '');
  });

  /* ── Flash auto-dismiss ──────────────────────────────── */
  document.querySelectorAll('.z-flash').forEach(el => {
    setTimeout(() => {
      el.style.transition = 'opacity .5s';
      el.style.opacity = '0';
      setTimeout(() => el.remove(), 550);
    }, 5000);
  });

  /* ── Smooth scroll ───────────────────────────────────── */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.hash);
      if (!target) return;
      e.preventDefault();
      const navH = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--navbar-h')) || 72;
      window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - navH - 16, behavior: 'smooth' });
    });
  });

  /* ── Scroll-reveal ───────────────────────────────────── */
  const revEls = document.querySelectorAll('.anim-fade-up');
  if (revEls.length) {
    const revObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.style.animationPlayState = 'running';
          revObs.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });
    revEls.forEach(el => {
      el.style.animationPlayState = 'paused';
      revObs.observe(el);
    });
  }

})();
