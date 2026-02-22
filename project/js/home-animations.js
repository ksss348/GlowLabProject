/* =========================
   GLOWLAB REFINED ANIMATIONS
   Unified Scroll, Parallax, and UI Logic
========================= */

document.addEventListener('DOMContentLoaded', function() {
   
   // --- PRELOADER ---
   const preloader = document.querySelector('.preloader');
   if (preloader) {
      window.addEventListener('load', function() {
         setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => preloader.style.display = 'none', 500);
         }, 500);
      });
   }

   // --- SCROLL REVEAL (INTERSECTION OBSERVER) ---
   const revealOptions = {
      threshold: 0.15,
      rootMargin: '0px 0px -50px 0px'
   };

   const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
         if (entry.isIntersecting) {
            entry.target.classList.add('active');
         }
      });
   }, revealOptions);

   const revealElements = document.querySelectorAll(
      '.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right, .scroll-reveal-scale'
   );
   revealElements.forEach(el => revealObserver.observe(el));

   // --- STEP SLIDER LOGIC ---
   const stepTabs = document.querySelectorAll('.step-tab');
   const stepCards = document.querySelectorAll('.step-card');
   const btnNext = document.querySelector('.btn-next');
   const btnBack = document.querySelector('.btn-back');
   let currentStep = 0;

   function showStep(index) {
      if (!stepCards.length) return;
      stepTabs.forEach(tab => tab.classList.remove('active'));
      stepCards.forEach(card => card.classList.remove('active'));
      
      stepTabs[index].classList.add('active');
      stepCards[index].classList.add('active');
      currentStep = index;
   }

   if (stepTabs.length > 0) {
      stepTabs.forEach((tab, index) => {
         tab.addEventListener('click', () => showStep(index));
      });

      if (btnNext) {
         btnNext.addEventListener('click', () => {
            currentStep = (currentStep + 1) % stepCards.length;
            showStep(currentStep);
         });
      }

      if (btnBack) {
         btnBack.addEventListener('click', () => {
            currentStep = (currentStep - 1 + stepCards.length) % stepCards.length;
            showStep(currentStep);
         });
      }

      // Auto-advance logic
      let autoAdvance = setInterval(() => {
         if (!document.hidden) {
            currentStep = (currentStep + 1) % stepCards.length;
            showStep(currentStep);
         }
      }, 5000);

      const stepsSlider = document.querySelector('.steps-slider');
      if (stepsSlider) {
         stepsSlider.addEventListener('mouseenter', () => clearInterval(autoAdvance));
         stepsSlider.addEventListener('mouseleave', () => {
            autoAdvance = setInterval(() => {
               currentStep = (currentStep + 1) % stepCards.length;
               showStep(currentStep);
            }, 5000);
         });
      }
   }

   // --- PARALLAX HERO ---
   // --- REFINED PARALLAX HERO ---
const heroImage = document.querySelector('.home .image img');
if (heroImage) {
   window.addEventListener('scroll', () => {
      // requestAnimationFrame makes the movement buttery smooth
      window.requestAnimationFrame(() => {
         const scrolled = window.pageYOffset;
         // Lower the multiplier (0.05) to keep alignment tight
         // Adding a limit prevents the image from flying into the header
         const val = scrolled * 0.05; 
         if (scrolled < 1000) { 
            heroImage.style.transform = `translate3d(0, ${val}px, 0)`;
         }
      });
   });
}
   // --- ANIMATED COUNTER ---
   function animateCounter(element, target) {
      let start = 0;
      const duration = 2000;
      const increment = target / (duration / 16);
      const timer = setInterval(() => {
         start += increment;
         if (start >= target) {
            element.textContent = Math.floor(target);
            clearInterval(timer);
         } else {
            element.textContent = Math.floor(start);
         }
      }, 16);
   }

   const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
         if (entry.isIntersecting) {
            const target = parseInt(entry.target.getAttribute('data-counter'));
            animateCounter(entry.target, target);
            counterObserver.unobserve(entry.target);
         }
      });
   }, { threshold: 0.5 });

   document.querySelectorAll('[data-counter]').forEach(c => counterObserver.observe(c));

   // --- HEADER EFFECT ---
   // --- HEADER SCROLL EFFECT FIX ---
// This ensures the header doesn't "snap" and break alignment
const header = document.querySelector('.header');
window.addEventListener('scroll', () => {
   if (window.scrollY > 10) {
      header.style.boxShadow = '0 5px 15px rgba(0,0,0,0.05)';
   } else {
      header.style.boxShadow = 'none';
   }
});

   // --- FLOATING PARTICLES ---
   function createParticle(section) {
      const particle = document.createElement('div');
      particle.className = 'floating-particle';
      const size = Math.random() * 50 + 20;
      particle.style.cssText = `
         position: absolute;
         width: ${size}px;
         height: ${size}px;
         background: radial-gradient(circle, rgba(183, 110, 121, 0.15), transparent);
         border-radius: 50%;
         left: ${Math.random() * 100}%;
         top: ${Math.random() * 100}%;
         pointer-events: none;
         z-index: 0;
         animation: floatAround ${Math.random() * 10 + 15}s linear infinite;
      `;
      section.appendChild(particle);
   }

   document.querySelectorAll('.skinConcerns, .how-it-works, .routine-preview').forEach(s => {
      s.style.position = 'relative';
      for(let i=0; i<3; i++) createParticle(s);
   });

   console.log('%c✨ GlowLab Modern Active', 'color: #b76e79; font-weight: bold; font-size: 16px;');
});