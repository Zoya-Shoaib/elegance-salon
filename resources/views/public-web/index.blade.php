<!DOCTYPE html><html lang="en"><head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Elegance Salon | Luxury Boutique Beauty Experience</title>
  <meta name="description" content="Experience unparalleled luxury at Elegance Salon. Premium hair styling, manicures, facials, and personalized spa treatments in Beverly Hills. Book your appointment today.">
  <!-- Premium Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&amp;family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Tailwind CSS (must come before tailwind-config) -->
  <!-- Custom Styles -->
  <link rel="stylesheet" href="{{ asset('style.css')  }}">
  <script src="{{ asset('script.js') }}"></script>
</head>
<body>
  <!-- ═══════════════════ MOBILE MENU ═══════════════════ -->
  <div class="mobile-menu" id="mobileMenu" role="dialog" aria-modal="true" aria-label="Navigation Menu">
    <button class="mobile-close" id="mobileClose" aria-label="Close Menu"><i class="fas fa-times"></i></button>
    <a href="#" onclick="closeMobileMenu()">Home</a>
    <a href="#services" onclick="closeMobileMenu()">Services</a>
    <a href="#gallery" onclick="closeMobileMenu()">Gallery</a>
    <a href="#stylists" onclick="closeMobileMenu()">Our Stylists</a>
    <a href="#feedback-section" onclick="closeMobileMenu()">Contact Us</a>
    <a href="{{route('login')}}" onclick="closeMobileMenu()" class="mobile-menu-portal-link">Staff Portal</a>
  </div>
  <!-- ═══════════════════ NAVBAR ═══════════════════ -->
  <header id="main-nav" role="banner">
    <div class="nav-inner">
      <a href="#" class="nav-logo" aria-label="Elegance Salon Home">
        <span class="nav-logo-icon"><i class="fas fa-gem"></i></span>
        <span class="nav-logo-text">Elegan<em>ce</em></span>
      </a>
      <nav aria-label="Main Navigation">
        <ul class="nav-links" id="navLinks">
          <li><a href="#" class="active" id="nav-home">Home</a></li>
          <li><a href="#services" id="nav-services">Services</a></li>
          <li><a href="#gallery" id="nav-gallery">Gallery</a></li>
          <li><a href="#stylists" id="nav-stylists">Our Stylists</a></li>
          <li><a href="#feedback-section" id="nav-contact">Contact</a></li>
        </ul>
      </nav>
      <div class="nav-cta">
        <a href="{{route('login')}}" class="btn-nav-portal" id="staffPortalBtn">
          <i class="fas fa-user-circle staff-portal-icon"></i>Staff Portal
        </a>
        <button class="nav-hamburger" id="hamburgerBtn" aria-label="Open Mobile Menu" aria-expanded="false" aria-controls="mobileMenu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>
  <main>
    <!-- ═══════════════════ HERO ═══════════════════ -->
    <section class="hero" aria-label="Hero Section">
      <div class="hero-bg">
        <img src='{{asset("hero.jpg")}}' alt="Luxurious interior of Elegance Salon with gold and green accents" fetchpriority="high" decoding="async">
      </div>
      <div class="hero-overlay"></div>
      <div class="hero-content container">
        <!-- Left: Text -->
        <div class="hero-text">
          <div class="hero-label">
            <span class="hero-label-line"></span>
            <span>Luxury Boutique Salon Experience</span>
          </div>
          <h1 class="hero-heading">
            Experience<br>
            Beauty <em>With</em><br>
            Confidence
          </h1>
          <p class="hero-sub-heading">Crafted By Expert Stylists</p>
          <div class="hero-divider"></div>
          <div class="hero-actions">
            <a href="{{ route('login') }}" class="btn-primary" id="heroBookBtn">
              <i class="fas fa-user-circle"></i> Staff Portal
            </a>
            <div class="hero-action-divider"></div>
            <a href="#services" class="btn-tertiary" id="heroServicesBtn">
              Explore Services <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
        <!-- Right: Floating Glass Cards -->
        <div class="hero-cards" aria-label="Salon Statistics">
          <!-- Card 1 -->
          <div class="glass-card">
            <div class="card-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="card-label">Today's Appointments</div>
            <div class="card-value">24</div>
            <div class="card-sub">↑ 3 since yesterday</div>
          </div>
          <!-- Card 2 -->
          <div class="glass-card">
            <div class="card-icon"><i class="fas fa-cut"></i></div>
            <div class="card-label">Active Stylists</div>
            <div class="card-value">8</div>
            <div class="card-sub">All available today</div>
          </div>
          <!-- Card 3 -->
          <div class="glass-card">
            <div class="card-icon"><i class="fas fa-users"></i></div>
            <div class="card-label">Monthly Clients</div>
            <div class="card-value">186</div>
            <div class="card-sub">+12% this month</div>
          </div>
          <!-- Card 4 -->
          <div class="glass-card">
            <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
            <div class="card-label">Revenue Today</div>
            <div class="card-value">$1,250</div>
            <div class="card-sub">Goal: $2,000</div>
          </div>
          <!-- Card 5 – Full width: satisfaction -->
          <div class="glass-card span-2">
            <div class="card-icon"><i class="fas fa-star"></i></div>
            <div class="sat-bar-wrap">
              <div class="card-label">Customer Satisfaction</div>
              <div class="card-value" style="font-size:1.7rem">98%</div>
              <div class="sat-bar-track">
                <div class="sat-bar-fill" id="satBar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Scroll indicator -->
      <div class="scroll-indicator">
        <div class="scroll-indicator-label">
          Scroll</div>
        <div class="scroll-indicator-line">
        </div>
      </div>
    </section>
    <!-- ═══════════════════ MARQUEE ═══════════════════ -->
    <div class="marquee-strip" aria-hidden="true">
      <div class="marquee-track" id="marqueeTrack">
        <!-- Items duplicated for seamless loop -->
        <span class="marquee-item">Hair Artistry <span class="marquee-dot"></span></span>
        <span class="marquee-item">Nail Couture <span class="marquee-dot"></span></span>
        <span class="marquee-item">Facial Therapy <span class="marquee-dot"></span></span>
        <span class="marquee-item">Bridal Styling <span class="marquee-dot"></span></span>
        <span class="marquee-item">Luxury Spa <span class="marquee-dot"></span></span>
        <span class="marquee-item">Balayage &amp; Color <span class="marquee-dot"></span></span>
        <span class="marquee-item">Skincare Rituals <span class="marquee-dot"></span></span>
        <span class="marquee-item">Makeup Artistry <span class="marquee-dot"></span></span>
        <span class="marquee-item">Hair Artistry <span class="marquee-dot"></span></span>
        <span class="marquee-item">Nail Couture <span class="marquee-dot"></span></span>
        <span class="marquee-item">Facial Therapy <span class="marquee-dot"></span></span>
        <span class="marquee-item">Bridal Styling <span class="marquee-dot"></span></span>
        <span class="marquee-item">Luxury Spa <span class="marquee-dot"></span></span>
        <span class="marquee-item">Balayage &amp; Color <span class="marquee-dot"></span></span>
        <span class="marquee-item">Skincare Rituals <span class="marquee-dot"></span></span>
        <span class="marquee-item">Makeup Artistry <span class="marquee-dot"></span></span>
      </div>
    </div>
    <!-- ═══════════════════ SERVICES ═══════════════════ -->
    <section class="services-section" id="services" aria-label="Services">
      <div class="container">
        <div class="services-header reveal">
          <div>
            <div class="section-label"><span>Curated Services</span></div>
            <h2 class="section-heading">Our <em>Signature</em><br>Treatments</h2>
          </div>
        </div>
        <div class="services-grid">
          <!-- Feature Card: Hair -->
          <div class="service-card feature reveal reveal-delay-1">
            <img class="service-card-img" src="https://images.unsplash.com/photo-1562322140-8baeececf3df?q=90&amp;w=900&amp;auto=format&amp;fit=crop" alt="Professional hair styling session" loading="lazy">
            <div class="service-card-overlay"></div>
            <div class="service-card-body">
              <span class="service-card-tag">Hair Artistry</span>
              <h3 class="service-card-title">Couture Styling<br>&amp; Color</h3>
            </div>
          </div>
          <!-- Nail Couture – image card -->
          <div class="service-card small reveal reveal-delay-2">
            <img class="service-card-img" src="https://images.unsplash.com/photo-1604654894610-df63bc536371?q=90&amp;w=700&amp;auto=format&amp;fit=crop" alt="Precision nail artistry manicure" loading="lazy">
            <div class="service-card-overlay"></div>
            <div class="service-card-body">
              <span class="service-card-tag">Nail Couture</span>
              <h3 class="service-card-title service-card-title-sm">Precision
                Nail<br>Artistry</h3>
            </div>
          </div>
          <!-- Facial Spa – image card -->
          <div class="service-card small reveal reveal-delay-3">
            <img class="service-card-img" src="https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?q=90&amp;w=700&amp;auto=format&amp;fit=crop" alt="Luxury facial spa treatment" loading="lazy">
            <div class="service-card-overlay"></div>
            <div class="service-card-body">
              <span class="service-card-tag">Skin Therapy</span>
              <h3 class="service-card-title service-card-title-sm">Facial
                Spa<br>&amp; Skincare</h3>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ═══════════════════ GALLERY ═══════════════════ -->
    <section class="gallery-section" id="gallery" aria-label="Gallery">
      <div class="container">
        <div class="gallery-intro reveal">
          <div>
            <div class="section-label"><span>Visual Perfection</span></div>
            <h2 class="section-heading">Our <em>Gallery</em></h2>
          </div>
        </div>
        <div class="gallery-grid">
          <div class="gallery-item reveal reveal-delay-1">
            <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?q=85&amp;w=700&amp;auto=format&amp;fit=crop" alt="Honey Balayage hair styling" loading="lazy">
            <div class="gallery-hover">
              <h4>Honey Balayage</h4>
              <p>Hair Artistry</p>
            </div>
          </div>
          <div class="gallery-item reveal reveal-delay-2">
            <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?q=85&amp;w=700&amp;auto=format&amp;fit=crop" alt="Gelish nail art manicure" loading="lazy">
            <div class="gallery-hover">
              <h4>Gelish Manicure</h4>
              <p>Nail Couture</p>
            </div>
          </div>
          <div class="gallery-item reveal reveal-delay-3">
            <img src="https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?q=85&amp;w=700&amp;auto=format&amp;fit=crop" alt="Gold mask luxury facial" loading="lazy">
            <div class="gallery-hover">
              <h4>Gold Mask Facial</h4>
              <p>Skin Therapy</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ═══════════════════ STYLISTS ═══════════════════ -->
    <section class="stylists-section" id="stylists" aria-label="Our Stylists">
      <div class="container">
        <div class="stylists-intro reveal">
          <div class="section-label section-label-center"><span>Our Artisans</span></div>
          <h2 class="section-heading stylists-heading">
            Meet Our <em>Elite</em> Stylists
          </h2>
          <p class="section-body stylists-body">
            World-class artisans dedicated to matching your vision with precision and passion. Every stylist is a master
            of their craft.
          </p>
        </div>
        <div class="stylists-grid">
          <div class="stylist-card reveal reveal-delay-1">
            <div class="stylist-avatar">
              <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&amp;w=300&amp;auto=format&amp;fit=crop" alt="Clarissa Gold – Master Stylist" loading="lazy">
            </div>
            <div class="stylist-name">Clarissa Gold</div>
            <span class="stylist-role">Master Stylist</span>
            <p class="stylist-bio">Over 12 years crafting award-winning cuts, bespoke colour palettes, and signature
              balayage finishes.</p>
          </div>
          <div class="stylist-card reveal reveal-delay-2">
            <div class="stylist-avatar">
              <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?q=80&amp;w=300&amp;auto=format&amp;fit=crop" alt="Mia Rose – Nail Artist" loading="lazy">
            </div>
            <div class="stylist-name">Mia Rose</div>
            <span class="stylist-role">Nail Artist &amp; Esthetician</span>
            <p class="stylist-bio">Specializes in custom gel nail designs and luxurious reflexology spa pedicure
              treatments.</p>
          </div>
          <div class="stylist-card reveal reveal-delay-3">
            <div class="stylist-avatar">
              <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&amp;w=300&amp;auto=format&amp;fit=crop" alt="Dr. Helen S. – Skin Specialist" loading="lazy">
            </div>
            <div class="stylist-name">Dr. Helen S.</div>
            <span class="stylist-role">Senior Skin Specialist</span>
            <p class="stylist-bio">Clinical dermatologist conducting Hydrafacial, chemical resurfacing, and
              micro-needling protocols.</p>
          </div>
          <div class="stylist-card reveal reveal-delay-4">
            <div class="stylist-avatar">
              <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&amp;w=300&amp;auto=format&amp;fit=crop" alt="Victoria Lux – Makeup Artist" loading="lazy">
            </div>
            <div class="stylist-name">Victoria Lux</div>
            <span class="stylist-role">Makeup Artist</span>
            <p class="stylist-bio">Renowned for high-fashion editorial makeup and flawless custom bridal
              transformations.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- ═══════════════════ CTA BANNER ═══════════════════ -->
    <section class="cta-section" aria-label="Call to Action">
      <div class="container">
        <div class="cta-inner reveal">
          <div class="section-label cta-label">
            <span>Elegance Salon Management System</span>
          </div>
          <h2 class="section-heading">Streamline Salon <em>Operations</em><br>&amp; Feedback</h2>
          <p>Access our secure staff portal to manage appointments, track inventory levels, and view stylist schedules. We also invite users and evaluators to submit system feedback.</p>
          <div class="cta-actions">
            <a href="{{ route('login') }}" class="btn-cta-primary" id="ctaLoginBtn">
              <i class="fas fa-user-shield"></i> Staff Login Portal
            </a>
            <a href="#feedback-section" class="btn-cta-outline" id="ctaFeedbackBtn">
              <i class="fas fa-comments"></i> Submit Application Feedback
            </a>
      </div>
    </div></div></section>
    <!-- ═══════════════════ CONTACT & FEEDBACK ═══════════════════ -->
    <section class="contact-section" id="feedback-section" aria-label="Contact and Feedback">
      <div class="container">
        <div class="reveal contact-header">
          <div class="section-label section-label-center"><span>User Experience</span></div>
          <h2 class="section-heading">Contact &amp; <em>Feedback</em></h2>
        </div>
        <div class="contact-grid">
          <!-- Info Card: Website Development Team -->
          <div class="contact-info-card reveal reveal-delay-1">
            <h3>Website Development Team</h3>
            <p>This website was designed and developed by our development team. Feel free to contact us regarding
              technical support, website issues, collaboration opportunities, or feature requests.</p>
            <div class="team-list">
              <!-- Developer 1 -->
              <div class="team-member-row">
                <div class="team-row-icon"><i class="fas fa-code"></i></div>
                <div class="team-row-content">
                  <h5>Lead Developer</h5>
                  <p>[Developer Name]</p>
                  <p class="team-contact-info">
                    <i class="fas fa-envelope team-contact-icon"></i>developer1@example.com<br>
                    <i class="fas fa-phone team-contact-icon"></i>+92 XXX XXXXXXX
                  </p>
                </div>
              </div>
              <!-- Developer 2 -->
              <div class="team-member-row">
                <div class="team-row-icon"><i class="fas fa-laptop-code"></i></div>
                <div class="team-row-content">
                  <h5>Frontend Developer</h5>
                  <p>[Developer Name]</p>
                  <p class="team-contact-info">
                    <i class="fas fa-envelope team-contact-icon"></i>developer2@example.com<br>
                    <i class="fas fa-phone team-contact-icon"></i>+92 XXX XXXXXXX
                  </p>
                </div>
              </div>
              <!-- Developer 3 -->
              <div class="team-member-row">
                <div class="team-row-icon"><i class="fas fa-server"></i></div>
                <div class="team-row-content">
                  <h5>Backend Developer</h5>
                  <p>[Developer Name]</p>
                  <p class="team-contact-info">
                    <i class="fas fa-envelope team-contact-icon"></i>developer3@example.com<br>
                    <i class="fas fa-phone team-contact-icon"></i>+92 XXX XXXXXXX
                  </p>
                </div>
              </div>
            </div>
            <!-- Organization footer line -->
            <div class="team-footer-line">
              Elegance Dev Studios &mdash; Karachi, Pakistan<br>
              contact@elegancedev.com &nbsp;&bull;&nbsp; +92 (21) 111-222-333
            </div>
          </div>
          <!-- Form Card: Website Feedback -->
          <div class="contact-form-card reveal reveal-delay-2">
            <h3>Website Feedback<br>&amp; User Experience</h3>
            <p>We value your experience. Please share your feedback about our website, report any bugs, usability
              issues, or suggest improvements to help us provide a better online experience.</p>
            <form id="contactForm" novalidate="">
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="contactName">Full Name</label>
                  <input class="form-input" id="contactName" type="text" placeholder="Enter your full name" required="">
                </div>
                <div class="form-group">
                  <label class="form-label" for="contactEmail">Email Address</label>
                  <input class="form-input" id="contactEmail" type="email" placeholder="Enter your email address" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="contactService">Which page did you experience an issue on?</label>
                  <select class="form-select" id="contactService">
                    <option value="Home">Home</option>
                    <option value="About">About</option>
                    <option value="Services">Services</option>
                    <option value="Appointments">Appointments</option>
                    <option value="Contact">Contact</option>
                    <option value="Gallery">Gallery</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Rate Your Website Experience</label>
                  <div id="ratingStars">
                    <i class="fas fa-star" data-rating="1"></i>
                    <i class="fas fa-star" data-rating="2"></i>
                    <i class="fas fa-star" data-rating="3"></i>
                    <i class="fas fa-star" data-rating="4"></i>
                    <i class="fas fa-star" data-rating="5"></i>
                  </div>
                  <input type="hidden" id="contactRating" value="5">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="contactMessage">Feedback / Bug Report</label>
                <textarea class="form-textarea" id="contactMessage" rows="4" placeholder="Tell us about your experience, report a bug, suggest improvements, or let us know if something isn't working correctly." required=""></textarea>
              </div>
              <button class="btn-submit" type="submit" id="submitInquiryBtn">
                <i class="fas fa-paper-plane"></i> Send Feedback
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- ═══════════════════ FOOTER ═══════════════════ -->
  <footer aria-label="Site Footer">
    <div class="container">
      <div class="footer-inner">
        <!-- Brand -->
        <div class="footer-brand">
          <a href="#" class="footer-logo">
            <span class="footer-logo-icon"><i class="fas fa-gem"></i></span>
            <span class="footer-logo-text">Elegan<em>ce</em></span>
          </a>
          <p class="footer-desc">
            Defining the standards of boutique luxury hair, nail, and skincare since 2012. Our commitment to excellence
            and elegance remains timeless.
          </p>
          <div class="footer-social">
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
            <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
          </div>
        </div>
        <!-- Quick Links -->
        <div class="footer-col">
          <h4>Navigate</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#stylists">Our Stylists</a></li>
            <li><a href="#feedback-section">Contact Us</a></li>
          </ul>
        </div>
        <!-- Legal -->
        <div class="footer-col">
          <h4>Legal</h4>
          <ul>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Cookie Policy</a></li>
            <li><a href="{{ route('login') }}">Staff Portal</a></li>
          </ul>
        </div>
        <!-- Hours & Contact -->
        <div class="footer-col footer-hours">
          <h4>Visit Us</h4>
          <div class="info-item">
            <div class="info-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="info-content">
              <p class="footer-address">123 Luxury Avenue,<br>Beverly Hills, CA 90210
              </p>
            </div>
          </div>
          <h4 class="footer-hours-heading">Business Hours</h4>
          <div class="footer-hours">
            <p>Tuesday – Saturday</p>
            <p>9:00 AM – 8:00 PM</p>
            <p class="hours-note">Closed Sun &amp; Mon</p>
          </div>
        </div>
      </div>
      <!-- Bottom Bar -->
      <div class="footer-bottom">
        <p>© 2026 Elegance Salon. All rights reserved.</p>
        <div class="footer-bottom-links">
          <a href="#">Privacy</a>
          <a href="#">Terms</a>
          <a href="{{route('login')}}">Staff Login</a>
        </div>
      </div>
    </div>
  </footer>
  <!-- ═══════════════════ SCRIPTS ═══════════════════ -->
  

  </body></html>