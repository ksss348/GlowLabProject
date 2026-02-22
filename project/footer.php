<footer class="footer" style="background: #fff; border-top: 1px solid #eee; padding: 7rem 1.5rem 3rem; font-family: 'Poppins', sans-serif;">
   <div class="box-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(22rem, 1fr)); gap: 3.5rem; max-width: 1200px; margin: 0 auto;">
      
      <div class="box">
         <h3 style="font-size: 1.8rem; color: #333; margin-bottom: 2.5rem; font-weight: 700; text-transform: capitalize;">GlowLab</h3>
         <p class="newsletter-text" style="font-size: 1.4rem; color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
            Personalized skincare solutions backed by science and expert consultation. 
            Your journey to radiant skin starts here.
         </p>
         <div class="socials" style="margin-top: 1.5rem; display: flex; gap: 1.5rem;">
            <a href="#" style="height: 4rem; width: 4rem; display: flex; align-items: center; justify-content: center; background: #fdf4f7; border-radius: 50%; transition: 0.3s;"><img src="images/facebook.png" alt="FB" width="20"></a>
            <a href="#" style="height: 4rem; width: 4rem; display: flex; align-items: center; justify-content: center; background: #fdf4f7; border-radius: 50%; transition: 0.3s;"><img src="images/twitter.png" alt="TW" width="20"></a>
            <a href="#" style="height: 4rem; width: 4rem; display: flex; align-items: center; justify-content: center; background: #fdf4f7; border-radius: 50%; transition: 0.3s;"><img src="images/instagram.png" alt="IG" width="20"></a>
            <a href="#" style="height: 4rem; width: 4rem; display: flex; align-items: center; justify-content: center; background: #fdf4f7; border-radius: 50%; transition: 0.3s;"><img src="images/linkedin.png" alt="IN" width="20"></a>
         </div>
      </div>

      <div class="box">
         <h3 style="font-size: 1.8rem; color: #333; margin-bottom: 2.5rem; font-weight: 700;">Quick Links</h3>
         <?php 
            $links = [
               'home.php' => 'Home', 
               'questionnarie.php' => 'Skin Analysis', 
               'index.php' => 'Products', 
               'searchpage.php' => 'Consultants', 
               'blogs.php' => 'Tips & Blog', 
               'about.php' => 'About Us'
            ];
            foreach($links as $url => $label): 
         ?>
         <a href="<?= $url ?>" style="display: block; font-size: 1.4rem; color: #666; padding: 1rem 0; text-decoration: none; transition: 0.3s;">
            <i class="fas fa-angle-right" style="color: #b76e79; margin-right: 1rem;"></i> <?= $label ?>
         </a>
         <?php endforeach; ?>
      </div>

      <div class="box">
         <h3 style="font-size: 1.8rem; color: #333; margin-bottom: 2.5rem; font-weight: 700;">Customer Care</h3>
         <?php 
            $care = ['FAQ', 'Shipping Info', 'Returns & Exchange', 'Track Your Order', 'Privacy Policy', 'Terms of Service'];
            foreach($care as $item): 
         ?>
         <a href="#" style="display: block; font-size: 1.4rem; color: #666; padding: 1rem 0; text-decoration: none; transition: 0.3s;">
            <i class="fas fa-angle-right" style="color: #b76e79; margin-right: 1rem;"></i> <?= $item ?>
         </a>
         <?php endforeach; ?>
      </div>

      <div class="box">
         <h3 style="font-size: 1.8rem; color: #333; margin-bottom: 2.5rem; font-weight: 700;">Stay Connected</h3>
         <p class="newsletter-text" style="font-size: 1.4rem; color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
            Subscribe for skincare tips, exclusive offers, and new product launches.
         </p>
         <form class="newsletter-form" method="post" style="display: flex; background: #f9f9f9; padding: 0.5rem; border-radius: 50px; border: 1px solid #eee;">
            <input type="email" class="email-input" placeholder="Your email address" required style="width: 100%; background: transparent; border: none; padding: 1rem 1.5rem; font-size: 1.3rem; outline: none;">
            <button type="submit" style="background: linear-gradient(135deg, #b76e79, #d18ea0); border: none; color: white; padding: 1rem 2rem; border-radius: 50px; cursor: pointer; font-weight: 600; white-space: nowrap;">
               Subscribe
            </button>
         </form>
         
         <div style="margin-top: 2rem;">
            <p style="font-size: 1.4rem; color: #666; padding: 0.5rem 0;"><i class="fas fa-phone" style="color: #b76e79; margin-right: 1rem;"></i> +95 123 456 789</p>
            <p style="font-size: 1.4rem; color: #666; padding: 0.5rem 0;"><i class="fas fa-envelope" style="color: #b76e79; margin-right: 1rem;"></i> hello@glowlab.com</p>
            <p style="font-size: 1.4rem; color: #666; padding: 0.5rem 0;"><i class="fas fa-map-marker-alt" style="color: #b76e79; margin-right: 1rem;"></i> Yangon, Myanmar</p>
         </div>
      </div>
   </div>

   <div class="footer-bottom" style="margin-top: 6rem; padding-top: 2rem; border-top: 1px solid #eee; text-align: center;">
      <p class="credit" style="font-size: 1.4rem; color: #666;">
         &copy; <?= date('Y'); ?> <span style="color: #b76e79; font-weight: 600;">GlowLab</span>. All rights reserved. 
         | Designed with <i class="fas fa-heart" style="color: #b76e79;"></i> for beautiful skin
      </p>
   </div>
</footer>