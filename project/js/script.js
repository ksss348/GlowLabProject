// =========================
// HEADER TOGGLES (OLD HEADER)
// =========================
const userBox = document.querySelector('.header .user-box');
const navbar  = document.querySelector('.header .navbar');
const userBtn = document.querySelector('#user-btn');
const menuBtn = document.querySelector('#menu-btn');

if (userBtn && userBox && navbar) {
   userBtn.addEventListener('click', () => {
      userBox.classList.toggle('active');
      navbar.classList.remove('active');
   });
}

if (menuBtn && userBox && navbar) {
   menuBtn.addEventListener('click', () => {
      navbar.classList.toggle('active');
      userBox.classList.remove('active');
   });
}

// Close menus on scroll (old header)
window.addEventListener('scroll', () => {
   if (userBox) userBox.classList.remove('active');
   if (navbar) navbar.classList.remove('active');
});


// =========================
// PRODUCT HEADER SCROLL SHADOW
// =========================
const productHeader = document.querySelector('.main-header');

if (productHeader) {
   window.addEventListener('scroll', () => {
      productHeader.classList.toggle('scrolled', window.scrollY > 50);
   });
}


// =========================
// HERO IMAGE PARALLAX
// =========================
const heroImg = document.querySelector('.home .image img');

if (heroImg) {
   window.addEventListener('scroll', () => {
      heroImg.style.transform = `translateY(${window.scrollY * 0.08}px)`;
   });
}


// =========================
// HOW GLOWLAB WORKS SLIDER
// =========================
document.addEventListener('DOMContentLoaded', () => {

   const steps   = document.querySelectorAll('.step-card');
   const tabs    = document.querySelectorAll('.step-tab');
   const nextBtn = document.querySelector('.btn-next');
   const backBtn = document.querySelector('.btn-back');

   if (steps.length && tabs.length && nextBtn && backBtn) {

      let currentStep = 0;

      function showStep(index) {
         steps.forEach((step, i) => {
            step.classList.toggle('active', i === index);
         });

         tabs.forEach((tab, i) => {
            tab.classList.toggle('active', i === index);
         });

         backBtn.disabled = index === 0;
         nextBtn.disabled = index === steps.length - 1;
      }

      nextBtn.addEventListener('click', () => {
         if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
         }
      });

      backBtn.addEventListener('click', () => {
         if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
         }
      });

      tabs.forEach((tab, i) => {
         tab.addEventListener('click', () => {
            currentStep = i;
            showStep(currentStep);
         });
      });

      showStep(currentStep);
   }
});

// =========================
// CHECKOUT PAYMENT QR LOGIC
// =========================
document.addEventListener('DOMContentLoaded', () => {

   const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
   const qrBox   = document.getElementById('qrBox');
   const qrImage = document.getElementById('qrImage');

   // If checkout page elements exist
   if (paymentRadios.length && qrBox && qrImage) {

      paymentRadios.forEach(radio => {
         radio.addEventListener('change', () => {

            switch (radio.value) {
               case 'kbzpay':
                  qrBox.style.display = 'block';
                  qrImage.src = 'images/qr/kbzpay.png';
                  break;

               case 'wavepay':
                  qrBox.style.display = 'block';
                  qrImage.src = 'images/qr/wavepay.png';
                  break;

               case 'apay':
                  qrBox.style.display = 'block';
                  qrImage.src = 'images/qr/apay.png';
                  break;

               default: // COD
                  qrBox.style.display = 'none';
                  qrImage.src = '';
            }
         });
      });
   }
});
