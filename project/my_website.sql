-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 04:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_mm` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `content_mm` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title_en`, `title_mm`, `content_en`, `content_mm`, `image_url`, `category`, `created_at`) VALUES
(1, 'The Ultimate 10-Step Korean Skincare Guide', 'ကိုးရီးယားစတိုင် ၁၀ ဆင့် အသားအရေထိန်းသိမ်းနည်း အပြည့်အစုံ', '1. Double cleanse... [truncated for space]', '၁။ Double Cleansing... [truncated]', 'k-beauty.jpg', 'Routine', '2026-02-08 08:38:15'),
(2, 'Understanding the Power of Vitamin C Serum', 'Vitamin C Serum ရဲ့ အစွမ်းထက်ပုံကို လေ့လာခြင်း', '1. Vitamin C is like a bright companion...', '၁။ Vitamin C ဆိုတာ...', 'vit-c.jpg', 'Ingredients', '2026-02-08 08:38:15'),
(3, 'How to Choose the Right Sunscreen for Your Skin', 'သင့်အသားအရေနဲ့ ကိုက်ညီတဲ့ နေလောင်ကာခရင်မ် ဘယ်လိုရွေးမလဲ', '1. We recommend choosing a sunscreen with SPF 30 or higher to keep your skin safe...', '၁။ အသားအရေလေးကို ကာကွယ်ဖို့အတွက် SPF 30 နဲ့ အထက်ပါတာလေးကို ရွေးချယ်ပေးစေချင်ပါတယ်ရှင်...', 'sunscreen.jpg', 'Protection', '2026-02-08 08:38:15'),
(4, 'The Truth About Acne and Diet', 'ဝက်ခြံနဲ့ စားသောက်မှုပုံစံကြားက အမှန်တရား', '1. Reducing sugary treats can be very helpful in calming down skin inflammation...', '၁။ အချိုဓာတ်များတာလေးတွေ လျှော့စားပေးရင် အသားအရေလေးမှာ ရောင်ရမ်းတာလေးတွေ သက်သာစေနိုင်ပါတယ်ရှင်...', 'acne-diet.jpg', 'Lifestyle', '2026-02-08 08:38:15'),
(5, 'Nighttime Recovery: Why You Need a Night Cream', 'ညဘက် အသားအရေ ပြလည်ပြုပြင်ခြင်း၏ အရေးပါပုံ', '1. Nighttime is a peaceful opportunity for your skin cells to renew and repair...', '၁။ ညဘက်ဆိုတာ အသားအရေလေးတွေ အေးအေးချမ်းချမ်းနဲ့ ပြန်လည်နုပျိုလာရမယ့် အချိန်လေးပါရှင်...', 'night-cream.jpg', 'Routine', '2026-02-08 08:38:15'),
(6, 'Exfoliation 101: Chemical vs. Physical', 'Exfoliation ပြုလုပ်နည်း အခြေခံ - Chemical နှင့် Physical', '1. Gently removing dead skin cells is a wonderful way to keep your pores clear...', '၁။ ဆဲလ်သေလေးတွေကို ဖယ်ရှားပေးတာက ချွေးပေါက်လေးတွေ မပိတ်အောင် ကူညီပေးနိုင်ပါတယ်ရှင်...', 'exfoliation.jpg', 'Tips', '2026-02-08 08:38:15'),
(7, 'The Benefits of Facial Massage and Gua Sha', 'မျက်နှာအကြောညှစ်ခြင်းနှင့် Gua Sha သုံးစွဲခြင်း၏ အကျိုးကျေးဇူးများ', '1. A gentle facial massage is a lovely way to boost circulation and health...', '၁။ မျက်နှာလေးကို ညင်ညင်သာသာ နှိပ်နယ်ပေးတာက သွေးလည်ပတ်မှုကို ကောင်းမွန်စေပါတယ်ရှင်...', 'guasha.jpg', 'Lifestyle', '2026-02-08 08:38:15'),
(8, 'How Stress Affects Your Skin Health', 'စိတ်ဖိစီးမှုက သင့်အသားအရေကို ဘယ်လိုထိခိုက်စေသလဲ', '1. When things get stressful, your skin might produce more oil...', '၁။ စိတ်ဖိစီးမှုလေးတွေ များလာတဲ့အခါ အသားအရေလေးက ပိုပြီး အဆီပြန်တတ်လို့ စိတ်လေးကို အေးအေးထားပေးပါနော်...', 'stress-skin.jpg', 'Lifestyle', '2026-02-08 08:38:15'),
(9, 'Caring for Sensitive Skin: Do and Don’ts', 'Sensitive Skin (နုနယ်ထိခိုက်လွယ်သောအသားအရေ) ကို ဘယ်လိုဂရုစိုက်မလဲ', '1. Strictly avoid products containing fragrances, alcohol, and harsh chemicals...', '၁။ အမွှေးနံ့သာနှင့် အယ်လ်ကိုဟောပါဝင်သော ပြင်းထန်သည့် ပစ္စည်းများကို လုံးဝရှောင်ကြဉ်ပါ။...', 'sensitive.jpg', 'Tips', '2026-02-15 22:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`, `date_sent`) VALUES
(1, 0, 'Mya Thida', 'tmya092@gmail.com', '09123456789', 'hi', '2026-02-22 09:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `skincare_tips`
--

CREATE TABLE `skincare_tips` (
  `id` int(11) NOT NULL,
  `skin_type` varchar(50) NOT NULL,
  `tip_text_en` text NOT NULL,
  `tip_text_mm` text NOT NULL,
  `image_url` varchar(255) DEFAULT 'normal.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skincare_tips`
--

INSERT INTO `skincare_tips` (`id`, `skin_type`, `tip_text_en`, `tip_text_mm`, `image_url`) VALUES
(1, 'Dry Skin', '✨ We recommend using serums with Hyaluronic Acid to keep your skin deeply hydrated from within.\r\n\r\n✨ To preserve your skin\'s natural oils, switching to a non-foaming cream cleanser would be a wonderful choice.\r\n\r\n✨ Applying a hydrating sheet mask once a week is a lovely way to give your skin an extra glow.\r\n\r\n✨ Please use a rich, nourishing moisturizer to seal in all that essential moisture throughout the day.\r\n\r\n✨ For the health of your skin, we suggest avoiding hot water and using cool water for washing instead.', '🌸 အသားအရေလေး အတွင်းပိုင်းထိ ရေဓာတ်ပြည့်ဝနေစေဖို့ Hyaluronic Acid ပါဝင်တဲ့ serum လေးတွေကို ဦးစားပေးသုံးကြည့်ပေးပါနော်။\r\n\r\n🌸 အသားအရေရဲ့ သဘာဝအဆီဓာတ်လေးတွေ မဆုံးရှုံးသွားစေဖို့ အမြှုပ်ထွက်နည်းတဲ့ Cream Cleanser လေးကို ပြောင်းသုံးကြည့်ဖို့ အကြံပြုပါရစေရှင်။\r\n\r\n🌸 တစ်ပတ်မှာ တစ်ကြိမ်လောက်တော့ အသားအရေလေး စိုပြေသွားအောင် ရေဓာတ်ဖြည့် Sheet Mask လေး ကပ်ပေးပါဦးနော်။\r\n\r\n🌸 ဖြည့်တင်းထားတဲ့ အစိုဓာတ်လေးတွေ အသားထဲမှာတင် ရှိနေစေဖို့ အာဟာရဓာတ်ကြွယ်ဝတဲ့ Moisturizer လေးနဲ့ သေချာလေး ပိတ်လှောင်ပေးထားပါရှင်။\r\n\r\n🌸 မျက်နှာသစ်တဲ့အခါ အသားအရေလေး မခြောက်သွေ့သွားစေဖို့ ရေနွေးထက်စာရင် ရေအေးလေးနဲ့ပဲ သစ်ပေးဖို့ တိုက်တွန်းပါရစေရှင်။', 'dry_skin.jpg'),
(2, 'Oily Skin', '✨ Using a cleanser with Salicylic Acid (BHA) is a great way to keep your pores clear and fresh.\r\n\r\n✨ We suggest choosing oil-free or gel-based moisturizers to keep your skin hydrated without feeling greasy.\r\n\r\n✨ Applying a matte-finish sunscreen daily will help you feel confident and control mid-day shine.\r\n\r\n✨ Gently exfoliating 2-3 times a week is a lovely habit to keep your skin smooth and clean.\r\n\r\n✨ To prevent unwanted breakouts, you might want to avoid heavy, oil-based products for a while.', '🌸 ချွေးပေါက်လေးတွေ ပိတ်ဆို့တာမျိုး မဖြစ်ရအောင် Salicylic Acid (BHA) ပါဝင်တဲ့ မျက်နှာသစ်ဆေးလေးကို သုံးပေးနိုင်ပါတယ်ရှင်။\r\n\r\n🌸 အသားအရေလေး အဆီမပြန်ဘဲ စိုပြေနေစေဖို့ အဆီမပါဝင်တဲ့ (Oil-free) Gel-based moisturizer လေးကို ရွေးချယ်ပေးပါနော်။\r\n\r\n🌸 နေ့ဘက်မှာ အဆီပြန်တာလေးကို ထိန်းပေးနိုင်ဖို့ Matte ဖြစ်စေတဲ့ Sunscreen လေးကို ပုံမှန်လေး လိမ်းပေးစေချင်ပါတယ်ရှင်။\r\n\r\n🌸 ချွေးပေါက်လေးတွေ သန့်ရှင်းနေစေဖို့အတွက် တစ်ပတ်မှာ ၂ ကြိမ်လောက် ညင်ညင်သာသာလေး ဆဲလ်သေဖယ်ရှားပေးပါဦးနော်။\r\n\r\n🌸 ဝက်ခြံလေးတွေ မထွက်အောင် ကာကွယ်ဖို့အတွက် အဆီဓာတ်အရမ်းများတဲ့ Skincare ပစ္စည်းလေးတွေကို ရှောင်ကြည့်ဖို့ အကြံပြုပါရစေရှင်။', 'oily_skin.jpg'),
(3, 'Normal Skin', '✨ Try \"multi-masking\" by hydrating your cheeks while managing oil on your T-zone for perfect balance.\r\n\r\n✨ For a deeper clean at night, we highly recommend trying the double cleansing method.\r\n\r\n✨ We suggest using a lightweight moisturizer for the whole face to keep it feeling fresh and airy.\r\n\r\n✨ Using a clay mask on your T-zone once a week is a wonderful way to manage excess oil naturally.\r\n\r\n✨ For those drier patches, adding an extra layer of cream only where needed will keep your skin happy.', '🌸 ပါးပြင်လေးတွေကို ရေဓာတ်ဖြည့်ပြီး T-zone ကို အဆီထိန်းပေးတဲ့ \"multi-masking\" နည်းလမ်းလေးကို သုံးကြည့်ပါဦးနော်။\r\n\r\n🌸 ညဘက်မှာ အညစ်အကြေးလေးတွေ အကုန်စင်သွားအောင် Double Cleansing နည်းလမ်းလေးနဲ့ သန့်စင်ပေးဖို့ အကြံပြုပါရစေရှင်။\r\n\r\n🌸 မျက်နှာတစ်ပြင်လုံးအတွက် ပေါ့ပေါ့ပါးပါးနဲ့ အသားထဲစိမ့်ဝင်လွယ်တဲ့ Moisturizer လေးကိုပဲ ရွေးချယ်ပေးပါနော်။\r\n\r\n🌸 အဆီပြန်တတ်တဲ့ T-zone နေရာလေးတွေအတွက်တော့ တစ်ပတ်တစ်ကြိမ် Clay mask လေး သုံးပေးတာက အဆင်ပြေစေမှာပါရှင်။\r\n\r\n🌸 အသားခြောက်တဲ့ နေရာလေးတွေမှာပဲ Cream ကို တစ်ထပ်ပိုလိမ်းပေးခြင်းအားဖြင့် အချိုးညီတဲ့ အလှတရားကို ရရှိနိုင်ပါတယ်ရှင်။', 'normal_skin.jpg'),
(4, 'Combination Skin', '✨ Start your morning with an antioxidant-rich Vitamin C serum to keep your natural glow shining bright.\r\n\r\n✨ We recommend using a lightweight night cream to keep your skin supple and nourished while you rest.\r\n\r\n✨ To protect your beautiful skin from premature aging, please never skip your daily sunscreen.\r\n\r\n✨ Maintaining a consistent and simple routine is the best way to keep your skin barrier healthy and strong.\r\n\r\n✨ Drinking plenty of water is a lovely, natural way to sustain your skin\'s healthy glow every day.', '🌸 မနက်ခင်းမှာ အသားအရေလေး ပိုပြီး ဝင်းပနေစေဖို့ Antioxidant ကြွယ်ဝတဲ့ Vitamin C serum လေးကို သုံးပေးနိုင်ပါတယ်ရှင်။\r\n\r\n🌸 ညဘက်မှာ အသားအရေလေး အာဟာရပြည့်ဝနေအောင် ပေါ့ပါးတဲ့ Night Cream လေး တစ်မျိုးမျိုးကို လိမ်းအိပ်ပေးပါနော်။\r\n\r\n🌸 အရွယ်မတိုင်မီ အိုမင်းတာမျိုး မဖြစ်အောင် နေလောင်ကာခရင်မ် (Sunscreen) လေးကိုတော့ နေ့တိုင်း ပုံမှန်လေး လိမ်းပေးစေချင်ပါတယ်ရှင်။\r\n🌸 အသားအရေရဲ့ သဘာဝအတားအဆီးလေး (Skin Barrier) ခိုင်မာနေဖို့အတွက် ရိုးရှင်းတဲ့ Skincare routine လေးကိုပဲ ထိန်းသိမ်းပေးပါနော်။\r\n\r\n🌸 သဘာဝအတိုင်း ဝင်းပနေတဲ့ အသားအရေလေးကို ဆက်လက်ပိုင်ဆိုင်နိုင်ဖို့ ရေများများသောက်ပေးဖို့လည်း မမေ့ပါနဲ့ဦးရှင်။', 'combination_skin.jpg'),
(5, 'Sensitive Skin', '✨ To keep your skin calm, we suggest choosing products that are free from fragrances and alcohol.\r\n\r\n✨ It is always a good idea to perform a small patch test before introducing any new products to your routine.\r\n\r\n✨ Washing your face with cool water instead of hot water will help keep your skin feeling comfortable.\r\n\r\n✨ Soothing ingredients like Aloe Vera and Centella are wonderful choices for your delicate skin.\r\n\r\n✨ We recommend avoiding harsh physical scrubs and choosing more gentle ways to refresh your face.', '🌸 အသားအရေလေး မနီမြန်းသွားအောင် အမွှေးနံ့နဲ့ အယ်လ်ကိုဟော မပါဝင်တဲ့ ပစ္စည်းလေးတွေကိုပဲ ရွေးချယ်ပေးစေချင်ပါတယ်ရှင်။\r\n\r\n🌸 ပစ္စည်းအသစ်လေးတွေ သုံးတိုင်း အသားအရေနဲ့ တည့်၊ မတည့် သိရအောင် နားသယ်စပ်မှာ အရင်စမ်းသပ်ပေးဖို့ အကြံပြုပါရစေနော်။\r\n\r\n🌸 အသားအရေလေး မနာကျင်အောင် မျက်နှာသစ်တဲ့အခါ ရေနွေးထက် ရေအေးလေးကိုပဲ သုံးပေးဖို့ တိုက်တွန်းပါရစေရှင်။\r\n\r\n🌸 ရှားစောင်းလက်ပတ်နဲ့ Centella လိုမျိုး အသားအရေကို အေးမြစေတဲ့ ပစ္စည်းလေးတွေက သင့်အတွက် အဖော်မွန်လေးတွေပါပဲရှင်။\r\n\r\n🌸 အသားအရေကို ထိက်ခိုက်စေနိုင်တဲ့ ပြင်းထန်တဲ့ Scrub တွေ သုံးမယ့်အစား ညင်သာတဲ့ နည်းလမ်းလေးတွေကိုပဲ ရွေးချယ်ပေးပါနော်။', 'sensitive_skin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `password` varchar(255) NOT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `skin_type` varchar(100) DEFAULT NULL,
  `total_score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `image`, `role`, `password`, `security_question`, `security_answer`, `skin_type`, `total_score`) VALUES
(1, 'Mya', 'tmya092@gmail.com', '09677411617', 'user_1_1771730502.jpg', 'admin', '$2y$10$S0.U5i71cqqTCFw/lN.6LuvMDwW03igo/wDiiarhQHcYw2Zx2uFzK', 'pet', 'cat', 'Dry Skin', 8),
(2, 'Madi', NULL, '', NULL, 'customer', '', NULL, NULL, 'Sensitive Skin', 32),
(7, 'phoophoo', 'phoo19112021@gmail.com', '09786689874', NULL, 'customer', '$2y$10$FwbKfnfk22.1QentthiyROowyel2lmzy.AQ3pUq65sT0rf65seYRS', 'pet', 'dog', NULL, NULL),
(10, 'MyaThida', 'mya123@gmail.com', '09123456789', 'user_10_1771728827.jpg', 'customer', '$2y$10$t5Q7cti03GiyVN6j1OW6AuQY9LWtR2KwkJ36SzZvk8.YDd3zFYxx2', 'pet', 'meow', 'Oily Skin', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skincare_tips`
--
ALTER TABLE `skincare_tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skincare_tips`
--
ALTER TABLE `skincare_tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
