-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 03 Tem 2022, 00:36:22
-- Sunucu sürümü: 5.7.38
-- PHP Sürümü: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `xne33esa_kofteciyusuf`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_logo` varchar(400) NOT NULL,
  `site_baslik` varchar(350) NOT NULL,
  `site_aciklama` varchar(300) NOT NULL,
  `site_link` varchar(100) NOT NULL,
  `site_sahip_mail` varchar(100) NOT NULL,
  `site_mail_host` varchar(100) NOT NULL,
  `site_mail_mail` varchar(100) NOT NULL,
  `site_mail_port` int(11) NOT NULL,
  `site_mail_sifre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_logo`, `site_baslik`, `site_aciklama`, `site_link`, `site_sahip_mail`, `site_mail_host`, `site_mail_mail`, `site_mail_port`, `site_mail_sifre`) VALUES
(1, '701260KalpKirmiziDaireliBeyaz24x24.png', 'Örnek Scriptler', 'Örnek Scriptler', 'http://localhost/Kurs', 'bmy_746@hotmail.com', '00000', '000', 0, '000000000');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(11) NOT NULL,
  `kul_isim` varchar(200) DEFAULT NULL,
  `kul_mail` varchar(200) DEFAULT NULL,
  `kul_sifre` varchar(200) DEFAULT NULL,
  `kul_tel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`, `kul_tel`) VALUES
(1, 'Mücahit Yiğit', 'b.mucahityigit@gmail.com', '60a05617672ac0cbff53400a1d86ee36', '0531 917 41 44'),
(2, 'Oğuzhan Güneş', 'oguzhan@gmail.com', '236b8f767a56f75cbb9255132ab9b373', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `masalar`
--

CREATE TABLE `masalar` (
  `masalar_id` int(11) NOT NULL,
  `masa_id` int(11) NOT NULL,
  `kart_adi` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'BOS',
  `kart_numarasi` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'BOS',
  `masa_durumu` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'BOS',
  `masa_detay` varchar(300) CHARACTER SET utf8 NOT NULL DEFAULT 'BOS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `masalar`
--

INSERT INTO `masalar` (`masalar_id`, `masa_id`, `kart_adi`, `kart_numarasi`, `masa_durumu`, `masa_detay`) VALUES
(1, 1, 'Dhrsghvv', '3333-3333-3333-3333', 'ÖDENDİ', ''),
(2, 2, 'BOS', 'BOS', 'BOS', 'BOS'),
(3, 3, 'BOS', 'BOS', 'BOS', 'BOS'),
(4, 4, 'BOS', 'BOS', 'BOS', 'BOS'),
(5, 5, 'BOS', 'BOS', 'BOS', 'BOS'),
(6, 6, 'BOS', 'BOS', 'BOS', 'BOS'),
(7, 7, 'BOS', 'BOS', 'BOS', 'BOS'),
(8, 8, 'BOS', 'BOS', 'BOS', 'BOS'),
(9, 9, 'BOS', 'BOS', 'BOS', 'BOS'),
(10, 10, 'BOS', 'BOS', 'BOS', 'BOS'),
(11, 11, 'BOS', 'BOS', 'BOS', 'BOS'),
(12, 12, 'BOS', 'BOS', 'BOS', 'BOS'),
(13, 13, 'BOS', 'BOS', 'BOS', 'BOS'),
(14, 14, 'BOS', 'BOS', 'BOS', 'BOS'),
(15, 15, 'BOS', 'BOS', 'BOS', 'BOS'),
(16, 16, 'BOS', 'BOS', 'BOS', 'BOS'),
(17, 17, 'BOS', 'BOS', 'BOS', 'BOS'),
(18, 18, 'BOS', 'BOS', 'BOS', 'BOS'),
(19, 19, 'BOS', 'BOS', 'BOS', 'BOS'),
(20, 20, 'BOS', 'BOS', 'BOS', 'BOS');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `siparis_id` int(11) NOT NULL,
  `masa_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `siparis_durumu` varchar(50) NOT NULL DEFAULT 'BOS',
  `siparis_gosterme` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`siparis_id`, `masa_id`, `urun_id`, `siparis_durumu`, `siparis_gosterme`) VALUES
(135, 16, 12, 'HAZIRLANDI', '1'),
(136, 16, 2, 'HAZIRLANDI', '1'),
(137, 16, 1, 'HAZIRLANDI', '1'),
(138, 18, 16, 'HAZIRLANDI', '1'),
(206, 1, 1, 'HAZIRLANIYOR', '0'),
(207, 1, 2, 'HAZIRLANIYOR', '0'),
(208, 1, 11, 'HAZIRLANIYOR', '0'),
(209, 1, 15, 'HAZIRLANIYOR', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL,
  `urun_adi` varchar(250) NOT NULL,
  `urun_img` varchar(250) NOT NULL,
  `urun_porsiyon` varchar(250) NOT NULL,
  `urun_fiyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_adi`, `urun_img`, `urun_porsiyon`, `urun_fiyat`) VALUES
(1, 'Köfte', 'kofte.jpg', '200 GR', 40),
(2, 'Sucuk', 'sucuk.jpg', '200 GR', 40),
(3, 'Köfte Sucuk Karışık', 'kofte-sucuk.jpg', '200 GR', 40),
(4, 'Köfte Sucuk Piliç Karışık', 'kofte-sucuk-pilic.jpg', '200 GR', 40),
(5, 'Köfte Et Karışık', 'kofte-et.jpg', '200 GR', 60),
(6, 'Kuzu Şiş', 'kuzu-sis.jpg', '200 GR', 60),
(7, 'Kuzu Beyti', 'kuzu-beyti.jpg', '200 GR', 60),
(8, 'Dana Kuzu Et Karışık', 'dana-kuzu.jpg', '200 GR', 60),
(9, 'Köfte Ekmek', 'kofte-ekmek-tam.jpg', 'Tam Ekmek', 35),
(10, 'Köfte Ekmek', 'kofte-ekmek-yarim.jpg', 'Yarım Ekmek', 25),
(11, 'Döner(Ekmek Arası)', 'doner-tam.jpg', 'Tam Ekmek', 35),
(12, 'Döner(Ekmek Arası)', 'doner-yarim.jpg', 'Yarım Ekmek', 25),
(13, 'Ayran', 'ayran.jpg', '1 Adet', 5),
(14, 'Kutu İçecekler', 'kutu-icecek.jpg', '1 Adet', 8),
(15, 'Ekmek Kadayıfı', 'ekmek-kadayifi.jpg', 'Tam', 18),
(16, 'Triliçe', 'trilice.jpg', '1 Dilim', 12);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kul_id`);

--
-- Tablo için indeksler `masalar`
--
ALTER TABLE `masalar`
  ADD PRIMARY KEY (`masalar_id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`siparis_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urun_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `masalar`
--
ALTER TABLE `masalar`
  MODIFY `masalar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `siparis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
