-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2026 at 07:17 PM
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
-- Database: `glowlab_db`
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
(1, 'The Ultimate 10-Step Korean Skincare Guide', 'ကိုးရီးယားစတိုင် ၁၀ ဆင့် အသားအရေထိန်းသိမ်းနည်း အပြည့်အစုံ', '1. To keep your skin fresh and clean, you might want to try the double cleansing method.\r\n2. Gently exfoliating twice a week will help your skin look younger and brighter.\r\n3. Please use a toner after washing to balance your skin\'s pH level beautifully.\r\n4. Using an essence is a lovely way to keep your deeper skin layers hydrated.\r\n5. We suggest picking a serum that specifically addresses your unique skin concerns.\r\n6. A relaxing sheet mask twice a week can provide your skin with wonderful nutrients.\r\n7. To care for your delicate eyes, applying an eye cream regularly is a great habit.\r\n8. It is best to use a moisturizer to lock in all that lovely hydration.\r\n9. Please don\'t forget your sunscreen during the day to keep your skin protected.\r\n10. At night, finishing with a sleeping mask will help your skin recover while you rest.', '၁။ အသားအရေလေး ကြည်လင်သန့်ရှင်းနေစေဖို့အတွက် Double Cleansing နည်းလမ်းလေးကို အသုံးပြုပေးနိုင်ပါတယ်ရှင်။\r\n၂။ တစ်ပတ်ကို နှစ်ကြိမ်လောက် ဆဲလ်သေလေးတွေ ဖယ်ရှားပေးရင် အသားအရေလေးက ပိုပြီး နုပျိုဝင်းပလာမှာပါ။\r\n၃။ မျက်နှာသစ်ပြီးတိုင်း pH level လေး ပြန်ညှိပေးဖို့ Toner လေးကို အသုံးပြုပေးပါနော်။\r\n၄။ အသားအရေ အတွင်းပိုင်းအထိ ရေဓာတ်ပြည့်ဝနေစေဖို့ Essence လေးက ကူညီပေးနိုင်ပါတယ်။\r\n၅။ ကိုယ့်ရဲ့ အသားအရေ စိုးရိမ်ပူပန်မှုလေးတွေအတွက် သင့်တော်တဲ့ Serum လေးတွေကို ရွေးချယ်ပေးပါရှင်။\r\n၆။ တစ်ပတ်ကို နှစ်ကြိမ်လောက် Sheet Mask လေး ကပ်ပေးရင် အသားအရေအတွက် အာဟာရဓာတ်လေးတွေ ပိုရစေပါတယ်ရှင်။\r\n၇။ နုနယ်တဲ့ မျက်ဝန်းတစ်ဝိုက်အတွက် Eye Cream လေးကို ပုံမှန်လေး လိမ်းပေးစေချင်ပါတယ်နော်။\r\n၈။ ဖြည့်တင်းထားတဲ့ အစိုဓာတ်လေးတွေ မကုန်ခမ်းသွားစေဖို့ Moisturizer လေးနဲ့ အုပ်ပေးဖို့ လိုပါတယ်ရှင်။\r\n၉။ နေ့ဘက်မှာတော့ အသားအရေလေးကို ကာကွယ်ပေးဖို့ Sunscreen လေးကို မမေ့မလျော့ လိမ်းပေးပါဦးနော်။\r\n၁၀။ ညဘက်မှာတော့ အသားအရေလေး ပြန်လည်အားဖြည့်ဖို့ Sleeping Mask လေးနဲ့ အနားယူပေးနိုင်ပါတယ်ရှင်။', 'k-beauty.jpg', 'Routine', '2026-02-08 15:08:15'),
(2, 'Understanding the Power of Vitamin C Serum', 'Vitamin C Serum ရဲ့ အစွမ်းထက်ပုံကို လေ့လာခြင်း', '1. Vitamin C is like a bright companion that brings a natural glow to your skin.\r\n2. It can be very helpful in soothing dark spots caused by the sun.\r\n3. This wonderful serum also helps keep your skin firm and youthful.\r\n4. Pairing it with sunscreen in the morning offers lovely protection for your face.\r\n5. To keep it effective, we recommend storing it away from direct light.\r\n6. If the serum changes color, it is best to stop using it for your skin\'s safety.\r\n7. For those with sensitive skin, starting with a lower concentration is very gentle.\r\n8. After toning, you can gently apply your Vitamin C for better absorption.\r\n9. Please remember to follow up with a moisturizer to keep your skin soft.\r\n10. With consistent use, you will surely see your skin looking more radiant every day.', '၁။ Vitamin C ဆိုတာ အသားအရေလေးကို သဘာဝအတိုင်း ကြည်လင်ဝင်းပစေတဲ့ အဖော်မွန်လေးတစ်ခုပါပဲ။\r\n၂။ နေရောင်ခြည်ကြောင့် ဖြစ်တတ်တဲ့ အမည်းစက်လေးတွေကိုလည်း သက်သာသွားစေဖို့ ကူညီပေးနိုင်ပါတယ်ရှင်။\r\n၃။ အသားအရေကို တင်းရင်းနုပျိုစေတဲ့ Collagen ထုတ်လုပ်မှုကိုလည်း မြှင့်တင်ပေးတတ်ပါသေးတယ်။\r\n၄။ မနက်ခင်းမှာ Sunscreen လေးနဲ့ တွဲသုံးပေးမယ်ဆိုရင် အသားအရေလေးအတွက် အကာအကွယ် ပိုရစေပါတယ်နော်။\r\n၅။ အစွမ်းထက်နေစေဖို့အတွက် အလင်းရောင်နဲ့ ဝေးရာမှာ သေချာလေး သိမ်းဆည်းပေးဖို့ အကြံပြုပါရစေရှင်။\r\n၆။ အရောင်လေး ပြောင်းသွားတဲ့ Serum မျိုးဆိုရင်တော့ အသားအရေလေးအတွက် ဆက်မသုံးတာ အကောင်းဆုံးပါပဲ။\r\n၇။ အသားအရေ နုနယ်သူလေးတွေဆိုရင် Concentration နည်းတာလေးကနေ အရင်စသုံးကြည့်ပေးပါနော်။\r\n၈။ Toner လေး လိမ်းပြီးတဲ့အချိန်မှာ Vitamin C လေးကို အသားထဲ စိမ့်ဝင်အောင် ညင်ညင်သာသာလေး လိမ်းပေးနိုင်ပါတယ်။\r\n၉။ Serum လိမ်းပြီးရင်တော့ အစိုဓာတ်လေး ထိန်းထားဖို့ Moisturizer လေး ထပ်လိမ်းပေးဖို့ မမေ့ပါနဲ့ဦးရှင်။\r\n၁၀။ ပုံမှန်လေး သုံးပေးမယ်ဆိုရင်တော့ ကြည်လင်တောက်ပတဲ့ အသားအရေလေးကို ပိုင်ဆိုင်လာမှာပါရှင်။', 'vit-c.jpg', 'Ingredients', '2026-02-08 15:08:15'),
(3, 'How to Choose the Right Sunscreen for Your Skin', 'သင့်အသားအရေနဲ့ ကိုက်ညီတဲ့ နေလောင်ကာခရင်မ် ဘယ်လိုရွေးမလဲ', '1. We recommend choosing a sunscreen with SPF 30 or higher to keep your skin safe.\r\n2. A broad-spectrum formula is wonderful as it protects against both UVA and UVB rays.\r\n3. For those with oily skin, gel-based options feel light and comfortable.\r\n4. If you have dry skin, cream sunscreens are lovely for adding extra moisture.\r\n5. Applying it 20 minutes before going out ensures your skin is well-protected.\r\n6. On sweaty days, please reapply every two hours to maintain that protection.\r\n7. Using the two-finger rule ensures you are applying enough to be effective.\r\n8. Even on cloudy days, a little sunscreen goes a long way in protecting your skin.\r\n9. If you spend time near sunny windows indoors, it is a good idea to stay protected.\r\n10. Consistent use is a beautiful way to keep your skin looking young and healthy.', '၁။ အသားအရေလေးကို ကာကွယ်ဖို့အတွက် SPF 30 နဲ့ အထက်ပါတာလေးကို ရွေးချယ်ပေးစေချင်ပါတယ်ရှင်။\r\n၂။ UVA ရော UVB ရော ကာကွယ်ပေးတဲ့ Broad-spectrum အမျိုးအစားလေးက အသားအရေအတွက် ပိုကောင်းပါတယ်နော်။\r\n၃။ အဆီပြန်တတ်တဲ့ အသားအရေလေးဆိုရင် Gel type လေးတွေက ပေါ့ပေါ့ပါးပါးနဲ့ အဆင်ပြေစေမှာပါ။\r\n၄။ အသားခြောက်တတ်သူလေးတွေအတွက်တော့ Cream type လေးတွေက အစိုဓာတ်ကို ပိုဖြည့်ပေးနိုင်ပါတယ်ရှင်။\r\n၅။ အပြင်မထွက်ခင် မိနစ် ၂၀ လောက် ကြိုလိမ်းထားပေးရင် အကာအကွယ် အပြည့်အဝ ရနိုင်ပါတယ်ရှင်။\r\n၆။ ချွေးထွက်များတဲ့နေ့မျိုးမှာတော့ အသားအရေလေးကို ကာကွယ်ဖို့ နှစ်နာရီခြားတစ်ခါလောက် ပြန်လိမ်းပေးပါနော်။\r\n၇။ လက်ချောင်းနှစ်ချောင်းစာ ပမာဏလောက် လိမ်းပေးမှသာ လုံလောက်တဲ့ အကာအကွယ် ရမှာဖြစ်ပါတယ်ရှင်။\r\n၈။ မိုးအုံ့တဲ့နေ့တွေမှာလည်း ခရမ်းလွန်ရောင်ခြည် ရှိနေတတ်လို့ Sunscreen လေးကို လိမ်းပေးဖို့ အကြံပြုပါရစေ။\r\n၉။ အိမ်ထဲမှာ နေရင်တောင် အလင်းရောင်ဝင်တဲ့ ပြတင်းပေါက်နား နေမယ်ဆိုရင် လိမ်းထားတာလေးက ပိုစိတ်ချရပါတယ်ရှင်။\r\n၁၀။ Sunscreen လေးကို ပုံမှန်လိမ်းပေးခြင်းက အသားအရေလေးကို အရွယ်မတိုင်မီ အိုမင်းခြင်းကနေ ကာကွယ်ပေးမှာပါနော်။', 'sunscreen.jpg', 'Protection', '2026-02-08 15:08:15'),
(4, 'The Truth About Acne and Diet', 'ဝက်ခြံနဲ့ စားသောက်မှုပုံစံကြားက အမှန်တရား', '1. Reducing sugary treats can be very helpful in calming down skin inflammation.\r\n2. Since dairy can affect some people, it is a good idea to observe how it impacts you.\r\n3. Drinking plenty of water is a lovely way to keep your skin clear from the inside.\r\n4. Leafy greens are like a natural treat that helps your skin stay healthy.\r\n5. Including fish and nuts in your diet can help soothe any skin redness.\r\n6. To keep breakouts away, try to limit greasy and fried foods whenever possible.\r\n7. Fresh fruits provide wonderful vitamins that help your skin repair itself naturally.\r\n8. Foods rich in zinc are great for naturally balancing acne-prone skin.\r\n9. Caring for your diet is a powerful step toward achieving the clear skin you desire.\r\n10. Pairing healthy food with good sleep will truly make your natural beauty shine.', '၁။ အချိုဓာတ်များတာလေးတွေ လျှော့စားပေးရင် အသားအရေလေးမှာ ရောင်ရမ်းတာလေးတွေ သက်သာစေနိုင်ပါတယ်ရှင်။\r\n၂။ နို့ထွက်ပစ္စည်းလေးတွေက တချို့သူလေးတွေမှာ ဝက်ခြံကို ပိုဖြစ်စေတတ်လို့ သတိထားပြီး စားပေးပါနော်။\r\n၃။ ရေဓာတ်လေး များများဖြည့်ပေးရင် အသားအရေလေးက အတွင်းပိုင်းကနေ ကြည်လင်လာမှာပါရှင်။\r\n၄။ ဟင်းသီးဟင်းရွက် အစိမ်းရောင်လေးတွေ စားပေးတာက အသားအရေလေးအတွက် သဘာဝအားဆေးပါပဲရှင်။\r\n၅။ ငါးနဲ့ အစေ့အဆန်လေးတွေ စားပေးရင် အသားအရေ နီမြန်းတာလေးတွေကို သက်သာစေနိုင်ပါတယ်နော်။\r\n၆။ အဆီများတဲ့ အကြော်အလှော်လေးတွေကို လျှော့စားပေးတာက ဝက်ခြံလေးတွေ မထွက်အောင် ကာကွယ်ပေးနိုင်ပါတယ်။\r\n၇။ လတ်ဆတ်တဲ့ အသီးအနှံလေးတွေက အသားအရေလေးကို အတွင်းပိုင်းကနေ ပြန်လည်ပြုပြင်ပေးနိုင်ပါတယ်ရှင်။\r\n၈။ ဇင့် (Zinc) ပါတဲ့ အစားအစာလေးတွေက ဝက်ခြံဖြစ်စေတဲ့ ပိုးမွှားလေးတွေကို တိုက်ဖျက်ပေးနိုင်ပါတယ်ရှင်။\r\n၉။ အစားအသောက်လေးတွေ ဂရုစိုက်ပေးတာက ကြည်လင်တဲ့ အသားအရေလေး ရဖို့အတွက် အများကြီး ကူညီပေးနိုင်ပါတယ်။\r\n၁၀။ အိပ်ရေးဝဝအိပ်ပြီး အာဟာရပြည့်တာလေးတွေ စားပေးရင် အလှတရားလေးက ပိုပေါ်လွင်လာမှာပါရှင်။', 'acne-diet.jpg', 'Lifestyle', '2026-02-08 15:08:15'),
(5, 'Nighttime Recovery: Why You Need a Night Cream', 'ညဘက် အသားအရေ ပြန်လည်ပြုပြင်ခြင်း၏ အရေးပါပုံ', '1. Nighttime is a peaceful opportunity for your skin cells to renew and repair.\r\n2. Night creams are specially formulated to give your skin a rich nutrient boost.\r\n3. They help keep your skin hydrated and soft while you enjoy your rest.\r\n4. We suggest using age-defying ingredients like retinol specifically during your night routine.\r\n5. Your skin is most receptive to absorbing all those good nutrients while you sleep.\r\n6. A night cream is like a comforting hug that nourishes tired skin overnight.\r\n7. Please apply it as your final step after your favorite toner and serums.\r\n8. Including your neck in your routine is a gentle way to prevent fine lines there.\r\n9. Waking up to a soft and refreshed face is a beautiful way to start your day.\r\n10. It is so rewarding to find a night cream that your skin truly loves.', '၁။ ညဘက်ဆိုတာ အသားအရေလေးတွေ အေးအေးချမ်းချမ်းနဲ့ ပြန်လည်နုပျိုလာရမယ့် အချိန်လေးပါရှင်။\r\n၂။ Night Cream လေးတွေက အသားအရေအတွက် လိုအပ်တဲ့ အာဟာရတွေကို ပိုပြီး ပြည့်ပြည့်ဝဝ ဖြည့်ပေးနိုင်ပါတယ်နော်။\r\n၃။ အိပ်နေစဉ်မှာ အသားအရေလေး ခြောက်မသွားအောင် အစိုဓာတ်လေးကို သေချာလေး ထိန်းပေးထားနိုင်ပါတယ်ရှင်။\r\n၄။ အိုမင်းခြင်းကို ကာကွယ်ပေးတဲ့ Retinol လိုမျိုး ပစ္စည်းလေးတွေကိုတော့ ညဘက်မှာပဲ အသုံးပြုဖို့ အကြံပြုပါရစေရှင်။\r\n၅။ ညဘက် အနားယူချိန်မှာ အသားအရေလေးက Skincare ပစ္စည်းတွေကို ပိုပြီး စုပ်ယူပေးနိုင်ပါတယ်ရှင်။\r\n၆။ ပင်ပန်းနေတဲ့ အသားအရေလေးအတွက် Night Cream လေးက တစ်ညလုံး အားဖြည့်ပေးသွားမှာပါနော်။\r\n၇။ မျက်နှာသစ်ပြီး Toner နဲ့ Serum လေး လိမ်းပြီးမှ Night Cream လေးကို အုပ်ပေးဖို့ မမေ့ပါနဲ့ဦးရှင်။\r\n၈။ လည်ပင်းလေးကိုပါ တစ်ခါတည်း လိမ်းပေးမယ်ဆိုရင် အရေးအကြောင်းလေးတွေ မဖြစ်အောင် ကာကွယ်ပေးနိုင်ပါတယ်ရှင်။\r\n၉။ မနက်နိုးလာတဲ့အခါ နူးညံ့ပြီး ကြည်လင်နေတဲ့ မျက်နှာလေးကို မြင်ရတာက စိတ်ချမ်းသာစရာပါပဲရှင်။\r\n၁၀။ ကိုယ့်ရဲ့ အသားအရေလေးနဲ့ အဆင်ပြေဆုံးဖြစ်မယ့် Night Cream လေးကို ရွေးချယ်ပေးပါဦးနော်။', 'night-cream.jpg', 'Routine', '2026-02-08 15:08:15'),
(6, 'Exfoliation 101: Chemical vs. Physical', 'Exfoliation ပြုလုပ်နည်း အခြေခံ - Chemical နှင့် Physical', '1. Gently removing dead skin cells is a wonderful way to keep your pores clear.\r\n2. Using a soft scrub can help refresh the surface of your skin beautifully.\r\n3. Ingredients like AHA and BHA offer a very gentle way to dissolve away dullness.\r\n4. If you have active breakouts, we recommend choosing soothing options over physical scrubs.\r\n5. AHA is a lovely choice for dry skin, as it leaves the surface looking radiant.\r\n6. For oily skin types, BHA is very helpful in cleaning deep within the pores.\r\n7. To be kind to your skin, please exfoliate only once or twice a week.\r\n8. Being too firm can stress your skin, so always use a gentle touch.\r\n9. Please remember to hydrate and protect your skin with sunscreen afterward.\r\n10. When done with care, exfoliation reveals the smooth and glowing skin underneath.', '၁။ ဆဲလ်သေလေးတွေကို ဖယ်ရှားပေးတာက ချွေးပေါက်လေးတွေ မပိတ်အောင် ကူညီပေးနိုင်ပါတယ်ရှင်။\r\n၂။ Scrub လေးတွေနဲ့ ပွတ်တိုက်ပေးတာက အပေါ်ယံ အညစ်အကြေးလေးတွေကို ဖယ်ရှားဖို့ အဆင်ပြေစေပါတယ်နော်။\r\n၃။ AHA နဲ့ BHA လိုမျိုး နည်းလမ်းလေးတွေကတော့ ဆဲလ်သေလေးတွေကို ညင်ညင်သာသာလေး ဖယ်ရှားပေးနိုင်ပါတယ်ရှင်။\r\n၄။ ဝက်ခြံလေးတွေ ရှိနေရင်တော့ Scrub လေးတွေ သုံးမယ့်အစား ပိုပြီး နုညံ့တဲ့ နည်းလမ်းလေးတွေကို ရွေးချယ်ပေးပါနော်။\r\n၅။ အသားခြောက်တတ်သူလေးတွေအတွက် AHA လေးက အသားအရေလေးကို ပိုပြီး ကြည်လင်စေမှာပါရှင်။\r\n၆။ အဆီပြန်တတ်တဲ့ အသားအရေလေးအတွက်တော့ BHA လေးက ချွေးပေါက်ထဲအထိ သန့်စင်ပေးနိုင်ပါတယ်ဗျာ။\r\n၇။ အသားအရေလေး မပင်ပန်းအောင် တစ်ပတ်ကို တစ်ကြိမ် ဒါမှမဟုတ် နှစ်ကြိမ်လောက်ပဲ လုပ်ပေးဖို့ အကြံပြုပါရစေ။\r\n၈။ အလွန်အမင်း ဖယ်ရှားမိရင်တော့ အသားအရေလေး နာကျင်တတ်လို့ ညင်ညင်သာသာလေးပဲ လုပ်ပေးပါဦးနော်။\r\n၉။ ဆဲလ်သေဖယ်ရှားပြီးရင်တော့ အစိုဓာတ်ထိန်းဆေးနဲ့ နေလောင်ကာခရင်မ်လေးကို မမေ့မလျော့ လိမ်းပေးပါရှင်။\r\n၁၀။ မှန်ကန်တဲ့ နည်းလမ်းလေးနဲ့ လုပ်ပေးရင်တော့ နူးညံ့အိစက်တဲ့ အသားအရေလေးကို ရရှိနိုင်မှာပါနော်။', 'exfoliation.jpg', 'Tips', '2026-02-08 15:08:15'),
(7, 'The Benefits of Facial Massage and Gua Sha', 'မျက်နှာအကြောညှစ်ခြင်းနှင့် Gua Sha သုံးစွဲခြင်း၏ အကျိုးကျေးဇူးများ', '1. A gentle facial massage is a lovely way to boost circulation and health.\r\n2. Using a Gua Sha tool can be very soothing for reducing any morning puffiness.\r\n3. It is a wonderful way to help define your natural features and cheekbones.\r\n4. Massaging also helps your favorite skincare products sink in even better.\r\n5. Making this a daily habit is a beautiful way to keep your skin firm and young.\r\n6. Please always use upward strokes to give your face a natural, healthy lift.\r\n7. To keep things smooth, we suggest applying a face oil before using your tool.\r\n8. Spending just 5 minutes on this ritual can be a very relaxing part of your day.\r\n9. Please keep your beauty tools clean to ensure the best care for your skin.\r\n10. With patience and consistency, you will see a lovely difference in your reflection.', '၁။ မျက်နှာလေးကို ညင်ညင်သာသာ နှိပ်နယ်ပေးတာက သွေးလည်ပတ်မှုကို ကောင်းမွန်စေပါတယ်ရှင်။\r\n၂။ Gua Sha လေးကို အသုံးပြုပေးရင် မျက်နှာလေး ဖောင်းအစ်နေတာတွေကို သက်သာစေနိုင်ပါတယ်နော်။\r\n၃။ မေးရိုးနဲ့ ပါးရိုးလေးတွေ ပိုပြီး ပေါ်လွင်လှပလာအောင် Gua Sha လေးက ကူညီပေးနိုင်ပါတယ်ရှင်။\r\n၄။ နှိပ်နယ်ပေးခြင်းအားဖြင့် လိမ်းထားတဲ့ Skincare လေးတွေက အသားထဲကို ပိုပြီး စိမ့်ဝင်သွားစေမှာပါရှင်။\r\n၅။ အသားအရေလေး တင်းရင်းနုပျိုနေစေဖို့ နေ့စဉ် နှိပ်နယ်ပေးတာက အလွန်ကောင်းမွန်တဲ့ အလေ့အကျင့်လေးပါပဲ။\r\n၆။ နှိပ်တဲ့အခါမှာတော့ အသားအရေလေး ပင့်တင်သွားအောင် အောက်ကနေ အပေါ်ဘက်ကိုပဲ လုပ်ပေးပါနော်။\r\n၇။ မျက်နှာလေး မပွတ်တိုက်မိအောင် Face Oil လေး တစ်ခုခု လိမ်းထားပြီးမှ Gua Sha လေး သုံးပေးဖို့ အကြံပြုပါရစေ။\r\n၈။ တစ်နေ့ကို ၅ မိနစ်လောက် အချိန်ပေးတာက စိတ်ရောကိုယ်ပါ အပန်းပြေစေမှာပါရှင်။\r\n၉။ သန့်ရှင်းမှုရှိဖို့အတွက် အသုံးပြုမယ့် ကိရိယာလေးတွေကို သေချာလေး ဆေးကြောပေးဖို့ မမေ့ပါနဲ့ဦးနော်။\r\n၁၀။ စိတ်ရှည်လက်ရှည်နဲ့ ပုံမှန်လေး လုပ်ပေးမယ်ဆိုရင်တော့ ပိုပြီး လှပတဲ့ မျက်နှာလေးကို ပိုင်ဆိုင်ရမှာပါရှင့်။', 'guasha.jpg', 'Lifestyle', '2026-02-08 15:08:15'),
(8, 'How Stress Affects Your Skin Health', 'စိတ်ဖိစီးမှုက သင့်အသားအရေကို ဘယ်လိုထိခိုက်စေသလဲ', '1. When things get stressful, your skin might produce more oil, so please try to take it easy.\r\n2. Stress can sometimes lead to breakouts, so it is a perfect time to be extra kind to yourself.\r\n3. It can be helpful to remember that stress might slow down your skin\'s natural healing.\r\n4. If your skin is feeling sensitive, finding a moment to relax can really help soothe it.\r\n5. Getting a good night\'s rest is a wonderful way to keep your eyes looking bright.\r\n6. Taking a few deep breaths or meditating can be a lovely treat for both mind and skin.\r\n7. We encourage you to enjoy your skincare routine as a peaceful self-love ritual.\r\n8. Staying hydrated and calm is a beautiful way to maintain your natural radiance.\r\n9. When you feel peaceful inside, your skin often reflects that inner glow beautifully.\r\n10. If you notice skin concerns, taking a moment to lower your stress is a great first step.', '၁။ စိတ်ဖိစီးမှုလေးတွေ များလာတဲ့အခါ အသားအရေလေးက ပိုပြီး အဆီပြန်တတ်လို့ စိတ်လေးကို အေးအေးထားပေးပါနော်။\r\n၂။ စိတ်တွေ ပင်ပန်းနေရင် ဝက်ခြံလေးတွေ ထွက်လာတတ်လို့ ကိုယ့်ကိုယ်ကို ပိုပြီး ဂရုစိုက်ပေးစေချင်ပါတယ်ရှင်။\r\n၃။ စိတ်ဖိစီးမှုက အသားအရေလေး ပြန်လည်ကောင်းမွန်လာဖို့ကို နှေးကွေးစေတတ်ပါတယ်နော်။\r\n၄။ အသားအရေ နီမြန်းတတ်သူလေးတွေအတွက် စိတ်ဖိစီးမှုက ပိုပြီး ဆိုးစေတတ်လို့ အပန်းဖြေဖို့ မမေ့ပါနဲ့နော်။\r\n၅။ အိပ်ရေးဝဝအိပ်ပေးတာက မျက်ကွင်းညိုတာလေးတွေကို သက်သာစေမယ့် အကောင်းဆုံး နည်းလမ်းပါပဲရှင်။\r\n၆။ တရားထိုင်တာ ဒါမှမဟုတ် အသက်ရှူလေ့ကျင့်ခန်းလေးတွေ လုပ်ပေးတာက အသားအရေအတွက်ရော စိတ်အတွက်ပါ ကောင်းမွန်စေပါတယ်။\r\n၇။ နေ့စဉ် Skincare လုပ်တဲ့ အချိန်လေးကို ကိုယ့်ကိုယ်ကို ချစ်ပေးတဲ့ အချိန်လေးအဖြစ် အသုံးချပေးပါဦးနော်။\r\n၈။ ရေများများသောက်ပြီး အေးအေးချမ်းချမ်း နေထိုင်ပေးတာက အသားအရေလေးကို တောက်ပစေမှာပါရှင်။\r\n၉။ စိတ်ကလေး ကြည်လင်နေတဲ့အခါမှာ အသားအရေလေးကလည်း လိုက်ပြီး ကြည်လင်လာတတ်ပါတယ်ရှင်.။\r\n၁၀။ အသားအရေလေးမှာ ပြဿနာလေးတွေ ရှိလာရင် စိတ်ဖိစီးမှုလေးတွေကို အရင်ဆုံး လျှော့ချကြည့်ဖို့ အကြံပြုပါရစေရှင်။', 'stress-skin.jpg', 'Lifestyle', '2026-02-08 15:08:15'),
(9, 'Caring for Sensitive Skin: Do and Don’ts', 'Sensitive Skin (နုနယ်ထိခိုက်လွယ်သောအသားအရေ) ကို ဘယ်လိုဂရုစိုက်မလဲ', '1. Strictly avoid products containing fragrances, alcohol, and harsh chemicals.\r\n2. Always perform a patch test on your jawline or inner arm before trying new products.\r\n3. Never use hot water for washing your face; use cool or lukewarm water instead.\r\n4. Choose soothing ingredients like Aloe Vera and Centella Asiatica to calm the skin.\r\n5. Avoid aggressive scrubbing or using harsh physical exfoliants on your face.\r\n6. Apply a gentle, broad-spectrum sunscreen daily to protect your sensitive skin from UV rays.\r\n7. Use a non-foaming cream cleanser to preserve the natural oils of your skin.\r\n8. If your skin becomes severely irritated or red, consult a dermatologist for professional advice.', '၁။ အမွှေးနံ့သာနှင့် အယ်လ်ကိုဟောပါဝင်သော ပြင်းထန်သည့် ပစ္စည်းများကို လုံးဝရှောင်ကြဉ်ပါ။\r\n၂။ ပစ္စည်းအသစ်သုံးတိုင်း နားသယ်စပ် သို့မဟုတ် လက်မောင်းအတွင်းပိုင်းတွင် အရင်ဆုံး စမ်းသပ်စစ်ဆေးပါ။\r\n၃။ မျက်နှာသစ်သည့်အခါ ရေပူကိုမသုံးဘဲ ရေအေး သို့မဟုတ် ခပ်နွေးနွေးရုံသာရှိသော ရေကိုသုံးပါ။\r\n၄။ ရှားစောင်းလက်ပတ် (Aloe Vera) နှင့် Centella ကဲ့သို့ အသားအရေကို အေးမြစေသော ပစ္စည်းများကို ရွေးချယ်ပါ။\r\n၅။ မျက်နှာကို အကြမ်းပတမ်း ပွတ်တိုက်ခြင်း သို့မဟုတ် scrub အပြင်းစားများ သုံးခြင်းမှ ရှောင်ကြဉ်ပါ။\r\n၆။ နေရောင်ခြည်ဒဏ်မှ ကာကွယ်ရန် နုနယ်သော အသားအရေအတွက် ထုတ်လုပ်ထားသည့် Sunscreen ကို နေ့စဉ်လိမ်းပါ။\r\n၇။ အသားအရေ၏ သဘာဝအဆီဓာတ်ကို မခမ်းခြောက်စေရန် အမြှုပ်မထွက်သော နို့ရည်မျက်နှာသစ်ဆေးကို သုံးပါ။\r\n၈။ အသားအရေ အလွန်အမင်း ထိခိုက်နီမြန်းလာပါက ကိုယ့်ဘာသာကုသခြင်းထက် အရေပြားဆရာဝန်နှင့် တိုင်ပင်ပါ။', 'sensitive.jpg', 'Tips', '2026-02-16 04:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `skincare_tips`
--

CREATE TABLE `skincare_tips` (
  `id` int(11) NOT NULL,
  `skin_type` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `tip_text_en` text DEFAULT NULL,
  `tip_text_mm` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skincare_tips`
--

INSERT INTO `skincare_tips` (`id`, `skin_type`, `image_url`, `tip_text_en`, `tip_text_mm`) VALUES
(1, 'Dry Skin', 'dry.png', '✨ We recommend using serums with Hyaluronic Acid to keep your skin deeply hydrated from within.\r\n\r\n✨ To preserve your skin\'s natural oils, switching to a non-foaming cream cleanser would be a wonderful choice.\r\n\r\n✨ Applying a hydrating sheet mask once a week is a lovely way to give your skin an extra glow.\r\n\r\n✨ Please use a rich, nourishing moisturizer to seal in all that essential moisture throughout the day.\r\n\r\n✨ For the health of your skin, we suggest avoiding hot water and using cool water for washing instead.', '🌸 အသားအရေလေး အတွင်းပိုင်းထိ ရေဓာတ်ပြည့်ဝနေစေဖို့ Hyaluronic Acid ပါဝင်တဲ့ serum လေးတွေကို ဦးစားပေးသုံးကြည့်ပေးပါနော်။\r\n\r\n🌸 အသားအရေရဲ့ သဘာဝအဆီဓာတ်လေးတွေ မဆုံးရှုံးသွားစေဖို့ အမြှုပ်ထွက်နည်းတဲ့ Cream Cleanser လေးကို ပြောင်းသုံးကြည့်ဖို့ အကြံပြုပါရစေရှင်။\r\n\r\n🌸 တစ်ပတ်မှာ တစ်ကြိမ်လောက်တော့ အသားအရေလေး စိုပြေသွားအောင် ရေဓာတ်ဖြည့် Sheet Mask လေး ကပ်ပေးပါဦးနော်။\r\n\r\n🌸 ဖြည့်တင်းထားတဲ့ အစိုဓာတ်လေးတွေ အသားထဲမှာတင် ရှိနေစေဖို့ အာဟာရဓာတ်ကြွယ်ဝတဲ့ Moisturizer လေးနဲ့ သေချာလေး ပိတ်လှောင်ပေးထားပါရှင်။\r\n\r\n🌸 မျက်နှာသစ်တဲ့အခါ အသားအရေလေး မခြောက်သွေ့သွားစေဖို့ ရေနွေးထက်စာရင် ရေအေးလေးနဲ့ပဲ သစ်ပေးဖို့ တိုက်တွန်းပါရစေရှင်။'),
(2, 'Oily Skin', 'oily.png', '✨ Using a cleanser with Salicylic Acid (BHA) is a great way to keep your pores clear and fresh.\r\n\r\n✨ We suggest choosing oil-free or gel-based moisturizers to keep your skin hydrated without feeling greasy.\r\n\r\n✨ Applying a matte-finish sunscreen daily will help you feel confident and control mid-day shine.\r\n\r\n✨ Gently exfoliating 2-3 times a week is a lovely habit to keep your skin smooth and clean.\r\n\r\n✨ To prevent unwanted breakouts, you might want to avoid heavy, oil-based products for a while.', '🌸 ချွေးပေါက်လေးတွေ ပိတ်ဆို့တာမျိုး မဖြစ်ရအောင် Salicylic Acid (BHA) ပါဝင်တဲ့ မျက်နှာသစ်ဆေးလေးကို သုံးပေးနိုင်ပါတယ်ရှင်။\r\n\r\n🌸 အသားအရေလေး အဆီမပြန်ဘဲ စိုပြေနေစေဖို့ အဆီမပါဝင်တဲ့ (Oil-free) Gel-based moisturizer လေးကို ရွေးချယ်ပေးပါနော်။\r\n\r\n🌸 နေ့ဘက်မှာ အဆီပြန်တာလေးကို ထိန်းပေးနိုင်ဖို့ Matte ဖြစ်စေတဲ့ Sunscreen လေးကို ပုံမှန်လေး လိမ်းပေးစေချင်ပါတယ်ရှင်။\r\n\r\n🌸 ချွေးပေါက်လေးတွေ သန့်ရှင်းနေစေဖို့အတွက် တစ်ပတ်မှာ ၂ ကြိမ်လောက် ညင်ညင်သာသာလေး ဆဲလ်သေဖယ်ရှားပေးပါဦးနော်။\r\n\r\n🌸 ဝက်ခြံလေးတွေ မထွက်အောင် ကာကွယ်ဖို့အတွက် အဆီဓာတ်အရမ်းများတဲ့ Skincare ပစ္စည်းလေးတွေကို ရှောင်ကြည့်ဖို့ အကြံပြုပါရစေရှင်။'),
(3, 'Combination Skin', 'combination.png', '✨ Try \"multi-masking\" by hydrating your cheeks while managing oil on your T-zone for perfect balance.\r\n\r\n✨ For a deeper clean at night, we highly recommend trying the double cleansing method.\r\n\r\n✨ We suggest using a lightweight moisturizer for the whole face to keep it feeling fresh and airy.\r\n\r\n✨ Using a clay mask on your T-zone once a week is a wonderful way to manage excess oil naturally.\r\n\r\n✨ For those drier patches, adding an extra layer of cream only where needed will keep your skin happy.', '🌸 ပါးပြင်လေးတွေကို ရေဓာတ်ဖြည့်ပြီး T-zone ကို အဆီထိန်းပေးတဲ့ \"multi-masking\" နည်းလမ်းလေးကို သုံးကြည့်ပါဦးနော်။\r\n\r\n🌸 ညဘက်မှာ အညစ်အကြေးလေးတွေ အကုန်စင်သွားအောင် Double Cleansing နည်းလမ်းလေးနဲ့ သန့်စင်ပေးဖို့ အကြံပြုပါရစေရှင်။\r\n\r\n🌸 မျက်နှာတစ်ပြင်လုံးအတွက် ပေါ့ပေါ့ပါးပါးနဲ့ အသားထဲစိမ့်ဝင်လွယ်တဲ့ Moisturizer လေးကိုပဲ ရွေးချယ်ပေးပါနော်။\r\n\r\n🌸 အဆီပြန်တတ်တဲ့ T-zone နေရာလေးတွေအတွက်တော့ တစ်ပတ်တစ်ကြိမ် Clay mask လေး သုံးပေးတာက အဆင်ပြေစေမှာပါရှင်။\r\n\r\n🌸 အသားခြောက်တဲ့ နေရာလေးတွေမှာပဲ Cream ကို တစ်ထပ်ပိုလိမ်းပေးခြင်းအားဖြင့် အချိုးညီတဲ့ အလှတရားကို ရရှိနိုင်ပါတယ်ရှင်။'),
(4, 'Normal Skin', 'normal.png', '✨ Start your morning with an antioxidant-rich Vitamin C serum to keep your natural glow shining bright.\r\n\r\n✨ We recommend using a lightweight night cream to keep your skin supple and nourished while you rest.\r\n\r\n✨ To protect your beautiful skin from premature aging, please never skip your daily sunscreen.\r\n\r\n✨ Maintaining a consistent and simple routine is the best way to keep your skin barrier healthy and strong.\r\n\r\n✨ Drinking plenty of water is a lovely, natural way to sustain your skin\'s healthy glow every day.', '🌸 မနက်ခင်းမှာ အသားအရေလေး ပိုပြီး ဝင်းပနေစေဖို့ Antioxidant ကြွယ်ဝတဲ့ Vitamin C serum လေးကို သုံးပေးနိုင်ပါတယ်ရှင်။\r\n\r\n🌸 ညဘက်မှာ အသားအရေလေး အာဟာရပြည့်ဝနေအောင် ပေါ့ပါးတဲ့ Night Cream လေး တစ်မျိုးမျိုးကို လိမ်းအိပ်ပေးပါနော်။\r\n\r\n🌸 အရွယ်မတိုင်မီ အိုမင်းတာမျိုး မဖြစ်အောင် နေလောင်ကာခရင်မ် (Sunscreen) လေးကိုတော့ နေ့တိုင်း ပုံမှန်လေး လိမ်းပေးစေချင်ပါတယ်ရှင်။\r\n\r\n🌸 အသားအရေရဲ့ သဘာဝအတားအဆီးလေး (Skin Barrier) ခိုင်မာနေဖို့အတွက် ရိုးရှင်းတဲ့ Skincare routine လေးကိုပဲ ထိန်းသိမ်းပေးပါနော်။\r\n\r\n🌸 သဘာဝအတိုင်း ဝင်းပနေတဲ့ အသားအရေလေးကို ဆက်လက်ပိုင်ဆိုင်နိုင်ဖို့ ရေများများသောက်ပေးဖို့လည်း မမေ့ပါနဲ့ဦးရှင်။'),
(5, 'Sensitive Skin', 'sensitive.png', '✨ To keep your skin calm, we suggest choosing products that are free from fragrances and alcohol.\r\n\r\n✨ It is always a good idea to perform a small patch test before introducing any new products to your routine.\r\n\r\n✨ Washing your face with cool water instead of hot water will help keep your skin feeling comfortable.\r\n\r\n✨ Soothing ingredients like Aloe Vera and Centella are wonderful choices for your delicate skin.\r\n\r\n✨ We recommend avoiding harsh physical scrubs and choosing more gentle ways to refresh your face.', '🌸 အသားအရေလေး မနီမြန်းသွားအောင် အမွှေးနံ့နဲ့ အယ်လ်ကိုဟော မပါဝင်တဲ့ ပစ္စည်းလေးတွေကိုပဲ ရွေးချယ်ပေးစေချင်ပါတယ်ရှင်။\r\n\r\n🌸 ပစ္စည်းအသစ်လေးတွေ သုံးတိုင်း အသားအရေနဲ့ တည့်၊ မတည့် သိရအောင် နားသယ်စပ်မှာ အရင်စမ်းသပ်ပေးဖို့ အကြံပြုပါရစေနော်။\r\n\r\n🌸 အသားအရေလေး မနာကျင်အောင် မျက်နှာသစ်တဲ့အခါ ရေနွေးထက် ရေအေးလေးကိုပဲ သုံးပေးဖို့ တိုက်တွန်းပါရစေရှင်။\r\n\r\n🌸 ရှားစောင်းလက်ပတ်နဲ့ Centella လိုမျိုး အသားအရေကို အေးမြစေတဲ့ ပစ္စည်းလေးတွေက သင့်အတွက် အဖော်မွန်လေးတွေပါပဲရှင်။\r\n\r\n🌸 အသားအရေကို ထိက်ခိုက်စေနိုင်တဲ့ ပြင်းထန်တဲ့ Scrub တွေ သုံးမယ့်အစား ညင်သာတဲ့ နည်းလမ်းလေးတွေကိုပဲ ရွေးချယ်ပေးပါနော်။');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `skin_type` varchar(100) NOT NULL,
  `total_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `skin_type`, `total_score`) VALUES
(1, 'Nadi', 'Dry Skin', 8),
(2, 'Madi', 'Sensitive Skin', 32),
(3, 'Yoon', 'Normal Skin', 16),
(4, 'Shoon', 'Combination Skin', 24),
(5, 'Kaung', 'Combination Skin', 24),
(6, 'Kuu', 'Dry Skin', 8),
(7, '', 'Normal Skin', 16),
(8, '', 'Normal Skin', 16),
(9, '', 'Normal Skin', 16),
(10, '', 'Normal Skin', 16),
(11, 'Mya', 'Sensitive Skin', 32),
(12, 'Suu', 'Dry Skin', 8),
(13, 'Jin Jin', 'Combination Skin', 24),
(14, 'Kyal', 'Normal Skin', 16),
(15, 'Su San', 'Oily Skin', 29),
(16, 'Kit Kit', 'Sensitive Skin', 32),
(17, 'Thu Thu', 'Dry Skin', 8),
(18, 'Phoo Phoo', 'Combination Skin', 24),
(19, 'Hsu Yi', 'Sensitive Skin', 32),
(20, 'Htet Htet', 'Combination Skin', 24),
(21, 'Zin Zin', 'Sensitive Skin', 27),
(22, 'Mu Mu', 'Normal Skin', 16),
(23, 'Htoo Htoo', 'Combination Skin', 24),
(24, 'Hla Hla', 'Sensitive Skin', 32),
(25, 'Wint', 'Combination Skin', 23),
(26, 'Wint', 'Combination Skin', 22),
(27, 'Wint', 'Combination Skin', 25),
(28, 'Wint', 'Dry Skin', 4),
(29, 'Chan Chan', 'Combination Skin', 24),
(30, 'Eaint Eaint', 'Sensitive Skin', 32),
(31, 'Chue', 'Normal Skin', 18),
(32, 'Kyi Kyi', 'Oily Skin', 30),
(33, 'Kaung Kaung', 'Combination Skin', 24),
(34, 'Kaung Kaung', 'Normal Skin', 20),
(35, 'Kaung Kaung', 'Normal Skin', 20),
(36, 'Ko Ko', 'Dry Skin', 8),
(37, 'Su Su', 'Oily Skin', 31),
(38, 'Su Su', 'Oily Skin', 31),
(39, 'Su Su', 'Sensitive Skin', 32),
(40, 'Su Su', 'Normal Skin', 16),
(41, 'Su', 'Combination Skin', 24),
(42, 'Su Su', 'Sensitive Skin', 32),
(43, 'Su Su', 'Sensitive Skin', 32),
(44, 'Su Su', 'Normal Skin', 14),
(45, 'Hope', 'Combination Skin', 27),
(46, 'Luck', 'Dry Skin', 10),
(47, 'Kyal sin', 'Oily Skin', 31),
(48, 'Ki Ki', 'Dry Skin', 5),
(49, 'Suzy', 'Normal Skin', 16),
(50, 'Chan Myae', 'Sensitive Skin', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skincare_tips`
--
ALTER TABLE `skincare_tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
