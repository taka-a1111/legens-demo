/* ============================================
   LEGENS - 共通JavaScript
============================================ */

(function () {
  'use strict';

  // ============================================
  // モバイルメニュートグル
  // ============================================
  const menuToggle = document.querySelector('.menu-toggle');
  const headerNav = document.querySelector('.header-nav');

  if (menuToggle && headerNav) {
    menuToggle.addEventListener('click', () => {
      menuToggle.classList.toggle('active');
      headerNav.classList.toggle('open');
      const expanded = menuToggle.classList.contains('active');
      menuToggle.setAttribute('aria-expanded', expanded);
    });

    // モバイルメニュー内リンククリックで閉じる
    headerNav.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
          menuToggle.classList.remove('active');
          headerNav.classList.remove('open');
        }
      });
    });

    // リサイズ時にPC幅に戻ったらメニューをリセット
    let resizeTimer;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        if (window.innerWidth > 768) {
          menuToggle.classList.remove('active');
          headerNav.classList.remove('open');
        }
      }, 200);
    });
  }

  // ============================================
  // スクロール時のヘッダー影
  // ============================================
  const header = document.querySelector('.site-header');
  if (header) {
    const onScroll = () => {
      if (window.scrollY > 10) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ============================================
  // スクロール出現アニメーション
  // ============================================
  if ('IntersectionObserver' in window) {
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(
      entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );
    reveals.forEach(el => observer.observe(el));
  } else {
    // フォールバック
    document.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
  }

  // ============================================
  // お問い合わせフォーム - 簡易バリデーション
  // ============================================
  const contactForm = document.querySelector('.contact-form');
  if (contactForm) {
    const agree = contactForm.querySelector('input[name="agree"]');
    const submit = contactForm.querySelector('button[type="submit"]');

    if (agree && submit) {
      const toggleSubmit = () => {
        submit.disabled = !agree.checked;
        submit.style.opacity = agree.checked ? '1' : '0.5';
        submit.style.cursor = agree.checked ? 'pointer' : 'not-allowed';
      };
      agree.addEventListener('change', toggleSubmit);
      toggleSubmit();
    }
  }
})();
