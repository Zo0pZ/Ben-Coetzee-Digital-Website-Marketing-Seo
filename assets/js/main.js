/* ============================================================
   BEN COETZEE DIGITAL — Main JavaScript
   ============================================================ */

'use strict';

/* ----------------------------------------------------------
   1. CURRENT YEAR IN FOOTER
   ---------------------------------------------------------- */
document.querySelectorAll('#year').forEach(el => {
  el.textContent = new Date().getFullYear();
});

/* ----------------------------------------------------------
   2. STICKY HEADER ON SCROLL
   ---------------------------------------------------------- */
const header = document.getElementById('site-header');
if (header) {
  const onScroll = () => {
    if (window.scrollY > 40) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // run once on load
}

/* ----------------------------------------------------------
   3. MOBILE NAVIGATION TOGGLE
   ---------------------------------------------------------- */
const navToggle = document.getElementById('nav-toggle');
const navLinks  = document.getElementById('nav-links');

if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    const isOpen = navLinks.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', String(isOpen));
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });

  // Close nav when a link is clicked
  navLinks.querySelectorAll('.nav__link').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  });

  // Close nav on Escape key
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && navLinks.classList.contains('open')) {
      navLinks.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
      navToggle.focus();
    }
  });
}

/* ----------------------------------------------------------
   4. SCROLL REVEAL ANIMATION
   ---------------------------------------------------------- */
const revealEls = document.querySelectorAll(
  '.service-card, .pillar, .expertise-item, .client-type, ' +
  '.intro__body, .intro__visual, .why__content, .why__pillars, ' +
  '.about__portrait, .about__body, .info-card, .contact__form-wrap, ' +
  '.credential, .hero__badge, .hero__headline, .hero__sub, ' +
  '.hero__actions, .hero__stats'
);

revealEls.forEach((el, i) => {
  el.classList.add('reveal');
  // Stagger service cards and pillars
  if (el.closest('.services__grid') || el.closest('.why__pillars') || el.closest('.expertise__grid')) {
    el.style.transitionDelay = (i % 4) * 0.08 + 's';
  }
});

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, {
  threshold: 0.1,
  rootMargin: '0px 0px -40px 0px'
});

revealEls.forEach(el => revealObserver.observe(el));

/* ----------------------------------------------------------
   5. SMOOTH SCROLL FOR ANCHOR LINKS
   ---------------------------------------------------------- */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', e => {
    const target = document.querySelector(anchor.getAttribute('href'));
    if (target) {
      e.preventDefault();
      const offset = header ? header.offsetHeight + 16 : 80;
      const top = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  });
});

/* ----------------------------------------------------------
   6. CONTACT FORM VALIDATION & SUBMISSION
   ---------------------------------------------------------- */
const contactForm = document.getElementById('contact-form');
if (contactForm) {

  const fields = {
    name:         { el: contactForm.querySelector('#name'),         err: contactForm.querySelector('#name-error') },
    companySize:  { el: contactForm.querySelector('#company-size'), err: contactForm.querySelector('#company-size-error') },
    email:        { el: contactForm.querySelector('#email'),        err: contactForm.querySelector('#email-error') },
    project:      { el: contactForm.querySelector('#project'),      err: contactForm.querySelector('#project-error') },
    consent:      { el: contactForm.querySelector('#consent'),      err: contactForm.querySelector('#consent-error') },
  };

  const submitBtn   = document.getElementById('submit-btn');
  const successMsg  = document.getElementById('form-success');

  const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  function setError(field, msg) {
    field.el.classList.add('error');
    if (field.err) field.err.textContent = msg;
    field.el.setAttribute('aria-invalid', 'true');
  }

  function clearError(field) {
    field.el.classList.remove('error');
    if (field.err) field.err.textContent = '';
    field.el.setAttribute('aria-invalid', 'false');
  }

  function validateField(key) {
    const field = fields[key];
    if (!field || !field.el) return true;

    if (key === 'name') {
      if (!field.el.value.trim()) { setError(field, 'Please enter your full name.'); return false; }
    }
    if (key === 'companySize') {
      if (!field.el.value) { setError(field, 'Please select your organisation type.'); return false; }
    }
    if (key === 'email') {
      if (!field.el.value.trim()) { setError(field, 'Please enter your email address.'); return false; }
      if (!EMAIL_RE.test(field.el.value.trim())) { setError(field, 'Please enter a valid email address.'); return false; }
    }
    if (key === 'project') {
      if (!field.el.value.trim()) { setError(field, 'Please provide a brief project overview.'); return false; }
      if (field.el.value.trim().length < 20) { setError(field, 'Please provide a little more detail (at least 20 characters).'); return false; }
    }
    if (key === 'consent') {
      if (!field.el.checked) { setError(field, 'Please confirm your consent to proceed.'); return false; }
    }

    clearError(field);
    return true;
  }

  // Live validation on blur
  Object.keys(fields).forEach(key => {
    const field = fields[key];
    if (!field || !field.el) return;
    const eventType = key === 'consent' ? 'change' : 'blur';
    field.el.addEventListener(eventType, () => validateField(key));
    field.el.addEventListener('input', () => {
      if (field.el.classList.contains('error')) validateField(key);
    });
  });

  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Validate all fields
    const valid = Object.keys(fields).map(k => validateField(k)).every(Boolean);
    if (!valid) {
      // Focus first error
      const firstError = contactForm.querySelector('.error');
      if (firstError) firstError.focus();
      return;
    }

    // Simulate submission (replace with real endpoint when available)
    const label   = submitBtn.querySelector('.btn__label');
    const loading = submitBtn.querySelector('.btn__loading');

    submitBtn.disabled = true;
    if (label)   label.hidden = true;
    if (loading) loading.hidden = false;

    await new Promise(resolve => setTimeout(resolve, 1200)); // simulate network

    // Show success
    contactForm.hidden = true;
    if (successMsg) {
      successMsg.hidden = false;
      successMsg.focus();
    }
  });
}

/* ----------------------------------------------------------
   7. ACTIVE NAV LINK HIGHLIGHT (on scroll, homepage)
   ---------------------------------------------------------- */
const sections = document.querySelectorAll('section[id]');
if (sections.length) {
  const navAnchors = document.querySelectorAll('.nav__links .nav__link:not(.nav__cta)');

  const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navAnchors.forEach(a => {
          a.classList.toggle(
            'active',
            a.getAttribute('href') === '#' + entry.target.id
          );
        });
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(s => sectionObserver.observe(s));
}
