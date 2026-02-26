-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 03:04 AM
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
-- Database: `skincare_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `phone`, `address`, `total_price`, `payment_method`, `order_date`, `status`) VALUES
(1, 'phoophoo', '09786689874', 'hlaing', 80000, '', '2026-02-08 10:04:42', 'Pending'),
(2, 'soe', '09786689874', 'hlaing', 18000, '', '2026-02-08 10:40:13', 'Pending'),
(3, 'phoophoo', '09786689874', 'hlaing', 18000, '', '2026-02-08 10:40:42', 'Pending'),
(4, 'Phoo Phoo', '09786689874', 'Inlay hostel\r\nYangon', 22000, '', '2026-02-08 11:18:37', 'Pending'),
(5, 'Phoo Phoo', '09786689874', 'Inlay hostel\r\nYangon', 40000, '', '2026-02-08 11:20:19', 'Pending'),
(6, 'phoo', '09786689874', 'Inlay hostel\r\nYangon', 40000, '', '2026-02-08 12:46:33', 'Pending'),
(7, 'Mya Thida', '091111111', 'yangon', 15000, '', '2026-02-08 15:39:04', 'Pending'),
(8, 'Mya Thida', '09677411617', 'NO.147, Latha Township, 21st street\r\n', 15000, '', '2026-02-15 01:30:22', 'Pending'),
(9, 'Mya Thida', '09677411617', 'NO.147, Latha Township, 21st street\r\n', 50000, '', '2026-02-18 05:47:39', 'Pending'),
(10, 'Mya Thida', '09677411617', 'NO.147, Latha Township, 21st street\r\n', 55000, 'COD', '2026-02-18 06:18:03', 'Pending'),
(11, 'Mya Thida', '09677411617', 'NO.147, Latha Township, 21st street\r\n', 30000, 'ONLINE', '2026-02-18 06:18:29', 'Pending'),
(12, 'Mya Thida', '09677411617', 'NO.147, Latha Township, 21st street', 35000, 'COD', '2026-02-18 06:21:48', 'Pending'),
(13, 'Mya Thida', '09677411617', 'NO.147, Latha Township, 21st street', 35000, 'ONLINE', '2026-02-18 06:22:21', 'Pending'),
(14, 'Mya Thida', '09677411617', 'NO.147, Latha Township, 21st street\r\n', 50000, 'ONLINE', '2026-02-18 06:46:26', 'Pending'),
(15, 'Mya Thida', '09123456789', 'NO.147, Latha Township, 21st street\r\n', 45000, 'COD', '2026-02-21 22:15:51', 'Pending'),
(16, 'Mya Thida', '09123456789', 'NO.147, Latha Township, 21st street\r\n', 15000, 'COD', '2026-02-21 22:36:51', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`) VALUES
(1, 1, 4, 22000),
(2, 1, 2, 25000),
(3, 1, 1, 15000),
(4, 1, 3, 18000),
(5, 2, 3, 18000),
(6, 3, 3, 18000),
(7, 4, 4, 22000),
(8, 5, 3, 18000),
(9, 5, 4, 22000),
(10, 6, 6, 20000),
(11, 6, 10, 20000),
(12, 7, 2, 15000),
(13, 8, 4, 15000),
(14, 9, 2, 15000),
(15, 9, 6, 20000),
(16, 9, 5, 15000),
(17, 10, 2, 15000),
(18, 10, 8, 20000),
(19, 10, 6, 20000),
(20, 11, 4, 15000),
(21, 11, 5, 15000),
(22, 12, 3, 15000),
(23, 12, 8, 20000),
(24, 13, 4, 15000),
(25, 13, 8, 20000),
(26, 14, 2, 15000),
(27, 14, 5, 15000),
(28, 14, 1, 20000),
(29, 15, 17, 25000),
(30, 15, 6, 20000),
(31, 16, 3, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `results` text DEFAULT NULL,
  `how_to_use` text DEFAULT NULL,
  `ingredients` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image_url`, `description`, `results`, `how_to_use`, `ingredients`) VALUES
(1, 'Purete Thermale One Step Milk Cleanser 3-In-1', 'Cleanser', 20000.00, 'uploads/1770550258_3337871319144.main-EN-V1.jpg', 'In one simple step, our 3-in-1 best-selling face cleanser perfectly cleanses, removes eye and face make-up and tones skin. Cleansed of impurities and pollution particles, skin is fresh, soft and soothed.\r\n', '93% of women said it leaves their skin feeling fresh 93% of women said it leaves their skin feeling comfortable 100% of women said it is not irritating for the eyes * Auto-evaluation on 30 women', 'Can be used with or without water. Either apply to a cotton pad and wipe off makeup or use with water and lather to cleanse face and remove makeup.', 'AQUA / WATER / EAU • PARAFFINUM LIQUIDUM / MINERAL OIL / HUILE MINERALE • ISOPROPYL MYRISTATE • POTASSIUM PHOSPHATE • CARBOMER • PARFUM / FRAGRANCE • SODIUM HYDROXIDE • DIPOTASSIUM PHOSPHATE • DISODIUM EDTA • DISODIUM COCOAMPHODIACETATE • MYRTRIMONIUM BROMIDE • BUTYLENE GLYCOL • BUTYROSPERMUM PARKII SEEDCAKE EXTRACT / SHEA BUTTER SEEDCAKE EXTRACT'),
(2, 'Purete Thermale Purifying Foaming Water', 'Cleanser', 15000.00, 'uploads/1770550769_3337871320980.main-EN-V1.jpg', 'nnovative, lightweight facial foam cleanser gently removes impurities from skin while restoring radiance and freshness. Healthier, smoother looking skin is revealed from the first use. Face cleanser enriched with Purisoft, extracted from Moringa Seeds, and Vichy Mineralizing Thermal Water, this formula fights the effects of pollution and impurities on the skin.', 'Skin is perfectly cleansed and looks refreshed and more radiant.', 'Put a small quantity of foaming cleanser in the palm of your hand. Massage with circular motion onto damp skin. Rinse with water.', 'WATER * HEXYLENE GLYCOL * SODIUM LAURYL SULFATE * ALLANTOIN * POLOXAMER 184 * DISODIUM EDTA * DISODIUM COCOAMPHODIACETATE * PANTHENOL * CENTAUREA CYANUS EXTRACT / CENTAUREA CYANUS FLOWER EXTRACT * POLYSORBATE 20 * POLYAMINOPROPYL BIGUANIDE * FRAGRANCE'),
(3, 'Normaderm 3-In-1 Scrub + Cleanser + Mask', 'Cleanser', 15000.00, 'uploads/1770550949_1.jpg', 'Triple action clay mask for oily and acne-prone skin. A one step facial cleanser with 3 uses. This facial cleanser will help minimize the look of large pores, eliminating shine and reducing the appearance of acne scars.\r\n1. Facial exfoliator: helps unclogs pores. Cleansing away excess oil and trapped dirt that can lead to acne breakouts.\r\n2. Cleansing cream: reduces sebum and oily skin, without irritating the skin.\r\n3. Mask: mattifies skin and evens skin complexion.\r\n\r\nThis formula is:\r\n100% Hypoallergenic\r\nTested under dermatological control\r\nSuitable for sensitive skin\r\nParaben-free\r\nAlcohol-free\r\n', 'Excess sebum is eliminated 96% Pores are less visibile 73% Impurities are eliminated 98% Self-Assesment  *Assesment on 27 men and 28 women with oily acne-prone skin immediately after application of mask.', 'As a scrub/cleanser: massage onto your damp face. As a mask: apply a thin layer to the face and let dry for 5 minutes. Rinse off with water. Avoid eye area.', 'AQUA / WATER / EAU • KAOLIN • BUTYLENE GLYCOL • ZEA MAYS STARCH / CORN STARCH • GLYCERIN • DECYL GLUCOSIDE • CI 77891 / TITANIUM DIOXIDE • CARRAGEENAN • PEG-7 GLYCERYL COCOATE • DISODIUM EDTA • GLYCOLIC ACID • SODIUM HYDROXIDE • ZINC GLUCONATE • DIPOTASSIUM GLYCYRRHIZATE • HYDRATED SILICA [NANO] / HYDRATED SILICA • PUMICE • COCO-BETAINE • SODIUM CHLORIDE • XANTHAN GUM • CI 77288 / CHROMIUM OXIDE GREENS • PHENOXYETHANOL • SALICYLIC ACID • PARFUM / FRAGRANCE'),
(4, 'Normaderm 3-in-1 Micellar Solution', 'Cleanser', 15000.00, 'uploads/1770551059_1 (1).jpg', 'Vichy\'s Normaderm 3-in-1 Micellar Solution cleanser is specifically formulated for acne-prone sensitive skin. It gently removes makeup, excess sebum and impurities without causing discomfort for your skin. It treats acne and prevents blemishes without irritating the skin. Easy to use and extremely practical, the rinse-free lotion soothes skin, while leaving it feeling fresh and purified.\r\n\r\nProven Efficacy\r\nCleanses all impurities and removes all face makeup.\r\nBalances skin\'s pH\r\nRemoves excess sebum, while soothing acne-prone skin\r\nThis formula is:\r\nTested on sensitive skin under dermatological control.\r\nHypoallergenic\r\nWith soothing and fortifying Vichy Thermal Water\r\nParaben free\r\nSoap-free\r\nColorant-free', 'Cleanses all impurities and removes all face makeup, including eye makeup Balances skin\'s pH Removes excess sebum, fighting acne breakouts and blemishes while soothing acne-prone skin  Suitable for sensitive skin and eyes.', 'Apply the Normaderm 3-In-1 Micellar Solution with a cotton pad. Smooth from the centre towards the outside of the face, cleansing away impurities. Cover the eyes with the cotton pad and press lightly to soak eye area and eyelashes with solution. Remove makeup by pressing gently towards the front of the eyelashes. Do not rinse.', 'AQUA / WATER / EAU • ALCOHOL DENAT. • GLYCERIN • HEXYLENE GLYCOL • CITRIC ACID • HYDROXYACETOPHENONE • TETRASODIUM GLUTAMATE DIACETATE • DISODIUM COCOAMPHODIACETATE • POLOXAMER 184 • MYRTRIMONIUM BROMIDE'),
(5, 'Normaderm Purifying Lotion', 'Cleanser', 15000.00, 'uploads/1770551230_1 (2).jpg', 'Vichy\'s Normaderm Purifying Toner is specifically formulated for acne-prone skin, large pores and excess shine. This formula combines soothing Vichy Mineralizing Water with glycolic and salicylic acid to unclog, tighten pores and purify the skin. Fighting impurities and refining skin texture without overdrying the skin.\r\n\r\nThis formula is:\r\n100% Hypoallergenic\r\nTested under dermatological control\r\nSuitable for sensitive skin\r\nSulfate-free', 'Imperfections are softened: 67% Pores are unclogged: 73% Pores are tightened: 71% Skin is less oily: 87% *Self-Assessment. 43 men, 43 women oily acne prone skin. T4weeks', 'Apply morning or evening with a cotton pad on cleansed skin. Avoid the eye area and do not rinse after application. PDP Section Ingredients', 'AQUA / WATER / EAU • ALCOHOL DENAT. • GLYCERIN • SODIUM CITRATE • PROPYLENE GLYCOL • SALICYLIC ACID • CITRIC ACID • SODIUM HYDROXIDE • GLYCOLIC ACID • PEG-60 HYDROGENATED CASTOR OIL • DIPOTASSIUM GLYCYRRHIZATE • GLUCONOLACTONE • TRISODIUM ETHYLENEDIAMINE DISUCCINATE • PARFUM / FRAGRANCE'),
(6, 'Minéral 89 Booster', 'Serum', 20000.00, 'uploads/1770551396_img1.webp', 'A breakthrough skincare formula : a high concentration of 89% of Vichy Volcanic Water, naturally charged with 15 Essential Minerals, enriched with pure Hyaluronic acid to help strengthen skin\'s moisture barrier and make it more resistant to daily aggressors. Replenished with moisture, the skin is hydrated, looks toned and plumped. Day after day, the skin radiates with a healthy glow.\r\n\r\nMINÉRAL 89 FORTIFYING AND PLUMPING DAILY BOOSTER by Vichy Laboratoires, brand recommended by 70 000 dermatologists worldwide.*\r\n\r\nThis formula contains:\r\n\r\n89% Vichy Volcanic Water: Helps strengthen skin barrier and protect from exposome factors.\r\n0.1% Pure hyaluronic acid : Helps hydrate and plump skin.\r\nThis formula is:\r\n\r\nTested under dermatological control\r\n100% hypoallergenic\r\nAlcohol-free, colorant-free and silicon-free', '1% instant hydration 71% skin strength  *Survey conducted among the dermocosmetic market carried out by AplusA and other partners between January 2021 and July 2021, involving dermatologists in 34 countries, representing more than 80% of the worldwide GDP.', 'Minéral 89 is the founding step in your skincare routine, to recharge skin with extra health and strength on a daily basis before any other more specific care rituals. It can be applied on face, eye contour and lips.  Apply 2 drops on your skin after cleansing morning and evening. Use as the first step of your skincare routine. Spread with outward movements from the middle of the face, without applying too much pressure.', 'AQUA / WATER / EAU • PROPANEDIOL • GLYCERIN • PEG/PPG/POLYBUTYLENE GLYCOL-8/5/3 GLYCERIN • METHYL GLUCETH-20 • CITRIC ACID • HYDROXYACETOPHENONE • SODIUM HYALURONATE • BIOSACCHARIDE GUM-1 • BUTYLENE GLYCOL • CAPRYLYL GLYCOL • CARBOMER • MALTODEXTRIN'),
(7, 'Liftactiv 16% Vitamin C Serum', 'Serum', 20000.00, 'uploads/1770551519_2.jpg', 'LIFTACTIV 16% VITAMIN C SERUM is a potent cocktail of active ingredients that helps reinforce skin\'s natural defenses against daily aggressors. This powerful serum combines 16% Pure Vitamin C with Hyaluronic Acid and Carnosine to deliver brighter, firmer, more even-toned skin.\r\nThis formula contains:\r\n\r\nNeohesperidine & Carnosine: Protect from internal agressors to prevent skin darkening, and keep youthful collagen & elastin fibers\r\n16% Pure Citamin C (L-Ascorbic Acid): Reinforces anti-oxidant action of the skin to increase protection from external aggressors\r\nHyaluronic Acid + Glycerin: Recharge skin\'s hydration to reduce wrinkles, increase hydration, and improve elasticity\r\nThis formula is:\r\n\r\nCertified by the Canadian Dermatology Association\r\nTested under dermatological control\r\nHypoallergenic\r\nFragrance-free\r\nFormulated with only 11 ingredients\r\nTested on sensitive skin and all phototypes.', 'Dermatologist measured clinical studies:  +40% Brightness* +51% Eveness* +83% Antioxidant skin defense* -17% Fine lines* *Clinical study, 52 women, 1 month *Clinical study, skin homogeneity calculated on spot area versus adjacent area, 40 women, 3 months *Clinical study, results on sebum photo-peroxidation test in vivo, 21 women', 'How to use Liftactiv 16% Vitamin C Serum :  In the morning, use dropper to place 4-5 Vitamin C serum drops in the palm of your cleansed hand. Then use fingertips to apply to a clean, dry face. Wash hands after use. Let the Vitamin C serum sit for a few moments, then apply your day cream Liftactiv Collagen Specialist Cream and sun protection of at least SPF 15 before sun exposure. For powerful anti-aging benefits, use in combination with LiftActiv H.A Wrinkle Filler Serum at night.', 'AQUA / WATER / EAU • ASCORBIC ACID • GLYCERIN • SODIUM HYDROXIDE • PENTYLENE GLYCOL • LAURETH-23 • HAEMATOCOCCUS PLUVIALIS EXTRACT • CARNOSINE • NEOHESPERIDIN DIHYDROCHALCONE • SODIUM HYALURONATE • TRISODIUM ETHYLENEDIAMINE DISUCCINATE • TOCOPHEROL • DIPOTASSIUM GLYCYRRHIZATE • CAPRYLIC/CAPRIC TRIGLYCERIDE • CAPRYLYL GLYCOL • CARRAGEENAN • PHENOXYETHANOL'),
(8, 'Minéral 89 Eyes', 'Serum', 20000.00, 'uploads/1770551713_3337875596763.jpg', 'Give your skin the eye care it deserves. Enjoy Minéral 89, the best eye serum for a daily boost of strength and a brighter look. Minéral 89 Eyes is a non-greasy gel formula combining 89% of Vichy Mineralizing Thermal Water with natural origin Hyaluronic Acid and pure caffeine to strengthen the skin’s barrier function. Smoothes fine lines with 24-hour hydration while brightening and decreasing the look of dark circles under eyes.', 'Hydrates, smoothes & brightens dark circles. Strengthens and preserves skin’s moisture barrier and reduces trans epidermal water loss. Hydrates and protects against skin aggressors for 24 hours. Tones skin and improves skin elasticity. PDP Section Ingredients', 'For all skin types, including sensitive ones. Apply a drop on clean skin, morning and evening. Tested under dermatological and ophthalmological control. Hypoallergenic. Suitable for contact lens wearers.  How to use:  Place a drop of M89 Eyes on your fingertips and apply it around each eye: 3 taps above and below each eye. Gently press with each drop into your eye contour using 2 fingertips, in order to drain and depuff eye bags. Use your finger to smooth from the inner to the outer corners of the under eye area and eyelid to smooth fine lines.', 'AQUA / WATER / EAU • PROPANEDIOL • GLYCERIN • ISOCETYL STEARATE • CARBOMER • CAFFEINE • SODIUM HYALURONATE • ADENOSINE • CHLORELLA VULGARIS EXTRACT • HYDROXYACETOPHENONE • CAPRYLYL GLYCOL • CITRIC ACID • BIOSACCHARIDE GUM-1 • MALTODEXTRIN • BUTYLENE GLYCOL (F.I.L. B268308/1)'),
(9, 'Liftactiv Pigment Specialist B3 Anti-dark Spots Serum', 'Serum', 20000.00, 'uploads/1770551954_1 (3).jpg', 'Discover the Liftactiv Pigment Specialist B3 Anti-dark Spots Serum & wrinkles serum with Melasyl. The most complete serum to correct dark spots and wrinkles at all stages of life. Corrects up to -86% of dark spots and up to -38% of wrinkles. Age and external aggressions, such as pollution and UV rays, can lead to the appearance of brown spots, wrinkles and uneven skin tone.\r\n\r\nThis formula contains:\r\n\r\nMELASYL + Niacinamide B3 that help reduce the appearance of dark spots and wrinkles. \r\nThis formula is:\r\n\r\nTested under dermatological control\r\nCertified by the Canadian Dermatology Association\r\nTested on sensitive skin and all phototypes\r\nHypoallergenic\r\nBy VICHY, brand recommended by 70 000 dermatologists worldwide.*\r\n\r\n*Survey conducted among the dermocosmetic market carried out by APLUSA and other partners between January 2023 and May 2023, involving dermatologists in 34 countries, representing more than 80% of the worldwide GDP.', 'Helps reduce dark spots by up to 86%, wrinkles by up to 38% and evens out skin tone and radiance.', 'Gently press the applicator for precise dosage.  2. Apply several drops to a clean, dry face morning and evening. Avoid contact with eyes and lips.  Use sunscreen, wear protective clothing and limit sun exposure while using this product and for one week afterwards.', 'AQUA / WATER / EAU • NIACINAMIDE • BUTYLENE GLYCOL • HYDROXYETHYLPIPERAZINE ETHANE SULFONIC ACID • GLYCERIN • PENTYLENE GLYCOL • PROPANEDIOL • HYDROXYETHYL UREA • GLYCOLIC ACID • ARGININE • TRANEXAMIC ACID • HYDROLYZED RICE PROTEIN • ALLANTOIN • CITRIC ACID • CYSTOSEIRA TAMARISCIFOLIA EXTRACT • SODIUM HYDROXIDE • TRISODIUM ETHYLENEDIAMINE DISUCCINATE • 2-MERCAPTONICOTINOYL GLYCINE • ASCORBYL GLUCOSIDE • DIPOTASSIUM GLYCYRRHIZATE • CAPRYLYL GLYCOL • XANTHAN GUM • CI 16035 / RED 40'),
(10, 'Liftactiv H.A. Wrinkle Filler', 'Serum', 20000.00, 'uploads/1770552079_3337875719209.jpg', 'Liftactiv H.A. Wrinkle Filler Serum, formulated with a high concentration of 1.5% Pure Hyaluronic Acid, provides a visible filling effect reducing wrinkles and fine lines. Our best hyaluronic acid serum, ideal as a wrinkle filler for the forehead, it also works as both an under-eye wrinkle filler, a lip contour line filler and is suitable for sensitive skin.\r\n\r\nThis formula contains:\r\n\r\nPure 1.5% Hyaluronic acid: Replumps skin & corrects wrinkles.\r\nVitamin Cg: Boosts antioxidants & skin\'s defenses.\r\nNeuropeptides Help smooth wrinkles.\r\nVichy Volcanic Water: Helps strengthen skin barrier and protect from exposome factors.\r\nThis formula is:\r\n\r\nCertified by the Canadian Dermatology Association\r\nFor all skin types, dermatologist-tested\r\nHypoallergenic\r\nFragrance-free\r\nOil-free\r\nSilicone-free\r\nParaben-free', '-47% wrinkles* -60% fine lines* +13% elasticity* *Clinical evaluation, 53 women, 6 weeks.', 'How to use hyaluronic acid serum:  Press the applicator gently for a precise dosage. Apply several drops on the face up to twice a day.', 'AQUA / WATER / EAU • GLYCERIN • HYDROXYETHYLPIPERAZINE ETHANE SULFONIC ACID • SODIUM HYALURONATE • PEG-60 HYDROGENATED CASTOR OIL • SECALE CEREALE SEED EXTRACT / RYE SEED EXTRACT • CALCIUM PANTOTHENATE • DIPEPTIDE DIAMINOBUTYROYL BENZYLAMIDE DIACETATE • PHENOXYETHANOL • CHLORPHENESIN • ASCORBYL GLUCOSIDE • DISODIUM EDTA • PENTYLENE GLYCOL'),
(11, 'CAPITAL SOLEIL UV+AGE DAILY SPF 60', 'Sunscreen', 20000.00, 'uploads/1770552313_CapitalSoleil-UV-AgeDaily-SPF60.jpg', 'Introducing Capital Soleil UV+AGE DAILY SPF 60 enriched with 5% Niacinamide and Peptides. This high-broad spectrum lotion protects the skin against harmful UVA and UVB rays while preventing and correcting the appearance of dark spots and wrinkles. Powered by the multi-patented Netlock technology and enriched with potent anti-aging dermatological actives, the formula is an ultra-lightweight, fragrance-free water-based fluid. Its invisible and easily absorbed finish layers perfectly under makeup without pilling. This is the anti-aging daily solution for all skin types, all year round.\r\nThis formula contains :\r\n\r\nMexoryl® XL: Combination of Mexoryl® XL and other sunscreen filters to offer broad and balanced protection against UVA and UVB rays.\r\n5% Niacinamide: Helps reduce the appareance of dark spots.\r\nPeptides: Help increase natural collagen production.\r\nProbiotic Fractions: Help strengthen skin barrier.\r\nThe formula is :\r\n\r\nRecognized by the Canadian Dermatology Association,\r\nTested under dermatological and ophthalmological control,\r\nAnti-eyes stinging,\r\nFragrance-free,\r\nHypoallergenic & non comedogenic,\r\nParaben-free.', 'Applied daily, this anti-aging face sun protection is clinically proven:  High protection against UVA and UVB rays. 86% skin feels smoother. 81% skin tone looks more even. 80% skin looks more radiant. 100% does not pill on skin. 95% compatible with make-up routine. *Self-assessment on 59 women after 4 weeks.', 'How to apply sunscreen:  Pour 5 to 6 pumps of the sun protection into your hands, then apply to the face, eye area and neck using lifting movements. Perform this gesture every morning as the last step of your skin care routine. Reapply after 2 hours of exposure to the sun.', 'AQUA / WATER • DROMETRIZOLE TRISILOXANE • ALCOHOL DENAT. • NIACINAMIDE • SILICA • OCTOCRYLENE • ISOPROPYL MYRISTATE • BIS-ETHYLHEXYLOXYPHENOL METHOXYPHENYL TRIAZINE • ETHYLHEXYL SALICYLATE • GLYCERIN • DIISOPROPYL SEBACATE • BUTYL METHOXYDIBENZOYLMETHANE • PROPANEDIOL • C12-22 ALKYL ACRYLATE/HYDROXYETHYLACRYLATE COPOLYMER • HOMOSALATE • PERLITE • TOCOPHEROL • PHENYLBENZIMIDAZOLE SULFONIC ACID • TRIETHANOLAMINE • CAPRYLYL GLYCOL • TRISODIUM ETHYLENEDIAMINE DISUCCINATE • PENTYLENE GLYCOL • HYDROLYZED RICE PROTEIN • HYDROXYETHYLCELLULOSE • ACRYLATES/C10-30 ALKYL ACRYLATE CROSSPOLYMER • VITREOSCILLA FERMENT\r\nPDP Section Ingredients\r\n'),
(12, 'Capital Soleil Sport Ultra-Light Refreshing Lotion SPF 60', 'Sunscreen', 25000.00, 'uploads/1770552519_3337875544252.main-VICHY.CA-EN.jpg', '', 'Idéal Soleil Sport SPF 60 contains the Mexoryl® sunscreen technology and other sunscreen filters to provide a broad spectrum sun protection against harmful UVA and UVB rays, which can cause damages and accelerate signs of aging. This is why Vichy aligns with the power and importance behind providing the best SPF for your face this Summer. After grabbing this sunscreen, take a look at Vichy\'s anti-aging treatment for even more ways to keep your skin feeling youthful and health', 'Apply generously and evenly, on face and body, 15 minutes before exposure. Reapply at least every 2 hours, after 80 minutes of swimming or sweating and immediately after towel drying. Can be applied on wet or dry skin. For use on children under 6 months of age, consult a health care practition', 'ACTIVE INGREDIENTS (W/W): HOMOSALATE: 10.72% • OCTOCRYLENE: 6% • OXYBENZONE: 3.86% • OCTISALATE: 3.21% • AVOBENZONE: 3% • DROMETRIZOLE TRISILOXANE (MEXORYL XL): 0.50%\r\n\r\nOTHER INGREDIENTS: AQUA • DIMETHICONE • ALCOHOL DENAT. • STYRENE/ACRYLATES COPOLYMER • ACRY LAT E S / D I M E T H I C O N E COPOLYMER • ACRYLATES/C10-30 ALKYL ACRYLATE CROSSPOLYMER • CAPRYLYL GLYCOL • DISODIUM EDTA • MENTHYL LACTATE • PEG-8 LAURATE • PHENOXYETHANOL • SILICA • SODIUM POLYACRYLATE • TOCOPHEROL'),
(13, 'CAPITAL SOLEIL AFTER SUN MILK', 'Sunscreen', 25000.00, 'uploads/1770552657_PS-30816-Vichy-3D-CapitalSoleil-After-Sun-Vichy.ca.jpg', '', 'Upon the very first application, skin is intensely soothed and hydrated for 24 hours. Day after day, skin becomes more resistant to sun irritations. This effectiveness works on all skin types and moisturizes the affected areas. Efficacy tested under dermatological control.', 'Rub on areas to relieve. Reapply during 4-5 days after sun exposure or as needed.', 'AQUA; ALCOHOL DENAT.; GLYCERIN; PARAFFINUM LIQUIDIDUM; CETEARYL ALCOHOL; BUTYROSPERMUM PARKII BUTTER; CAPRYLYL GLYCOL; CARBOMER; DIMETHICONE; EPILOBIUM ANGUSTIFOLIUM EXTRACT; GLYCERYL STERATE; PALMITIC ACID; PEG-100 STEARATE; PHENOXYETHANOL; SODIUM HYALURONATE; SODIUM HYDROXIDE; STEARIC ACID; XANTHAM GUM; ZINC GLUCONATE; PARFUM'),
(14, 'CAPITAL SOLEIL ULTRA-LIGHT UV LOTION SPF 30', 'Sunscreen', 25000.00, 'uploads/1770552852_3337875789875.mainB.jpg', 'Broad-spectrum UVA/UVB protection SPF 30\r\nWater & sweat resistance [40 MINUTES]\r\nMoisturizing formula\r\nIdeal for face & daily use', 'Broad spectrum UVA/UVB protection SPF 30. Ultra-light lotion that spreads evenly for an invisible non-greasy finish. Moisturising formula. Quick absorption. WATER AND SWEAT RESISTANT [ 40 MINUTES ].', 'Shake well • Apply generously 15 minutes before sun exposure • Reapply at least every 2 hours • Reapply after 40 minutes of swimming or sweating • Reapply immediately after towel drying.   Broad spectrum UVA/UVB protection SPF 30 WATER AND SWEAT RESISTANT [ 40 MINUTES ] Recognized by the Canadian Dermatology Association for Sun Protection Mexoryl® XL and other sunscreen filters NETLOCK TECHNOLOGY: Allows ultra-light lotion to spread evenly for an invisible non-greasy finish Moisturising formula. Ideal for face and daily use. Quick absorption. SUITABLE FOR SENSITIVE SKIN, HYPOALLERGENIC, TESTED UNDER DERMATOLOGICAL CONTROL, NON-COMEDOGENIC, FRAGRANCE-FREE , PARABEN-FREE, OXYBENZONE-FREE, OIL-FREE', 'FML885726 6\r\n\r\nActive ingredients (w/w) / Ingrédients actifs (p/p)\r\n\r\nBemotrizinol5%, Octisalate 5%, Octocrylene 5%, Drometrizole trisiloxane (Mexoryl XL) 3.5%, Avobenzone 3%, Homosalate 2%.\r\n\r\nInactive ingredients / Ingrédients inactifs\r\n\r\naqua, alcohol denat., silica, isopropyl myristate, glycerin diisopropyl sebacate, propanediolc12-22 alkyl acrylate/hydroxyethylacrylate copolymer, perlite, tocopherol, hydroxyacetophenone, caprylyl glycol, trisodium, ethylenediamine disuccinate, triethanolamine, hydroxyethylcellulose, acrylates/c10-30 alkyl acrylate crosspolymer.\r\n\r\nFIL:V280558/1'),
(16, 'Idéal Soleil After Sun Sos Balm', 'Sunscreen', 25000.00, 'uploads/1770553669_Vichy-Soin-Solaire-Apres-soleil-Ideal-Soleil-Baume-de-secours-apres-soleil-100ml-000-3337871318697-Front.jpg', 'This specific sunburn care\r\nprovides you with an instant\r\nsoothing action', 'Skin is instantly relieved Skin is intensively hydrated 24 hours later, skin visibly recovers from the stress & erythema fades', '1 APPLY A THICK LAYER OF THE RICH TEXTURE OVER THE AREA REQUIRING TREATMENT 2 REPEAT APPLICATION FOR 4 to 5 days FOLLOWING SUNBURN', 'AQUA • GLYCERIN • ALCOHOL DENAT. • PROPYLENE GLYCOL • ISONONYL ISONONANOATE • BUTYROSPERMUM PARKII BUTTER • HYDROGENATED POLYISOBUTENE • AMMONIUM POLYACRYLDIMETHYLTAURAMIDE • CARBOMER • CETYL ALCOHOL • CI 77891 • DISODIUM EDTA • EPILOBIUM ANGUSTIFOLIUM EXTRACT • ETHYLHEXYLGLYCERIN • GLYCERYL STEARATE • GLYCINE SOJA OIL • PALMITIC ACID • PEG-100 STEARATE • STEARIC ACID • TOCOPHEROL • TRIETHANOLAMINE • PARFUM (F.I.L. B24908/4).'),
(17, 'Liftactiv Collagen Specialist 16 Day Cream', 'Moisturizer', 25000.00, 'uploads/1770553828_1.webp', 'Discover the Liftactiv Collagen Specialist 16 Cream powered with CO-BOND TECHNOLOGY to boost and bond all collagen types and correct 16 ageing signs. Improving: wrinkles, fine lines, firmness, plumpness, contour definition, smoothness, skin texture, tonicity, density, skin strength, skin repair, radiance, softness, suppleness, hydration, evenness. Product of 32 years of research, 1000+ molecules tested and 42 publications.\r\n\r\n\r\nThis formula contains:\r\n\r\nExclusive Co-Bond Technology [Rhamnose + Peptides + Maitake]: boost skin affected by the loss of collagens\r\nNiacinamide: Helps even skin tone and reduces the look of dark spots\r\nThe formula is:\r\n\r\nTested under dermatological control\r\nTested on sensitive skin and all phototypes\r\nHypoallergenic\r\nBy VICHY, brand recommended by 70 000 dermatologists worldwide.*\r\n\r\n*Survey conducted among the dermocosmetic market carried out by APLUSA and other partners between January 2023 and May 2023, involving dermatologists in 34 countries, representing more than 80% of the worldwide GDP.', 'linically Proven Efficacy:   +350% Collagen boost  88% of women agree that skin feels firmer* 86% of women agree that skin looks more elastic* *Consumer test, auto-evaluation.', 'Apply a pea-sized amount twice daily after your serum. Avoid eye contours.', 'AQUA / WATER / EAU • GLYCERIN • DIMETHICONE • SILICA • ISOHEXADECANE • ALCOHOL DENAT. • HYDROXYETHYLPIPERAZINE ETHANE SULFONIC ACID • NIACINAMIDE • PROPANEDIOL • SYNTHETIC WAX • PEG-10 DIMETHICONE • HYDROLYZED RICE PROTEIN • SODIUM PHYTATE • ADENOSINE • GRIFOLA FRONDOSA FRUITING BODY EXTRACT • HYDROXYACETOPHENONE • PALMITOYL TETRAPEPTIDE-7 • PALMITOYL TRIPEPTIDE-1 • RHAMNOSE • SH-POLYPEPTIDE-69 • SODIUM HYDROXIDE • ASCORBYL GLUCOSIDE • DISTEARDIMONIUM HECTORITE • BUTYLENE GLYCOL • CAPRYLIC/CAPRIC TRIGLYCERIDE • CAPRYLYL GLYCOL • CARBOMER • CETEARETH-6 • CI 77891 / TITANIUM DIOXIDE • MALTODEXTRIN • PENTYLENE GLYCOL • POLYSORBATE 20 • PROPYLENE CARBONATE • SODIUM ACRYLATES COPOLYMER • SODIUM CHLORIDE • SODIUM CITRATE • SODIUM LACTATE • SODIUM PHOSPHATE • SORBITAN OLEATE • STEARYL ALCOHOL • SYNTHETIC FLUORPHLOGOPITE • TOCOPHEROL • ZEA MAYS STARCH / CORN STARCH • DIMETHICONE/PEG-10/15 CROSSPOLYMER • DIMETHICONE/POLYGLYCERIN-3 CROSSPOLYMER • CI 15985 / YELLOW 6 • DIPROPYLENE GLYCOL • PARFUM / FRAGRANCE'),
(18, 'MINÉRAL 89 72H MOISTURE BOOSTING FRAGRANCE FREE CREAM', 'Moisturizer', 25000.00, 'uploads/1770553950_3337875839624-mainB.jpg', 'Discover the new MINÉRAL 89 72H MOISTURE BOOSTING CREAM. Enriched with Minerals, Pure Hyaluronic Acid, Vitamins and Squalane, it\'s your daily dose of skin essential elements that locks-in hydration for 72H.\r\n\r\nUsed after MINÉRAL 89 BOOSTER, MINÉRAL 89 72H MOISTURE BOOSTING CREAM results in 100% skin barrier recovery.\r\n\r\nThis formula contains:\r\n\r\nMillions of minerals: 89PPM to help fortify and repair the skin barrier.\r\n0.1% Pure hyaluronic acid : Helps hydrate and plump skin.\r\n2.2% Niacinamide and Vitamin E: Helps boost ceramide production.\r\n1% Squalane: Helps enhance skin barrier repair.\r\nThis formula is:\r\n\r\nTested under dermatological control\r\nTested on sensitive skins and all phototypes\r\nAlcohol-free, colorant-free and silicon-free\r\nMINÉRAL 89 72H MOISTURE BOOSTING CREAM by VICHY, brand recommended by 50 000 dermatologists worldwide.*\r\n\r\n*Survey conducted among the dermocosmetic market carried out by AplusA and other partners between January 2021 and July 2021, involving dermatologists in 34 countries representing more than 80% of the worldwide GDP.\r\n\r\n', '72H long-lasting hydration 100% skin barrier recovery Helps rehydrate and replump skin cells. Helps reinforce skin structure. Helps boost ceramide production.', 'Apply a generous amount of MINÉRAL 89 72H MOISTURE BOOSTING CREAM on your skin morning and evening to a cleansed skin by spreading a touch of cream all over the face. Spread with outward movements from the middle of the face', 'AQUA / WATER / EAU • GLYCERIN • DICAPRYLYL ETHER • PENTYLENE GLYCOL • POLYGLYCERYL-6 DISTEARATE • NIACINAMIDE • PROPANEDIOL • CETYL ESTERS • JOJOBA ESTERS • CETEARYL ISONONANOATE • SQUALANE • BEHENYL ALCOHOL • ADENOSINE • CAPRYLOYL SALICYLIC ACID • HYDROXYACETOPHENONE • MINERAL SALTS • SODIUM HYALURONATE • TRISODIUM ETHYLENEDIAMINE DISUCCINATE • VITREOSCILLA FERMENT • TOCOPHEROL • ACACIA DECURRENS FLOWER CERA / ACACIA DECURRENS FLOWER WAX • ACRYLAMIDE/SODIUM ACRYLOYLDIMETHYLTAURATE COPOLYMER • CETYL ALCOHOL • HELIANTHUS ANNUUS SEED CERA / SUNFLOWER SEED WAX • HYDROXYPROPYL STARCH PHOSPHATE • ISOHEXADECANE • POLYGLYCERIN-3 • POLYGLYCERYL-3 BEESWAX • POLYSORBATE 80 • SODIUM STEAROYL GLUTAMATE • SORBITAN OLEATE'),
(19, 'Liftactiv Hyaluronic Specialist H.A. Anti-Wrinkle Day for normal to combination skin', 'Moisturizer', 25000.00, 'uploads/1770554093_WFP-1817701_VICHY-W25-Hyaluronic-Specialist-NTC-ATF-ECOM-1-V2.jpg', 'Liftactiv Hyaluronic Specialist H.A. Anti-Wrinkle Day Moisturiser for normal to combination skin, formulated with the plumping Hyaluronic Acid and vigour of Rhamnose, to optimise your morning skincare routine. This product\'s potent formulation offers a lasting lifting effect, combating fine lines, wrinkles, and loss of elasticity. Experience visibly reduced wrinkles and enhanced skin firmness with continued use, restoring a youthful glow. The following evening, use Liftactiv H.A. Anti-Wrinkle Night Moisturizer for a complete protocol against visible signs of aging.\r\n\r\nThis formula contains:\r\n\r\nHyaluronic Acid: Replumps skin and corrects wrinkles.\r\nRhamnose: Helps improve skin\'s firmness.\r\nVitamin Cg: Boosts antioxidants and skin\'s defenses.\r\nVichy Volcanic Water: Helps strengthen the skin barrier and protect from exposome factors.\r\nThe formula is:\r\n\r\nSuitable for Sensitive Skin\r\nDermatologist-tested for Safety,\r\nHypoallergenic,\r\nParaben-free.', 'Clinically Proven Efficacy:  +38% immediate elasticity (1) 83% reduction in skin dullness (2) (1) Instrumental test, 40 women (2) Self assesment, 52 women, 1 month', 'How to apply day cream:  Apply on cleansed face either alone or after one of the Liftactiv serums. Apply to face and neck until thoroughly absorbed.', 'AQUA / WATER / EAU • GLYCERIN • ISOPROPYL ISOSTEARATE • BEHENYL ALCOHOL • ZEA MAYS STARCH / CORN STARCH • ALCOHOL DENAT. • DICAPRYLYL CARBONATE • MYRISTIC ACID • PEG-100 STEARATE • CERA ALBA / BEESWAX / CIRE DABEILLE • SILICA • ADENOSINE • CAPRYLOYL SALICYLIC ACID • FAEX EXTRACT / YEAST EXTRACT / EXTRAIT DE LEVURE • HYDROXYACETOPHENONE • SODIUM HYALURONATE • SODIUM HYDROXIDE • TRISODIUM ETHYLENEDIAMINE DISUCCINATE • VITREOSCILLA FERMENT • ASCORBYL GLUCOSIDE • PANTHENOL • DIPOTASSIUM GLYCYRRHIZATE • ACRYLATES/C10-30 ALKYL ACRYLATE CROSSPOLYMER • CAPRYLYL GLYCOL • CARBOMER • CITRIC ACID • PEG-30 DIPOLYHYDROXYSTEARATE • PENTYLENE GLYCOL • SORBITAN TRISTEARATE • TOCOPHEROL • TRIDECETH-6 • PARFUM / FRAGRANCE\r\nPDP Section Ingredients\r\n'),
(20, 'MINÉRAL 89 MOISTURE RECOVERY NIGHT CREAM', 'Moisturizer', 25000.00, 'uploads/1770554199_packshot M89.jpg', 'Discover the MINÉRAL 89 MOISTURE RECOVERY NIGHT CREAM a hydrating night cream powered by Pure Melatonin, it helps boost your skin\'s performance at night for a faster skin recovery from daytime stress. It is your nightly dose of skin essential elements (Minerals, Pure Hyaluronic Acid, Vitamins B3&E) to intensely hydrate and replump the skin. Its pillow-like texture and dreamy fragrance infuse the skin all night long, so you wake up to radiant and healthy-looking skin.', 'Clinically Proven Efficacy:  94% overall skin appearance looks improved* 89% Skin features look rested** * Self-assessment, 167 users, the morning after  ** Self-assessment, 167 users, 2 weeks', 'How to apply the night cream:  In the evening, apply a generous amount of MINÉRAL 89 MOISTURE RECOVERY NIGHT CREAM to clean skin. Gently spread in an outward motion from the center of the face. For best results, use after Minéral 89 Booster to maximize hydration and skin recovery.', 'QUA / WATER / EAU • GLYCERIN • SQUALANE • NIACINAMIDE • CAPRYLIC/CAPRIC TRIGLYCERIDE • PENTAERYTHRITYL TETRAETHYLHEXANOATE • BUTYLENE GLYCOL • SODIUM CARBOMER • CHRYSIN • CITRIC ACID • COPPER GLUCONATE • HYDROXYACETOPHENONE • MELATONIN • MINERAL SALTS • PALMITOYL TETRAPEPTIDE-7 • ROSMARINUS OFFICINALIS LEAF EXTRACT / ROSEMARY LEAF EXTRACT • SODIUM HYALURONATE • SODIUM HYDROXIDE • TRISODIUM ETHYLENEDIAMINE DISUCCINATE • VITREOSCILLA FERMENT • TOCOPHEROL • BIOSACCHARIDE GUM-1 • CAPRYLYL GLYCOL • GLYCERYL ISOSTEARATE • LACTIC ACID • MALTODEXTRIN • PENTYLENE GLYCOL • SILICA • SODIUM STEAROYL GLUTAMATE • XANTHAN GUM • SALICYLIC ACID • PARFUM / FRAGRANCE'),
(21, 'JM Solution', 'Cleanser', 30000.00, 'uploads/1770566095_jmwater.jpg', 'cleanse the skin deeply and moisturize', 'brighten the skin and reduce dark spot', 'Use with cotton pad for make up remove', 'centalla');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `orders` 
ADD COLUMN `payment_proof` VARCHAR(255) DEFAULT NULL 
AFTER `payment_method`;
