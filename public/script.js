/* =================================================================
   ELEGANCE SALON — Unified Script File
   Contains: Tailwind Config + JS Logic with safe element checks
   ================================================================= */

/* ─── Tailwind Configuration (runs immediately) ──────────────── */
/* Tailwind CSS Theme Configuration — Elegance Salon */
if (typeof tailwind !== 'undefined') {
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          "primary":           "#0F6B50",
          "primary-container": "#0A4A35",
          "secondary":         "#D4AF37",
          "secondary-dark":    "#C5A028",
          "background":        "#FAF8F3",
          "background-dark":   "#041B14",
          "surface":           "#FFFFFF",
          "emerald-deep":      "#0A3428",
          "outline":           "#D4AF37",
          "sage":              "#8FBC8F"
        },
        fontFamily: {
          "serif": ["Playfair Display", "serif"],
          "sans":  ["Hanken Grotesk", "sans-serif"]
        }
      }
    }
  };
}


/* =================================================================
   ELEGANCE SALON — Unified Script File
   Contains: JS from all pages with safe element checks
   ================================================================= */

/* ─── Helper: safely get element ─────────────────────────────── */
function el(id) { return document.getElementById(id); }

/* ─── LOGIN PAGE ─────────────────────────────────────────────── */
window.togglePassword = function () {
  var passwordField = el('password-field');
  var toggleIcon = el('password-toggle-icon');
  if (!passwordField || !toggleIcon) return;
  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    toggleIcon.textContent = 'visibility_off';
  } else {
    passwordField.type = 'password';
    toggleIcon.textContent = 'visibility';
  }
};


/* ─── Interactive Logic (runs after DOM is ready) ────────────── */
document.addEventListener('DOMContentLoaded', function () {
/* ─── INDEX PAGE — Mobile Menu ───────────────────────────────── */
(function () {
  var hamburgerBtn = el('hamburgerBtn');
  var mobileMenu  = el('mobileMenu');
  var mobileClose = el('mobileClose');

  if (!hamburgerBtn || !mobileMenu) return;

  function openMobileMenu() {
    mobileMenu.classList.add('open');
    hamburgerBtn.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }

  window.closeMobileMenu = function () {
    mobileMenu.classList.remove('open');
    hamburgerBtn.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  };

  hamburgerBtn.addEventListener('click', openMobileMenu);
  if (mobileClose) mobileClose.addEventListener('click', window.closeMobileMenu);
  mobileMenu.addEventListener('click', function (e) {
    if (e.target === mobileMenu) window.closeMobileMenu();
  });
})();

/* ─── INDEX PAGE — Navbar scroll behaviour ───────────────────── */
(function () {
  var nav = el('main-nav');
  if (!nav) return;
  window.addEventListener('scroll', function () {
    if (window.scrollY > 60) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
    }
  }, { passive: true });
})();

/* ─── INDEX PAGE — Scroll Reveal ────────────────────────────── */
(function () {
  var reveals = document.querySelectorAll('.reveal');
  if (!reveals.length) return;
  var revealObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.10, rootMargin: '0px 0px -40px 0px' });
  reveals.forEach(function (el) { revealObserver.observe(el); });
})();

/* ─── INDEX PAGE — Active nav link on scroll ─────────────────── */
(function () {
  var sections = document.querySelectorAll('section[id]');
  var navItems = document.querySelectorAll('.nav-links a');
  if (!sections.length || !navItems.length) return;

  var sectionObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        var id = entry.target.getAttribute('id');
        navItems.forEach(function (a) {
          a.classList.remove('active');
          if (a.getAttribute('href') === '#' + id) a.classList.add('active');
        });
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(function (s) { sectionObserver.observe(s); });
})();

/* ─── INDEX PAGE — Star Rating ───────────────────────────────── */
(function () {
  var stars = document.querySelectorAll('#ratingStars i');
  var ratingInput = el('contactRating');
  if (!stars.length || !ratingInput) return;

  stars.forEach(function (star) {
    star.addEventListener('click', function () {
      var val = parseInt(star.getAttribute('data-rating'));
      ratingInput.value = val;
      stars.forEach(function (s) {
        var sVal = parseInt(s.getAttribute('data-rating'));
        if (sVal <= val) {
          s.classList.remove('far');
          s.classList.add('fas');
        } else {
          s.classList.remove('fas');
          s.classList.add('far');
        }
      });
    });
  });
})();

/* ─── INDEX PAGE — Contact Form ──────────────────────────────── */
(function () {
  var form = el('contactForm');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var name    = el('contactName')    ? el('contactName').value    : '';
    var email   = el('contactEmail')   ? el('contactEmail').value   : '';
    var service = el('contactService') ? el('contactService').value : '';
    var rating  = el('contactRating')  ? el('contactRating').value  : '5';
    var message = el('contactMessage') ? el('contactMessage').value : '';

    var newFeedback = {
      name: name, email: email, stylist: service,
      rating: parseInt(rating), message: message,
      date: new Date().toLocaleDateString()
    };

    var feedbacks = JSON.parse(localStorage.getItem('salonFeedbacks') || '[]');
    feedbacks.push(newFeedback);
    localStorage.setItem('salonFeedbacks', JSON.stringify(feedbacks));

    var btn = el('submitInquiryBtn');
    if (btn) {
      btn.innerHTML = '<i class="fas fa-check"></i> Feedback Sent!';
      btn.style.background = 'var(--forest-mid)';
      btn.disabled = true;
      setTimeout(function () {
        btn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Feedback';
        btn.style.background = '';
        btn.disabled = false;
        form.reset();
        /* reset stars */
        var stars = document.querySelectorAll('#ratingStars i');
        stars.forEach(function (s) {
          s.classList.remove('far');
          s.classList.add('fas');
        });
        var ri = el('contactRating');
        if (ri) ri.value = 5;
      }, 4000);
    }
  });
})();

/* ─── INDEX PAGE — Satisfaction bar ─────────────────────────── */
(function () {
  window.addEventListener('load', function () {
    setTimeout(function () {
      var bar = el('satBar');
      if (bar) bar.style.width = '98%';
    }, 800);
  });
})();

});


/* ─── MAIN.JS CONSOLIDATED ───────────────────────────────────── */
/*
  Elegance Salon - Public Site Script
*/

document.addEventListener('DOMContentLoaded', () => {
  // Navbar layout changes on scroll
  const navbar = document.getElementById('main-nav');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        navbar.classList.add('py-4', 'shadow-md');
        navbar.classList.remove('py-6');
      } else {
        navbar.classList.add('py-6');
        navbar.classList.remove('py-4', 'shadow-md');
      }
    });
  }

  // Smooth scroll for nav links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Contact Form Feedback Submission
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = document.getElementById('contactName').value;
      const email = document.getElementById('contactEmail').value;
      const service = document.getElementById('contactService').value;
      const rating = document.getElementById('contactRating') ? document.getElementById('contactRating').value : '5';
      const message = document.getElementById('contactMessage').value;

      if (name && email && message) {
        showSuccessAlert(contactForm, `Thank you, ${name}! Your shift feedback for "${service}" has been sent to salon management.`);
        // Note: index.html inline script already writes to localStorage feedbacks
      }
    });
  }

  // Common Tailwind alert message generator
  function showSuccessAlert(formElement, message) {
    // Remove any existing alerts first
    const existingAlert = formElement.querySelector('.tailwind-success-alert');
    if (existingAlert) {
      existingAlert.remove();
    }

    const alertDiv = document.createElement('div');
    alertDiv.className = 'tailwind-success-alert mt-6 p-4 rounded-lg bg-emerald-50 border border-primary/20 text-primary flex items-start gap-3 animated-fade-in transition-premium';
    alertDiv.style.animation = 'fadeInUp 0.5s ease forwards';
    
    alertDiv.innerHTML = `
      <span class="material-symbols-outlined text-secondary mt-0.5">check_circle</span>
      <div class="flex-grow">
        <strong class="font-label-md block text-sm mb-1">Inquiry Submitted</strong>
        <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">${message}</p>
      </div>
      <button type="button" class="close-alert-btn text-on-surface-variant hover:text-primary transition-premium">
        <span class="material-symbols-outlined text-sm">close</span>
      </button>
    `;
    
    formElement.appendChild(alertDiv);

    // Bind close button
    alertDiv.querySelector('.close-alert-btn').addEventListener('click', () => {
      alertDiv.classList.add('opacity-0');
      setTimeout(() => alertDiv.remove(), 400);
    });
    
    // Auto remove after 8 seconds
    setTimeout(() => {
      if (alertDiv.parentNode) {
        alertDiv.classList.add('opacity-0');
        setTimeout(() => alertDiv.remove(), 400);
      }
    }, 8000);
  }
});
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Open the modal container
            document.getElementById('editItemModal').classList.remove('hidden');
            
            // Set the dynamic form route
            document.getElementById('editModal').action = '/inventory/' + this.dataset.id;
            
            // Populating values safely
            document.getElementById('name').value = this.dataset.name ;
            document.getElementById('category').value = this.dataset.category ;
            document.getElementById('stock_level').value = this.dataset.stock ;
            document.getElementById('target_stock').value = this.dataset.target ;
            document.getElementById('supplier_name').value = this.dataset.supplier ;
            document.getElementById('cost_per_unit').value = this.dataset.cost ;
            document.getElementById('is_active').value = this.dataset.active;
        });
    });

    // ─── Responsive Portal Sidebar (Admin, Receptionist, Stylist) ───
    var sidebar = document.getElementById('portalSidebar');
    var toggleBtn = document.getElementById('sidebarToggle');
    var closeBtn = document.getElementById('sidebarClose');
    var backdrop = document.getElementById('sidebarBackdrop');

    function openSidebar() {
      if (sidebar) {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
      }
      if (backdrop) {
        backdrop.classList.remove('hidden');
      }
    }

    function closeSidebar() {
      if (sidebar) {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
      }
      if (backdrop) {
        backdrop.classList.add('hidden');
      }
    }

    if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (backdrop) backdrop.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeSidebar();
    });
});