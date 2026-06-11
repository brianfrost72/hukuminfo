-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2026 at 01:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hukuminfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) NOT NULL,
  `ad_title` varchar(255) NOT NULL,
  `ad_img` varchar(255) NOT NULL,
  `ad_link` varchar(255) NOT NULL,
  `ad_request` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `ad_title`, `ad_img`, `ad_link`, `ad_request`, `created_at`) VALUES
(3, 'TESS1', '1781149462_6a2a2f16121e4.jpg', 'FACEBOOK', 'PI.TESSS', '2026-06-11 10:44:22'),
(4, 'ABCC', '1781149679_6a2a2fef594d8.jpg', 'WWW.GGOLE.COM', 'PT.ABB', '2026-06-11 10:47:59'),
(5, 'AA', '1781149757_6a2a303d89401.jpg', 'BB', 'CC', '2026-06-11 10:49:17'),
(6, 'AAA', '1781149804_6a2a306c19aa9.jpg', 'BBB', 'CCC', '2026-06-11 10:50:04'),
(7, '123', '1781149920_6a2a30e083830.jpg', 'INSTAGRAM', '1234', '2026-06-11 10:52:00'),
(8, '12A', '1781149977_6a2a3119cdc9f.jpg', 'INST', 'CCC', '2026-06-11 10:52:57'),
(9, 'TES1', '1781150309_6a2a3265d3f94.jpg', 'INSTAGRAM', '1234', '2026-06-11 10:58:29'),
(10, 'TES1', '1781150430_6a2a32de1d2c7.jpeg', 'WWW.GGOLE.COM', '1234', '2026-06-11 11:00:30'),
(11, 'TES12', '1781150464_6a2a3300b4971.jpg', 'INSTAGRAM', '1234', '2026-06-11 11:01:04'),
(12, 'TES2', '1781150633_6a2a33a92db01.jpg', 'INSTAGRAM', '1234', '2026-06-11 11:03:53'),
(13, 'TESS3', '1781150665_6a2a33c974fd2.jpg', 'INSTAGRAM', '1234', '2026-06-11 11:04:25'),
(14, '1', '1781150699_6a2a33eb2e8cb.jpg', 'WWW.GGOLE.COM', 'CCC', '2026-06-11 11:04:59'),
(15, '22', '1781150729_6a2a340920a6b.jpg', 'AA', 'CCC', '2026-06-11 11:05:29'),
(16, 'TES4', '1781150770_6a2a3432187a3.jpg', 'WWW.GGOLE.COM', 'PT', '2026-06-11 11:06:10'),
(17, 'TESS1', '1781150802_6a2a34520e471.jpg', 'WWW.TES', 'PT', '2026-06-11 11:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `list_socmed`
--

CREATE TABLE `list_socmed` (
  `id` int(11) NOT NULL,
  `name_platform` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_socmed`
--

INSERT INTO `list_socmed` (`id`, `name_platform`, `created_at`) VALUES
(1, 'Instagram', '2026-06-01 08:34:26'),
(2, 'Facebook', '2026-06-01 08:34:26'),
(3, 'Youtube', '2026-06-01 08:35:13'),
(4, 'LinkedIn', '2026-06-01 08:35:13'),
(5, 'Tiktok', '2026-06-01 08:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_campaigns`
--

CREATE TABLE `newsletter_campaigns` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('draft','scheduled','sending','complete','cancelled') NOT NULL DEFAULT 'draft',
  `scheduled_at` datetime DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_logs`
--

CREATE TABLE `newsletter_logs` (
  `id` bigint(20) NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `subscriber_id` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` enum('success','failed') NOT NULL,
  `smtp_response` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_queue`
--

CREATE TABLE `newsletter_queue` (
  `id` bigint(20) NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `subscriber_id` bigint(20) NOT NULL,
  `status` enum('pending','processing','sent','failed') NOT NULL DEFAULT 'pending',
  `retry_count` int(11) NOT NULL DEFAULT 0,
  `error_message` text NOT NULL,
  `processing_at` datetime NOT NULL,
  `sent_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_sub_title` varchar(255) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_subcategory_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `post_desc` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `total_views` int(11) DEFAULT 0,
  `total_comments` int(11) DEFAULT 0,
  `total_likes` int(11) DEFAULT 0,
  `total_bookmarks` int(11) DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `status` enum('draft','publish') NOT NULL DEFAULT 'publish',
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post_title`, `post_sub_title`, `post_category_id`, `post_subcategory_id`, `role_id`, `user_id`, `post_desc`, `post_image`, `total_views`, `total_comments`, `total_likes`, `total_bookmarks`, `slug`, `status`, `created_at`, `update_at`) VALUES
(11, 'Harga BBM Pertamina 9 Juni 2026 dari Jenis Pertalite hingga Pertamax, Ada yang Naik!', 'FINAL', 1, 8, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">JAKARTA, iNews.id - </span>Harga <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/bbm-pertamina\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">BBM Pertamina</a></span> pada Selasa (9/6/2026) penting diketahui masyarakat. Apalagi, <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/pertamina\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Pertamina</a></span> Patra Niaga baru saja menyesuaikan harga jual produk <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/bbm\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">BBM</a></span> nonsubsidi pada Senin (1/6/2026).&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dalam kebijakan ini, harga Pertamax Turbo mengalami kenaikan. Sedangkan, harga Pertamina Dex dan Dexlite mengalami penurunan. “Penurunan harga Pertamina Dex, Dexlite, serta penyesuaian harga Pertamax Turbo dilakukan dengan mempertimbangkan dinamika harga energi global serta parameter yang ditetapkan pemerintah melalui formula harga yang berlaku,” ujar Corporate Secretary Pertamina Patra Niaga, Roberth MV Dumatubun dalam keterangan resminya, Senin (1/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/harga-bbm\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Harga BBM</a></span> 9 Juni 2026</p>', '1780965808_6a2761b06e90d.jpeg', 1, 0, 0, 0, 'harga-bbm-pertamina-9-juni-2026-dari-jenis-pertalite-hingga-pertamax-ada-yang-naik', 'publish', '2026-06-09 07:43:28', '2026-06-11 12:21:23'),
(13, '2 Terdakwa Penyiram Air Keras ke Andrie Yunus Dipecat dari TNI', '2 Terdakwa Penyiram Air Keras ke Andrie Yunus Dipecat dari TNI', 1, 6, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">JAKARTA, iNews.id </span>- Majelis Hakim <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/pengadilan-militer\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Pengadilan Militer</a></span> II-08 Jakarta menghukum empat prajurit BAIS TNI <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/terdakwa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">terdakwa</a></span> penyiram air keras ke aktivis KontraS, Andrie Yunus 1,5 tahun hingga 3 tahun <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/penjara\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">penjara</a></span>. Pembacaan <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/vonis\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">vonis</a></span> tersebut pada <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/sidang\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">sidang</a></span> yang digelar, Rabu (10/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Keempat terdakwa yakni Serda Edi Sudarko (ES), Lettu Budhi Hariyanto Widhi Cahyono (BHW), Kapten Nandala Dwi Prasetya (NDP), dan Lettu Sami Lakka&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dalam amar putusan, Serda Edi Sudarko divonis 3 tahun penjara, Lettu Budhi Hariyanto Widhi Cahyono dijatuhi hukuman 2 tahun 6 bulan penjara, Kapten Nandala Dwi Prasetya divonis 2 tahun penjara, dan Lettu Sami Lakka divonis 1 tahun 6 bulan penjara.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Selain pidana penjara, majelis hakim juga menjatuhkan pidana tambahan berupa pemecatan dari dinas militer terhadap dua terdakwa, yakni Serda Edi Sudarko dan Lettu Budhi Hariyanto Widhi Cahyono</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Terdakwa 1 (Serda Edi Sudarko), pidana pokok penjara selama tiga tahun. Pidana tambahan dipecat dari dinas militer. Terdakwa 2 (Lettu Budhi Hariyanto) pidana pokok penjara selama dua tahun dan enam bulan. Pidana tambahan dipecat dari dinas militer,\" kata Ketua Majelis Hakim Fredy Ferdian Isnartanto, Rabu (10/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Majelis hakim menambahkan, para terdakwa terbukti secara sah dan meyakinkan melakukan tindak pidana penganiayaan berencana yang mengakibatkan luka berat sebagaimana diatur dalam Pasal 467 ayat (2) juncto Pasal 20 huruf c Undang-Undang Nomor 1 Tahun 2023 tentang KUHP. Pasal tersebut didakwakan secara lebih subsider oleh oditur militer.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Usai pembacaan putusan, majelis hakim memberikan kesempatan kepada para terdakwa maupun oditur militer untuk menyatakan sikap atas putusan tersebut. Para terdakwa memilih menyatakan pikir-pikir sebelum menentukan langkah hukum selanjutnya</p>', '1781078209_6a2918c1ec56d.jpg', 1, 0, 0, 0, '2-terdakwa-penyiram-air-keras-ke-andrie-yunus-dipecat-dari-tni', 'publish', '2026-06-10 14:56:49', '2026-06-11 12:18:44'),
(14, 'Naik Tank hingga Latihan Ala Marinir, 100 Siswa SMK Ketintang Surabaya Digembleng Pasukan Amfibi TNI', 'Naik Tank hingga Latihan Ala Marinir, 100 Siswa SMK Ketintang Surabaya Digembleng Pasukan Amfibi TNI', 2, 13, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">SURABAYA, iNewsSurabaya.id – Suasana berbeda dirasakan ratusan siswa <a rel=\"dofollow\" href=\"https://surabaya.inews.id/tag/smk-ketintang-surabaya\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">SMK Ketintang Surabaya</a> saat mengikuti Perkemahan Sabtu-Minggu (<a rel=\"dofollow\" href=\"https://surabaya.inews.id/tag/persami\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Persami</a>) di markas Batalyon <a rel=\"dofollow\" href=\"https://surabaya.inews.id/tag/tank-amfibi-2-marinir\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Tank Amfibi 2 Marinir</a>, Kesatrian Sutedi Senaputra, Karang Pilang, Surabaya. Dalam kegiatan ini, para pelajar tidak hanya berkemah, tetapi juga mendapatkan <a rel=\"dofollow\" href=\"https://surabaya.inews.id/tag/pembinaan-karakter\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">pembinaan karakter</a> langsung dari pasukan elite Korps Marinir TNI AL.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Sebanyak 100 siswa yang tergabung dalam Korps Kadet Republik Indonesia (KKRI) mengikuti berbagai rangkaian kegiatan yang dirancang untuk membentuk kedisiplinan, jiwa kepemimpinan, kerja sama tim, serta semangat cinta tanah air.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Pengalaman yang paling menarik perhatian peserta adalah kesempatan melihat lebih dekat hingga menaiki kendaraan tempur tank amfibi milik Korps Marinir. Kegiatan tersebut menjadi pengalaman langka yang tidak biasa mereka temui di lingkungan sekolah.</p><div style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Inter, sans-serif; font-size: medium;\">Sebanyak 100 siswa SMK Ketintang Surabaya mengikuti pembinaan karakter di markas Batalyon Tank Amfibi 2 Marinir. Mereka belajar disiplin, kepemimpinan hingga merasakan naik tank TNI. Foto iNewsSurabaya.id/kia</div><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Pada awal kegiatan, sebagian siswa mengaku sempat merasa tegang karena berada di lingkungan militer. Namun suasana tersebut perlahan berubah setelah para instruktur dan panitia dari Korps Marinir menghadirkan berbagai aktivitas edukatif yang dikemas secara interaktif dan menyenangkan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kepala SMK Ketintang Surabaya, Agung Nugroho, S.E., M.M, mengatakan bahwa Persami bukan hanya sekadar kegiatan berkemah, melainkan bagian dari proses pembentukan karakter peserta didik.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Persami merupakan sarana pembinaan karakter yang bertujuan menanamkan nilai disiplin, tanggung jawab, kepemimpinan, kerja sama, serta semangat cinta tanah air. Kegiatan ini sejalan dengan tujuan KKRI dalam membentuk generasi muda yang berkarakter, berjiwa patriotisme, memiliki wawasan kebangsaan, dan semangat bela negara,” ujarnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurut Agung, para peserta didorong untuk belajar mandiri, menghargai kebersamaan, meningkatkan keterampilan, serta memperkuat mental dan fisik dalam menghadapi berbagai tantangan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Selama kegiatan berlangsung, siswa mendapatkan beragam materi dan pelatihan, mulai dari Peraturan Baris-Berbaris (PBB), teknik penggunaan tongkat, keterampilan tali-temali, hingga praktik langsung menaiki tank yang berkeliling di area pangkalan Marinir.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Tak hanya itu, para peserta juga merasakan pengalaman latihan mendayung perahu yang menjadi salah satu bagian dari pembinaan ketahanan fisik dan kerja sama tim.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Setelah seluruh rangkaian kegiatan selesai, para peserta kembali menuju titik kumpul di kawasan Royal Plaza Surabaya. Dari lokasi tersebut, mereka melanjutkan perjalanan menuju sekolah dengan berjalan kaki bersama sebagai bagian dari penutupan kegiatan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Salah satu peserta KKRI, Alvian, mengaku mendapatkan pengalaman berharga selama mengikuti pembinaan di markas Marinir tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Untuk kesan saya, kegiatan ini seru banget. Kegiatannya tidak terlalu ketat sehingga siswa merasa aman dan nyaman, tetapi tetap mengajarkan kedisiplinan,” katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Melalui kegiatan ini, SMK Ketintang Surabaya berharap para siswa mampu menjadi generasi muda yang memiliki karakter kuat, disiplin tinggi, serta semangat pantang menyerah. Nilai-nilai tersebut diharapkan dapat diterapkan tidak hanya di lingkungan sekolah, tetapi juga dalam kehidupan bermasyarakat sebagai agen perubahan yang membawa dampak positif bagi lingkungan sekitar.</p>', '1781078378_6a29196a0d1be.jpg', 4, 0, 0, 0, 'naik-tank-hingga-latihan-ala-marinir-100-siswa-smk-ketintang-surabaya-digembleng-pasukan-amfibi-tni', 'publish', '2026-06-10 14:59:38', '2026-06-11 12:09:49'),
(15, 'KPK Amankan Uang dan Saldo Rekening Nyaris Rp2 Miliar dari OTT Bupati Muara Enim', 'KPK Amankan Uang dan Saldo Rekening Nyaris Rp2 Miliar dari OTT Bupati Muara Enim', 1, 6, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">JAKARTA, iNews.id -</span> Komisi Pemberantasan Korupsi (<span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/kpk\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">KPK</a></span>) menyita sejumlah <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/barang-bukti\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">barang bukti</a></span> usai melakukan rangkaian operasi tangkap tangan (OTT) di Kabupaten Muara Enim, Sumatera Selatan. Barang bukti itu berupa <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/uang-tunai\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">uang tunai</a></span> hingga saldo rekening yang nilainya hampir Rp2 miliar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Juru bicara KPK, Budi Prasetyo mengatakan uang tunai yang disita tidak hanya berbentuk mata uang rupiah. Penyidik juga mengamankan barang bukti berupa valuta asing (valas).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Barang bukti dalam bentuk uang tunai, ada rupiah, dolar, riyal, kemudian ada sejumlah rekening yang juga diamankan, di mana saldo-saldo di dalamnya total dengan uang tunai yang diamankan, senilai hampir Rp2 miliar,\" ujar Juru bicara KPK, Budi Prasetyo di Gedung Merah Putih KPK, Kuningan, Jakarta Selatan, Selasa (9/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Budi menjelaskan sejumlah rekening turut disita karena diduga digunakan sebagai rekening penampung penerimaan uang yang tidak sesuai ketentuan hukum dari pihak swasta.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Mengapa rekening-rekening ini juga turut diamankan? Karena memang para pihak ini menyiapkan rekening penampungan untuk menampung terkait dengan dugaan penerimaan dari para pihak swasta,\" imbuh Budi.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Sebagai informasi, dalam perkara ini, KPK juga telah menetapkan <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/bupati-muara-enim\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Bupati Muara Enim</a></span>, Edison sebagai tersangka. Penetapan itu dilakukan bersama tiga orang lainnya.</p>', '1781078534_6a291a0687a52.jpg', 1, 0, 0, 0, 'kpk-amankan-uang-dan-saldo-rekening-nyaris-rp2-miliar-dari-ott-bupati-muara-enim', 'publish', '2026-06-10 15:02:14', '2026-06-11 12:20:06'),
(16, 'Praja Sragen Kritik Pemkab soal Pengisian BPD, 341 Formasi Perangkat Desa Masih Kosong', 'Praja Sragen Kritik Pemkab soal Pengisian BPD, 341 Formasi Perangkat Desa Masih Kosong', 1, 6, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">SRAGEN, iNewsSragen.id</span> - <a rel=\"dofollow\" href=\"https://sragen.inews.id/tag/persatuan-perangkat-desa-indonesia\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Persatuan Perangkat Desa Indonesia</a> (<a rel=\"dofollow\" href=\"https://sragen.inews.id/tag/praja\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Praja</a>) <a rel=\"dofollow\" href=\"https://sragen.inews.id/tag/kabupaten-sragen\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Kabupaten Sragen</a> melontarkan <a rel=\"dofollow\" href=\"https://sragen.inews.id/tag/kritik\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">kritik</a> terhadap kebijakan Pemerintah Kabupaten (<a rel=\"dofollow\" href=\"https://sragen.inews.id/tag/pemkab\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Pemkab</a>) Sragen terkait terbitnya Surat Pedoman Teknis Pengisian Anggota Badan Permusyawaratan Desa (BPD) Nomor 100.1.9.7/94/019/2026 tertanggal 5 Juni 2026.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Praja menilai kebijakan tersebut menunjukkan ketidakkonsistenan pemerintah daerah dalam menyikapi kekosongan jabatan di pemerintahan desa. Selama tiga tahun terakhir, sebanyak 341 formasi perangkat desa di Kabupaten Sragen belum terisi dengan alasan terbentur regulasi. Namun di sisi lain, Pemkab Sragen justru menerbitkan pedoman teknis untuk percepatan pengisian anggota BPD.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Penasehat Praja Sragen, Sumanto, mempertanyakan dasar hukum yang digunakan Pemkab Sragen dalam menerbitkan surat pedoman pengisian BPD tersebut. Menurutnya, dasar regulasi pengisian perangkat desa maupun BPD sama-sama mengacu pada Peraturan Pemerintah (PP).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Yang menjadi pertanyaan kami, pengisian BPD saat ini dasarnya apa? Kalau mengacu pada PP, pengisian perangkat desa juga berdasarkan PP. Bobotnya mirip. Kalau BPD bisa dilaksanakan pengisiannya, kenapa perangkat desa yang sudah kosong tiga tahun lalu tidak segera diisi?” ujar Sumanto, Selasa (9/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Ia juga menyoroti langkah Pemkab Sragen yang dinilai mendahului hasil audiensi bersama ke Kementerian Dalam Negeri (Kemendagri). Sebelumnya, Praja dan Pemkab Sragen disebut telah sepakat untuk berkonsultasi bersama terkait kejelasan aturan pasca perubahan regulasi.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Faktanya kita belum ke Kemendagri, tetapi Pemda sudah membuat edaran agar BPD segera diisi. Kalau mendasari Permendagri Nomor 110 Tahun 2016, menurut kami itu sudah dibatalkan dalam PP Nomor 16,” katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Praja menegaskan bahwa tuntutan pengisian perangkat desa dilakukan demi menjaga pelayanan masyarakat di tingkat desa. Kekosongan jabatan yang berkepanjangan dinilai menyebabkan beban kerja perangkat desa yang tersisa semakin berat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Kepentingan kami adalah mengurangi beban kerja teman-teman perangkat desa yang saat ini sudah sangat berat. Ada desa yang seharusnya memiliki 10 perangkat desa, tetapi sekarang hanya tersisa empat orang. Kami hanya meminta pemerintah konsisten,” imbuhnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Sementara itu, perwakilan Praja Kecamatan Tanon, Agus Salim, menyebut sosialisasi terkait pengisian anggota BPD sudah mulai dilakukan di tingkat kecamatan. Menurutnya, sejumlah kepala desa dan sekretaris desa telah menerima undangan untuk mengikuti sosialisasi dari pihak kecamatan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Undangan dari kecamatan mulai disampaikan kemarin sore kepada kepala desa dan sekretaris desa untuk mengikuti sosialisasi pengisian BPD,” ungkap Agus.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Hingga berita ini diturunkan, Dinas Pemberdayaan Masyarakat dan Desa (PMD) Kabupaten Sragen belum memberikan keterangan resmi terkait penerbitan pedoman teknis pengisian anggota BPD tersebut maupun tanggapan atas kritik dari Praja Sragen.</p>', '1781078636_6a291a6cd28ee.jpg', 1, 0, 0, 0, 'praja-sragen-kritik-pemkab-soal-pengisian-bpd-341-formasi-perangkat-desa-masih-kosong', 'publish', '2026-06-10 15:03:56', '2026-06-11 12:20:56'),
(17, 'Pencarian Korban Ledakan Bom Sisa Perang Dunia II di Biak Numfor Ditutup, 6 Tewas', 'Pencarian Korban Ledakan Bom Sisa Perang Dunia II di Biak Numfor Ditutup, 6 Tewas', 2, 13, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">JAKARTA, iNews.id</span> - <span style=\"margin: 0px; padding: 0px; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/operasi-pencarian-dan-pertolongan\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Operasi Pencarian dan Pertolongan</a></span> (SAR) korbanledakan bom peninggalan Perang Dunia (PD) II di <span style=\"margin: 0px; padding: 0px; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/kabupaten-biak-numfor\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Kabupaten Biak Numfor</a></span>, Papua, ditutup setelah sembilan pencarian. Hingga kini, tercatat enam orang tewas dan belasan rumah rusak.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Operasi Pencarian dan Pertolongan (SAR) terhadap korban ledakan yang terjadi di Kompleks Perikanan Kabupaten Biak Numfor pada 31 Mei 2026 resmi ditutup pada Senin (8/6/2026) setelah berlangsung selama sembilan hari,” kata Kapolres Biak, AKBP Ari Trestiawan, Selasa (9/6/2026).&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Meski operasi pencarian telah berakhir, proses penyidikan dan identifikasi korban masih terus dilakukan oleh tim gabungan guna mengungkap secara menyeluruh penyebab peristiwa tersebut.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Sampai saat ini kami masih melakukan olah tempat kejadian perkara secara menyeluruh dan berkelanjutan untuk mengumpulkan seluruh petunjuk yang mengarah pada penyebab terjadinya ledakan,” ujar dia.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Kami juga masih menunggu hasil pemeriksaan Laboratorium Forensik Polri terhadap sejumlah sampel yang telah dikirim untuk diteliti lebih lanjut,\" katanya.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kasie Ops dan Siaga Basarnas Biak, Andarias Alik mengatakan, keputusan penghentian operasi pencarian diambil setelah tim tidak lagi menemukan tanda-tanda keberadaan korban maupun temuan baru di lokasi kejadian.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Pada hari kesembilan tidak ditemukan lagi serpihan maupun indikasi keberadaan korban. Berdasarkan hasil evaluasi bersama seluruh unsur yang terlibat serta keluarga korban, Operasi SAR Gabungan resmi ditutup pada 8 Juni 2026 pukul 18.20 WIT,\" katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Basarnas mencatat bahwa selama operasi berlangsung, tim gabungan berhasil menemukan enam korban meninggal dunia. Adapun tiga korban lainnya masih menunggu hasil identifikasi resmi dari Tim DVI Polri.</p>', '1781078769_6a291af1e694a.jpg', 1, 0, 0, 0, 'pencarian-korban-ledakan-bom-sisa-perang-dunia-ii-di-biak-numfor-ditutup-6-tewas', 'publish', '2026-06-10 15:06:09', '2026-06-11 12:19:06'),
(18, 'PLN Targetkan Pemulihan Kelistrikan Sumut Lebih Cepat dari Perkiraan', 'PLN Targetkan Pemulihan Kelistrikan Sumut Lebih Cepat dari Perkiraan', 1, 6, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">MEDAN, iNewsMedan.id – </span><a rel=\"dofollow\" href=\"https://medan.inews.id/tag/pln\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">PLN</a> menyatakan terus memaksimalkan percepatan pemulihan sistem kelistrikan di Sumatera Utara dan menargetkan penyelesaian pekerjaan lebih cepat dari perkiraan awal yang sebelumnya diproyeksikan hingga 14 Juni 2026.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Komitmen tersebut disampaikan manajemen PLN saat menerima kunjungan Gubernur Sumatera Utara, <a rel=\"dofollow\" href=\"https://medan.inews.id/tag/bobby-nasution\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Bobby Nasution</a>, di Kantor PLN Unit Pelaksana Pengatur Beban Sumatera Bagian Utara (UP2B Sumbagut), Medan, Senin (8/6), untuk memantau perkembangan penanganan gangguan kelistrikan akibat cuaca ekstrem yang merusak infrastruktur transmisi.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">General Manager PLN Unit Induk Distribusi Sumatera Utara, Mundhakir, mengatakan seluruh personel dan sumber daya saat ini difokuskan untuk mempercepat proses pemulihan jaringan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Berdasarkan perhitungan teknis, skenario terburuk penerapan manajemen beban diperkirakan berlangsung hingga 14 Juni 2026. Namun, seluruh tim terus bekerja maksimal agar proses pemulihan dapat diselesaikan lebih cepat,” ujar Mundhakir.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurutnya, PLN telah mengerahkan personel internal dan mitra kerja secara paralel, termasuk mempercepat pembangunan tower darurat (emergency tower) pada jalur transmisi yang terdampak hujan deras dan angin kencang pada Kamis (4/6) malam lalu.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Selain pekerjaan fisik di lapangan, PLN juga melakukan pengaturan operasi sistem secara terukur guna menjaga stabilitas pasokan listrik selama proses pemulihan berlangsung. Karena itu, manajemen beban atau pemadaman bergilir masih berpotensi diterapkan di sejumlah wilayah dengan durasi dan lokasi yang menyesuaikan kondisi sistem.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dalam kunjungan tersebut, Bobby Nasution menerima paparan mengenai perkembangan pekerjaan lapangan, mobilisasi material, hingga strategi percepatan yang sedang dijalankan PLN.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Gubernur meminta proses pemulihan dilakukan secara maksimal dan perkembangan penanganan disampaikan secara terbuka kepada masyarakat agar pelanggan memperoleh informasi yang jelas mengenai kondisi sistem kelistrikan dan tahapan perbaikannya.</p><br><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menanggapi hal itu, Mundhakir menyampaikan apresiasi atas perhatian Pemerintah Provinsi Sumatera Utara terhadap upaya percepatan pemulihan kelistrikan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Kami mengapresiasi perhatian Bapak Gubernur Sumatera Utara terhadap proses pemulihan kelistrikan. Arahan dan dukungan tersebut menjadi penguatan bagi seluruh tim PLN yang terus bekerja secara intensif untuk mempercepat penyelesaian pekerjaan,” katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Ia menegaskan percepatan pemulihan menjadi prioritas karena pasokan listrik berperan penting dalam mendukung aktivitas masyarakat, layanan publik, serta kegiatan ekonomi di Sumatera Utara.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Fokus kami adalah mempercepat pemulihan secara aman, terukur, dan berkelanjutan. Kami juga terus melakukan evaluasi agar setiap tahapan pekerjaan dapat berjalan efektif dan pelayanan kepada masyarakat kembali optimal,” pungkasnya</p>', '1781078954_6a291baaf39ba.jpg', 1, 0, 0, 0, 'pln-targetkan-pemulihan-kelistrikan-sumut-lebih-cepat-dari-perkiraan', 'publish', '2026-06-10 15:09:15', '2026-06-11 12:18:15'),
(19, 'Sehari Jadi Pelatih Persija, Shin Tae-yong Langsung Intip Timnas Indonesia di SUGBK', 'Sehari Jadi Pelatih Persija, Shin Tae-yong Langsung Intip Timnas Indonesia di SUGBK', 2, 13, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">JAKARTA, iNews.id </span>– <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/shin-taedashyong\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Shin Tae-yong</a></span> langsung menjadi sorotan sehari setelah resmi menjabat pelatih <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/persija-jakarta\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Persija Jakarta</a></span>. Dia menyaksikan laga <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/timnas-indonesia\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Timnas Indonesia</a></span> melawan Mozambik pada FIFA Matchday di Stadion Utama Gelora Bung Karno (SUGBK), Selasa (9/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Pelatih anyar Macan Kemayoran itu hadir langsung di stadion untuk memantau pertandingan internasional tersebut. Kehadiran Shin Tae-yong terjadi hanya sehari setelah dia diperkenalkan secara resmi sebagai pelatih Persija Jakarta.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Pada Senin (8/6/2026), Shin Tae-yong diumumkan menangani Persija Jakarta dengan durasi kontrak tiga tahun. Penunjukan itu langsung mengundang perhatian publik sepak bola nasional karena statusnya sebagai sosok berpengalaman di level internasional.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Berdasarkan pantauan iNews Media Group, Shin Tae-yong tiba di area stadion pada pukul 20.08 WIB, delapan menit setelah pertandingan dimulai. Dia langsung menuju tribun VIP Barat untuk menyaksikan jalannya laga.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dalam kesempatan tersebut, Shin Tae-yong tidak datang sendirian. Dia didampingi penerjemahnya, Jeong Seok Seo alias Jeje, selama berada di tribun kehormatan Stadion Utama Gelora Bung Karno.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Kehadiran Shin Tae-yong di laga internasional itu berkaitan erat dengan kepentingan Persija Jakarta. Dia memantau sejumlah pemain Persija yang masuk dalam skuad Timnas Indonesia, yakni Rizky Ridho, Dony Tri Pamungkas, Rayhan Hannan, dan Mauro Zijlstra.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"></p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Laga Timnas Indonesia melawan Mozambik menjadi pertandingan terakhir FIFA Matchday periode Juni 2026. Kedua tim berupaya meraih hasil maksimal demi tambahan poin FIFA.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Saat ini, Timnas Indonesia menempati peringkat ke-119 dunia. Sementara itu, Mozambik berada di posisi ke-102 peringkat FIFA, sehingga laga tersebut memiliki arti penting bagi kedua negara.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"></p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Sebelum menghadapi Mozambik, Timnas Indonesia meraih kemenangan 3-0 atas Oman dalam laga FIFA Matchday yang juga digelar di Stadion Utama Gelora Bung Karno pada pekan sebelumnya.</p>', '1781079109_6a291c456a625.jpg', 1, 0, 0, 0, 'sehari-jadi-pelatih-persija-shin-tae-yong-langsung-intip-timnas-indonesia-di-sugbk', 'publish', '2026-06-10 15:11:49', '2026-06-11 12:19:34'),
(20, 'Harapan Menteri KKP Meleset, Kampung Nelayan Merah Putih Waingapu Baru Capai 80 Persen', 'Harapan Menteri KKP Meleset, Kampung Nelayan Merah Putih Waingapu Baru Capai 80 Persen', 2, 14, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">WAINGAPU, iNewsSumba.id</span> – Asa menjadikan <a rel=\"dofollow\" href=\"https://sumba.inews.id/tag/kampung-nelayan-merah-putih\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Kampung Nelayan Merah Putih</a> (KNMP) di Kelurahan Kamalaputi, Kota Waingapu, Kabupaten Sumba Timur, sebagai salah satu proyek percontohan sektor kelautan dan perikanan di Nusa Tenggara Timur belum sepenuhnya terwujud sesuai jadwal.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Proyek yang sebelumnya ditargetkan rampung pada akhir Mei 2026 atas arahan Menteri Kelautan dan Perikanan, Sakti Wahyu Trenggono, hingga awal Juni ini masih berada pada tahap penyelesaian akhir atau finishing.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kondisi tersebut berbanding dengan komitmen yang pernah disampaikan kontraktor pelaksana, <a rel=\"dofollow\" href=\"https://sumba.inews.id/tag/pt-dewata-teknik\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">PT Dewata Teknik</a>, di hadapan <a rel=\"dofollow\" href=\"https://sumba.inews.id/tag/menteri-kkp\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Menteri KKP</a> saat kunjungan kerja pada Februari lalu.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kala itu, Direktur PT Dewata Teknik, I Gede Suwarsana, memastikan pihaknya akan melakukan percepatan pekerjaan agar proyek dapat selesai sesuai target. “Kami sudah siapkan skema percepatan. Target kami akhir Mei 2026 selesai,” kata Suwarsana saat mendampingi kunjungan Menteri KKP pada 26 Februari 2026.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Namun di lapangan, target tersebut belum tercapai. Site Manager PT Dewata Teknik, Samsuri, mengakui progres pembangunan saat ini baru mencapai sekitar 80 persen.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurutnya, faktor cuaca menjadi hambatan terbesar yang mempengaruhi ritme pekerjaan konstruksi. “Kendala terbesarnya adalah cuaca. Kami buat target baru Juli 2026 ini rampung,” ujar Samsuri kepada wartawan di lokasi proyek.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Ia menjelaskan, sejumlah pekerjaan utama sebenarnya telah memasuki tahap akhir. Akan tetapi, masih terdapat beberapa item pekerjaan yang membutuhkan penyelesaian lebih lanjut. “Yang belum rampung yakni pekerjaan jalan dan juga penerangan. Kalau pekerjaan yang lain rata-rata sudah finishing,” jelasnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Samsuri mengatakan curah hujan yang turun secara tidak menentu membuat sejumlah pekerjaan teknis terhambat. Bahkan pekerjaan penggalian yang dilakukan saat cuaca cerah sering kali terhenti karena hujan deras yang datang mendadak.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Akibat kondisi tersebut, area pekerjaan kerap tergenang sehingga harus dilakukan penyedotan air sebelum pekerjaan kembali dilanjutkan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Karena faktor cuaca tersebut, pihak kontraktor mengajukan addendum waktu pelaksanaan pekerjaan kepada Pejabat Pembuat Komitmen (PPK) dan telah memperoleh persetujuan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Jika seluruh pekerjaan berjalan sesuai rencana, <a rel=\"dofollow\" href=\"https://sumba.inews.id/tag/knmp-kamalaputi\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">KNMP Kamalaputi</a> ditargetkan dapat beroperasi penuh pada Juli 2026 sebagai pusat aktivitas ekonomi nelayan di Kota Waingapu.</p>', '1781079247_6a291ccfd3467.jpg', 2, 0, 0, 0, 'harapan-menteri-kkp-meleset-kampung-nelayan-merah-putih-waingapu-baru-capai-80-persen', 'publish', '2026-06-10 15:14:07', '2026-06-11 12:02:57'),
(21, 'Usai Paksa Israel Setop Serang Iran, Trump Klaim Perundingan Damai Bisa Diteken dalam 3 Hari', 'Usai Paksa Israel Setop Serang Iran, Trump Klaim Perundingan Damai Bisa Diteken dalam 3 Hari', 2, 14, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">WASHINGTON, iNews.id</span> - Presiden <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/amerika-serikat\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Amerika Serikat</a></span> (AS) <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/donald-trump\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Donald Trump</a></span> menegaskan perundingan damai dengan <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/iran\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Iran</a></span> berlanjut setelah Iran dan <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/israel\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Israel</a></span> sepakat menghentikan serangan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Trump, dalam pernyataannya kepada wartawan setelah menghadiri &nbsp;laga final NBA di New York, mengatakan negosiasi dengan Iran masih berlangsung, termasuk membahas soal nuklir. Dia mengatakan, perundingan tidak berhenti selama perang Iran-Israel pada Minggu dan Senin.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Bahkan, Trump yakin kesepakatan untuk mengakhiri perang bisa dicapai dalam 2 atau 3 hari mendatang.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Kita berada di tahap akhir, dari apa yang akan menjadi kesepakatan sangat, sangat baik, yang tidak akan memungkinkan senjata nuklir, dll,\" kata Trump, seperti dikutip dari Anadolu, Selasa (9/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dia mengeklaim, Iran juga setuju untuk segera membuka Selat Hormuz.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"...Penandatanganan, yang bisa terjadi dalam 2 atau 3 hari,\" ujarnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Ketegangan meningkat sejak AS dan Israel melancarkan serangan ke Iran pada 28 Februari. Gencatan senjata yang ditengahi Pakistan, berlaku pada 8 April, mengalami ujian terberat setelah Israel mengebom ibu kota Lebanon, Beirut, yang memicu pembalasan Iran pada Minggu (7/6/2026) malam.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Beberapa jam kemudian atau pada Senin dini hari, Israel menyerang Iran dalam beberapa gelombang.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Di hari yang sama, Militer Iran mengumumkan penghentian serangan terhadap Israel. Meski demikian Iran memperingatkan akan kembali menyerang lebih keras dan menghancurkan jika Israel melanjutkan serangannya terhadap Lebanon.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Israel juga setuju menghentikan serangan terhadap Iran, setelah Trump berbicara dengan Perdana Menteri <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/benjamin-netanyahu\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Benjamin Netanyahu</a></span>, namun akan terus melanjutkan operasi militer di Lebanon Selatan.</p>', '1781079401_6a291d692bf24.jpg', 8, 0, 0, 0, 'usai-paksa-israel-setop-serang-iran-trump-klaim-perundingan-damai-bisa-diteken-dalam-3-hari', 'publish', '2026-06-10 15:16:41', '2026-06-11 12:30:51');
INSERT INTO `post` (`id`, `post_title`, `post_sub_title`, `post_category_id`, `post_subcategory_id`, `role_id`, `user_id`, `post_desc`, `post_image`, `total_views`, `total_comments`, `total_likes`, `total_bookmarks`, `slug`, `status`, `created_at`, `update_at`) VALUES
(22, 'Butuh Rujukan Darurat, Keluarga Pasien Keluhkan Sulitnya Akses Ambulans RSUD Bukittinggi', 'Butuh Rujukan Darurat, Keluarga Pasien Keluhkan Sulitnya Akses Ambulans RSUD Bukittinggi', 2, 14, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">BUKITTINGGI, iNewsPadang.id</span> — Keluarga seorang pasien asal Gadut, <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/kabupaten-agam\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Kabupaten Agam</a>, Sumatra barat, mengeluhkan pelayanan di Instalasi Gawat Darurat (IGD) <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/rsud-bukittinggi\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">RSUD Bukittinggi</a> setelah kerabat mereka diduga harus menunggu sekitar dua jam untuk proses penanganan lanjutan dan rujukan medis.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Keluhan tersebut disampaikan Januar (54), keluarga pasien bernama Amril (68), yang mengalami kecelakaan di rumah pada Senin (8/6/2026) sore dan segera dibawa ke IGD RSUD Bukittinggi di kawasan Bypass Gulai Bancah.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurut Januar, sesampainya di <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/rumah-sakit\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">rumah sakit</a>, Amril mendapatkan penanganan awal berupa pemasangan perban pada luka di kepala serta pemotongan rambut di area yang mengalami cedera. Setelah dilakukan pemeriksaan, pihak rumah sakit menyatakan pasien perlu dirujuk ke rumah sakit lain karena keterbatasan fasilitas penunjang.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Setelah diperiksa, kami diberitahu bahwa pasien harus dirujuk karena di RSUD belum ada CT Scan. Namun yang kami sesalkan, pasien tidak segera diberangkatkan,\" kata Januar, Selasa (9/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Ia mengaku keluarga berharap pasien dapat segera dibawa menggunakan ambulans yang tersedia di rumah sakit. Namun, menurutnya, terdapat sejumlah persyaratan administrasi yang harus dipenuhi terlebih dahulu sebelum ambulans dapat digunakan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Karena khawatir kondisi pasien memburuk, keluarga akhirnya mencari ambulans secara mandiri dan memperoleh bantuan dari Ambulans Masjid Jamiyatul Abrar di Aro Kandikia, Nagari Gadut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Yang kami pertanyakan adalah sisi kemanusiaannya. Jika memang ada administrasi atau biaya yang harus diselesaikan, seharusnya itu bisa dilakukan setelah pasien diantar. Keselamatan pasien mestinya menjadi prioritas,\" ujarnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Januar juga mengungkapkan, setelah tiba di rumah sakit tujuan, keluarga kembali menghadapi kendala karena dokter jaga mempertanyakan kelengkapan dokumen rujukan dari rumah sakit sebelumnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menanggapi keluhan tersebut, pihak RSUD Bukittinggi menegaskan seluruh proses pelayanan telah dilakukan sesuai standar operasional prosedur (SOP) yang berlaku.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kepala Bagian Tata Usaha RSUD Bukittinggi, Feli, didampingi Kabid Pelayanan dr Yeva, Kabid Keperawatan Sri Wahyuni Y, Kasubag Humas Fatma Idola, dan Kasi Pelayanan dr Ermalinda, menjelaskan bahwa pasien langsung mendapatkan penanganan medis setibanya di IGD.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurut pihak rumah sakit, hasil pemeriksaan menunjukkan pasien memiliki riwayat gangguan jantung sehingga diperlukan pemeriksaan lanjutan menggunakan CT Scan, sementara fasilitas tersebut belum tersedia di RSUD Bukittinggi.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Pasien sudah kami terima dan langsung ditindaklanjuti. Karena RSUD belum memiliki CT Scan, kami mengupayakan rujukan ke RSAM. Namun proses rujukan membutuhkan waktu, sementara keluarga menginginkan pasien segera berangkat sehingga disarankan menggunakan ambulans secara mandiri,\" jelas Feli.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">RSUD Bukittinggi diketahui memiliki sejumlah unit ambulans operasional, termasuk kendaraan bantuan dari Yayasan Prabowo Subianto, BRI Peduli, dan Bank Nagari.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Keluhan terkait prosedur penggunaan ambulans juga pernah disampaikan warga lainnya. Debi, warga Kelurahan Tarok Dipo, Kecamatan Guguk Panjang, mengaku pernah mengalami kesulitan serupa saat hendak melahirkan anak keduanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Sewaktu saya akan melahirkan anak kedua tidak bisa pakai ambulans yang standby, padahal sakit sudah tak tertahankan. Saya disuruh pindah rumah sakit dan akhirnya memesan kendaraan ojek daring,\" kenangnya mengingat peristiwa yang terjadi delapan bulan yang lalu.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Peristiwa tersebut menambah sorotan terhadap pelayanan rujukan dan akses transportasi medis bagi pasien dalam kondisi darurat. Keluarga pasien berharap prosedur administrasi dan penerapan SOP tetap memperhatikan aspek keselamatan serta kebutuhan mendesak pasien agar penanganan medis dapat berlangsung lebih cepat dan efektif.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><br></p>', '1781079579_6a291e1bd3d30.jpg', 1, 0, 0, 0, 'butuh-rujukan-darurat-keluarga-pasien-keluhkan-sulitnya-akses-ambulans-rsud-bukittinggi', 'publish', '2026-06-10 15:19:39', '2026-06-11 12:18:54'),
(23, 'Sejarah Baru Pemulihan Bencana, Hunian Tetap Pertama di Sumbar Hadir untuk Anak Yatim', 'Sejarah Baru Pemulihan Bencana, Hunian Tetap Pertama di Sumbar Hadir untuk Anak Yatim', 1, 10, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">AGAM, iNEWSDPadang.ID</span> —<span style=\"margin: 0px; padding: 0px; font-weight: 700;\"> </span><a rel=\"dofollow\" href=\"https://padang.inews.id/tag/hunian-tetap\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Hunian tetap</a> pertama di <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/sumatera-barat\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Sumatera Barat</a> (Sumbar) resmi dihadirkan bagi korban longsor dan banjir bandang di Nagari <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/sungai-landia\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Sungai Landia</a>, <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/kabupaten-agam\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Kabupaten Agam</a>. Program kemanusiaan yang menjadi tonggak baru penanganan pascabencana di Sumbar ini diresmikan pada Senin (12/1/2026) dan secara khusus diperuntukkan bagi anak-<a rel=\"dofollow\" href=\"https://padang.inews.id/tag/anak-yatim\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">anak yatim</a> yang kehilangan rumah akibat <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/bencana-alam\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">bencana alam</a>.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Peresmian berlangsung khidmat dan penuh haru. Hunian tetap tersebut diinisiasi oleh Founder Yayasan Peduli Negeri (Ashpen), Zulfamiadi, bekerja sama dengan Karang Waluh Group dari Kalimantan Selatan (Kalsel). Kehadiran hunian ini sekaligus menandai dimulainya pendekatan pemulihan jangka panjang berbasis hunian permanen di Sumbar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kegiatan ini dihadiri berbagai unsur pemerintah dan masyarakat. Pemerintah Provinsi Sumatera Barat diwakili Kepala Dinas Perumahan dan Kawasan Permukiman Sumbar Ahdiyarsyah. Turut hadir perwakilan Kakanwil Sumbar, Pemerintah Kabupaten Agam yang diwakili Staf Ahli Bidang Kemasyarakatan dan SDM Taslim, S.Pd., M.Pd., Camat IV Koto, Subchan, unsur kebencanaan, Wali Nagari Sungai Landia, tokoh masyarakat, serta tamu undangan lainnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Zulfamiadi dalam sambutannya menegaskan bahwa hunian tetap ini bukan sekadar bangunan fisik, melainkan bentuk kepedulian dan harapan baru bagi anak-anak yang terdampak langsung bencana. Ia menyampaikan bahwa anak yatim menjadi prioritas utama karena tanpa figur orang tua sekaligus kehilangan tempat berlindung.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Hunian tetap ini kami berikan untuk anak-anak yatim yang di tempat laimn di Malalo, Tanah Datar bahkan juga kehilangan orang tuanya akibat bencana. Ini adalah doa dan ikhtiar dari orang-orang baik, agar mereka tetap memiliki harapan dan tempat tinggal yang aman,” ujar Zulfamiadi.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Sementara itu, Taslim menyebut Kabupaten Agam termasuk wilayah yang cukup sering terdampak bencana alam dalam beberapa waktu terakhir. Sejumlah kecamatan seperti Palembayan, Matur, Palupuh, hingga Sungai Landia mengalami dampak serius, baik dari banjir bandang maupun longsor.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dia menjelaskan bahwa pemerintah daerah terus berupaya melakukan pemulihan pascabencana melalui pembangunan hunian sementara dan penyusunan solusi jangka panjang. Kehadiran hunian tetap pertama di Sumbar ini dinilai menjadi langkah strategis sekaligus contoh kolaborasi lintas daerah yang patut diapresiasi.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Atas nama Pemerintah Kabupaten Agam, kami menyampaikan terima kasih dan apresiasi setinggi-tingginya kepada Karang Waluh Group dari Kalimantan Selatan serta seluruh pihak yang telah berkontribusi. Bantuan hunian tetap ini sangat berarti bagi warga kami yang terdampak bencana,” kata Taslim.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dengan diresmikannya hunian tetap pertama di Sumatera Barat ini, diharapkan proses pemulihan kehidupan korban bencana, khususnya anak-anak yatim, dapat berjalan lebih berkelanjutan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Program ini juga diharapkan menjadi model penanganan pascabencana berbasis kemanusiaan dan gotong royong, sekaligus memperkuat solidaritas antar daerah dalam menghadapi risiko bencana alam.</p>', '1781079705_6a291e998070e.jpg', 4, 0, 0, 0, 'sejarah-baru-pemulihan-bencana-hunian-tetap-pertama-di-sumbar-hadir-untuk-anak-yatim', 'publish', '2026-06-10 15:21:45', '2026-06-11 17:55:19'),
(24, 'Bukittinggi Bidik Prestasi Provinsi Lewat Inovasi Literasi dan Pemberdayaan TP PKK Puhun Pintu Kabun', 'Bukittinggi Bidik Prestasi Provinsi Lewat Inovasi Literasi dan Pemberdayaan TP PKK Puhun Pintu Kabun', 1, 9, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">BUKITTINGGI, iNewsPadang.id</span> — Tim Penggerak Pemberdayaan dan Kesejahteraan Keluarga (TP PKK) Kelurahan <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/puhun-pintu-kabun\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Puhun Pintu Kabun</a>, Kecamatan Mandiangin Koto Selayan, mewakili Kota Bukittinggi dalam penilaian Lomba Gerakan PKK Tingkat Provinsi <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/sumatera-barat\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Sumatera Barat</a> Tahun 2026. Kegiatan penilaian berlangsung di Kelurahan Puhun Pintu Kabun, Selasa (2/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kehadiran tim penilai provinsi disambut oleh jajaran Pemerintah Kota Bukittinggi, TP PKK Kota Bukittinggi, perangkat kecamatan dan kelurahan, serta berbagai unsur masyarakat yang terlibat dalam pelaksanaan program PKK.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Wakil Wali Kota Bukittinggi, <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/ibnu-asis\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Ibnu Asis</a>, menyampaikan apresiasi kepada seluruh jajaran TP PKK mulai dari tingkat kelurahan, kecamatan hingga kota yang telah mempersiapkan penilaian secara maksimal sesuai indikator yang ditetapkan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurutnya, berbagai capaian yang diraih tidak terlepas dari koordinasi dan kolaborasi berbagai pihak dalam mendukung program <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/pemberdayaan-keluarga\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">pemberdayaan keluarga</a> di tengah masyarakat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Kami mengapresiasi kerja keras seluruh jajaran TP PKK yang telah mempersiapkan penilaian ini dengan baik. Capaian yang ada merupakan hasil sinergi dan kolaborasi seluruh pemangku kepentingan,\" ujar Ibnu Asis.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Ia menegaskan Pemerintah Kota Bukittinggi melalui seluruh perangkat daerah siap memberikan dukungan terhadap berbagai program dan kegiatan PKK guna mewujudkan masyarakat yang lebih maju, sejahtera, dan berdaya saing.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Sementara itu, Ketua TP PKK Kota Bukittinggi, Ny. Yesi Ramlan Nurmatias, menjelaskan bahwa Gerakan PKK merupakan mitra strategis pemerintah dalam memperkuat ketahanan keluarga melalui pelaksanaan 10 Program Pokok PKK.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurutnya, berbagai program tersebut diarahkan untuk meningkatkan kualitas pendidikan, kesehatan, ekonomi keluarga, serta pelestarian lingkungan yang berkelanjutan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Ketua Bidang IV TP PKK Provinsi Sumatera Barat, Ny. Ermawati, mengatakan Gerakan PKK tumbuh dari, oleh, dan untuk masyarakat sehingga memiliki peran penting dalam mendukung pembangunan keluarga yang berkualitas.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dalam kesempatan itu, ia mengapresiasi berbagai inovasi yang telah dikembangkan TP PKK Kelurahan Puhun Pintu Kabun, khususnya pada bidang pendidikan, literasi, dan pemberdayaan masyarakat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Ny. Ermawati juga menekankan pentingnya penguatan program pencegahan stunting, pengendalian tuberkulosis (TBC), serta upaya mengurangi paparan asap rokok di lingkungan keluarga sebagai bagian dari pembangunan sumber daya manusia yang sehat dan produktif.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Penilaian tingkat provinsi ini menjadi momentum bagi TP PKK Kelurahan Puhun Pintu Kabun untuk menunjukkan berbagai praktik baik yang telah dijalankan bersama masyarakat. Selain menjadi ajang evaluasi, kegiatan tersebut diharapkan mampu mendorong peningkatan kualitas program PKK serta memperkuat peran keluarga sebagai fondasi pembangunan daerah.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><br></p>', '1781079850_6a291f2a6d543.jpg', 3, 0, 0, 0, 'bukittinggi-bidik-prestasi-provinsi-lewat-inovasi-literasi-dan-pemberdayaan-tp-pkk-puhun-pintu-kabun', 'publish', '2026-06-10 15:24:10', '2026-06-11 17:31:10'),
(25, 'Flyover Padang Luar Terancam Batal, Relokasi Pasar Dinilai Tak Lagi Relevan', 'Flyover Padang Luar Terancam Batal, Relokasi Pasar Dinilai Tak Lagi Relevan', 1, 9, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">AGAM, iNewsPadang.id</span> — Pemerintah Kabupaten Agam, <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/sumatera-barat\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Sumatera Barat</a>, tengah melakukan kajian mendalam terkait keberlanjutan proyek pembangunan jalan layang (flyover) di kawasan Pasar Padang Luar. Kajian itu dilakukan setelah muncul aturan dari Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR) yang melarang adanya aktivitas publik di bawah struktur flyover.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Bupati Agam, <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/benni-warlis\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Benni Warlis</a> mengatakan bahwa pembahasan lanjutan proyek tersebut telah dilakukan melalui rapat bersama sejumlah pihak di Kota Bukittinggi, Rabu (20/5). Rapat dihadiri unsur Pemerintah Provinsi Sumatera Barat, Balai Jalan, PT Kereta Api Indonesia (KAI), Kejaksaan Tinggi, Dinas Perdagangan, serta instansi terkait lainnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurut Benni, pembahasan berfokus pada sinkronisasi antara rencana pembangunan infrastruktur dengan keberadaan pasar yang selama ini menjadi pusat aktivitas masyarakat di bawah kawasan yang direncanakan untuk flyover.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Berdasarkan peraturan dari Kementerian PUPR, area di bawah flyover harus steril dari aktivitas publik, termasuk kegiatan berdagang. Konsekuensinya, pasar yang saat ini berada di lokasi tersebut wajib direlokasi ke tempat yang baru,” ujar Benni.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kondisi itu memunculkan dilema dalam proses pengambilan kebijakan. Sebab, <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/relokasi-pasar\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">relokasi pasar</a> dinilai berpotensi menghilangkan sumber utama kemacetan yang selama ini menjadi alasan pembangunan flyover di kawasan Padang Luar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Kalau pasar direlokasi untuk flyover, untuk apa lagi kita buat flyover? Kalau pasar dipindah, area tersebut tentu tidak akan macet lagi. Logikanya kan seperti itu,” katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Benni mengakui informasi hasil rapat sebelumnya sempat terlambat disampaikan kepada publik sehingga menimbulkan kesan kurang serius dalam penanganan proyek tersebut. Meski demikian, ia memastikan pemerintah daerah tetap berkomitmen mencari solusi terbaik agar persoalan kemacetan dapat diatasi tanpa menimbulkan persoalan baru bagi masyarakat dan pedagang.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dia juga mengapresiasi dukungan berbagai pihak, termasuk anggota DPR RI Andre Rosiade, yang ikut mendorong pembahasan solusi untuk kawasan Padang Luar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Selain opsi relokasi pasar, dalam pembahasan juga muncul usulan alternatif berupa pengalihan jalur exit tol melalui bypass yang berada dekat kawasan Pasar Padang Luar. Opsi itu dinilai dapat menjadi solusi kemacetan tanpa harus membangun konstruksi flyover yang membutuhkan anggaran besar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Jika usulan jalur bypass untuk exit tol ini dapat direalisasikan, maka kompleksitas permasalahan kemacetan dinilai akan selesai tanpa harus mengorbankan anggaran besar untuk konstruksi fisik yang tumpang tindih,” ucap Benni.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Hingga kini, Pemerintah Kabupaten Agam masih menunggu hasil kajian lanjutan dan sinkronisasi kebijakan bersama pemerintah pusat sebelum memutuskan arah final proyek flyover tersebut.</p>', '1781079976_6a291fa892bb9.jpg', 2, 0, 0, 0, 'flyover-padang-luar-terancam-batal-relokasi-pasar-dinilai-tak-lagi-relevan', 'publish', '2026-06-10 15:26:16', '2026-06-11 12:20:48'),
(26, 'Tinjau SMAN 1 Palupuh, Anggota Dewan Syafril Dt Rajo Api Dorong Perhatian pada Sarana Sekolah', 'Tinjau SMAN 1 Palupuh, Anggota Dewan Syafril Dt Rajo Api Dorong Perhatian pada Sarana Sekolah', 2, 14, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">AGAM, iNewsPadang.id</span> — Anggota DPRD Kabupaten Agam, <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/syafril-dt-rajo-api\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Syafril Dt Rajo Api</a>, melakukan kunjungan silaturahmi ke <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/sma-negeri-1-palupuh\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">SMA Negeri 1 Palupuh</a> pada Senin, 18 Mei 2026. Kunjungan tersebut dilakukan untuk mempererat hubungan dengan pihak sekolah sekaligus melihat secara langsung kondisi sarana dan prasarana pendidikan di sekolah tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dalam kunjungan itu, Syafril meninjau sejumlah fasilitas sekolah dan berdialog dengan pihak sekolah mengenai kebutuhan serta kondisi lingkungan belajar siswa. Ia menilai perhatian terhadap dunia pendidikan harus menjadi tanggung jawab bersama, terutama dalam memastikan fasilitas sekolah tetap layak dan nyaman digunakan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">“Kita berharap sarana dan prasarana sekolah tersebut terus mendapatkan perhatian agar kegiatan belajar mengajar berjalan nyaman dan maksimal,” ujar Syafril Dt Rajo Api, Selasa (19/5/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurutnya, kualitas fasilitas pendidikan memiliki peran penting dalam mendukung proses belajar mengajar dan menciptakan lingkungan sekolah yang kondusif bagi siswa maupun tenaga pendidik. Karena itu, ia berharap adanya perhatian berkelanjutan terhadap pengembangan infrastruktur pendidikan di wilayah Kabupaten Agam, khususnya di Kecamatan Palupuh.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Pihak SMA Negeri 1 Palupuh menyambut baik kedatangan anggota DPRD tersebut. Kunjungan itu dinilai menjadi bentuk perhatian terhadap dunia pendidikan sekaligus membuka ruang komunikasi antara sekolah dan wakil rakyat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kegiatan berlangsung dalam suasana akrab dan penuh kekeluargaan. Selain menjadi ajang silaturahmi, pertemuan tersebut juga diharapkan mampu memperkuat sinergi antara pemerintah daerah dan lingkungan pendidikan demi peningkatan kualitas pendidikan di Kabupaten Agam</p>', '1781080083_6a29201375a87.jpg', 3, 0, 0, 0, 'tinjau-sman-1-palupuh-anggota-dewan-syafril-dt-rajo-api-dorong-perhatian-pada-sarana-sekolah', 'publish', '2026-06-10 15:28:03', '2026-06-11 12:12:31'),
(27, 'FIFA Matchday Juni 2026 Tuntas, Kapan Timnas Indonesia Main Lagi?', 'FIFA Matchday Juni 2026 Tuntas, Kapan Timnas Indonesia Main Lagi?', 1, 7, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">AKARTA, iNews.id </span>– <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/timnas-indonesia\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Timnas Indonesia</a></span> menutup <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/fifa-matchday\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">FIFA Matchday</a></span> Juni 2026 dengan performa meyakinkan. Garuda meraih dua kemenangan beruntun dan langsung mengalihkan fokus ke <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/piala-aff-2026\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Piala AFF 2026</a></span> sebagai agenda terdekat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dua hasil positif membuat kepercayaan diri skuad Garuda melonjak. Setelah menghajar Oman tiga gol tanpa balas, tim Merah Putih kembali tampil dominan saat menundukkan Mozambik, sekaligus memperpanjang tren tak terkalahkan pada periode internasional ini.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Rentetan kemenangan itu berdampak langsung ke posisi di ranking FIFA. Timnas Indonesia kini menghuni peringkat 118 dunia, melonjak empat strip dibanding posisi sebelumnya, sebuah sinyal progres signifikan di bawah arahan pelatih <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/john-herdman\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">John Herdman</a></span>.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Kinerja solid tersebut menjadi modal penting jelang agenda berikutnya. Setelah FIFA Matchday berakhir, Rizky Ridho dan kawan-kawan bersiap tampil pada Piala AFF edisi ke-16 yang dijadwalkan bergulir mulai akhir Juli 2026.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Pada turnamen regional itu, Timnas Indonesia tergabung di Grup A. Persaingan dipastikan ketat karena dia harus berhadapan dengan Vietnam, Singapura, Kamboja, dan Timor Leste.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Laga pembuka langsung mempertemukan Indonesia dengan Kamboja. Pertandingan tersebut dijadwalkan berlangsung pada 27 Juli 2026 di Stadion Pakansari, Cibinong, Bogor, sekaligus menjadi ujian awal konsistensi performa pasca FIFA Matchday.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Setelah itu, perjalanan Garuda berlanjut menghadapi Timor Leste, Vietnam, lalu Singapura secara beruntun. Jadwal padat ini menuntut kesiapan fisik dan mental tinggi dari seluruh pemain.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Indonesia berstatus tuan rumah saat menjamu Vietnam dan kembali menggunakan Stadion Pakansari sebagai kandang. Sementara saat menghadapi Timor Leste dan Singapura, skuad asuhan Herdman harus tampil sebagai tim tamu.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dengan ranking FIFA yang terus membaik dan performa yang stabil, publik menaruh ekspektasi besar. Piala AFF 2026 menjadi panggung pembuktian lanjutan, sekaligus tolok ukur kekuatan Timnas Indonesia di level Asia Tenggara.</p><h2 style=\"margin: 0px; padding: 0px; font-size: clamp(20px, 2vw, 24px); font-weight: 700; line-height: 36px; color: rgb(0, 0, 0); font-family: MNCSansRegular, sans-serif;\">Jadwal Timnas Indonesia di Fase Grup Piala AFF 2026:</h2><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">27 Juli 2026: Timnas Indonesia vs Kamboja<br style=\"margin: 0px; padding: 0px;\">31 Juli 2026: Timor Leste vs Timnas Indonesia<br style=\"margin: 0px; padding: 0px;\">3 Agustus 2026: Timnas Indonesia vs Vietnam<br style=\"margin: 0px; padding: 0px;\">7 Agustus 2026: Singapura vs Timnas Indonesia</p>', '1781080239_6a2920af66e44.jpg', 1, 0, 0, 0, 'fifa-matchday-juni-2026-tuntas-kapan-timnas-indonesia-main-lagi', 'publish', '2026-06-10 15:30:39', '2026-06-11 12:18:31'),
(28, 'Intimidasi Iran, Trump Sebut Rudal AS Jatuh hanya 60 Km dari Ibu Kota Teheran', 'Intimidasi Iran, Trump Sebut Rudal AS Jatuh hanya 60 Km dari Ibu Kota Teheran', 1, 6, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">WASHINGTON, iNews.id</span> - Presiden <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/amerika-serikat\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Amerika Serikat</a></span> (AS) <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/donald-trump\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Donald Trump</a></span> menegaskan militermya akan kembali menyerang <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/iran\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Iran</a></span> pada Kamis (11/6/2026) jika negara itu tetap menolak menandatangani kesepakatan damai bersadarkan proposal yang diajukan negosiatornya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dikutip dari Fox News, menggunakan kata-kata kasar, Trump memperbarui ancamannya tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Trump juga mengeklaim, sebanyak 49 rudal Tomahawk digunakan untuk menyerang target di wilayah Iran dalam serangan terbaru pada Rabu (10/6/2026) malam waktu setempat. Beberapa di antaranya jatuh berjarak hanya 64 km dari jantung Ibu Kota Teheran.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Presiden mengatakan jet tempur AS juga beroperasi di atas langit Iran, menghancurkan sistem radar dan sistem pertahanan udara di sebelah barat daya negara itu, dekat dengan Teluk Persia,\" demikian laporan Fox News.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Trump lalu mengeklaim, para pejabat tinggi Iran menghubunginya dan meminta AS untuk menghentikan pemboman.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dalam wawancara dengan Al Jazeera, seorang pejabat membantah keras, memastikan tak ada komunikasi apa pun dengan Trump maupun pejabat AS lainnya saat ini.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Dia menegaskan apa yang terjadi di Iran saat ini hanya fokus &nbsp;membela diri dan mempersiapkan pembalasan yang dahsyat terhadap AS.</p>', '1781146470_6a2a2366b9b68.jpg', 1, 0, 0, 0, 'intimidasi-iran-trump-sebut-rudal-as-jatuh-hanya-60-km-dari-ibu-kota-teheran', 'publish', '2026-06-11 09:54:30', '2026-06-11 12:17:58'),
(29, 'Sidang Perdana Gugatan Hak Angket DPRD Gowa Ditunda, Para Tergugat Tak Hadir', 'Sidang Perdana Gugatan Hak Angket DPRD Gowa Ditunda, Para Tergugat Tak Hadir', 3, 16, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">GOWA, iNewsCelebes.id - </span>Pengadilan Negeri (PN) Sungguminasa menggelar sidang perdana gugatan Perbuatan Melawan Hukum (PMH) Nomor 61/Pdt.G/2026/PN Sgm yang diajukan Masnawi Muhiddin terhadap DPRD <a rel=\"dofollow\" href=\"https://celebes.inews.id/tag/kabupaten-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Kabupaten Gowa</a>, Ketua DPRD Kabupaten Gowa, dan Panitia Khusus (Pansus) Hak Angket DPRD Kabupaten Gowa, Rabu (10/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Sidang perdana ini belum memasuki pokok perkara lantaran para tergugat tidak hadir dalam persidangan. Sementara pihak penggugat hadir melalui tim kuasa hukumnya Muallim bahar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Atas ketidakhadiran para tergugat, Majelis Hakim memutuskan menunda persidangan dan menjadwalkan sidang lanjutan pada 24 Juni 2026 guna memberikan kesempatan pemanggilan kembali sesuai ketentuan hukum acara perdata yang berlaku.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Kuasa Hukum Penggugat, Muallim bahar, mengatakan pihaknya menghormati keputusan majelis hakim dan tetap menaruh kepercayaan terhadap independensi <a rel=\"dofollow\" href=\"https://celebes.inews.id/tag/pn-sungguminasa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">PN Sungguminasa</a> dalam memeriksa perkara tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">\"Kami menghormati proses hukum yang sedang berjalan dan menghormati keputusan Majelis Hakim untuk melanjutkan persidangan pada tanggal 24 Juni 2026, kami berharap seluruh pihak dapat hadir dan memberikan penjelasan secara terbuka di hadapan pengadilan demi terciptanya kepastian hukum,\" ujar Muallim bahar kepada awak media usai persidangan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Menurut Muallim, gugatan tersebut tidak semata menyangkut kepentingan pribadi penggugat, melainkan juga berkaitan dengan batas kewenangan lembaga legislatif dalam menggunakan instrumen hak angket dalam sistem pemerintahan daerah.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Ia menilai masyarakat perlu memperoleh pemahaman yang jelas mengenai batas-batas kewenangan DPRD sebagaimana diatur dalam peraturan perundang-undangan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Muallim Bahar, menyebut perkara tersebut memiliki dimensi kepentingan publik yang besar karena menyangkut tafsir hukum terhadap penggunaan hak angket DPRD yang belakangan menjadi perhatian masyarakat Kabupaten Gowa.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">\"Perkara ini bukan hanya menyangkut kepentingan Penggugat semata. Yang sedang diuji adalah bagaimana batas kewenangan lembaga legislatif daerah dalam menjalankan fungsi pengawasannya.\" katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">\"Oleh karena itu, hasil perkara ini berpotensi menjadi rujukan penting bagi praktik demokrasi dan tata kelola pemerintahan daerah ke depan,\" sambung Muallim.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Muallim juga berharap proses persidangan dapat berlangsung secara terbuka dan memberikan akses informasi yang luas kepada masyarakat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">\"Kami berharap persidangan ini dapat diakses secara terbuka oleh masyarakat dan media massa sesuai kebijakan serta kewenangan pengadilan.\" harapnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Menurut Muallim, keterbukaan persidangan penting mengingat substansi perkara berkaitan dengan kepentingan publik dan menjadi perhatian masyarakat luas.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">\"Kami berpandangan bahwa semakin terbuka proses peradilan, maka semakin baik pula pendidikan hukum dan demokrasi yang dapat diterima masyarakat,\" tuturnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Pihak penggugat menilai keterbukaan informasi akan memberikan ruang bagi masyarakat untuk memahami secara langsung argumentasi hukum masing-masing pihak tanpa dipengaruhi asumsi maupun spekulasi yang berkembang di ruang publik.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Sebelumnya, Pemerintah Kabupaten Gowa melalui Surat <a rel=\"dofollow\" href=\"https://celebes.inews.id/tag/bupati-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Bupati Gowa</a> Nomor 100/3.2/691/Bag.Hukum telah menyatakan menghormati proses hukum yang sedang berlangsung serta mengimbau seluruh perangkat daerah untuk menjaga netralitas dan menghormati jalannya proses peradilan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Kuasa hukum penggugat mengapresiasi sikap tersebut sebagai bentuk penghormatan terhadap prinsip negara hukum dan independensi kekuasaan kehakiman.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Diketahui, perkara Nomor 61/Pdt.G/2026/PN Sgm menguji legalitas serta batas kewenangan penggunaan Hak Angket DPRD Kabupaten Gowa, khususnya terhadap sejumlah materi yang menurut penggugat berada di luar ruang lingkup fungsi pengawasan DPRD.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Sementara itu, Ketua Pansus Hak Angket DPRD Kabupaten Gowa, Muh. Kasim Sila, saat dikonfirmasi terkait gugatan yang diajukan terhadap DPRD Gowa memilih menyerahkan persoalan tersebut kepada pimpinan DPRD.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">\"Kalau terkait itu rananya pimpinan DPRD,\" ujar Kasim Sila melalui aplikasi pesan singkat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">Meski demikian, Kasim menegaskan bahwa Panitia Khusus Hak Angket tetap menjalankan tugas dan fungsinya sebagaimana mandat yang diberikan oleh pimpinan DPRD Kabupaten Gowa.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33); text-align: justify;\">\"Kamipun di Pansus bekerja atas dasar surat tugas dari pimpinan,\" tutupnya.</p>', '1781146715_6a2a245b6d7de.jpg', 2, 0, 0, 0, 'sidang-perdana-gugatan-hak-angket-dprd-gowa-ditunda-para-tergugat-tak-hadir', 'publish', '2026-06-11 09:58:35', '2026-06-11 12:11:40');
INSERT INTO `post` (`id`, `post_title`, `post_sub_title`, `post_category_id`, `post_subcategory_id`, `role_id`, `user_id`, `post_desc`, `post_image`, `total_views`, `total_comments`, `total_likes`, `total_bookmarks`, `slug`, `status`, `created_at`, `update_at`) VALUES
(30, 'Infografis: 9 Aturan Gila Piala Dunia 2026, Tutup Mulut saat Protes Bisa Berujung Kartu Merah', 'Infografis: 9 Aturan Gila Piala Dunia 2026, Tutup Mulut saat Protes Bisa Berujung Kartu Merah', 3, 17, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">JAKARTA, iNews.id</span> - Sejumlah aturan baru yang akan diterapkan pada <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/piala-dunia\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Piala Dunia</a></span> 2026 menarik perhatian publik. <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/fifa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">FIFA</a></span> memperkenalkan sembilan perubahan penting yang diperkirakan dapat memengaruhi jalannya pertandingan sejak awal laga.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Salah satu perubahan utama adalah penindakan terhadap pelanggaran yang terjadi sebelum bola kembali dimainkan. Kontak fisik berlebihan, blok ilegal, hingga aksi menarik atau menahan lawan di area penalti kini dapat langsung dianggap sebagai pelanggaran.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Timnas Inggris disebut-sebut menjadi salah satu tim yang berpotensi terkena dampak aturan ini. Ketua Komite Wasit FIFA, Pierluigi Collina, mengatakan gol Inggris saat bermain imbang 1-1 melawan Uruguay dalam laga persahabatan tidak akan dianggap sah jika terjadi pada <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/piala-dunia-2026\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Piala Dunia 2026</a></span>. Menurutnya, tindakan tersebut menjadi faktor utama yang menghalangi bek menjalankan tugasnya dengan normal.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">FIFA juga melakukan perombakan besar pada sistem Video Assistant Referee (<span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/var\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">VAR</a></span>). VAR kini bisa mengintervensi pada situasi sepak pojok, kartu kuning, hingga kartu kuning kedua.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Sikap pemain terhadap wasit juga menjadi perhatian. FIFA akan memberikan sanksi tegas terhadap pemain yang menutup mulut saat beradu argumen dengan ofisial pertandingan atau meninggalkan lapangan sebagai bentuk protes. Kedua tindakan tersebut dapat langsung berujung kartu merah.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Upaya mengurangi praktik membuang waktu juga menjadi fokus. Pemain selain kiper dilarang memasuki area teknis untuk menerima instruksi pelatih ketika penjaga gawang sedang mendapatkan perawatan medis.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Kebijakan itu muncul setelah pelatih Daniel Farke menuduh Gianluigi Donnarumma memanfaatkan celah aturan saat pertandingan Manchester City melawan Leeds pada November lalu.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">FIFA juga mengubah prosedur pergantian pemain. Tim hanya memiliki waktu 10 detik untuk menyelesaikan proses substitusi. Jika melewati batas tersebut, pemain pengganti baru dapat masuk setelah menunggu tambahan waktu satu menit.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Untuk lemparan ke dalam dan tendangan gawang, wasit akan menerapkan hitungan mundur selama lima detik. Pelanggaran atas aturan ini dapat berakibat lemparan diberikan kepada lawan atau bahkan menghasilkan sepak pojok.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Sebagai langkah antisipasi terhadap cuaca panas ekstrem di Amerika Serikat, Kanada, dan Meksiko selaku tuan rumah, FIFA menetapkan jeda minum selama tiga menit pada setiap babak pertandingan.</p>', '1781147070_6a2a25bec5ff6.jpg', 1, 0, 0, 0, 'infografis-9-aturan-gila-piala-dunia-2026-tutup-mulut-saat-protes-bisa-berujung-kartu-merah', 'publish', '2026-06-11 10:04:30', '2026-06-11 12:19:15'),
(31, 'Empat Pria Asal Bukittinggi dan Agam yang Ditangkap BNNP Bawa 150 Kg Ganja Terancam Hukuman Mati', 'Empat Pria Asal Bukittinggi dan Agam yang Ditangkap BNNP Bawa 150 Kg Ganja Terancam Hukuman Mati', 3, 15, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://padang.inews.id/tag/agam\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">AGAM</a>, iNewsPadang.id</span> — Badan <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/narkotika\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Narkotika</a> Nasional Provinsi (BNNP) Sumatera Barat memusnahkan 145.085,23 gram atau sekitar 145 kilogram ganja hasil pengungkapan kasus peredaran gelap narkotika lintas provinsi yang melibatkan empat pria asal <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/bukittinggi\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Bukittinggi</a> dan Kabupaten Agam.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Pemusnahan barang bukti tersebut dilakukan di Krematorium Bukit Gado-Gado, Kota Padang, Rabu (10/6/2026), serta dihadiri unsur Forkopimda, aparat penegak hukum, tokoh masyarakat, dan sejumlah perwakilan instansi terkait. Barang bukti yang dimusnahkan merupakan hasil pengungkapan kasus penyelundupan ganja seberat sekitar 150 kilogram yang diduga berasal dari <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/mandailing-natal\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Mandailing Natal</a>, Sumatera Utara.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kepala BNNP Sumatera Barat, Brigjen Pol Dr. Ricky Yanuarfi, mengatakan pemusnahan tersebut merupakan bagian dari proses penegakan hukum sekaligus bentuk komitmen negara dalam memerangi peredaran narkotika.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Kegiatan pemusnahan barang bukti yang kita laksanakan hari ini bukan sekadar memenuhi ketentuan hukum, tetapi juga merupakan bukti nyata komitmen negara dalam memerangi penyalahgunaan dan peredaran gelap narkotika,\" ujar Ricky dalam sambutannya.</p><div style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Inter, sans-serif; font-size: medium;\"><img src=\"https://img.inews.co.id/files/networks/2026/06/10/33805_ka-bnnp.jpg\" style=\"margin: 0px; padding: 0px; width: clamp(400px, 100%, 100%); height: auto; border-radius: 18px; object-fit: cover; object-position: center center;\"><br style=\"margin: 0px; padding: 0px;\">Kepala<a rel=\"dofollow\" href=\"https://padang.inews.id/tag/bnnp-sumbar\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: block;\">BNNP Sumbar</a>Brigjen Pol Dr. Ricky Yanuarfi memimpin kegiatan pemusnahan 145 kilogram ganja yang disaksikan unsur Forkopimda dan instansi terkait di Padang, Rabu (10/6/2026). (Foto: Istimewa)</div><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kasus ini bermula dari laporan masyarakat yang diterima Direktorat Intelijen BNN RI mengenai dugaan penyelundupan ganja dari wilayah Mandailing Natal menuju Sumatera Barat. Informasi tersebut ditindaklanjuti oleh tim intelijen dan pemberantasan BNNP Sumbar melalui penyelidikan sejak 9 Mei 2026.&nbsp;&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dari hasil penyelidikan, petugas menemukan indikasi adanya rencana penyelundupan narkotika yang melibatkan sejumlah pelaku. Pada Minggu, 10 Mei 2026 sekitar pukul 04.00 WIB, petugas menghentikan dua kendaraan di Jalan KM 5 Bukittinggi-Medan, Jorong Batang Palupuah, Nagari Koto Rantang, Kecamatan Palupuah, Kabupaten Agam.&nbsp;&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kendaraan pertama berupa Toyota Agya warna kuning nomor polisi BA 1527 XF yang ditumpangi Monarki Islami alias Arki dan Dany Ramanda. Kendaraan kedua berupa Daihatsu Sigra warna silver nomor polisi BA 1669 EV yang ditumpangi Nico Leza Putra dan Afrizal.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Saat dilakukan penggeledahan terhadap Daihatsu Sigra, petugas menemukan tujuh karung putih bermerek terigu yang ditutupi plastik biru. Di dalamnya terdapat ratusan paket ganja dengan berat total sekitar 150 kilogram.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Empat tersangka yang diamankan masing-masing Monarki Islami alias Arki (31), warga Nagari Bukik Batabuah, Kabupaten Agam, Dany Ramanda (35), warga Kecamatan Mandiangin Koto Selayan, Kota Bukittinggi, Afrizal (31), warga Nagari Bukik Batabuah, Kabupaten Agam, serta Nico Leza Putra (28), warga Kecamatan Guguak Panjang, Kota Bukittinggi.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dalam proses penyidikan, Kejaksaan Negeri Bukittinggi menetapkan barang bukti ganja yang disita sebanyak 148.085,23 gram. Sebanyak 1.500 gram disisihkan untuk kepentingan pemeriksaan laboratorium forensik dan 1.500 gram lainnya untuk kebutuhan pembuktian di persidangan. Dengan demikian, jumlah ganja yang dimusnahkan mencapai 145.085,23 gram.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurut Ricky, pemusnahan barang bukti juga bertujuan memastikan narkotika yang telah disita tidak lagi berpotensi disalahgunakan.</p><div style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Inter, sans-serif; font-size: medium;\"><img src=\"https://img.inews.co.id/files/networks/2026/06/10/9c249_bb-musnah.jpg\" style=\"margin: 0px; padding: 0px; width: clamp(400px, 100%, 100%); height: auto; border-radius: 18px; object-fit: cover; object-position: center center;\"><br style=\"margin: 0px; padding: 0px;\">Petugas menyiapkan paket-paket ganja yang akan dimusnahkan. Barang bukti tersebut merupakan bagian dari sitaan sekitar 150 kilogram ganja yang diduga berasal dari Mandailing Natal, Sumatera Utara. (Foto: Istimewa)</div><div style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Inter, sans-serif; font-size: medium;\"><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; color: rgb(33, 33, 33);\">\"Pemusnahan barang bukti merupakan bagian dari proses penegakan hukum yang transparan dan akuntabel, sekaligus memastikan bahwa barang bukti yang telah disita tidak lagi berpotensi disalahgunakan,\" katanya.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; color: rgb(33, 33, 33);\">Para tersangka dijerat Pasal 114 ayat (2), Pasal 115 ayat (2), Pasal 111 ayat (2), dan Pasal 132 ayat (1) Undang-Undang Nomor 35 Tahun 2009 tentang Narkotika. Mereka terancam <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/hukuman\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">hukuman</a> <a rel=\"dofollow\" href=\"https://padang.inews.id/tag/mati\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">mati</a> atau penjara seumur hidup serta denda maksimal Rp10 miliar.&nbsp;</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; color: rgb(33, 33, 33);\">BNNP Sumbar juga mengajak masyarakat untuk terus meningkatkan kewaspadaan dan berani melaporkan apabila mengetahui adanya indikasi penyalahgunaan maupun peredaran gelap narkotika di lingkungan masing-masing.</p></div>', '1781147306_6a2a26aa92e14.jpg', 1, 0, 0, 0, 'empat-pria-asal-bukittinggi-dan-agam-yang-ditangkap-bnnp-bawa-150-kg-ganja-terancam-hukuman-mati', 'publish', '2026-06-11 10:08:26', '2026-06-11 12:19:28'),
(32, 'Presiden FIFA Pusing jelang Piala Dunia 2026, Wasit Ditolak Masuk AS dan Tiket Mahal Jadi Masalah', 'Presiden FIFA Pusing jelang Piala Dunia 2026, Wasit Ditolak Masuk AS dan Tiket Mahal Jadi Masalah', 4, 21, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">JAKARTA, iNews.id</span> – Presiden <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/fifa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">FIFA</a></span> <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/gianni-infantino\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Gianni Infantino</a></span> pusing jelang <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/piala-dunia-2026\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Piala Dunia 2026</a></span> setelah wasit ditolak masuk Amerika Serikat (AS) dan harga tiket mahal jadi masalah. Dua isu besar itu membuat turnamen yang digelar di AS, Kanada, dan Meksiko langsung menjadi sorotan sebelum kick-off.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Piala Dunia 2026 akan dimulai Kamis dengan format besar. Turnamen ini diikuti 48 negara dan memainkan total 104 pertandingan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Namun, pesta sepak bola dunia itu sudah dihantam sejumlah polemik sebelum laga pertama dimainkan. FIFA harus menghadapi kritik soal harga tiket, isu politik, hingga persoalan akses masuk perangkat pertandingan ke AS.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Salah satu masalah yang mencuri perhatian adalah kasus wasit asal Somalia, Omar Artan. Dia dipulangkan pekan ini setelah pemerintahan <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/donald-trump\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Donald Trump</a></span> menudingnya memiliki hubungan dengan “anggota organisasi teror yang dicurigai”.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Kasus itu menambah panas situasi menjelang Piala Dunia 2026. Sebelumnya, kehadiran Iran di turnamen juga sempat diragukan karena konflik yang masih berlangsung antara Iran dan Amerika Serikat.</p><h2 style=\"margin: 0px; padding: 0px; font-size: clamp(20px, 2vw, 24px); font-weight: 700; line-height: 36px; color: rgb(0, 0, 0); font-family: MNCSansRegular, sans-serif;\"><br style=\"margin: 0px; padding: 0px;\">Gianni Infantino Minta Publik Tenang</h2><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Gianni Infantino memakai konferensi pers peluncuran Piala Dunia 2026 pada Rabu untuk menjawab berbagai persoalan tersebut. Presiden FIFA itu meminta publik tetap tenang menghadapi masalah yang muncul.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“Santai, rileks,” kata Infantino, dikutip <em style=\"margin: 0px; padding: 0px; font-size: 12px; line-height: 18px; color: rgb(154, 154, 154);\">Independent.</em></p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Infantino menegaskan FIFA terus bekerja untuk mencari jalan keluar atas setiap persoalan yang mengganggu persiapan turnamen. Dia tidak ingin polemik tersebut membuat atmosfer Piala Dunia 2026 semakin keruh.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Namun, Infantino juga mengakui FIFA tidak punya kekuasaan penuh atas keputusan pemerintah AS, termasuk dalam kasus penolakan masuk terhadap Omar Artan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“Kami bukan raja dunia,” kata Infantino.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Pernyataan itu menjadi pengakuan penting dari orang nomor satu FIFA. Dia menyampaikan otoritas sepak bola dunia tidak bisa memaksa sebuah negara memberi izin masuk kepada seseorang.</p><h2 style=\"margin: 0px; padding: 0px; font-size: clamp(20px, 2vw, 24px); font-weight: 700; line-height: 36px; color: rgb(0, 0, 0); font-family: MNCSansRegular, sans-serif;\"><br style=\"margin: 0px; padding: 0px;\">Tiket Mahal Piala Dunia 2026 Bikin FIFA Disorot</h2><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Selain kasus wasit, harga tiket Piala Dunia 2026 juga menjadi sorotan tajam. FIFA menetapkan harga tiket mulai dari 140 dolar AS atau sekitar Rp2,5 juta.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Harga kursi reguler untuk final pada 19 Juli di New Jersey bahkan mencapai 8.680 dolar AS atau sekitar Rp155,8 juta. FIFA kemudian menaikkan harga tiket final menjadi 10.990 dolar AS atau sekitar Rp197,2 juta.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Lonjakan paling mencolok terjadi saat harga tiket final mencapai 32.970 dolar AS atau sekitar Rp591,8 juta. Angka itu memicu kritik keras karena dianggap terlalu mahal untuk sebagian suporter.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Setelah mendapat kritik, FIFA menawarkan sejumlah kecil tiket 60 dolar AS atau sekitar Rp1 juta kepada federasi nasional. Tiket itu disiapkan untuk suporter reguler masing-masing negara.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Infantino membela kebijakan harga tiket tersebut. Dia menyebut rata-rata harga tiket turnamen masih berada di bawah 500 dolar AS atau sekitar Rp8,9 juta.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“Jika kami melakukan sesuatu yang salah, semua orang di Amerika Utara juga melakukan sesuatu yang salah,” kata Infantino.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Infantino membandingkan harga tiket Piala Dunia 2026 dengan ajang olahraga besar di Amerika Serikat saat memasuki fase play-off. Dia juga menyinggung lonjakan harga tiket NBA Finals antara New York Knicks dan San Antonio Spurs sebagai contoh.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Meski begitu, klaim Infantino dinilai lebih sesuai untuk harga jual kembali, bukan harga resmi awal. FIFA juga menghadapi perhatian dari jaksa agung di California, New Jersey, New York, dan Texas terkait masalah tiket tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Infantino mengaku tidak khawatir dengan penyelidikan itu. Dia menegaskan FIFA sudah memeriksa seluruh proses penjualan tiket sebelum melepas jutaan tiket ke publik.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“Kami sangat tenang soal ini karena sebelum mulai menjual 6,5 juta atau 7 juta tiket, kami memeriksa semua yang kami lakukan bersama pengacara terbaik dan ahli terbaik,” kata Infantino.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“Kami menyambut setiap penyelidikan,” ujarnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Infantino juga menilai pasar tiket sekunder berada di luar kendali FIFA. Menurutnya, lonjakan harga yang dilihat banyak penggemar untuk pertandingan Piala Dunia terjadi di area yang tidak sepenuhnya bisa dikendalikan organisasinya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Polemik harga tiket dan kasus Omar Artan membuat tekanan terhadap FIFA semakin besar. Piala Dunia 2026 belum dimulai, tetapi Infantino sudah harus menjawab kritik dari banyak arah.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Situasi ini menjadi ujian awal bagi FIFA sebagai penyelenggara turnamen sepak bola terbesar dunia. Dengan skala 48 negara dan 104 pertandingan, Piala Dunia 2026 langsung bergerak dalam atmosfer panas sebelum bola pertama bergulir.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><br></p>', '1781147660_6a2a280c4e69d.jpg', 1, 0, 0, 0, 'presiden-fifa-pusing-jelang-piala-dunia-2026-wasit-ditolak-masuk-as-dan-tiket-mahal-jadi-masalah', 'publish', '2026-06-11 10:14:20', '2026-06-11 12:22:36'),
(33, 'Kontroversi Piala Dunia 2026, Wasit Somalia Omar Artan Ditolak Amerika Serikat', 'Kontroversi Piala Dunia 2026, Wasit Somalia Omar Artan Ditolak Amerika Serikat', 5, 27, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">JAKARTA, iNews.id </span>– Wasit So</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">malia Omar Artan gagal memimpin <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/piala-dunia-2026\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Piala Dunia 2026</a></span> setelah dicekal masuk <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/amerika-serikat\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Amerika Serikat</a></span>. Padahal dia sudah terpilih sebagai salah satu pengadil pertandingan pada ajang sepak bola terbesar dunia tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Omar Artan sejatinya bersiap mencatat sejarah sebagai wasit asal Somalia pertama yang memimpin laga di putaran final Piala Dunia. Namun, namanya dicoret dari daftar ofisial setelah otoritas imigrasi Amerika Serikat menolak dia masuk saat tiba di Bandara Internasional Miami.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Artan, yang menyabet gelar Wasit Terbaik Pria Afrika versi Konfederasi Sepak Bola Afrika 2025, kini berada di Turki setelah dipulangkan. Hingga kini, pihak imigrasi Amerika Serikat tidak memberikan alasan resmi terkait penolakan tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Somalia termasuk dalam daftar negara yang terdampak kebijakan pembatasan perjalanan yang diterapkan pada era pemerintahan Donald Trump. Kondisi ini diduga menjadi faktor utama yang memengaruhi keputusan imigrasi.</p><h2 style=\"margin: 0px; padding: 0px; font-size: clamp(20px, 2vw, 24px); font-weight: 700; line-height: 36px; color: rgb(0, 0, 0); font-family: MNCSansRegular, sans-serif;\">FIFA Angkat Bicara, Artan Dipastikan Absen</h2><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Setelah berkomunikasi dengan otoritas Amerika Serikat, FIFA memastikan Artan tidak bisa menjalankan tugasnya di Piala Dunia 2026.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“FIFA dapat mengonfirmasi bahwa ofisial pertandingan Omar Abdulkadir Artan tidak dapat mengikuti pelatihan dan memimpin pertandingan di Piala Dunia FIFA 2026 setelah dia ditolak masuk ke Amerika Serikat,” bunyi pernyataan resmi FIFA.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“FIFA tidak terlibat dalam proses imigrasi negara tuan rumah, termasuk penilaian visa, dan telah diberi tahu oleh otoritas terkait status Tuan Artan tidak akan berubah untuk saat ini,” lanjut pernyataan tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“Sejalan dengan penyelenggaraan ajang FIFA sebelumnya, pemerintah tuan rumah memiliki kewenangan penuh menentukan siapa yang menerima visa dan siapa yang diizinkan masuk ke negaranya,” tulis FIFA.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Seorang penasihat senior Kementerian Pemuda dan Olahraga Somalia mengonfirmasi kepada BBC terkait penolakan tersebut. Dia menegaskan Artan melakukan perjalanan dengan dokumen yang sah.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Pejabat Kedutaan Besar Somalia di Nairobi juga menyebut Artan memegang paspor diplomatik yang diterbitkan khusus guna mempermudah perjalanan internasionalnya, menyusul kendala visa yang pernah dialami sebelumnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Federasi Sepak Bola Somalia langsung mengambil langkah dengan menghubungi FIFA dan meminta klarifikasi mendesak terkait pencoretan Artan dari daftar wasit Piala Dunia 2026.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Berbicara kepada BBC World Service, Andrew Giuliani, yang memimpin Satuan Tugas Gedung Putih untuk Piala Dunia, menyampaikan sikap pemerintah Amerika Serikat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">“Saya tidak bisa menjelaskan detail informasi sensitif tersebut, tetapi saya dapat memastikan keputusan bea cukai dan patroli perbatasan sudah tepat dan saya mendukung keputusan itu,” ucapnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Artan sebelumnya masuk dalam daftar 52 wasit yang diumumkan FIFA untuk memimpin pertandingan Piala Dunia 2026 yang digelar di Kanada, Meksiko, dan Amerika Serikat pada 11 Juni hingga 19 Juli. Dia tercatat menjadi wasit FIFA sejak 2018 dan berpengalaman memimpin pertandingan Piala Afrika</p>', '1781148032_6a2a2980b5dec.jpg', 1, 0, 0, 0, 'kontroversi-piala-dunia-2026-wasit-somalia-omar-artan-ditolak-amerika-serikat', 'publish', '2026-06-11 10:20:32', '2026-06-11 12:19:49'),
(34, 'Aksi Curnak Resahkan Warga Miomaffo Barat, Pelaku Sembelih 3 Ekor Sapi di Kebun dalam Hitungan Jam', 'Aksi Curnak Resahkan Warga Miomaffo Barat, Pelaku Sembelih 3 Ekor Sapi di Kebun dalam Hitungan Jam', 6, 36, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://ttu.inews.id/tag/kefamenanu\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">KEFAMENANU</a>, iNewsTTU.id</span> – Kepolisian Sektor (Polsek) Miomaffo Barat bergerak cepat menindaklanjuti laporan kasus pencurian ternak yang terjadi di Desa <a rel=\"dofollow\" href=\"https://ttu.inews.id/tag/suanae\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Suanae</a>, Kecamatan Miomaffo Barat, Kabupaten Timor Tengah Utara (TTU), Rabu (10/6/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kasus tersebut mengakibatkan tiga ekor sapi milik dua warga setempat hilang setelah diduga dicuri dan disembelih oleh pelaku di lokasi yang tidak jauh dari kandang ternak.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kapolres TTU AKBP Eliana Papote melalui Kapolsek Miomaffo Barat IPDA Pulus Niaf, yang dikonfirmasi melalui Kasi Humas Polres TTU AKP Anselmus Pera, membenarkan adanya peristiwa tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Benar, personel piket Polsek Miomaffo Barat menerima laporan resmi dari warga Desa Suanae terkait kasus pencurian sapi dengan modus ternak disembelih di sekitar lokasi kejadian. Saat ini kasus tersebut sedang dalam proses penyelidikan,\" kata AKP Anselmus Pera.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Korban pertama, Rofina Klaenoni (45), warga RT 009/RW 005 Desa Suanae, melaporkan kehilangan dua ekor sapi betina miliknya. Ternak tersebut terakhir kali diberi makan oleh menantunya, Surianto Robinson Banu, pada Selasa (9/6/2026) sekitar pukul 16.00 WITA.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Namun pada Rabu pagi sekitar pukul 06.10 WITA, korban mendapati tempat pengikatan sapi dalam keadaan kosong. Bersama keluarga, korban kemudian melakukan pencarian dan menemukan kedua sapi tersebut sekitar 200 meter dari lokasi semula dalam kondisi telah disembelih.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Pelaku diduga mengambil hampir seluruh bagian daging sapi dan hanya meninggalkan kepala, kulit, serta isi perut hewan di lokasi kejadian. Akibat kejadian itu, korban mengalami kerugian sekitar Rp15 juta.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dua ekor anak sapi berusia sekitar empat bulan yang sempat hilang dari lokasi pengikatan berhasil ditemukan warga dalam keadaan hidup dan telah diamankan kembali.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Peristiwa serupa juga dialami Gregorius Babu (57), yang tinggal tidak jauh dari rumah korban pertama. Satu ekor sapi jantan berusia sekitar satu tahun miliknya dilaporkan hilang pada malam yang sama.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Saat hendak memindahkan ternaknya pada Rabu pagi sekitar pukul 06.30 WITA, Gregorius mendapati tali pengikat sapi sudah kosong. Tidak lama kemudian, ia mendapat informasi bahwa ternaknya ditemukan di lokasi yang sama dengan sapi milik Rofina.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Sapi tersebut juga ditemukan dalam kondisi telah disembelih dan hanya menyisakan kulit, kepala, serta isi perut. Kerugian yang dialami korban ditaksir mencapai Rp4 juta.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dalam proses penyelidikan, polisi telah meminta keterangan sejumlah saksi. Salah satunya Thomas Sabu yang mengaku melihat kerumunan warga di sekitar lokasi kejadian pada pukul 06.20 WITA.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Saat mendatangi lokasi bersama dua warga lainnya, Thomas menemukan sebuah gagang pisau berukuran sekitar 10 sentimeter di pinggir jalan yang berjarak sekitar 100 meter dari lokasi penyembelihan ternak. Barang tersebut kemudian diserahkan kepada petugas sebagai barang bukti.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Polsek Miomaffo Barat telah melakukan serangkaian tindakan kepolisian, mulai dari menerima laporan polisi, melakukan olah tempat kejadian perkara (TKP), mengidentifikasi saksi, meminta keterangan korban dan saksi, hingga mengamankan sejumlah barang bukti berupa tali nilon pengikat sapi dan gagang pisau yang ditemukan warga.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">AKP Anselmus Pera menegaskan pihak kepolisian berkomitmen mengungkap pelaku pencurian ternak yang meresahkan masyarakat tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Kami terus melakukan penyelidikan untuk mengidentifikasi dan menangkap pelaku. Kami juga mengimbau masyarakat agar meningkatkan kewaspadaan dan mengaktifkan kembali sistem keamanan lingkungan guna mencegah kejadian serupa,\" pungkasnya.</p>', '1781148214_6a2a2a36e8d1f.jpg', 2, 0, 0, 0, 'aksi-curnak-resahkan-warga-miomaffo-barat-pelaku-sembelih-3-ekor-sapi-di-kebun-dalam-hitungan-jam', 'publish', '2026-06-11 10:23:34', '2026-06-11 17:56:00'),
(35, 'Penggeledahan Dinas Perkimtan Gowa Berlanjut, 50 Saksi Diperiksa Polisi', 'Penggeledahan Dinas Perkimtan Gowa Berlanjut, 50 Saksi Diperiksa Polisi', 3, 15, 1, 1, '<p><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">SUNGGUMINASA, iNews.id</span><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> - Penanganan dugaan persoalan </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/izin-persetujuan-bangunan-gedung\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">izin Persetujuan Bangunan Gedung</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> (PBG) di Kabupaten Gowa terus bergulir. Tim Tindak Pidana Korupsi (Tipidkor) Polres Gowa bahkan telah melakukan </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/penggeledahan\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">penggeledahan</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> di Kantor Dinas Perumahan, Kawasan Permukiman dan Pertanahan (Perkimtan) Gowa, pada Rabu (20/5/2026).</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">Penggeledahan yang berlangsung sekitar pukul 13.30 WITA di kantor Dinas Perkimtan, Jalan Beringin, Kelurahan Tombolo, Kecamatan Somba Opu, Kabupaten Gowa, Provinsi Sulsel, itu mendapat pengamanan ketat. Sejumlah personel kepolisian bersenjata lengkap tampak berjaga selama proses pemeriksaan berlangsung.</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">Pada hari yang sama, </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/kepala-dinas-perkimtan-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Kepala Dinas Perkimtan Gowa</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">, </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/abdullah-sirajuddin\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Abdullah Sirajuddin</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">, juga diketahui menjalani pemeriksaan maraton di Polres Gowa. Pemeriksaan berlangsung sejak pukul 11.00 hingga sekitar pukul 21.30 WITA terkait dugaan permasalahan penerbitan izin PBG.</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">\"Iya, pak kadis masih diperiksa di dalam,\" ujar </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/kanit-tipidkor-polres-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Kanit Tipidkor Polres Gowa</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">, </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/ipda-agus\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">IPDA Agus</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">, saat ditemui di pelataran parkir Polres Gowa ketika itu.</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">Dalam penggeledahan tersebut, penyidik turut mengamankan sejumlah boks yang diduga berisi dokumen dan berkas penting untuk kepentingan penyelidikan.</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">Perkembangan terbaru, penyidik Tipidkor Polres Gowa telah memeriksa sedikitnya 50 orang saksi dalam perkara tersebut. Mereka berasal dari berbagai pihak yang dianggap mengetahui proses dan mekanisme penerbitan izin yang kini tengah diselidiki.</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">\"Saat ini kami sudah memeriksa 50 orang saksi, termasuk Kadis Perkimtan. Jadi belum ada penetapan tersangka,\" kata Kanit Tipidkor Polres Gowa, IPDA Agus saat dikonfirmasi melalui sambungan telepon, Selasa (9/6/2026).</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">Meski puluhan saksi telah dimintai keterangan dan sejumlah dokumen diamankan, polisi menegaskan proses penyelidikan masih terus berjalan. Hingga kini, penyidik belum menetapkan pihak yang bertanggung jawab dalam kasus dugaan permasalahan izin PBG tersebut.</span></p>', '1781148349_6a2a2abd4bb59.jpg', 1, 0, 0, 0, 'penggeledahan-dinas-perkimtan-gowa-berlanjut-50-saksi-diperiksa-polisi', 'publish', '2026-06-11 10:25:49', '2026-06-11 12:19:44'),
(36, 'Polisi Geledah Kantor Perkimtan Gowa, Kepala Dinas Ikut Diperiksa', 'Polisi Geledah Kantor Perkimtan Gowa, Kepala Dinas Ikut Diperiksa', 3, 18, 1, 1, '<p><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">SUNGGUMINASA, iNewsGowa.id</span><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> - </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/tim-tindak-pidana-korupsi\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Tim Tindak Pidana Korupsi</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> (Tipidkor) </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/polres-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Polres Gowa</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> melakukan penggeledahan di Kantor Dinas Perumahan, Kawasan Permukiman dan Pertanahan (Perkimtan) Kabupaten Gowa, Sulawesi Selatan, Rabu (20/5/2026).</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">Penggeledahan berlangsung di kantor </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/dinas-perkimtan-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Dinas Perkimtan Gowa</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> yang berlokasi di Jalan Beringin, Kelurahan Tombolo, Kecamatan Somba Opu. Sejumlah aparat kepolisian bersenjata lengkap terlihat berjaga di sekitar lokasi selama proses pemeriksaan berlangsung.</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">Dikabarkan saat ini, </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/kepala-dinas-perkimtan-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Kepala Dinas Perkimtan Gowa</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">, </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/abdullah-sirajuddin\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Abdullah Sirajuddin</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">, sedang menjalani pemeriksaan di Polres Gowa terkait dugaan permasalahan izin Persetujuan Bangunan Gedung (PBG).</span><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">\"Iya, pak kadis masih diperiksa di dalam,\" terang </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/kanit-tipidkor-polres-gowa\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">Kanit Tipidkor Polres Gowa</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\">, </span><a rel=\"dofollow\" href=\"https://gowa.inews.id/tag/ipda-agus\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block; font-family: Inter, sans-serif; font-size: 18px; background-color: rgb(255, 255, 255);\">IPDA Agus</a><span style=\"color: rgb(33, 33, 33); font-family: Inter, sans-serif; font-size: 18px;\"> saat ditemui di pelataran parkir Polres Gowa.</span></p>', '1781148575_6a2a2b9f8e4ac.jpg', 1, 0, 0, 0, 'polisi-geledah-kantor-perkimtan-gowa-kepala-dinas-ikut-diperiksa', 'publish', '2026-06-11 10:29:35', '2026-06-11 12:17:50');
INSERT INTO `post` (`id`, `post_title`, `post_sub_title`, `post_category_id`, `post_subcategory_id`, `role_id`, `user_id`, `post_desc`, `post_image`, `total_views`, `total_comments`, `total_likes`, `total_bookmarks`, `slug`, `status`, `created_at`, `update_at`) VALUES
(37, 'Inspiratif! Maudy Ayunda Bangun Ruang Belajar Sementara di Aceh Timur', 'Inspiratif! Maudy Ayunda Bangun Ruang Belajar Sementara di Aceh Timur', 4, 23, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\">ACEH TIMUR, iNews.id</span> – Suara tawa anak-anak kembali terdengar dari ruang belajar sederhana di <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/aceh-timur\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Aceh Timur</a></span>. Di tengah dinding kelas yang masih polos dan fasilitas seadanya, semangat belajar perlahan tumbuh lagi setelah <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/banjir\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">banjir</a></span> sempat memporak-porandakan kehidupan mereka.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Di ruangan itu, artis <span style=\"margin: 0px; padding: 0px; font-family: MNCSansBold, sans-serif; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://www.inews.id/tag/maudy-ayunda\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">Maudy Ayunda</a></span> duduk berjongkok sejajar dengan para murid. Mengenakan rompi merah marun dan hijab biru tua, dia menyapa anak-anak satu per satu dengan senyum hangat. Sinar matahari yang masuk dari jendela besar menambah suasana akrab di ruang belajar sementara tersebut.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Anak-anak tampak antusias mengerubungi aktris film Para Perasuk itu. Sebagian memegang buku, sebagian lainnya duduk rapi sambil memandang penuh rasa penasaran. Tas sekolah merah tersandar di samping meja belajar biru putih yang tampak baru digunakan kembali pascabanjir.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Kehadiran Maudy bukan sekadar kunjungan simbolis. Dia datang membawa semangat baru bagi anak-anak yang sempat kehilangan ruang belajar akibat bencana.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Suasana semakin hidup ketika lulusan Stanford University itu memasuki kelas lain yang dipenuhi puluhan murid. Duduk di kursi kecil, Maudy membacakan cerita menggunakan mikrofon hitam sambil sesekali mengajak anak-anak berdialog. Mata para siswa berbinar mengikuti dongeng yang dibacakannya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Beberapa anak terlihat paling antusias. Mereka duduk di barisan depan sambil memeluk makanan ringan yang dibagikan. Ada yang aktif mengangkat tangan untuk bertanya, ada pula yang hanya diam terpaku mendengarkan cerita dengan serius.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Di sela kegiatan, Maudy beberapa kali membungkukkan badan agar bisa mendengar cerita anak-anak lebih dekat. Dia juga menyempatkan diri berdiskusi dengan guru dan warga sekitar mengenai kondisi pendidikan pascabencana.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Bencana merusak kelas, tetapi tidak mematahkan semangat anak-anak untuk tetap datang ke sekolah dan belajar,\" ujar Maudy dalam keterangan resminya, Rabu (20/5/2026).</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Menurut dia, persoalan terbesar setelah bencana bukan hanya kerusakan bangunan sekolah, tetapi hilangnya akses pendidikan bagi anak-anak. Banyak keluarga masih kesulitan transportasi, merasa khawatir soal keamanan, hingga belum mampu kembali menjalani aktivitas belajar secara normal.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Ketika akses pendidikan sudah terbatas sejak awal, bencana seperti ini bisa membuat kesempatan belajar anak-anak semakin timpang. Kami percaya setiap anak tetap berhak mendapatkan pendidikan yang layak, bahkan dalam situasi paling sulit sekalipun,\" tuturnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Data Kementerian Pendidikan Dasar dan Menengah per Februari 2026 menunjukkan dampak banjir di Aceh cukup besar. Sebanyak 3.120 sekolah di Aceh terdampak bencana, dengan lebih dari 707 ribu murid serta puluhan ribu guru ikut merasakan gangguan proses pembelajaran.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Melihat kondisi tersebut, Maudy Ayunda Foundation bersama Save the Children Indonesia menghadirkan program Temporary Learning Space atau Ruang Belajar Sementara bagi anak-anak terdampak banjir di Aceh Tamiang dan Aceh Timur.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Program itu tidak hanya menyediakan ruang belajar darurat, tetapi juga dukungan literasi dan pendampingan psikososial agar anak-anak bisa kembali merasa aman dan nyaman saat belajar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">CEO Save the Children Indonesia, Dessy Kurwiany Ukar mengatakan, proses belajar menjadi bagian penting dalam pemulihan mental anak-anak korban bencana.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Belajar kembali adalah keberanian anak-anak untuk pulih,\" katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Di tengah ruang kelas bercat kusam dan meja kayu lama yang masih digunakan, senyum anak-anak Aceh Timur perlahan kembali merekah. Kehadiran Maudy Ayunda hari itu seolah menjadi pengingat bahwa pendidikan tetap bisa menghadirkan harapan, bahkan setelah bencana datang menghancurkan banyak hal.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Program itu tidak hanya menyediakan ruang belajar darurat, tetapi juga dukungan literasi dan pendampingan psikososial agar anak-anak bisa kembali merasa aman dan nyaman saat belajar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">CEO Save the Children Indonesia, Dessy Kurwiany Ukar mengatakan, proses belajar menjadi bagian penting dalam pemulihan mental anak-anak korban bencana.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Belajar kembali adalah keberanian anak-anak untuk pulih,\" katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Di tengah ruang kelas bercat kusam dan meja kayu lama yang masih digunakan, senyum anak-anak Aceh Timur perlahan kembali merekah. Kehadiran Maudy Ayunda hari itu seolah menjadi pengingat bahwa pendidikan tetap bisa menghadirkan harapan, bahkan setelah bencana datang menghancurkan banyak hal.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Program itu tidak hanya menyediakan ruang belajar darurat, tetapi juga dukungan literasi dan pendampingan psikososial agar anak-anak bisa kembali merasa aman dan nyaman saat belajar.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">CEO Save the Children Indonesia, Dessy Kurwiany Ukar mengatakan, proses belajar menjadi bagian penting dalam pemulihan mental anak-anak korban bencana.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">\"Belajar kembali adalah keberanian anak-anak untuk pulih,\" katanya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: MNCSansRegular, sans-serif; color: rgb(0, 0, 0);\">Di tengah ruang kelas bercat kusam dan meja kayu lama yang masih digunakan, senyum anak-anak Aceh Timur perlahan kembali merekah. Kehadiran Maudy Ayunda hari itu seolah menjadi pengingat bahwa pendidikan tetap bisa menghadirkan harapan, bahkan setelah bencana datang menghancurkan banyak hal.</p>', '1781148841_6a2a2ca9b728d.jpg', 1, 0, 0, 0, 'inspiratif-maudy-ayunda-bangun-ruang-belajar-sementara-di-aceh-timur', 'publish', '2026-06-11 10:34:01', '2026-06-11 12:16:55'),
(38, 'Tersangka Kasus Dugaan Pencurian Sapi di Hauteas Ditahan, Kuasa Hukum Apresiasi Kinerja Polres TTU', 'Tersangka Kasus Dugaan Pencurian Sapi di Hauteas Ditahan, Kuasa Hukum Apresiasi Kinerja Polres TTU', 5, 32, 1, 1, '<p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://ttu.inews.id/tag/kefamenanu\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">KEFAMENANU</a></span>, <span style=\"margin: 0px; padding: 0px; font-weight: 700;\">iNewsTTU</span>.id – Penanganan kasus dugaan pencurian ternak sapi di Desa Hauteas, Kecamatan Biboki Utara, Kabupaten Timor Tengah Utara (TTU), NTT terus berlanjut. Empat tersangka yang sebelumnya telah ditetapkan oleh penyidik akhirnya memenuhi panggilan pemeriksaan di Polres TTU pada Senin (8/6/2026) malam.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kapolres TTU, Eliana Papote melalui Kasi Humas Polres TTU, Anselmus Pera, Selasa (9/6/2026), menjelaskan bahwa keempat tersangka menjalani pemeriksaan lanjutan di ruang Satreskrim Polres TTU.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Keempat tersangka telah hadir di Polres TTU dan dilakukan pemeriksaan oleh penyidik. Setelah itu penyidik melengkapi administrasi penahanan,\" ujar Anselmus Pera.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\"><a rel=\"dofollow\" href=\"https://ttu.inews.id/tag/kefamenanu\" style=\"margin: 0px; padding: 0px; color: rgb(0, 191, 255); display: inline-block;\">KEFAMENANU</a></span>, <span style=\"margin: 0px; padding: 0px; font-weight: 700;\">iNewsTTU</span>.id – Penanganan kasus dugaan pencurian ternak sapi di Desa Hauteas, Kecamatan Biboki Utara, Kabupaten Timor Tengah Utara (TTU), NTT terus berlanjut. Empat tersangka yang sebelumnya telah ditetapkan oleh penyidik akhirnya memenuhi panggilan pemeriksaan di Polres TTU pada Senin (8/6/2026) malam.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kapolres TTU, Eliana Papote melalui Kasi Humas Polres TTU, Anselmus Pera, Selasa (9/6/2026), menjelaskan bahwa keempat tersangka menjalani pemeriksaan lanjutan di ruang Satreskrim Polres TTU.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Keempat tersangka telah hadir di Polres TTU dan dilakukan pemeriksaan oleh penyidik. Setelah itu penyidik melengkapi administrasi penahanan,\" ujar Anselmus Pera.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dari hasil pemeriksaan tersebut, penyidik memutuskan menahan tiga orang tersangka. Sementara satu tersangka lainnya tidak ditahan dengan mempertimbangkan faktor usia dan sejumlah pertimbangan hukum lainnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Tiga tersangka langsung dilakukan penahanan pada Senin malam, sedangkan satu tersangka tidak ditahan karena faktor umur dan pertimbangan lain dari penyidik,\" jelasnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Perkembangan tersebut mendapat apresiasi dari tim kuasa hukum korban, pemilik sapi yang dilaporkan hilang dan diduga dicuri oleh para tersangka.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Salah satu kuasa hukum korban, Oktovianus Fahik, menyampaikan penghargaan kepada jajaran Polres TTU yang dinilai bekerja secara profesional sejak laporan polisi diterima hingga proses penetapan tersangka dan penahanan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Dari hasil pemeriksaan tersebut, penyidik memutuskan menahan tiga orang tersangka. Sementara satu tersangka lainnya tidak ditahan dengan mempertimbangkan faktor usia dan sejumlah pertimbangan hukum lainnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Tiga tersangka langsung dilakukan penahanan pada Senin malam, sedangkan satu tersangka tidak ditahan karena faktor umur dan pertimbangan lain dari penyidik,\" jelasnya.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Perkembangan tersebut mendapat apresiasi dari tim kuasa hukum korban, pemilik sapi yang dilaporkan hilang dan diduga dicuri oleh para tersangka.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Salah satu kuasa hukum korban, Oktovianus Fahik, menyampaikan penghargaan kepada jajaran Polres TTU yang dinilai bekerja secara profesional sejak laporan polisi diterima hingga proses penetapan tersangka dan penahanan.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Kami sangat mengapresiasi kinerja rekan-rekan Kepolisian Timor Tengah Utara yang telah bekerja maksimal mulai dari laporan polisi, penyelidikan, penyidikan, gelar perkara hingga penetapan tersangka dan penahanan. Ini menunjukkan penegakan hukum berjalan sesuai aturan dan prosedur yang berlaku,\" kata Oktovianus.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Senada, anggota tim kuasa hukum lainnya, Dotin Yikwa, menilai langkah penyidik telah mencerminkan proses hukum yang transparan, profesional dan akuntabel.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurut mereka, keberhasilan pengungkapan kasus tersebut menjadi bukti komitmen Polres TTU dalam menjaga marwah hukum dan memberikan kepastian hukum kepada masyarakat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kasus ini bermula dari laporan warga Desa Hauteas bernama Marselinus Bouk yang kehilangan ternak sapi miliknya. Korban kemudian melaporkan empat warga setempat ke Polres TTU pada Februari 2026 atas dugaan pencurian ternak.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Berdasarkan laporan yang diterima, sapi milik korban diduga diambil pada malam hari dan disembelih di belakang gereja setempat. Informasi awal diperoleh dari seorang tukang ojek yang mengaku melihat aktivitas penangkapan dan penyembelihan sapi oleh sejumlah warga.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Setelah melalui serangkaian penyelidikan dan penyidikan, Polres TTU menggelar perkara dan menetapkan keempat terlapor sebagai tersangka. Kini proses hukum terhadap para tersangka terus berjalan sesuai ketentuan yang berlaku.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">\"Kami sangat mengapresiasi kinerja rekan-rekan Kepolisian Timor Tengah Utara yang telah bekerja maksimal mulai dari laporan polisi, penyelidikan, penyidikan, gelar perkara hingga penetapan tersangka dan penahanan. Ini menunjukkan penegakan hukum berjalan sesuai aturan dan prosedur yang berlaku,\" kata Oktovianus.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Senada, anggota tim kuasa hukum lainnya, Dotin Yikwa, menilai langkah penyidik telah mencerminkan proses hukum yang transparan, profesional dan akuntabel.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Menurut mereka, keberhasilan pengungkapan kasus tersebut menjadi bukti komitmen Polres TTU dalam menjaga marwah hukum dan memberikan kepastian hukum kepada masyarakat.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Kasus ini bermula dari laporan warga Desa Hauteas bernama Marselinus Bouk yang kehilangan ternak sapi miliknya. Korban kemudian melaporkan empat warga setempat ke Polres TTU pada Februari 2026 atas dugaan pencurian ternak.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Berdasarkan laporan yang diterima, sapi milik korban diduga diambil pada malam hari dan disembelih di belakang gereja setempat. Informasi awal diperoleh dari seorang tukang ojek yang mengaku melihat aktivitas penangkapan dan penyembelihan sapi oleh sejumlah warga.</p><p style=\"margin: 0px 0px 24px; padding: 0px; font-size: 18px; line-height: 25.6px; font-family: Inter, sans-serif; color: rgb(33, 33, 33);\">Setelah melalui serangkaian penyelidikan dan penyidikan, Polres TTU menggelar perkara dan menetapkan keempat terlapor sebagai tersangka. Kini proses hukum terhadap para tersangka terus berjalan sesuai ketentuan yang berlaku.</p>', '1781149155_6a2a2de3ce121.jpg', 1, 0, 0, 0, 'tersangka-kasus-dugaan-pencurian-sapi-di-hauteas-ditahan-kuasa-hukum-apresiasi-kinerja-polres-ttu', 'publish', '2026-06-11 10:39:15', '2026-06-11 12:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `post_bookmarks`
--

CREATE TABLE `post_bookmarks` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_bookmarks`
--

INSERT INTO `post_bookmarks` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(1, 14, 5, '2026-06-11 12:07:18'),
(3, 29, 5, '2026-06-11 12:11:47'),
(4, 26, 5, '2026-06-11 12:12:35'),
(5, 38, 5, '2026-06-11 12:16:45'),
(6, 37, 5, '2026-06-11 12:16:59'),
(7, 36, 5, '2026-06-11 12:17:54'),
(8, 28, 5, '2026-06-11 12:18:00'),
(9, 21, 5, '2026-06-11 12:18:13'),
(10, 18, 5, '2026-06-11 12:18:18'),
(11, 24, 5, '2026-06-11 12:18:23'),
(12, 23, 5, '2026-06-11 12:18:29'),
(13, 27, 5, '2026-06-11 12:18:33'),
(14, 13, 5, '2026-06-11 12:18:47'),
(15, 20, 5, '2026-06-11 12:18:53'),
(16, 22, 5, '2026-06-11 12:18:57'),
(17, 17, 5, '2026-06-11 12:19:10'),
(18, 30, 5, '2026-06-11 12:19:18'),
(19, 31, 5, '2026-06-11 12:19:31'),
(20, 19, 5, '2026-06-11 12:19:36'),
(21, 35, 5, '2026-06-11 12:19:46'),
(22, 33, 5, '2026-06-11 12:19:51'),
(23, 15, 5, '2026-06-11 12:20:08'),
(24, 25, 5, '2026-06-11 12:20:50'),
(25, 16, 5, '2026-06-11 12:20:59'),
(26, 34, 5, '2026-06-11 12:21:10'),
(27, 11, 5, '2026-06-11 12:21:26'),
(28, 32, 5, '2026-06-11 12:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `id` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `desc_category` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id`, `name_category`, `desc_category`, `slug`, `created_at`, `update_at`) VALUES
(1, 'TES1', 'tes1', '', '2026-06-04 16:38:27', '2026-06-06 11:09:23'),
(2, 'TES2', 'TES12', '', '2026-06-06 11:09:14', '0000-00-00 00:00:00'),
(3, 'TES3', 'TES3', '', '2026-06-06 11:09:38', '0000-00-00 00:00:00'),
(4, 'TES4', 'TES1234', '', '2026-06-06 11:10:01', '0000-00-00 00:00:00'),
(5, 'TES5', 'TES5', '', '2026-06-06 11:10:17', '0000-00-00 00:00:00'),
(6, 'TES6', 'tes123456', '', '2026-06-06 11:10:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('approved','rejected') NOT NULL DEFAULT 'approved',
  `reason_status` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_id`, `user_id`, `comment`, `status`, `reason_status`, `created_at`, `updated_at`) VALUES
(9, 21, 4, 'AGUS', 'approved', NULL, '2026-06-11 12:46:46', '0000-00-00 00:00:00'),
(10, 21, 5, 'tes', 'approved', NULL, '2026-06-11 12:47:58', '0000-00-00 00:00:00'),
(11, 22, 5, 'aji x paldo', 'approved', NULL, '2026-06-11 12:49:05', '0000-00-00 00:00:00'),
(12, 14, 5, 'tea x paldo GGS', 'approved', NULL, '2026-06-11 12:51:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_comment_reply`
--

CREATE TABLE `post_comment_reply` (
  `id` bigint(20) NOT NULL,
  `comment_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comment_reply`
--

INSERT INTO `post_comment_reply` (`id`, `comment_id`, `user_id`, `reply`, `status`, `created_at`, `updated_at`) VALUES
(9, 9, 5, 'josu x paldo', 'approved', '2026-06-11 12:47:11', '0000-00-00 00:00:00'),
(10, 9, 6, 'suga', 'approved', '2026-06-11 12:47:43', '0000-00-00 00:00:00'),
(11, 10, 4, 'bagus', 'approved', '2026-06-11 12:48:45', '0000-00-00 00:00:00'),
(12, 10, 6, 'bang sem', 'approved', '2026-06-11 12:49:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(1, 21, 4, '2026-06-10 19:00:58'),
(2, 14, 5, '2026-06-11 12:07:14'),
(3, 26, 6, '2026-06-11 12:08:06'),
(4, 29, 5, '2026-06-11 12:11:45'),
(5, 26, 5, '2026-06-11 12:12:36'),
(6, 38, 5, '2026-06-11 12:16:44'),
(7, 37, 5, '2026-06-11 12:16:58'),
(8, 36, 5, '2026-06-11 12:17:53'),
(9, 28, 5, '2026-06-11 12:18:01'),
(10, 21, 5, '2026-06-11 12:18:11'),
(11, 18, 5, '2026-06-11 12:18:17'),
(12, 24, 5, '2026-06-11 12:18:22'),
(13, 23, 5, '2026-06-11 12:18:28'),
(14, 27, 5, '2026-06-11 12:18:34'),
(15, 13, 5, '2026-06-11 12:18:46'),
(16, 20, 5, '2026-06-11 12:18:52'),
(17, 22, 5, '2026-06-11 12:18:56'),
(18, 17, 5, '2026-06-11 12:19:08'),
(19, 30, 5, '2026-06-11 12:19:17'),
(20, 31, 5, '2026-06-11 12:19:30'),
(21, 19, 5, '2026-06-11 12:19:37'),
(22, 35, 5, '2026-06-11 12:19:47'),
(23, 33, 5, '2026-06-11 12:19:52'),
(24, 15, 5, '2026-06-11 12:20:09'),
(25, 25, 5, '2026-06-11 12:20:51'),
(26, 16, 5, '2026-06-11 12:20:58'),
(27, 34, 5, '2026-06-11 12:21:11'),
(28, 11, 5, '2026-06-11 12:21:27'),
(29, 32, 5, '2026-06-11 12:22:39'),
(30, 21, 6, '2026-06-11 12:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_subcategory`
--

CREATE TABLE `post_subcategory` (
  `id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `name_subcategory` varchar(255) NOT NULL,
  `desc_subcategory` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_subcategory`
--

INSERT INTO `post_subcategory` (`id`, `post_category_id`, `name_subcategory`, `desc_subcategory`, `created_at`, `update_at`) VALUES
(6, 1, 'TES1', 'tes1', '2026-06-06 11:11:15', NULL),
(7, 1, 'TES2', 'TES', '2026-06-06 11:11:38', NULL),
(8, 1, 'TES3', 'TES123', '2026-06-06 11:11:59', NULL),
(9, 1, 'TES4', 'tes4', '2026-06-06 11:12:16', NULL),
(10, 1, 'TES5', 'tes12345', '2026-06-06 11:12:32', NULL),
(11, 1, 'TES6', 'tes6', '2026-06-06 11:12:51', NULL),
(12, 2, 'TES1', 'tes1', '2026-06-06 11:13:07', NULL),
(13, 2, 'TES2', 'tes12', '2026-06-06 11:18:14', NULL),
(14, 2, 'TES3', 'tes3', '2026-06-06 11:18:55', NULL),
(15, 3, 'TES3', 'TES123', '2026-06-11 09:33:35', NULL),
(16, 3, 'TES1', '123', '2026-06-11 09:34:10', NULL),
(17, 3, 'TES2', '12', '2026-06-11 09:34:25', NULL),
(18, 3, 'TES4', 'TES1234', '2026-06-11 09:35:09', NULL),
(19, 3, 'TES5', 'TES12345', '2026-06-11 09:35:29', '2026-06-11 09:35:48'),
(20, 3, 'TES6', 'TES66', '2026-06-11 09:36:12', NULL),
(21, 4, 'TES1', 'TES1', '2026-06-11 09:36:50', NULL),
(22, 4, 'TES2', 'TES22', '2026-06-11 09:37:21', NULL),
(23, 4, 'TES3', 'TES33', '2026-06-11 09:37:43', NULL),
(24, 4, 'TES4', 'TES44', '2026-06-11 09:38:25', NULL),
(25, 4, 'TES5', 'TES55', '2026-06-11 09:38:41', NULL),
(26, 4, 'TES6', 'TES66', '2026-06-11 09:40:13', NULL),
(27, 5, 'TES1', 'TES11', '2026-06-11 09:40:36', NULL),
(28, 2, 'TES4', 'TES4', '2026-06-11 09:41:47', NULL),
(29, 2, 'TES5', 'TES54', '2026-06-11 09:42:03', NULL),
(30, 2, 'TES6', 'TESS1', '2026-06-11 09:42:18', NULL),
(31, 5, 'TES2', 'TES13', '2026-06-11 09:43:41', NULL),
(32, 5, 'TES3', 'TESS1', '2026-06-11 09:44:34', NULL),
(33, 5, 'TES4', 'TES45', '2026-06-11 09:45:00', NULL),
(34, 5, 'TES5', 'TES45', '2026-06-11 09:45:35', NULL),
(35, 5, 'TES6', 'TES125', '2026-06-11 09:46:04', NULL),
(36, 6, 'TES1', 'TESS2', '2026-06-11 09:46:31', NULL),
(37, 6, 'TES2', 'TESS2', '2026-06-11 09:46:47', NULL),
(38, 6, 'TES3', 'TES32', '2026-06-11 09:47:06', NULL),
(39, 6, 'TES4', 'TES44', '2026-06-11 09:47:23', NULL),
(40, 6, 'TES5', 'TES5', '2026-06-11 09:47:52', NULL),
(41, 6, 'TES6', 'TES6', '2026-06-11 09:48:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `created_at`) VALUES
(33, 11, 3, '2026-06-09 08:53:25'),
(34, 13, 8, '2026-06-10 14:56:49'),
(35, 17, 9, '2026-06-10 15:06:09'),
(36, 18, 10, '2026-06-10 15:09:15'),
(37, 19, 8, '2026-06-10 15:11:49'),
(38, 19, 11, '2026-06-10 15:11:49'),
(39, 20, 12, '2026-06-10 15:14:07'),
(40, 21, 13, '2026-06-10 15:16:41'),
(41, 22, 14, '2026-06-10 15:19:39'),
(42, 23, 15, '2026-06-10 15:21:45'),
(43, 24, 16, '2026-06-10 15:24:10'),
(44, 25, 17, '2026-06-10 15:26:16'),
(45, 26, 16, '2026-06-10 15:28:03'),
(46, 27, 16, '2026-06-10 15:30:39'),
(47, 28, 18, '2026-06-11 09:54:30'),
(48, 28, 19, '2026-06-11 09:54:30'),
(49, 29, 20, '2026-06-11 09:58:35'),
(50, 30, 21, '2026-06-11 10:04:30'),
(51, 30, 22, '2026-06-11 10:04:30'),
(52, 30, 23, '2026-06-11 10:04:30'),
(53, 31, 24, '2026-06-11 10:08:26'),
(54, 31, 25, '2026-06-11 10:08:26'),
(55, 32, 26, '2026-06-11 10:14:20'),
(56, 32, 27, '2026-06-11 10:14:20'),
(57, 33, 28, '2026-06-11 10:20:32'),
(58, 33, 29, '2026-06-11 10:20:32'),
(59, 34, 30, '2026-06-11 10:23:34'),
(60, 34, 31, '2026-06-11 10:23:34'),
(61, 35, 30, '2026-06-11 10:25:49'),
(62, 35, 32, '2026-06-11 10:25:49'),
(63, 35, 20, '2026-06-11 10:25:49'),
(64, 36, 30, '2026-06-11 10:29:35'),
(65, 36, 32, '2026-06-11 10:29:35'),
(66, 36, 33, '2026-06-11 10:29:35'),
(67, 37, 34, '2026-06-11 10:34:01'),
(68, 37, 35, '2026-06-11 10:34:01'),
(69, 38, 30, '2026-06-11 10:39:15'),
(70, 38, 31, '2026-06-11 10:39:15'),
(71, 38, 36, '2026-06-11 10:39:15'),
(72, 38, 37, '2026-06-11 10:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `post_views`
--

CREATE TABLE `post_views` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `user_agent` text NOT NULL,
  `device` enum('Desktop','Mobile','Tablet') NOT NULL,
  `viewed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_views`
--

INSERT INTO `post_views` (`id`, `post_id`, `user_id`, `ip_address`, `user_agent`, `device`, `viewed_at`) VALUES
(1, 21, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-10 19:30:11'),
(2, 14, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-10 19:40:10'),
(3, 21, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-10 20:31:25'),
(4, 21, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-10 21:32:36'),
(5, 21, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 06:46:54'),
(6, 14, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 07:11:36'),
(7, 20, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 07:19:21'),
(8, 21, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 08:16:44'),
(9, 24, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 08:38:53'),
(10, 25, 1, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 09:19:26'),
(11, 26, 1, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 09:24:02'),
(12, 29, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 10:01:07'),
(13, 23, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 10:02:55'),
(14, 20, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:02:57'),
(15, 14, 0, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:04:46'),
(16, 26, 6, '192.168.1.144', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 12:07:58'),
(17, 23, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 12:09:28'),
(18, 14, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 12:09:49'),
(19, 29, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:11:40'),
(20, 21, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:12:25'),
(21, 26, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:12:31'),
(22, 38, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:16:40'),
(23, 37, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:16:55'),
(24, 36, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:17:50'),
(25, 28, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:17:58'),
(26, 18, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:18:15'),
(27, 24, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:18:21'),
(28, 23, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:18:26'),
(29, 27, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:18:31'),
(30, 13, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:18:44'),
(31, 22, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:18:54'),
(32, 17, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:19:06'),
(33, 30, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:19:15'),
(34, 31, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:19:28'),
(35, 19, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:19:34'),
(36, 35, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:19:44'),
(37, 33, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:19:49'),
(38, 15, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:20:06'),
(39, 25, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:20:48'),
(40, 16, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:20:56'),
(41, 34, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:21:07'),
(42, 11, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:21:23'),
(43, 32, 5, '192.168.1.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Desktop', '2026-06-11 12:22:36'),
(44, 21, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 12:29:15'),
(45, 21, 6, '192.168.1.144', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 12:30:51'),
(46, 24, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 17:31:10'),
(47, 23, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 17:55:19'),
(48, 34, 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'Desktop', '2026-06-11 17:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `code`, `name`) VALUES
(1, '11', 'Aceh'),
(2, '12', 'Sumatera Utara'),
(3, '13', 'Sumatera Barat'),
(4, '14', 'Riau'),
(5, '15', 'Jambi'),
(6, '16', 'Sumatera Selatan'),
(7, '17', 'Bengkulu'),
(8, '18', 'Lampung'),
(9, '19', 'Kepulauan Bangka Belitung'),
(10, '21', 'Kepulauan Riau'),
(11, '31', 'DKI Jakarta'),
(12, '32', 'Jawa Barat'),
(13, '33', 'Jawa Tengah'),
(14, '34', 'DI Yogyakarta'),
(15, '35', 'Jawa Timur'),
(16, '36', 'Banten'),
(17, '51', 'Bali'),
(18, '52', 'Nusa Tenggara Barat'),
(19, '53', 'Nusa Tenggara Timur'),
(20, '61', 'Kalimantan Barat'),
(21, '62', 'Kalimantan Tengah'),
(22, '63', 'Kalimantan Selatan'),
(23, '64', 'Kalimantan Timur'),
(24, '65', 'Kalimantan Utara'),
(25, '71', 'Sulawesi Utara'),
(26, '72', 'Sulawesi Tengah'),
(27, '73', 'Sulawesi Selatan'),
(28, '74', 'Sulawesi Tenggara'),
(29, '75', 'Gorontalo'),
(30, '76', 'Sulawesi Barat'),
(31, '81', 'Maluku'),
(32, '82', 'Maluku Utara'),
(33, '91', 'Papua'),
(34, '92', 'Papua Barat'),
(35, '93', 'Papua Selatan'),
(36, '94', 'Papua Tengah'),
(37, '95', 'Papua Pegunungan'),
(38, '96', 'Papua Barat Daya');

-- --------------------------------------------------------

--
-- Table structure for table `public_profile`
--

CREATE TABLE `public_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birth_place` varchar(150) NOT NULL,
  `date_birth` varchar(11) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `provinces_id` int(11) NOT NULL,
  `regencies_id` int(11) NOT NULL,
  `hobby` text NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `photo_profile` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_profile`
--

INSERT INTO `public_profile` (`id`, `user_id`, `full_name`, `birth_place`, `date_birth`, `gender`, `provinces_id`, `regencies_id`, `hobby`, `address`, `phone_number`, `photo_profile`, `status`) VALUES
(1, 4, 'Rizal', 'Jakarta', '1997-02-07', 'Laki-laki', 17, 276, 'tss', 'tes', '083197503154', '', 1),
(2, 5, 'ini', '', '', 'Laki-laki', 12, 176, '', 'harapan baru', '081234567890', 'avatar-men.png', 1),
(3, 6, 'josua simorangkir', '', '', 'Laki-laki', 12, 176, '', 'Kp. Harapan Baru', '085893574850', 'avatar-men.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `regencies`
--

CREATE TABLE `regencies` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regencies`
--

INSERT INTO `regencies` (`id`, `province_id`, `code`, `name`) VALUES
(1, 1, '1101', 'Kabupaten Simeulue'),
(2, 1, '1102', 'Kabupaten Aceh Singkil'),
(3, 1, '1103', 'Kabupaten Aceh Selatan'),
(4, 1, '1104', 'Kabupaten Aceh Tenggara'),
(5, 1, '1105', 'Kabupaten Aceh Timur'),
(6, 1, '1106', 'Kabupaten Aceh Tengah'),
(7, 1, '1107', 'Kabupaten Aceh Barat'),
(8, 1, '1108', 'Kabupaten Aceh Besar'),
(9, 1, '1109', 'Kabupaten Pidie'),
(10, 1, '1110', 'Kabupaten Bireuen'),
(11, 1, '1111', 'Kabupaten Aceh Utara'),
(12, 1, '1112', 'Kabupaten Aceh Barat Daya'),
(13, 1, '1113', 'Kabupaten Gayo Lues'),
(14, 1, '1114', 'Kabupaten Aceh Tamiang'),
(15, 1, '1115', 'Kabupaten Nagan Raya'),
(16, 1, '1116', 'Kabupaten Aceh Jaya'),
(17, 1, '1117', 'Kabupaten Bener Meriah'),
(18, 1, '1118', 'Kabupaten Pidie Jaya'),
(19, 1, '1171', 'Kota Banda Aceh'),
(20, 1, '1172', 'Kota Sabang'),
(21, 1, '1173', 'Kota Langsa'),
(22, 1, '1174', 'Kota Lhokseumawe'),
(23, 1, '1175', 'Kota Subulussalam'),
(24, 2, '1201', 'Kabupaten Nias'),
(25, 2, '1202', 'Kabupaten Mandailing Natal'),
(26, 2, '1203', 'Kabupaten Tapanuli Selatan'),
(27, 2, '1204', 'Kabupaten Tapanuli Tengah'),
(28, 2, '1205', 'Kabupaten Tapanuli Utara'),
(29, 2, '1206', 'Kabupaten Toba Samosir'),
(30, 2, '1207', 'Kabupaten Labuhan Batu'),
(31, 2, '1208', 'Kabupaten Asahan'),
(32, 2, '1209', 'Kabupaten Simalungun'),
(33, 2, '1210', 'Kabupaten Dairi'),
(34, 2, '1211', 'Kabupaten Karo'),
(35, 2, '1212', 'Kabupaten Deli Serdang'),
(36, 2, '1213', 'Kabupaten Langkat'),
(37, 2, '1214', 'Kabupaten Nias Selatan'),
(38, 2, '1215', 'Kabupaten Humbang Hasundutan'),
(39, 2, '1216', 'Kabupaten Pakpak Bharat'),
(40, 2, '1217', 'Kabupaten Samosir'),
(41, 2, '1218', 'Kabupaten Serdang Bedagai'),
(42, 2, '1219', 'Kabupaten Batu Bara'),
(43, 2, '1220', 'Kabupaten Padang Lawas Utara'),
(44, 2, '1221', 'Kabupaten Padang Lawas'),
(45, 2, '1222', 'Kabupaten Labuhan Batu Selatan'),
(46, 2, '1223', 'Kabupaten Labuhan Batu Utara'),
(47, 2, '1224', 'Kabupaten Nias Utara'),
(48, 2, '1225', 'Kabupaten Nias Barat'),
(49, 2, '1271', 'Kota Sibolga'),
(50, 2, '1272', 'Kota Tanjung Balai'),
(51, 2, '1273', 'Kota Pematang Siantar'),
(52, 2, '1274', 'Kota Tebing Tinggi'),
(53, 2, '1275', 'Kota Medan'),
(54, 2, '1276', 'Kota Binjai'),
(55, 2, '1277', 'Kota Padangsidempuan'),
(56, 2, '1278', 'Kota Gunungsitoli'),
(57, 3, '1301', 'Kabupaten Kepulauan Mentawai'),
(58, 3, '1302', 'Kabupaten Pesisir Selatan'),
(59, 3, '1303', 'Kabupaten Solok'),
(60, 3, '1304', 'Kabupaten Sijunjung'),
(61, 3, '1305', 'Kabupaten Tanah Datar'),
(62, 3, '1306', 'Kabupaten Padang Pariaman'),
(63, 3, '1307', 'Kabupaten Agam'),
(64, 3, '1308', 'Kabupaten Lima Puluh Kota'),
(65, 3, '1309', 'Kabupaten Pasaman'),
(66, 3, '1310', 'Kabupaten Solok Selatan'),
(67, 3, '1311', 'Kabupaten Dharmasraya'),
(68, 3, '1312', 'Kabupaten Pasaman Barat'),
(69, 3, '1371', 'Kota Padang'),
(70, 3, '1372', 'Kota Solok'),
(71, 3, '1373', 'Kota Sawah Lunto'),
(72, 3, '1374', 'Kota Padang Panjang'),
(73, 3, '1375', 'Kota Bukittinggi'),
(74, 3, '1376', 'Kota Payakumbuh'),
(75, 3, '1377', 'Kota Pariaman'),
(76, 4, '1401', 'Kabupaten Kuantan Singingi'),
(77, 4, '1402', 'Kabupaten Indragiri Hulu'),
(78, 4, '1403', 'Kabupaten Indragiri Hilir'),
(79, 4, '1404', 'Kabupaten Pelalawan'),
(80, 4, '1405', 'Kabupaten Siak'),
(81, 4, '1406', 'Kabupaten Kampar'),
(82, 4, '1407', 'Kabupaten Rokan Hulu'),
(83, 4, '1408', 'Kabupaten Bengkalis'),
(84, 4, '1409', 'Kabupaten Rokan Hilir'),
(85, 4, '1410', 'Kabupaten Kepulauan Meranti'),
(86, 4, '1471', 'Kota Pekanbaru'),
(87, 4, '1473', 'Kota Dumai'),
(88, 5, '1501', 'Kabupaten Kerinci'),
(89, 5, '1502', 'Kabupaten Merangin'),
(90, 5, '1503', 'Kabupaten Sarolangun'),
(91, 5, '1504', 'Kabupaten Batang Hari'),
(92, 5, '1505', 'Kabupaten Muaro Jambi'),
(93, 5, '1506', 'Kabupaten Tanjung Jabung Timur'),
(94, 5, '1507', 'Kabupaten Tanjung Jabung Barat'),
(95, 5, '1508', 'Kabupaten Tebo'),
(96, 5, '1509', 'Kabupaten Bungo'),
(97, 5, '1571', 'Kota Jambi'),
(98, 5, '1572', 'Kota Sungai Penuh'),
(99, 6, '1601', 'Kabupaten Ogan Komering Ulu'),
(100, 6, '1602', 'Kabupaten Ogan Komering Ilir'),
(101, 6, '1603', 'Kabupaten Muara Enim'),
(102, 6, '1604', 'Kabupaten Lahat'),
(103, 6, '1605', 'Kabupaten Musi Rawas'),
(104, 6, '1606', 'Kabupaten Musi Banyuasin'),
(105, 6, '1607', 'Kabupaten Banyuasin'),
(106, 6, '1608', 'Kabupaten Ogan Komering Ulu Selatan'),
(107, 6, '1609', 'Kabupaten Ogan Komering Ulu Timur'),
(108, 6, '1610', 'Kabupaten Ogan Ilir'),
(109, 6, '1611', 'Kabupaten Empat Lawang'),
(110, 6, '1612', 'Kabupaten Penukal Abab Lematang Ilir'),
(111, 6, '1613', 'Kabupaten Musi Rawas Utara'),
(112, 6, '1671', 'Kota Palembang'),
(113, 6, '1672', 'Kota Prabumulih'),
(114, 6, '1673', 'Kota Pagar Alam'),
(115, 6, '1674', 'Kota Lubuklinggau'),
(116, 7, '1701', 'Kabupaten Bengkulu Selatan'),
(117, 7, '1702', 'Kabupaten Rejang Lebong'),
(118, 7, '1703', 'Kabupaten Bengkulu Utara'),
(119, 7, '1704', 'Kabupaten Kaur'),
(120, 7, '1705', 'Kabupaten Seluma'),
(121, 7, '1706', 'Kabupaten Mukomuko'),
(122, 7, '1707', 'Kabupaten Lebong'),
(123, 7, '1708', 'Kabupaten Kepahiang'),
(124, 7, '1709', 'Kabupaten Bengkulu Tengah'),
(125, 7, '1771', 'Kota Bengkulu'),
(126, 8, '1801', 'Kabupaten Lampung Barat'),
(127, 8, '1802', 'Kabupaten Tanggamus'),
(128, 8, '1803', 'Kabupaten Lampung Selatan'),
(129, 8, '1804', 'Kabupaten Lampung Timur'),
(130, 8, '1805', 'Kabupaten Lampung Tengah'),
(131, 8, '1806', 'Kabupaten Lampung Utara'),
(132, 8, '1807', 'Kabupaten Way Kanan'),
(133, 8, '1808', 'Kabupaten Tulang Bawang'),
(134, 8, '1809', 'Kabupaten Pesawaran'),
(135, 8, '1810', 'Kabupaten Pringsewu'),
(136, 8, '1811', 'Kabupaten Mesuji'),
(137, 8, '1812', 'Kabupaten Tulang Bawang Barat'),
(138, 8, '1813', 'Kabupaten Pesisir Barat'),
(139, 8, '1871', 'Kota Bandar Lampung'),
(140, 8, '1872', 'Kota Metro'),
(141, 9, '1901', 'Kabupaten Bangka'),
(142, 9, '1902', 'Kabupaten Belitung'),
(143, 9, '1903', 'Kabupaten Bangka Barat'),
(144, 9, '1904', 'Kabupaten Bangka Tengah'),
(145, 9, '1905', 'Kabupaten Bangka Selatan'),
(146, 9, '1906', 'Kabupaten Belitung Timur'),
(147, 9, '1971', 'Kota Pangkal Pinang'),
(148, 10, '2101', 'Kabupaten Karimun'),
(149, 10, '2102', 'Kabupaten Bintan'),
(150, 10, '2103', 'Kabupaten Natuna'),
(151, 10, '2104', 'Kabupaten Lingga'),
(152, 10, '2105', 'Kabupaten Kepulauan Anambas'),
(153, 10, '2171', 'Kota Batam'),
(154, 10, '2172', 'Kota Tanjung Pinang'),
(155, 11, '3101', 'Kabupaten Kepulauan Seribu'),
(156, 11, '3171', 'Kota Jakarta Selatan'),
(157, 11, '3172', 'Kota Jakarta Timur'),
(158, 11, '3173', 'Kota Jakarta Pusat'),
(159, 11, '3174', 'Kota Jakarta Barat'),
(160, 11, '3175', 'Kota Jakarta Utara'),
(161, 12, '3201', 'Kabupaten Bogor'),
(162, 12, '3202', 'Kabupaten Sukabumi'),
(163, 12, '3203', 'Kabupaten Cianjur'),
(164, 12, '3204', 'Kabupaten Bandung'),
(165, 12, '3205', 'Kabupaten Garut'),
(166, 12, '3206', 'Kabupaten Tasikmalaya'),
(167, 12, '3207', 'Kabupaten Ciamis'),
(168, 12, '3208', 'Kabupaten Kuningan'),
(169, 12, '3209', 'Kabupaten Cirebon'),
(170, 12, '3210', 'Kabupaten Majalengka'),
(171, 12, '3211', 'Kabupaten Sumedang'),
(172, 12, '3212', 'Kabupaten Indramayu'),
(173, 12, '3213', 'Kabupaten Subang'),
(174, 12, '3214', 'Kabupaten Purwakarta'),
(175, 12, '3215', 'Kabupaten Karawang'),
(176, 12, '3216', 'Kabupaten Bekasi'),
(177, 12, '3217', 'Kabupaten Bandung Barat'),
(178, 12, '3218', 'Kabupaten Pangandaran'),
(179, 12, '3271', 'Kota Bogor'),
(180, 12, '3272', 'Kota Sukabumi'),
(181, 12, '3273', 'Kota Bandung'),
(182, 12, '3274', 'Kota Cirebon'),
(183, 12, '3275', 'Kota Bekasi'),
(184, 12, '3276', 'Kota Depok'),
(185, 12, '3277', 'Kota Cimahi'),
(186, 12, '3278', 'Kota Tasikmalaya'),
(187, 12, '3279', 'Kota Banjar'),
(188, 13, '3301', 'Kabupaten Cilacap'),
(189, 13, '3302', 'Kabupaten Banyumas'),
(190, 13, '3303', 'Kabupaten Purbalingga'),
(191, 13, '3304', 'Kabupaten Banjarnegara'),
(192, 13, '3305', 'Kabupaten Kebumen'),
(193, 13, '3306', 'Kabupaten Purworejo'),
(194, 13, '3307', 'Kabupaten Wonosobo'),
(195, 13, '3308', 'Kabupaten Magelang'),
(196, 13, '3309', 'Kabupaten Boyolali'),
(197, 13, '3310', 'Kabupaten Klaten'),
(198, 13, '3311', 'Kabupaten Sukoharjo'),
(199, 13, '3312', 'Kabupaten Wonogiri'),
(200, 13, '3313', 'Kabupaten Karanganyar'),
(201, 13, '3314', 'Kabupaten Sragen'),
(202, 13, '3315', 'Kabupaten Grobogan'),
(203, 13, '3316', 'Kabupaten Blora'),
(204, 13, '3317', 'Kabupaten Rembang'),
(205, 13, '3318', 'Kabupaten Pati'),
(206, 13, '3319', 'Kabupaten Kudus'),
(207, 13, '3320', 'Kabupaten Jepara'),
(208, 13, '3321', 'Kabupaten Demak'),
(209, 13, '3322', 'Kabupaten Semarang'),
(210, 13, '3323', 'Kabupaten Temanggung'),
(211, 13, '3324', 'Kabupaten Kendal'),
(212, 13, '3325', 'Kabupaten Batang'),
(213, 13, '3326', 'Kabupaten Pekalongan'),
(214, 13, '3327', 'Kabupaten Pemalang'),
(215, 13, '3328', 'Kabupaten Tegal'),
(216, 13, '3329', 'Kabupaten Brebes'),
(217, 13, '3371', 'Kota Magelang'),
(218, 13, '3372', 'Kota Surakarta'),
(219, 13, '3373', 'Kota Salatiga'),
(220, 13, '3374', 'Kota Semarang'),
(221, 13, '3375', 'Kota Pekalongan'),
(222, 13, '3376', 'Kota Tegal'),
(223, 14, '3401', 'Kabupaten Kulon Progo'),
(224, 14, '3402', 'Kabupaten Bantul'),
(225, 14, '3403', 'Kabupaten Gunung Kidul'),
(226, 14, '3404', 'Kabupaten Sleman'),
(227, 14, '3471', 'Kota Yogyakarta'),
(228, 15, '3501', 'Kabupaten Pacitan'),
(229, 15, '3502', 'Kabupaten Ponorogo'),
(230, 15, '3503', 'Kabupaten Trenggalek'),
(231, 15, '3504', 'Kabupaten Tulungagung'),
(232, 15, '3505', 'Kabupaten Blitar'),
(233, 15, '3506', 'Kabupaten Kediri'),
(234, 15, '3507', 'Kabupaten Malang'),
(235, 15, '3508', 'Kabupaten Lumajang'),
(236, 15, '3509', 'Kabupaten Jember'),
(237, 15, '3510', 'Kabupaten Banyuwangi'),
(238, 15, '3511', 'Kabupaten Bondowoso'),
(239, 15, '3512', 'Kabupaten Situbondo'),
(240, 15, '3513', 'Kabupaten Probolinggo'),
(241, 15, '3514', 'Kabupaten Pasuruan'),
(242, 15, '3515', 'Kabupaten Sidoarjo'),
(243, 15, '3516', 'Kabupaten Mojokerto'),
(244, 15, '3517', 'Kabupaten Jombang'),
(245, 15, '3518', 'Kabupaten Nganjuk'),
(246, 15, '3519', 'Kabupaten Madiun'),
(247, 15, '3520', 'Kabupaten Magetan'),
(248, 15, '3521', 'Kabupaten Ngawi'),
(249, 15, '3522', 'Kabupaten Bojonegoro'),
(250, 15, '3523', 'Kabupaten Tuban'),
(251, 15, '3524', 'Kabupaten Lamongan'),
(252, 15, '3525', 'Kabupaten Gresik'),
(253, 15, '3526', 'Kabupaten Bangkalan'),
(254, 15, '3527', 'Kabupaten Sampang'),
(255, 15, '3528', 'Kabupaten Pamekasan'),
(256, 15, '3529', 'Kabupaten Sumenep'),
(257, 15, '3571', 'Kota Kediri'),
(258, 15, '3572', 'Kota Blitar'),
(259, 15, '3573', 'Kota Malang'),
(260, 15, '3574', 'Kota Probolinggo'),
(261, 15, '3575', 'Kota Pasuruan'),
(262, 15, '3576', 'Kota Mojokerto'),
(263, 15, '3577', 'Kota Madiun'),
(264, 15, '3578', 'Kota Surabaya'),
(265, 15, '3579', 'Kota Batu'),
(266, 16, '3601', 'Kabupaten Pandeglang'),
(267, 16, '3602', 'Kabupaten Lebak'),
(268, 16, '3603', 'Kabupaten Tangerang'),
(269, 16, '3604', 'Kabupaten Serang'),
(270, 16, '3671', 'Kota Tangerang'),
(271, 16, '3672', 'Kota Cilegon'),
(272, 16, '3673', 'Kota Serang'),
(273, 16, '3674', 'Kota Tangerang Selatan'),
(274, 17, '5101', 'Kabupaten Jembrana'),
(275, 17, '5102', 'Kabupaten Tabanan'),
(276, 17, '5103', 'Kabupaten Badung'),
(277, 17, '5104', 'Kabupaten Gianyar'),
(278, 17, '5105', 'Kabupaten Klungkung'),
(279, 17, '5106', 'Kabupaten Bangli'),
(280, 17, '5107', 'Kabupaten Karangasem'),
(281, 17, '5108', 'Kabupaten Buleleng'),
(282, 17, '5171', 'Kota Denpasar'),
(283, 18, '5201', 'Kabupaten Lombok Barat'),
(284, 18, '5202', 'Kabupaten Lombok Tengah'),
(285, 18, '5203', 'Kabupaten Lombok Timur'),
(286, 18, '5204', 'Kabupaten Sumbawa'),
(287, 18, '5205', 'Kabupaten Dompu'),
(288, 18, '5206', 'Kabupaten Bima'),
(289, 18, '5207', 'Kabupaten Sumbawa Barat'),
(290, 18, '5208', 'Kabupaten Lombok Utara'),
(291, 18, '5271', 'Kota Mataram'),
(292, 18, '5272', 'Kota Bima'),
(293, 19, '5301', 'Kabupaten Sumba Barat'),
(294, 19, '5302', 'Kabupaten Sumba Timur'),
(295, 19, '5303', 'Kabupaten Kupang'),
(296, 19, '5304', 'Kabupaten Timor Tengah Selatan'),
(297, 19, '5305', 'Kabupaten Timor Tengah Utara'),
(298, 19, '5306', 'Kabupaten Belu'),
(299, 19, '5307', 'Kabupaten Alor'),
(300, 19, '5308', 'Kabupaten Lembata'),
(301, 19, '5309', 'Kabupaten Flores Timur'),
(302, 19, '5310', 'Kabupaten Sikka'),
(303, 19, '5311', 'Kabupaten Ende'),
(304, 19, '5312', 'Kabupaten Ngada'),
(305, 19, '5313', 'Kabupaten Manggarai'),
(306, 19, '5314', 'Kabupaten Rote Ndao'),
(307, 19, '5315', 'Kabupaten Manggarai Barat'),
(308, 19, '5316', 'Kabupaten Sumba Tengah'),
(309, 19, '5317', 'Kabupaten Sumba Barat Daya'),
(310, 19, '5318', 'Kabupaten Nagekeo'),
(311, 19, '5319', 'Kabupaten Manggarai Timur'),
(312, 19, '5320', 'Kabupaten Sabu Raijua'),
(313, 19, '5321', 'Kabupaten Malaka'),
(314, 19, '5371', 'Kota Kupang'),
(315, 20, '6101', 'Kabupaten Sambas'),
(316, 20, '6102', 'Kabupaten Bengkayang'),
(317, 20, '6103', 'Kabupaten Landak'),
(318, 20, '6104', 'Kabupaten Mempawah'),
(319, 20, '6105', 'Kabupaten Sanggau'),
(320, 20, '6106', 'Kabupaten Ketapang'),
(321, 20, '6107', 'Kabupaten Sintang'),
(322, 20, '6108', 'Kabupaten Kapuas Hulu'),
(323, 20, '6109', 'Kabupaten Sekadau'),
(324, 20, '6110', 'Kabupaten Melawi'),
(325, 20, '6111', 'Kabupaten Kayong Utara'),
(326, 20, '6112', 'Kabupaten Kubu Raya'),
(327, 20, '6171', 'Kota Pontianak'),
(328, 20, '6172', 'Kota Singkawang'),
(329, 21, '6201', 'Kabupaten Kotawaringin Barat'),
(330, 21, '6202', 'Kabupaten Kotawaringin Timur'),
(331, 21, '6203', 'Kabupaten Kapuas'),
(332, 21, '6204', 'Kabupaten Barito Selatan'),
(333, 21, '6205', 'Kabupaten Barito Utara'),
(334, 21, '6206', 'Kabupaten Sukamara'),
(335, 21, '6207', 'Kabupaten Lamandau'),
(336, 21, '6208', 'Kabupaten Seruyan'),
(337, 21, '6209', 'Kabupaten Katingan'),
(338, 21, '6210', 'Kabupaten Pulang Pisau'),
(339, 21, '6211', 'Kabupaten Gunung Mas'),
(340, 21, '6212', 'Kabupaten Barito Timur'),
(341, 21, '6213', 'Kabupaten Murung Raya'),
(342, 21, '6271', 'Kota Palangka Raya'),
(343, 22, '6301', 'Kabupaten Tanah Laut'),
(344, 22, '6302', 'Kabupaten Kotabaru'),
(345, 22, '6303', 'Kabupaten Banjar'),
(346, 22, '6304', 'Kabupaten Barito Kuala'),
(347, 22, '6305', 'Kabupaten Tapin'),
(348, 22, '6306', 'Kabupaten Hulu Sungai Selatan'),
(349, 22, '6307', 'Kabupaten Hulu Sungai Tengah'),
(350, 22, '6308', 'Kabupaten Hulu Sungai Utara'),
(351, 22, '6309', 'Kabupaten Tabalong'),
(352, 22, '6310', 'Kabupaten Tanah Bumbu'),
(353, 22, '6311', 'Kabupaten Balangan'),
(354, 22, '6371', 'Kota Banjarmasin'),
(355, 22, '6372', 'Kota Banjarbaru'),
(356, 23, '6401', 'Kabupaten Paser'),
(357, 23, '6402', 'Kabupaten Kutai Barat'),
(358, 23, '6403', 'Kabupaten Kutai Kartanegara'),
(359, 23, '6404', 'Kabupaten Kutai Timur'),
(360, 23, '6405', 'Kabupaten Berau'),
(361, 23, '6409', 'Kabupaten Penajam Paser Utara'),
(362, 23, '6411', 'Kabupaten Mahakam Hulu'),
(363, 23, '6471', 'Kota Balikpapan'),
(364, 23, '6472', 'Kota Samarinda'),
(365, 23, '6474', 'Kota Bontang'),
(366, 24, '6501', 'Kabupaten Malinau'),
(367, 24, '6502', 'Kabupaten Bulungan'),
(368, 24, '6503', 'Kabupaten Tana Tidung'),
(369, 24, '6504', 'Kabupaten Nunukan'),
(370, 24, '6571', 'Kota Tarakan'),
(371, 25, '7101', 'Kabupaten Bolaang Mongondow'),
(372, 25, '7102', 'Kabupaten Minahasa'),
(373, 25, '7103', 'Kabupaten Kepulauan Sangihe'),
(374, 25, '7104', 'Kabupaten Kepulauan Talaud'),
(375, 25, '7105', 'Kabupaten Minahasa Selatan'),
(376, 25, '7106', 'Kabupaten Minahasa Utara'),
(377, 25, '7107', 'Kabupaten Bolaang Mongondow Utara'),
(378, 25, '7108', 'Kabupaten Siau Tagulandang Biaro'),
(379, 25, '7109', 'Kabupaten Minahasa Tenggara'),
(380, 25, '7110', 'Kabupaten Bolaang Mongondow Selatan'),
(381, 25, '7111', 'Kabupaten Bolaang Mongondow Timur'),
(382, 25, '7171', 'Kota Manado'),
(383, 25, '7172', 'Kota Bitung'),
(384, 25, '7173', 'Kota Tomohon'),
(385, 25, '7174', 'Kota Kotamobagu'),
(386, 26, '7201', 'Kabupaten Banggai Kepulauan'),
(387, 26, '7202', 'Kabupaten Banggai'),
(388, 26, '7203', 'Kabupaten Morowali'),
(389, 26, '7204', 'Kabupaten Poso'),
(390, 26, '7205', 'Kabupaten Donggala'),
(391, 26, '7206', 'Kabupaten Tolitoli'),
(392, 26, '7207', 'Kabupaten Buol'),
(393, 26, '7208', 'Kabupaten Parigi Moutong'),
(394, 26, '7209', 'Kabupaten Tojo Una-Una'),
(395, 26, '7210', 'Kabupaten Sigi'),
(396, 26, '7211', 'Kabupaten Banggai Laut'),
(397, 26, '7212', 'Kabupaten Morowali Utara'),
(398, 26, '7271', 'Kota Palu'),
(399, 27, '7301', 'Kabupaten Kepulauan Selayar'),
(400, 27, '7302', 'Kabupaten Bulukumba'),
(401, 27, '7303', 'Kabupaten Bantaeng'),
(402, 27, '7304', 'Kabupaten Jeneponto'),
(403, 27, '7305', 'Kabupaten Takalar'),
(404, 27, '7306', 'Kabupaten Gowa'),
(405, 27, '7307', 'Kabupaten Sinjai'),
(406, 27, '7308', 'Kabupaten Maros'),
(407, 27, '7309', 'Kabupaten Pangkajene dan Kepulauan'),
(408, 27, '7310', 'Kabupaten Barru'),
(409, 27, '7311', 'Kabupaten Bone'),
(410, 27, '7312', 'Kabupaten Soppeng'),
(411, 27, '7313', 'Kabupaten Wajo'),
(412, 27, '7314', 'Kabupaten Sidenreng Rappang'),
(413, 27, '7315', 'Kabupaten Pinrang'),
(414, 27, '7316', 'Kabupaten Enrekang'),
(415, 27, '7317', 'Kabupaten Luwu'),
(416, 27, '7318', 'Kabupaten Tana Toraja'),
(417, 27, '7322', 'Kabupaten Luwu Utara'),
(418, 27, '7325', 'Kabupaten Luwu Timur'),
(419, 27, '7326', 'Kabupaten Toraja Utara'),
(420, 27, '7371', 'Kota Makassar'),
(421, 27, '7372', 'Kota Parepare'),
(422, 27, '7373', 'Kota Palopo'),
(423, 27, '7371', 'Kota Makassar'),
(424, 27, '7372', 'Kota Parepare'),
(425, 27, '7373', 'Kota Palopo'),
(426, 28, '7401', 'Kabupaten Buton'),
(427, 28, '7402', 'Kabupaten Muna'),
(428, 28, '7403', 'Kabupaten Konawe'),
(429, 28, '7404', 'Kabupaten Kolaka'),
(430, 28, '7405', 'Kabupaten Konawe Selatan'),
(431, 28, '7406', 'Kabupaten Bombana'),
(432, 28, '7407', 'Kabupaten Wakatobi'),
(433, 28, '7408', 'Kabupaten Kolaka Utara'),
(434, 28, '7409', 'Kabupaten Buton Utara'),
(435, 28, '7410', 'Kabupaten Konawe Utara'),
(436, 28, '7411', 'Kabupaten Kolaka Timur'),
(437, 28, '7412', 'Kabupaten Konawe Kepulauan'),
(438, 28, '7413', 'Kabupaten Muna Barat'),
(439, 28, '7414', 'Kabupaten Buton Tengah'),
(440, 28, '7415', 'Kabupaten Buton Selatan'),
(441, 28, '7471', 'Kota Kendari'),
(442, 28, '7472', 'Kota Baubau'),
(443, 29, '7501', 'Kabupaten Boalemo'),
(444, 29, '7502', 'Kabupaten Gorontalo'),
(445, 29, '7503', 'Kabupaten Pohuwato'),
(446, 29, '7504', 'Kabupaten Bone Bolango'),
(447, 29, '7505', 'Kabupaten Gorontalo Utara'),
(448, 29, '7571', 'Kota Gorontalo'),
(449, 30, '7601', 'Kabupaten Majene'),
(450, 30, '7602', 'Kabupaten Polewali Mandar'),
(451, 30, '7603', 'Kabupaten Mamasa'),
(452, 30, '7604', 'Kabupaten Mamuju'),
(453, 30, '7605', 'Kabupaten Pasangkayu'),
(454, 30, '7606', 'Kabupaten Mamuju Tengah'),
(455, 31, '8101', 'Kabupaten Kepulauan Tanimbar'),
(456, 31, '8102', 'Kabupaten Maluku Tenggara'),
(457, 31, '8103', 'Kabupaten Maluku Tengah'),
(458, 31, '8104', 'Kabupaten Buru'),
(459, 31, '8105', 'Kabupaten Kepulauan Aru'),
(460, 31, '8106', 'Kabupaten Seram Bagian Barat'),
(461, 31, '8107', 'Kabupaten Seram Bagian Timur'),
(462, 31, '8108', 'Kabupaten Maluku Barat Daya'),
(463, 31, '8109', 'Kabupaten Buru Selatan'),
(464, 31, '8171', 'Kota Ambon'),
(465, 31, '8172', 'Kota Tual'),
(466, 32, '8201', 'Kabupaten Halmahera Barat'),
(467, 32, '8202', 'Kabupaten Halmahera Tengah'),
(468, 32, '8203', 'Kabupaten Kepulauan Sula'),
(469, 32, '8204', 'Kabupaten Halmahera Selatan'),
(470, 32, '8205', 'Kabupaten Halmahera Utara'),
(471, 32, '8206', 'Kabupaten Halmahera Timur'),
(472, 32, '8207', 'Kabupaten Pulau Morotai'),
(473, 32, '8208', 'Kabupaten Pulau Taliabu'),
(474, 32, '8271', 'Kota Ternate'),
(475, 32, '8272', 'Kota Tidore Kepulauan'),
(476, 34, '9101', 'Kabupaten Fakfak'),
(477, 34, '9102', 'Kabupaten Kaimana'),
(478, 34, '9103', 'Kabupaten Teluk Wondama'),
(479, 34, '9104', 'Kabupaten Teluk Bintuni'),
(480, 34, '9105', 'Kabupaten Manokwari'),
(481, 34, '9106', 'Kabupaten Sorong Selatan'),
(482, 34, '9107', 'Kabupaten Sorong'),
(483, 34, '9108', 'Kabupaten Raja Ampat'),
(484, 34, '9109', 'Kabupaten Tambrauw'),
(485, 34, '9110', 'Kabupaten Maybrat'),
(486, 34, '9111', 'Kabupaten Manokwari Selatan'),
(487, 34, '9112', 'Kabupaten Pegunungan Arfak'),
(488, 34, '9171', 'Kota Sorong'),
(489, 33, '9401', 'Kabupaten Merauke'),
(490, 33, '9402', 'Kabupaten Jayawijaya'),
(491, 33, '9403', 'Kabupaten Jayapura'),
(492, 33, '9404', 'Kabupaten Nabire'),
(493, 33, '9408', 'Kabupaten Kepulauan Yapen'),
(494, 33, '9409', 'Kabupaten Biak Numfor'),
(495, 33, '9410', 'Kabupaten Paniai'),
(496, 33, '9411', 'Kabupaten Puncak Jaya'),
(497, 33, '9412', 'Kabupaten Mimika'),
(498, 33, '9413', 'Kabupaten Boven Digoel'),
(499, 33, '9414', 'Kabupaten Mappi'),
(500, 33, '9415', 'Kabupaten Asmat'),
(501, 33, '9416', 'Kabupaten Yahukimo'),
(502, 33, '9417', 'Kabupaten Pegunungan Bintang'),
(503, 33, '9418', 'Kabupaten Tolikara'),
(504, 33, '9419', 'Kabupaten Sarmi'),
(505, 33, '9420', 'Kabupaten Keerom'),
(506, 33, '9426', 'Kabupaten Waropen'),
(507, 33, '9427', 'Kabupaten Supiori'),
(508, 33, '9428', 'Kabupaten Mamberamo Raya'),
(509, 33, '9429', 'Kabupaten Nduga'),
(510, 33, '9430', 'Kabupaten Lanny Jaya'),
(511, 33, '9431', 'Kabupaten Mamberamo Tengah'),
(512, 33, '9432', 'Kabupaten Yalimo'),
(513, 33, '9433', 'Kabupaten Puncak'),
(514, 33, '9434', 'Kabupaten Dogiyai'),
(515, 33, '9435', 'Kabupaten Intan Jaya'),
(516, 33, '9436', 'Kabupaten Deiyai'),
(517, 33, '9471', 'Kota Jayapura');

-- --------------------------------------------------------

--
-- Table structure for table `reset_token`
--

CREATE TABLE `reset_token` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `reset_token` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('terkirim','gagal') NOT NULL DEFAULT 'terkirim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_token`
--

INSERT INTO `reset_token` (`id`, `user_id`, `email`, `reset_token`, `created_at`, `status`) VALUES
(2, 1, 'yohanesferdinan76@yahoo.co.id', 'QUPKC3ZJD8', '2026-06-08 13:22:59', 'terkirim');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `update_at`) VALUES
(1, 'Pembina', '2026-06-01 20:06:01', '0000-00-00 00:00:00'),
(2, 'Moderator', '2026-06-09 16:57:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `link_platform` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform_id`, `account_name`, `link_platform`, `created_at`, `update_at`) VALUES
(6, 2, 'Hukuminfo Official', 'https://www.instagram.com/', '2026-06-09 13:47:32', '2026-06-10 20:26:07'),
(7, 1, '@Hukuminfo.official', 'https://www.instagram.com/', '2026-06-10 20:25:46', '2026-06-10 20:26:25'),
(8, 4, 'Hukuminfo Official', 'https://www.instagram.com/', '2026-06-10 20:26:48', '0000-00-00 00:00:00'),
(9, 5, '@Hukuminfo.official', 'https://www.instagram.com/tes', '2026-06-10 20:27:04', '0000-00-00 00:00:00'),
(10, 3, 'Hukuminfo Official', 'https://www.instagram.com/tes', '2026-06-10 20:27:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) NOT NULL,
  `subscriber_type` enum('guest','account') NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `email` int(11) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','unsubscribe','banned') NOT NULL DEFAULT 'active',
  `unsubscribe_token` varchar(255) NOT NULL,
  `subscribed_ip` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(100) NOT NULL,
  `tag_slug` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`, `tag_slug`, `created_at`) VALUES
(1, 'pol', 'pol', '2026-06-06 17:56:40'),
(2, 'PILDO', 'pildo', '2026-06-08 18:57:21'),
(3, 'kuda lumping', 'kuda-lumping', '2026-06-09 07:29:53'),
(4, 'pisau gerangan', 'pisau-gerangan', '2026-06-09 07:29:53'),
(5, 'PAK POL TOLOL', 'pak-pol-tolol', '2026-06-09 07:31:14'),
(6, 'WKWWKKW', 'wkwwkkw', '2026-06-09 07:31:14'),
(7, 'WAUJAN', 'waujan', '2026-06-09 07:41:14'),
(8, 'tes', 'tes', '2026-06-10 14:56:49'),
(9, 'tess', 'tess', '2026-06-10 15:06:09'),
(10, 'tst', 'tst', '2026-06-10 15:09:15'),
(11, 'tesss', 'tesss', '2026-06-10 15:11:49'),
(12, 'tessst', 'tessst', '2026-06-10 15:14:07'),
(13, 'test', 'test', '2026-06-10 15:16:41'),
(14, 'test1', 'test1', '2026-06-10 15:19:39'),
(15, 'tes1', 'tes1', '2026-06-10 15:21:45'),
(16, 'tss1', 'tss1', '2026-06-10 15:24:10'),
(17, 'st1', 'st1', '2026-06-10 15:26:16'),
(18, 'IRAN', 'iran', '2026-06-11 09:54:30'),
(19, 'USA', 'usa', '2026-06-11 09:54:30'),
(20, 'DPRD G', 'dprd-g', '2026-06-11 09:58:35'),
(21, 'PIALA DUNIA', 'piala-dunia', '2026-06-11 10:04:30'),
(22, 'BOLA', 'bola', '2026-06-11 10:04:30'),
(23, 'ATURAN BOLA', 'aturan-bola', '2026-06-11 10:04:30'),
(24, 'BNN', 'bnn', '2026-06-11 10:08:26'),
(25, 'BNNP', 'bnnp', '2026-06-11 10:08:26'),
(26, 'FIFA', 'fifa', '2026-06-11 10:14:20'),
(27, 'PILDUN', 'pildun', '2026-06-11 10:14:20'),
(28, 'WASIT', 'wasit', '2026-06-11 10:20:32'),
(29, 'AMERIKA', 'amerika', '2026-06-11 10:20:32'),
(30, 'POLISI', 'polisi', '2026-06-11 10:23:34'),
(31, 'PENCURIAN', 'pencurian', '2026-06-11 10:23:34'),
(32, 'KORUPSI', 'korupsi', '2026-06-11 10:25:49'),
(33, 'DINAS', 'dinas', '2026-06-11 10:29:35'),
(34, 'ARTIS', 'artis', '2026-06-11 10:34:01'),
(35, 'ACEH', 'aceh', '2026-06-11 10:34:01'),
(36, 'SAPI', 'sapi', '2026-06-11 10:39:15'),
(37, 'MALING', 'maling', '2026-06-11 10:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_type` enum('internal','public') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `last_seen` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `newsletter_subscribe` tinyint(1) DEFAULT NULL,
  `account_status` enum('Active','Inactive') DEFAULT 'Active',
  `delete_requested_at` datetime DEFAULT NULL,
  `delete_scheduled_at` datetime DEFAULT NULL,
  `delete_cancel_until` datetime DEFAULT NULL,
  `pending_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `user_type`, `created_at`, `updated_at`, `last_seen`, `logout_at`, `is_online`, `newsletter_subscribe`, `account_status`, `delete_requested_at`, `delete_scheduled_at`, `delete_cancel_until`, `pending_delete`) VALUES
(1, 'yohanesferdinan76@yahoo.co.id', '$2y$10$6tJ6BHNXo1Yj.gkPZkYZ9evdQua739aaJu7Dk5ySElrpnpgKKgSQ2', 1, 'internal', '2026-05-31 23:37:26', '2026-06-11 11:48:00', '2026-06-11 09:19:20', '2026-06-11 11:48:00', 0, NULL, 'Active', NULL, NULL, NULL, 0),
(2, 'briansteven464@gmail.com', '$2y$10$f7XswuiRm6Sl0kR/l6G7M.Cz7sk9XHP53XBFSIs1bZ3aLQcWGenvi', 2, 'internal', '2026-06-09 16:58:12', '2026-06-10 18:05:50', '2026-06-10 17:13:56', '2026-06-10 18:05:50', 0, NULL, 'Active', NULL, NULL, NULL, 0),
(3, 'brianbi7297@gmail.com', '$2y$10$otUKG6Sq7CIf9UIot4O5OOzR3xXc3YhMag6SQwmwU4cI8DW8kP3PG', 2, 'internal', '2026-06-09 17:28:59', '0000-00-00 00:00:00', '2026-06-09 17:28:59', '2026-06-09 17:28:59', 0, NULL, 'Active', NULL, NULL, NULL, 0),
(4, 'konigguard.official@gmail.com', '$2y$10$GdtXAKooVl9bdOxlK5mD1OB23Voaqv9hY8nZMF8W5kJQAmMg9KC1i', 2, 'public', '2026-06-10 06:08:05', '2026-06-11 12:48:57', '2026-06-11 12:05:34', '2026-06-11 12:48:57', 0, NULL, 'Active', '2026-06-10 08:26:39', '2026-07-10 08:26:39', NULL, 1),
(5, 'inis15146@gmail.com', '$2y$10$NCUw5yQLg7OIf5E4PlDzy.GMEuBp1wNT6.oYmeBhaBPZ3UKjlvQ96', 2, 'public', '2026-06-11 11:53:00', '2026-06-11 12:05:23', '2026-06-11 12:05:23', '2026-06-11 11:53:00', 1, NULL, 'Active', NULL, NULL, NULL, 0),
(6, 'josuasmrngkr20@gmail.com', '$2y$10$CErttzC29t8bLrfHshVXD.9ApMbB29bdsiyx/iojA57H7huyL8N0u', 2, 'public', '2026-06-11 11:53:48', '2026-06-11 12:07:22', '2026-06-11 12:07:22', '2026-06-11 11:53:48', 1, NULL, 'Active', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `date_birth` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `marital_status` enum('Belum Menikah','Menikah') NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `photo_profile` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `full_name`, `birth_place`, `date_birth`, `gender`, `marital_status`, `address`, `phone_number`, `linkedin`, `instagram`, `photo_profile`, `slug`) VALUES
(1, 1, 'Yohanes Ferdinan Silaen', 'Jakarta', '1997-07-07', 'Laki-laki', 'Belum Menikah', 'Tes123', '0811 1902 759', 'tidak kosong', 'tidak kosong', 'yohanes-ferdinan-silaen.jpeg', 'yohanes-ferdinan-silaen'),
(2, 2, 'Brian Steven', 'Jakarta', '1997-02-07', 'Laki-laki', 'Belum Menikah', 'tes', '083197503720', '', '', 'avatar-men.png', 'brian-steven'),
(3, 3, 'Noname', 'Bekasi', '1997-12-25', 'Laki-laki', 'Belum Menikah', 'tes', '083197503154', '', '', 'avatar-men.png', 'noname');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` bigint(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `code` varchar(6) NOT NULL,
  `expired_at` datetime NOT NULL,
  `is_used` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `email`, `code`, `expired_at`, `is_used`, `created_at`) VALUES
(4, 'konigguard.official@gmail.com', '825092', '2026-06-10 06:09:41', '1', '2026-06-10 06:07:41'),
(5, 'inis15146@gmail.com', '443990', '2026-06-11 11:54:03', '1', '2026-06-11 11:52:03'),
(6, 'josuasmrngkr20@gmail.com', '670316', '2026-06-11 11:55:25', '1', '2026-06-11 11:53:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_socmed`
--
ALTER TABLE `list_socmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_logs`
--
ALTER TABLE `newsletter_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_queue`
--
ALTER TABLE `newsletter_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `post_bookmarks`
--
ALTER TABLE `post_bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_bookmark` (`post_id`,`user_id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comment_reply`
--
ALTER TABLE `post_comment_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`post_id`,`user_id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `post_subcategory`
--
ALTER TABLE `post_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `public_profile`
--
ALTER TABLE `public_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regencies`
--
ALTER TABLE `regencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_role_name` (`role_name`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `list_socmed`
--
ALTER TABLE `list_socmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newsletter_logs`
--
ALTER TABLE `newsletter_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter_queue`
--
ALTER TABLE `newsletter_queue`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `post_bookmarks`
--
ALTER TABLE `post_bookmarks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_comment_reply`
--
ALTER TABLE `post_comment_reply`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `post_subcategory`
--
ALTER TABLE `post_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `post_views`
--
ALTER TABLE `post_views`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `public_profile`
--
ALTER TABLE `public_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regencies`
--
ALTER TABLE `regencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=518;

--
-- AUTO_INCREMENT for table `reset_token`
--
ALTER TABLE `reset_token`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_bookmarks`
--
ALTER TABLE `post_bookmarks`
  ADD CONSTRAINT `fk_bookmark_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bookmark_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `fk_like_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regencies`
--
ALTER TABLE `regencies`
  ADD CONSTRAINT `regencies_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
