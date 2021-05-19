-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Nis 2021, 13:35:50
-- Sunucu sürümü: 10.4.16-MariaDB
-- PHP Sürümü: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eti̇caret`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adresler`
--

CREATE TABLE `adresler` (
  `id` int(11) NOT NULL,
  `UyeId` int(11) NOT NULL,
  `AdSoyad` varchar(50) NOT NULL,
  `Adres` varchar(250) NOT NULL,
  `Ilce` varchar(200) NOT NULL,
  `Sehir` varchar(250) NOT NULL,
  `TelefonNumarasi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `adresler`
--

INSERT INTO `adresler` (`id`, `UyeId`, `AdSoyad`, `Adres`, `Ilce`, `Sehir`, `TelefonNumarasi`) VALUES
(4, 5, 'mustafa yerli', 'cemre mahallesi kubra sokak', 'pursaklar', 'ankara', '05362720169'),
(6, 5, 'nafia dinler', 'gürcükapı/erzurum', 'gürcükapı', 'erzurum', '05364114414');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` tinyint(1) NOT NULL,
  `SiteAdi` varchar(50) NOT NULL,
  `SiteTitle` varchar(60) NOT NULL,
  `SiteLinki` varchar(255) NOT NULL,
  `SiteDescription` text NOT NULL,
  `SiteKeywords` varchar(250) NOT NULL,
  `SiteCopyRightMetni` varchar(250) NOT NULL,
  `SiteLogo` varchar(50) NOT NULL,
  `SiteMail` varchar(50) NOT NULL,
  `SiteMailSifre` varchar(50) NOT NULL,
  `SiteHostAdresi` varchar(250) NOT NULL,
  `sosyal_link_face` varchar(200) NOT NULL,
  `sosyal_link_twit` varchar(200) NOT NULL,
  `sosyal_link_linked` varchar(200) NOT NULL,
  `sosyal_link_ins` varchar(200) NOT NULL,
  `sosyal_link_pint` varchar(200) NOT NULL,
  `sosyal_link_you` varchar(200) NOT NULL,
  `UsdKuru` double NOT NULL,
  `EuroKuru` double NOT NULL,
  `UcretsizKargoBaraji` double NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `StoreKey` varchar(100) NOT NULL,
  `ApiKullanicisi` varchar(100) NOT NULL,
  `ApiSifresi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `SiteAdi`, `SiteTitle`, `SiteLinki`, `SiteDescription`, `SiteKeywords`, `SiteCopyRightMetni`, `SiteLogo`, `SiteMail`, `SiteMailSifre`, `SiteHostAdresi`, `sosyal_link_face`, `sosyal_link_twit`, `sosyal_link_linked`, `sosyal_link_ins`, `sosyal_link_pint`, `sosyal_link_you`, `UsdKuru`, `EuroKuru`, `UcretsizKargoBaraji`, `ClientID`, `StoreKey`, `ApiKullanicisi`, `ApiSifresi`) VALUES
(1, 'NACOFF', 'NACOFF', 'http://localhost/NACOFF/', 'Bir kahvenin 40 yıl hatrı vardır! Kahve saatlerinizi daha zevkli ve göz alıcı hale getirebilceğiniz birbirinden renkli ve dekoratif kahve fincan takımları, sunumluklar ve daha fazlası burada sizleri bekliyor! Daha fazlası için NACOFF&#039; u takipte kalın!', 'kahve, fincan,sunum, kupa, sunumluk', 'Copyright2020-NACOFF-TümHakları Saklıdır.', 'images.jpg', 'nafiadeneme123@gmail.com', 'deneme_123', 'localhost', 'https://www.facebook.com/', 'https://twitter.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://tr.pinterest.com/', 'https://www.youtube.com/', 8.17, 9.6, 150, '00000000', '11111111', '3DKullanicim', 'ggujgln');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bankahesaplari`
--

CREATE TABLE `bankahesaplari` (
  `id` tinyint(11) NOT NULL,
  `banka_logo` varchar(200) NOT NULL,
  `bankaAdi` varchar(250) NOT NULL,
  `konumSehir` varchar(250) NOT NULL,
  `konumUlke` varchar(250) NOT NULL,
  `subeAdi` varchar(200) NOT NULL,
  `subeKodu` int(50) NOT NULL,
  `paraBirimi` varchar(200) NOT NULL,
  `hesapSahibi` varchar(200) NOT NULL,
  `hesapNum` varchar(200) NOT NULL,
  `ibanNum` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `bankahesaplari`
--

INSERT INTO `bankahesaplari` (`id`, `banka_logo`, `bankaAdi`, `konumSehir`, `konumUlke`, `subeAdi`, `subeKodu`, `paraBirimi`, `hesapSahibi`, `hesapNum`, `ibanNum`) VALUES
(1, '2951124ff50251d62ce2a7f75.jpg', 'AKBANK', 'Trabzon', 'Türkiye', 'Akçaabat', 61, 'Türk Lirası', 'Nafia Taşdemir', '123456789', 'TR330006100519786457841326'),
(2, '1f945efc3dea7b67f63a8bb21.jpg', 'DENİZBANK', 'Erzurum', 'Türkiye', 'Uzundere', 25, 'Türk Lirası', 'Bahanur Kadirhan', '2134567099', 'TR330006100519786457841478'),
(3, '28a30b93aaa19b9fbf0136152.jpg', 'Ziraat Bankası', 'Bursa', 'Türkiye', 'Nilüfer', 16, 'Amerikan Doları', 'Emre Özdemir', '2144567089', 'TR330006100519786457567089'),
(4, 'f5da52d566c9f0dcb3eba316a.jpg', 'Finans Bank', 'Paris', 'Türkiye', 'Louvre', 236, 'Euro', 'Cemre Yerli', '2314578888', 'FR1420041010050500013M02606'),
(5, 'a2f8917e7e26c11dc8d7540d7.jpg', 'INGBANK', 'Ankara', 'Türkiye', 'Ulus', 6, 'Türk Lirası', 'Betül Reyyan Özer', '2134567777', 'TR330006258919786457841326'),
(6, 'cede50c0976c93b997700fbc8.jpg', 'İş Bankası', 'Bayburt', 'Türkiye', 'Merkez', 69, 'Türk Lirası', 'Alpaslan Meriç Bozkurt', '2314578889', 'TR330006100519782314578889');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bannerler`
--

CREATE TABLE `bannerler` (
  `id` int(11) NOT NULL,
  `BannerAlani` varchar(100) NOT NULL,
  `BannerResmi` varchar(100) NOT NULL,
  `GosterimSayisi` int(10) NOT NULL,
  `BannerAdi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `bannerler`
--

INSERT INTO `bannerler` (`id`, `BannerAlani`, `BannerResmi`, `GosterimSayisi`, `BannerAdi`) VALUES
(1, 'Menu Altı', 'banner1.jpg', 443, 'örnek reklam1'),
(2, 'Menu Altı', 'banner2.jpg', 444, 'örnek reklam2'),
(3, 'Menu Altı', 'b02ac7752e7bfe6d9e7626071.jpg', 444, 'Menü Altı1'),
(6, 'urunDetay', 'eadb2906635c81ac3b9f8a50f.jpg', 146, 'ürün detay'),
(9, 'urunDetay', '271b4fa5db446fc1e0b00008e.jpg', 146, 'ÜrünDetay1'),
(10, 'urunDetay', '3e2f1a7a53a0b5c7efc9a2f5f.png', 147, 'denemehh'),
(18, 'Ana Sayfa', '3480afd87aa38e60b69f83e74.jpg', 33, 'AnaBanner1'),
(19, 'Ana Sayfa', 'a054dafe7a792dd1d48ad4139.jpg', 28, 'AnaBanner2'),
(20, 'Ana Sayfa', '3666dec5ba002c82680906869.jpg', 28, 'AnaBanner4'),
(23, 'Ana Sayfa', 'a9def8c0404df7d52033f5cef.jpg', 1, 'AnaBanner7'),
(24, 'Ana Sayfa', '6673fb4602fa324f16a7413f6.jpg', 1, 'AnaBanner8');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favoriler`
--

CREATE TABLE `favoriler` (
  `id` int(11) NOT NULL,
  `UrunId` int(11) NOT NULL,
  `UyeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `havalebildirimleri`
--

CREATE TABLE `havalebildirimleri` (
  `id` int(11) NOT NULL,
  `BankaId` int(11) NOT NULL,
  `adisoyadi` varchar(250) NOT NULL,
  `emailAdresi` varchar(250) NOT NULL,
  `telefonNum` int(11) NOT NULL,
  `Aciklama` text NOT NULL,
  `islemTarihi` int(11) NOT NULL,
  `durum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `havalebildirimleri`
--

INSERT INTO `havalebildirimleri` (`id`, `BankaId`, `adisoyadi`, `emailAdresi`, `telefonNum`, `Aciklama`, `islemTarihi`, `durum`) VALUES
(3, 5, 'NAFİA TAŞDEMİR', 'denemefincan@gmail.com', 2147483647, 'dd', 1615285398, 0),
(4, 4, 'oguz Özer', 'alianilkocak@gmail.com', 2147483647, 'İlgili bankaya ödemeyi yaptım.', 1617459520, 0),
(5, 4, 'anıl koçak', 'denemefincann@gmail.com', 2147483647, '&#039;', 1617462190, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kargofirmalari`
--

CREATE TABLE `kargofirmalari` (
  `id` int(11) NOT NULL,
  `FirmaLogosu` varchar(100) NOT NULL,
  `FirmaAdi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kargofirmalari`
--

INSERT INTO `kargofirmalari` (`id`, `FirmaLogosu`, `FirmaAdi`) VALUES
(8, '138ebc29ad880ab56f7633fa5.png', 'Yurtiçi Kargo'),
(9, '1648338f34ed9366d0cd19c22.png', 'MNG Kargo'),
(10, '35de4025afb5f871697ec5ff9.png', 'Aras Kargo'),
(11, '21f65bba7e1248eff47fbd066.png', 'PTT Kargo'),
(12, '5c70cd2b9c09a0401482278d8.png', 'Sürat Kargo');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kredikartlari`
--

CREATE TABLE `kredikartlari` (
  `Id` int(11) NOT NULL,
  `KrediKartiAdi` varchar(50) NOT NULL,
  `KrediKartiResmi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kredikartlari`
--

INSERT INTO `kredikartlari` (`Id`, `KrediKartiAdi`, `KrediKartiResmi`) VALUES
(1, 'Akbank Kredi Kartı', 'akbankkredi.jfif'),
(2, 'Garanti Kredi Kartı', 'garantiKredi.jfif'),
(3, 'Ziraat Kredi Kartı', 'ziraatkredi.jfif'),
(4, 'ING Kredi Kartı', 'ingkredi.jfif'),
(5, 'İş Bankası Kredi Kartı', 'isBankasıKredi.jfif'),
(6, 'Diğer', 'diger.jfif');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menuler`
--

CREATE TABLE `menuler` (
  `id` int(11) NOT NULL,
  `UrunTuru` varchar(100) NOT NULL,
  `MenuAdi` varchar(50) NOT NULL,
  `UrunSayisi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `menuler`
--

INSERT INTO `menuler` (`id`, `UrunTuru`, `MenuAdi`, `UrunSayisi`) VALUES
(1, 'fincan', 'Karaca', 3),
(2, 'fincan', 'Kütahya Porselen', 3),
(3, 'fincan', 'Porland', 1),
(4, 'fincan', 'Emsan', 2),
(5, 'fincan', 'Korkmaz', 1),
(6, 'fincan', 'Bambum', 3),
(7, 'kupa', 'Karaca', 4),
(8, 'kupa', 'Kütahya Porselen', 3),
(9, 'kupa', 'Porland', 1),
(10, 'kupa', 'Emsan', 2),
(11, 'kupa', 'Korkmaz', 4),
(12, 'kupa', 'Bambum', 3),
(13, 'kahveyanibardak', 'Karaca', 0),
(14, 'kahveyanibardak', 'Paşabahçe', 2),
(15, 'kahveyanibardak', 'Kristal', 2),
(16, 'kahveyanibardak', 'Porland', 0),
(19, 'sunumluk', 'Korkmaz', 1),
(20, 'sunumluk', 'Bambum', 3),
(21, 'sunumluk', 'Porland', 0),
(22, 'sunumluk', 'Korkmaz', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `id` int(11) NOT NULL,
  `SepetNumarasi` int(11) NOT NULL,
  `UyeId` int(11) NOT NULL,
  `UrunId` int(11) NOT NULL,
  `VaryantId` int(11) NOT NULL,
  `UrunAdedi` int(3) NOT NULL,
  `KargoId` int(10) NOT NULL,
  `AdresId` int(11) NOT NULL,
  `OdemeSecimi` varchar(25) NOT NULL,
  `TaksitSecimi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL,
  `SiparisNumarasi` int(50) NOT NULL,
  `UrunId` int(10) NOT NULL,
  `UrunAdi` varchar(250) NOT NULL,
  `UrunFiyati` double NOT NULL,
  `UrunResmiBir` varchar(250) NOT NULL,
  `VaryantBasligi` varchar(50) NOT NULL,
  `VaryantSecimi` varchar(100) NOT NULL,
  `KargoUcreti` double NOT NULL,
  `KDVOrani` int(3) NOT NULL,
  `KargoFirmaSecimi` varchar(100) NOT NULL,
  `AdresAdSoyad` varchar(100) NOT NULL,
  `AdresDetay` varchar(250) NOT NULL,
  `AdresTelefon` varchar(11) NOT NULL,
  `OdemeSecimi` varchar(25) NOT NULL,
  `TaksitSecimi` int(2) NOT NULL,
  `OnayDurumu` tinyint(1) NOT NULL,
  `KargoDurumu` tinyint(1) NOT NULL,
  `KargoGonderiKodu` varchar(30) NOT NULL,
  `SiparisTarihi` int(10) NOT NULL,
  `SiparisIpAdresi` varchar(25) NOT NULL,
  `UyeId` int(11) NOT NULL,
  `UrunTuru` varchar(50) NOT NULL,
  `UrunAdedi` int(3) NOT NULL,
  `ToplamUrunFiyati` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `SiparisNumarasi`, `UrunId`, `UrunAdi`, `UrunFiyati`, `UrunResmiBir`, `VaryantBasligi`, `VaryantSecimi`, `KargoUcreti`, `KDVOrani`, `KargoFirmaSecimi`, `AdresAdSoyad`, `AdresDetay`, `AdresTelefon`, `OdemeSecimi`, `TaksitSecimi`, `OnayDurumu`, `KargoDurumu`, `KargoGonderiKodu`, `SiparisTarihi`, `SiparisIpAdresi`, `UyeId`, `UrunTuru`, `UrunAdedi`, `ToplamUrunFiyati`) VALUES
(1, 2, 36, 'Civcik Baskılı Kahve Fincanı', 228.76, '75b6c4c6a505933aa974ccd04.jpg', 'Renk', 'Sarı-Beyaz', 0, 18, 'Yurtiçi Kargo', 'nafia dinler', 'gürcükapı/erzurum gürcükapı/erzurum', '05364114414', 'Banka Havalesi', 0, 1, 1, '1234567858', 1617959234, '::1', 5, 'fincan', 6, 1372.56),
(2, 2, 15, 'Avakado Kupa', 69, 'bfcce52348d7ddd1dd4ca24fd.jpg', 'Renk', 'Koyu Yeşil', 0, 18, 'Yurtiçi Kargo', 'nafia dinler', 'gürcükapı/erzurum gürcükapı/erzurum', '05364114414', 'Banka Havalesi', 0, 1, 1, '1234567858', 1617959234, '::1', 5, 'kupa', 2, 138),
(3, 3, 16, 'Kadın Ayakkabılı Kupa', 21, 'e1777fcb021dd81fb35a1e3a6.jpg', 'Renk', 'Beyaz-Bordo', 10, 18, 'Aras Kargo', 'mustafa yerli', 'cemre mahallesi kubra sokak pursaklar/ankara', '05362720169', 'Banka Havalesi', 0, 1, 1, '1234567890', 1617959531, '::1', 5, 'kupa', 1, 21),
(4, 4, 34, 'Eğik Bükük Kahve Yanı Bardağı', 20, '30419c99409f932f96547aa63.jpg', 'Renk', 'Tek Renk', 10, 18, 'MNG Kargo', 'mustafa yerli', 'cemre mahallesi kubra sokak pursaklar/ankara', '05362720169', 'Banka Havalesi', 0, 1, 1, '1234567890', 1617959555, '::1', 5, 'kahveyanibardak', 6, 120),
(5, 5, 38, 'Kabak Fincan', 228.76, '0ab0f93be2fba84a9eec901fb.jpg', 'Renk', 'Turuncu', 0, 18, 'Aras Kargo', 'mustafa yerli', 'cemre mahallesi kubra sokak pursaklar/ankara', '05362720169', 'Banka Havalesi', 0, 1, 1, '1234567800', 1617959802, '::1', 5, 'fincan', 1, 228.76),
(6, 6, 28, 'Oyalı Sunum  Leçeği', 10, '8f5125b9f14b38b134235a586.jpg', 'Renk', 'Beyaz-Lila', 10, 18, 'Sürat Kargo', 'mustafa yerli', 'cemre mahallesi kubra sokak pursaklar/ankara', '05362720169', 'Banka Havalesi', 0, 1, 1, '1234567855', 1617960634, '::1', 5, 'sunumluk', 8, 80);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorular`
--

CREATE TABLE `sorular` (
  `id` int(11) NOT NULL,
  `soru` varchar(255) NOT NULL,
  `cevap` text NOT NULL,
  `Konu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sorular`
--

INSERT INTO `sorular` (`id`, `soru`, `cevap`, `Konu`) VALUES
(1, '1. sorunuzun başlığı', '1. sorunuzun cevap metni budur', 'üyelik işlemleri'),
(2, '2. sorunuzun başlığı', '2. sorunuzun cevap metni', 'site işlemleri'),
(3, '3. sorunuzun başlığı', '3. sorunuzun cevap metni', 'üyelik işlemleri'),
(4, '4. sorunuzun başlığı', '4. sorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metnisorunuzun cevap metni', 'site işlemleri'),
(5, '5. sorunuzn başlığı', '5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı5. sorunuzun cevabı', 'site işlemleri'),
(8, '6. sorunuzun başlığı', '6. sorunuzun cevabı', 'site işlemleri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sozlesmelervemetinler`
--

CREATE TABLE `sozlesmelervemetinler` (
  `Id` int(11) NOT NULL,
  `hakkimizdaMetni` text NOT NULL,
  `uyelikSozMetni` text NOT NULL,
  `kullanımKosullariMetni` text NOT NULL,
  `gizlilikSozMetni` text NOT NULL,
  `mesafeliSatisMetni` text NOT NULL,
  `teslimatMetni` text NOT NULL,
  `iptalIadeDegisimMetni` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sozlesmelervemetinler`
--

INSERT INTO `sozlesmelervemetinler` (`Id`, `hakkimizdaMetni`, `uyelikSozMetni`, `kullanımKosullariMetni`, `gizlilikSozMetni`, `mesafeliSatisMetni`, `teslimatMetni`, `iptalIadeDegisimMetni`) VALUES
(1, 'nafiahakkımızda metnihakkımızda metnihakkımızda metnihakkımızda metnihakkımızda metnihakkımızda metni', 'üyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesiüyelik sizleşmesi', 'kullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metnikullanımkosulları metni', 'gizlilik sözleşmesi metnigizlilik sözleşmesi metnigizlilik sözleşmesi metnigizlilik sözleşmesi metnigizlilik sözleşmesi metnigisdfghjkzlilik sözleşmesi metni', 'mesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesiimesafeli satış sözleşmesii', 'teslimatmetniteslimatmetniteslimatmetniteslimatmetniteslimatmetniteslimatmetni', 'iptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişmiptailiadedeğişm');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `MenuId` int(11) NOT NULL,
  `UrunAdi` varchar(250) NOT NULL,
  `UrunFiyati` double NOT NULL,
  `ParaBirimi` varchar(250) NOT NULL,
  `UrunAciklamasi` text NOT NULL,
  `UrunResmiBir` varchar(250) NOT NULL,
  `UrunResmiIki` varchar(250) NOT NULL,
  `UrunResmiUc` varchar(250) NOT NULL,
  `UrunResmi4` varchar(250) NOT NULL,
  `Durumu` tinyint(1) NOT NULL,
  `ToplamSatisSayisi` int(10) NOT NULL,
  `ToplamSatisTutari` double NOT NULL,
  `GoruntulenmeSayisi` int(10) NOT NULL,
  `VaryantBasligi` varchar(50) NOT NULL,
  `KDVOrani` int(2) NOT NULL,
  `YorumSayisi` tinyint(1) NOT NULL,
  `ToplamYorumPuani` int(110) NOT NULL,
  `UrunTuru` varchar(100) NOT NULL,
  `KargoUcreti` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `MenuId`, `UrunAdi`, `UrunFiyati`, `ParaBirimi`, `UrunAciklamasi`, `UrunResmiBir`, `UrunResmiIki`, `UrunResmiUc`, `UrunResmi4`, `Durumu`, `ToplamSatisSayisi`, `ToplamSatisTutari`, `GoruntulenmeSayisi`, `VaryantBasligi`, `KDVOrani`, `YorumSayisi`, `ToplamYorumPuani`, `UrunTuru`, `KargoUcreti`) VALUES
(1, 12, 'Bambum Panda Kupa', 21, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '041150b130cb7e2aef323a17f.jpg', '', '', '', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'kupa', 10),
(2, 10, 'Emsan Korku Konsept Kupa', 45, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '6467174c5fb29010f8e530deb.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(3, 7, 'Kitap Keyfi Kuş Kupa', 45, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '595262c48ac015e900374d2b4.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(4, 11, 'Mix Kupa', 54, 'EUR', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '2484d4d1a290c283a31d76f7e.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(5, 11, 'Ugly Kupa', 100, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'e3bc990335c9d880c36e52f96.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(6, 11, 'Klasik Öğretmen Kupa', 25, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '8018f1590d22715fc91db188c.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(7, 8, 'Klasik  Kupa', 32, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nÜrünün tabağı ve kaşığı hediyedir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '632fdd65fd6a750919a71a188.jpg', '', '', '', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'kupa', 10),
(8, 9, 'Ebruli Kupa', 45, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'a50cd6235c42387eb4e5fa839.jpg', '', '', '', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'kupa', 10),
(9, 8, 'Kaplan Kupa', 98.99, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '484885dedfdf078c31a326a99.jpg', 'ccf61ca797c5b686347042609.jpg', 'db3e85083e19214b84af07cf9.jpg', 'a828b81e33b291d2b083cf102.jpg', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(10, 12, 'Emoji Kupa', 98.99, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '0b50b5938710d0eb99acbad41.jpg', '5bcb062a03256fad7e42354e6.jpg', '66b73252dcc1e673f52fbd833.jpg', '95c5aca447bcdd0a163400ce4.jpg', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(11, 8, 'Romantik Çift Kupası', 120.99, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir. Ürünümüz çift kişiliktir.(İki Adet)\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'ec4d440ca17e56c82452cb328.jpg', 'e2a0e63fa7cb9787ea76db3a4.jpg', 'e1e0c490e78f7992baf618d26.jpg', '64160b1fb404372044a771add.jpg', 1, 0, 0, 3, 'Renk', 18, 0, 0, 'kupa', 10),
(12, 7, 'Mısırlı Konsept Kupa', 16, 'USD', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'e6a47d957ca6cf77f6df275d5.jpg', '61b180f5e1d97cb10521dd046.jpg', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(13, 7, 'Unicorn Kupa', 16, 'USD', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'b15cd8a82834c5fd287c5f671.jpg', '3aa326d5bd9cb8c91702a9de6.jpg', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(14, 7, 'Cat&#039;s Kupa', 16, 'USD', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'afe0b5a5f20ad4a9cb9bf1b85.jpg', '3c7bdbb7b7a56e8b24d41a7b9.jpg', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kupa', 10),
(15, 12, 'Avakado Kupa', 69, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'bfcce52348d7ddd1dd4ca24fd.jpg', '2196a75e8818168b5b9c970f8.jpg', '55787c8aa18d4bf33da4a2737.jpg', '', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'kupa', 10),
(16, 10, 'Kadın Ayakkabılı Kupa', 21, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'e1777fcb021dd81fb35a1e3a6.jpg', '', '', '', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'kupa', 10),
(17, 11, 'Çift Özel Kupası', 60, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir. Çift Kişiliktir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '4b9f46261dc4650521d3a4e65.jpg', '', '', '', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'kupa', 10),
(18, 6, 'Mustafa Kemal Resmi Kahve Fincanı', 45, 'TRY', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'd894eec3a8e15e1b9383e0952.jpg', '683d1dc00e0fb61fcaafc6c10.jpg', '', '', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'fincan', 10),
(19, 4, 'Renkli Kulb Detaylı Kahve Fincanı', 12.99, 'TRY', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'fc4184055254e80158b5f5685.jpg', '61a60eba569ee1fa5bbb0e1fa.jpg', 'c1dcd218dc999ef3b20b885c4.jpg', 'd19dabc930070dd3631bbaa63.jpg', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'fincan', 10),
(20, 15, 'Kristal Kahve Yanı Bardağı', 12, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'b92f3c7700c5feab571ac876c.jpg', '3e61c0a943a4d710ea933b928.jpg', '7854777ae0a8048a39ecfa2d9.jpg', '', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'kahveyanibardak', 10),
(21, 6, 'Fil Desenli Kahve Fincanı Takımı', 21, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '4b4ab82387e7d992b6ac84ad3.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'fincan', 10),
(22, 4, 'Ananas Desenli Kahve Fincanı Takımı', 21, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\n\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '43f188a4e57d0ae6cd79d8adb.jpg', '588efcf9c3fe098b256255892.jpg', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'fincan', 10),
(23, 17, 'Hasır Tepsi', 102.39, 'TRY', 'Ürünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nÜrünün yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '779489fb818e3aa2368609c40.jpg', 'c0a0773ef689c1484267ac36c.jpg', '', '', 0, 0, 0, 1, 'Renk', 18, 0, 0, 'sunumluk', 10),
(24, 1, 'Karaca Klasik Kahve Fincan Takımı', 102.39, 'TRY', 'Kahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\n\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '4dfa58956262e45db0523c27f.jpg', '58a2919ad37c12b27a54590a7.jpg', '1918b118a52db509b4b8ff3e5.jpg', 'c3b2e0b7c947d4b6b57682977.jpg', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'fincan', 10),
(25, 20, 'Hasır Tepsi', 123, 'TRY', 'Ürünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nAsıl ürünün yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '84ea13c1c31de3b43ddb34a1e.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'sunumluk', 10),
(26, 15, 'Düz Klasik Kahve Yanı Bardak', 9.99, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nAsıl ürünün yanındaki ürünler ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '43d5ca1765f372049acb74e4a.jpg', '917b76660c41cb9d38d1d8b4a.jpg', '13db2a5cc99006db987606203.jpg', '', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'kahveyanibardak', 10),
(27, 14, 'Ananas Baskılı Kahve Yanı Bardak', 12.99, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nAsıl ürünün yanındaki ürünler ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '96df88c0511ca77bd38068a51.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'kahveyanibardak', 10),
(28, 19, 'Oyalı Sunum  Leçeği', 10, 'TRY', 'Ürünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nAsıl ürünün yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '8f5125b9f14b38b134235a586.jpg', '', '', '', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'sunumluk', 10),
(29, 2, 'Melek Kanadı Kulplu Kahve Fincanı', 48, 'TRY', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '09b90ae3c8889e2c42c8b58fb.jpg', '40d2444a24bf2c8df5c764079.jpg', '429bb97c6a8a9b34061df7a84.jpg', '', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'fincan', 10),
(30, 1, 'Retro Desenli Kahve Fincan Takımı', 58, 'TRY', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'a94b847391bc0242948d80eb6.jpg', '1f930150d2a4dcb84ba195ac1.jpg', '2d64aafb8ad933bfd2eefa264.jpg', '4852410d7fe21caf260fd71f9.jpg', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'fincan', 10),
(31, 20, 'Püsküllü Tepsi', 45, 'EUR', 'Ürünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nAsıl ürünün yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '82c4ad30639b717dc9ae97d77.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'sunumluk', 10),
(32, 3, 'Tilki Baskılı Kahve Fincnı', 45, 'EUR', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.  Ürünün Yanındki Tilki Desenli şişe Hediyemizdir.', 'e589c43abe7a651a3e07e5e78.jpg', 'c57dd327bedc83416471e3eb4.jpg', '527520a08f9cb0ef3d13af253.jpg', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'fincan', 10),
(33, 6, 'Yelpaze Fincan Takımı', 90, 'TRY', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '87ed072b0f40b7ef7c59d1f1e.jpg', '', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'fincan', 10),
(34, 14, 'Eğik Bükük Kahve Yanı Bardağı', 20, 'TRY', 'Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nÜrünümüz bulaşık makinasında yıkanabilir.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nAsıl ürünün yanındaki ürünler ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '30419c99409f932f96547aa63.jpg', '', '', '', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'kahveyanibardak', 10),
(35, 2, 'Roman Rakam Desenli Kahve Fincanı', 28, 'EUR', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '4622ca00fe95bfffae1561841.jpg', '', '', '', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'fincan', 10),
(36, 2, 'Civcik Baskılı Kahve Fincanı', 28, 'EUR', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '75b6c4c6a505933aa974ccd04.jpg', '', '', '', 1, 0, 0, 3, 'Renk', 18, 0, 0, 'fincan', 10),
(37, 20, 'Kabak Mumluk', 28, 'EUR', 'Ürünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları 1 adet üzerinden gösterilmektedir.\r\nAsıl ürünün yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '4c1e259fb37da531010d354b9.jpg', 'ff907791d0900acd853c1a7ef.jpg', '', '', 1, 0, 0, 0, 'Renk', 18, 0, 0, 'sunumluk', 10),
(38, 5, 'Kabak Fincan', 28, 'EUR', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', '0ab0f93be2fba84a9eec901fb.jpg', '2a5074de2c852534c06ab7b23.jpg', '25e7a8b3411c9864e899d7757.jpg', '98563fc9e6195ac292c7a0d40.jpg', 1, 0, 0, 2, 'Renk', 18, 0, 0, 'fincan', 10),
(39, 1, 'Çizgili Kahve Fincanı', 13.99, 'TRY', 'Kahve Fincanı Ürünümüz 1. Sınıf Porselenden Üretilmiştir.\r\nKahve Fincanı Elde Yıkanmalıdır. Bulaşık Makinesinde Yıkanması Tavsiye Edilmez.\r\nÜrünlerimiz Kargoda Oluşan Kırılmalara Karşı Garantilidir. Böyle Bir Durumda Bizimle İletişime Geçiniz.\r\nÜrünlerimizin fiyatları tekli takım (1 fincan 1 fincan tabağı) üzerinden gösterilmektedir.\r\nKahve fincanının yanındaki ürünler sadece görsellik amacıyla kullanılmıştır.\r\nÜrün dışındaki diğer ürünleri beğendiyseniz ilgili kategorilerden onları da satın alıp sizde harika sunumlar yapabilirsiniz.', 'da6e4af448ca0e885012f77ad.jpg', 'cdecd9c64c7a30d3247973aed.jpg', '', '', 1, 0, 0, 1, 'Renk', 18, 0, 0, 'fincan', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunvaryantlari`
--

CREATE TABLE `urunvaryantlari` (
  `id` int(10) NOT NULL,
  `UrunId` int(10) NOT NULL,
  `VaryantAdi` varchar(250) NOT NULL,
  `StokAdedi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunvaryantlari`
--

INSERT INTO `urunvaryantlari` (`id`, `UrunId`, `VaryantAdi`, `StokAdedi`) VALUES
(1, 1, 'Siyah-Beyaz', 22),
(2, 2, 'Tek Renk', 25),
(3, 3, 'Tek Renk', 25),
(4, 4, 'Çok Renkli', 25),
(5, 5, 'Tek Renk', 25),
(6, 6, 'Beyaz-Pembe', 250),
(7, 7, 'Pembe', 250),
(8, 7, 'Turkuvaz', 250),
(9, 7, 'Beyaz', 80),
(10, 8, 'Siyah-Beyaz', 100),
(11, 8, 'Pembe-Beyaz', 20),
(12, 8, 'Mavi-Beyaz', 20),
(13, 8, 'Turuncu-Beyaz', 10),
(14, 8, 'Kahverengi-Beyaz', 1),
(15, 9, 'Siyah', 100),
(16, 9, 'Pembe', 20),
(17, 9, 'Sarı', 20),
(18, 10, 'Kahverengi', 100),
(19, 11, 'Pembe-Beyaz', 100),
(20, 12, 'Gold', 100),
(21, 12, 'Silver', 14),
(22, 13, 'Pembe', 100),
(23, 13, 'Beyaz', 14),
(24, 14, 'Siyah-Beyaz', 100),
(25, 15, 'Koyu Yeşil', 10),
(26, 16, 'Beyaz-Kırmızı', 100),
(27, 16, 'Beyaz-Bordo', 500),
(28, 17, 'Beyaz-Kırmızı', 10),
(30, 18, 'Siyah-Beyaz', 100),
(31, 18, 'Gold-Beyaz', 500),
(32, 19, 'Mor', 100),
(33, 19, 'Pembe', 500),
(34, 20, 'Pembe', 100),
(35, 20, 'Mor', 1),
(36, 20, 'Siyah', 10),
(37, 21, 'Mavi', 25),
(38, 22, 'Tek Renk', 25),
(39, 23, 'Tek Renk', 25),
(40, 24, 'Lila', 252),
(41, 25, 'Tek Renk', 10000),
(42, 26, 'Lila', 100),
(43, 27, 'Tek Renk', 100),
(44, 28, 'Beyaz-Lila', 100),
(45, 29, 'Siyah', 100),
(46, 29, 'Beyaz', 120),
(47, 29, 'Turuncu', 500),
(48, 29, 'Yeşil', 100),
(49, 29, 'Mor', 98),
(50, 30, 'Pembe-Beyaz', 100),
(51, 30, 'Sarı-Beyaz', 100),
(52, 26, 'Pembe', 14),
(53, 26, 'Sarı', 10),
(54, 31, 'Sarı', 250),
(55, 32, 'Tek Renk', 250),
(56, 33, 'Beyaz', 100),
(57, 33, 'Siyah', 5222),
(58, 34, 'Tek Renk', 100),
(59, 35, 'Siyah-Beyaz', 100),
(60, 36, 'Sarı-Beyaz', 100),
(61, 37, 'Turuncu', 100),
(62, 38, 'Turuncu', 100),
(63, 39, 'Turuncu', 100),
(64, 39, 'Yeşil', 500),
(65, 39, 'Sarı', 16),
(66, 39, 'Lila', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `EmailAdres` varchar(250) NOT NULL,
  `Sifre` varchar(100) NOT NULL,
  `IsimSoyisim` varchar(250) NOT NULL,
  `TelefonNumara` varchar(11) NOT NULL,
  `Cinsiyet` varchar(6) NOT NULL,
  `Durumu` tinyint(1) NOT NULL,
  `KayitTarihi` int(11) NOT NULL,
  `KayitIpAdresi` varchar(20) NOT NULL,
  `AktivasyonKodu` varchar(200) NOT NULL,
  `SilinmeDurumu` tinyint(3) NOT NULL,
  `smsIleHaberAl` varchar(50) NOT NULL,
  `EmailIleHaberAl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `EmailAdres`, `Sifre`, `IsimSoyisim`, `TelefonNumara`, `Cinsiyet`, `Durumu`, `KayitTarihi`, `KayitIpAdresi`, `AktivasyonKodu`, `SilinmeDurumu`, `smsIleHaberAl`, `EmailIleHaberAl`) VALUES
(5, 'denemefincan@gmail.com', '0e449f9403ba364cdc7184c20eab6796', 'eda tasdemirr', '05362720160', 'Erkek', 1, 1612814047, '::1', '43802-94640-15519', 0, 'hayır', 'evet'),
(8, 'tasdemirnafia98@gmail.com', '9adee7dcf45f05fa8437378d1dfb5072', 'Betül Reyyan Özer', '05445362765', 'Kadın', 0, 1617543450, '::1', '34481-73890-31638', 0, '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `id` int(11) NOT NULL,
  `KullaniciAdi` varchar(250) NOT NULL,
  `Sifre` varchar(250) NOT NULL,
  `IsimSoyisim` varchar(250) NOT NULL,
  `TelefonNumarasi` varchar(11) NOT NULL,
  `EmailAdres` varchar(100) NOT NULL,
  `SilinmeyecekYoneticiDurum` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `KullaniciAdi`, `Sifre`, `IsimSoyisim`, `TelefonNumarasi`, `EmailAdres`, `SilinmeyecekYoneticiDurum`) VALUES
(1, 'nafish', 'a1b11dee01d277820823448f48ba6382', 'eda tasdemirr', '05362720160', 'denemefincan@gmail.com', 1),
(2, 'cihan', '', 'cihan yılmaz', '05362745669', 'nafiasalihakanber@gmail.com', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `UrunId` int(11) NOT NULL,
  `UyeId` int(11) NOT NULL,
  `Puan` tinyint(1) NOT NULL,
  `YorumMetni` text NOT NULL,
  `YorumTarihi` int(10) NOT NULL,
  `YorumIpAdresi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adresler`
--
ALTER TABLE `adresler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bankahesaplari`
--
ALTER TABLE `bankahesaplari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bannerler`
--
ALTER TABLE `bannerler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `favoriler`
--
ALTER TABLE `favoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `havalebildirimleri`
--
ALTER TABLE `havalebildirimleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kargofirmalari`
--
ALTER TABLE `kargofirmalari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kredikartlari`
--
ALTER TABLE `kredikartlari`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `menuler`
--
ALTER TABLE `menuler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sorular`
--
ALTER TABLE `sorular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sozlesmelervemetinler`
--
ALTER TABLE `sozlesmelervemetinler`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunvaryantlari`
--
ALTER TABLE `urunvaryantlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yoneticiler`
--
ALTER TABLE `yoneticiler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adresler`
--
ALTER TABLE `adresler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `bankahesaplari`
--
ALTER TABLE `bankahesaplari`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `bannerler`
--
ALTER TABLE `bannerler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `favoriler`
--
ALTER TABLE `favoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `havalebildirimleri`
--
ALTER TABLE `havalebildirimleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `kargofirmalari`
--
ALTER TABLE `kargofirmalari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `kredikartlari`
--
ALTER TABLE `kredikartlari`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `menuler`
--
ALTER TABLE `menuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `sorular`
--
ALTER TABLE `sorular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `sozlesmelervemetinler`
--
ALTER TABLE `sozlesmelervemetinler`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Tablo için AUTO_INCREMENT değeri `urunvaryantlari`
--
ALTER TABLE `urunvaryantlari`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `yoneticiler`
--
ALTER TABLE `yoneticiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
