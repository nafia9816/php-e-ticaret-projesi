<?php
//stok guncelle urun satııs arttıt
if (isset($_SESSION["Kullanici"])) {
    if (isset($_POST["odemeTuruSecimi"])){
       $GelenodemeTuruSecimi=guvenlik($_POST["odemeTuruSecimi"]);
    }else{
       $GelenodemeTuruSecimi="";
    }

    if (isset($_POST["taksitSecimi"])){
       $GelentaksitSecimi=guvenlik($_POST["taksitSecimi"]);
    }else{
       $GelentaksitSecimi="";
    }


    if ($GelenodemeTuruSecimi!="") {
      if ($GelenodemeTuruSecimi=="Banka Havalesi") {
        //banka havalesiseçmiştir .banka havalesi seçtiği için sepetteki tüm ürünlerini siparişler(hesabım siparişler sayfasına ve db de siparisler tablosuna kayıt olcaz) e aktarıcaz
        $alisverisSepeti_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=?");
        $alisverisSepeti_sorgusu->execute([$KullaniciId]);
        $sepetsayisi=$alisverisSepeti_sorgusu->rowCount(); //kayıt varmı
        $sepet_kayitlari=$alisverisSepeti_sorgusu->fetchAll(PDO::FETCH_ASSOC);
        if ($sepetsayisi>0) {
          $sepettekiTopFiyat=0;          
          foreach ($sepet_kayitlari as $sepet) {
            //sepetin içindeki her siparişin bilgilerini döngü yardımıyla tek tek alıyoruz.
            $sepetId=$sepet["id"];
            $sepetSepetNum=$sepet["SepetNumarasi"];
            $sepetUyeId=$sepet["UyeId"];
            $sepetUrunId=$sepet["UrunId"];
            $sepetAdresId=$sepet["AdresId"];
            $sepetVaryantId=$sepet["VaryantId"];
            $sepetKargoId=$sepet["KargoId"];
            $sepetUrunAdedi=$sepet["UrunAdedi"];
            $sepetOdemeSecimi=$sepet["OdemeSecimi"];
            $sepetTaksitSecimi=$sepet["TaksitSecimi"];

            $UrunBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");//sepeteki siparişin ürün id sini yuarıda cektin. bu id yi kulanarak ta aynı urunun urunler tablosundan bilgilerini çekiyorum.(döngü içindeki olduğumuz için her siparişin kini ayrı ayrı alıyoruz. ve işliyoruz.)
            $UrunBilgileri_sorgusu->execute([$sepetUrunId]);
            $sepetteki_urun_kaydi=$UrunBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);
            
            $urununResmi=$sepetteki_urun_kaydi["UrunResmiBir"];
            $urununTuru=$sepetteki_urun_kaydi["UrunTuru"];
            $urununAdi=$sepetteki_urun_kaydi["UrunAdi"];
            $urununFiyati=$sepetteki_urun_kaydi["UrunFiyati"];
            $urununKdvOrani=$sepetteki_urun_kaydi["KDVOrani"];
            $urununParaBirimi=$sepetteki_urun_kaydi["ParaBirimi"];
            $urununKargoUcreti=$sepetteki_urun_kaydi["KargoUcreti"];
            $urununVaryantBasligi=$sepetteki_urun_kaydi["VaryantBasligi"];
            
            $UrunVaryantBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");//sepeteki siparişin varyant id sini yuarıda cektin. bu id yi kulanarak ta aynı urunun urunlervaryantları tablosundan bilgilerini çekiyorum.(döngü içindeki olduğumuz için her siparişin kini ayrı ayrı alıyoruz. ve işliyoruz.)
            $UrunVaryantBilgileri_sorgusu->execute([$sepetVaryantId]);

            $sepetteki_urun_varyant_kaydi=$UrunVaryantBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);
            $varyantAdi=$sepetteki_urun_varyant_kaydi["VaryantAdi"];

            $kargoBilgileri_sorgusu=$baglan->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");//sepeteki siparişin karg id sini yuarıda cektin. bu id yi kulanarak ta aynı urunun kargofirmaları tablosundan bilgilerini çekiyorum.(döngü içindeki olduğumuz için her siparişin kini ayrı ayrı alıyoruz. ve işliyoruz.)
            $kargoBilgileri_sorgusu->execute([$sepetKargoId]);
            $sepettekikargo_kaydi=$kargoBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);
            $KargoAdi=$sepettekikargo_kaydi["FirmaAdi"];

            $adresBilgileri_sorgusu=$baglan->prepare("SELECT * FROM adresler WHERE id=? LIMIT 1");//sepeteki siparişin adresıd sini yuarıda cektin. bu id yi kulanarak ta aynı urunun urunler tablosundan bilgilerini çekiyorum.(döngü içindeki olduğumuz için her siparişin kini ayrı ayrı alıyoruz. ve işliyoruz.)
            $adresBilgileri_sorgusu->execute([$sepetAdresId]);
            $adres_kaydi=$adresBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);
            
            $adresAdSoyad=$adres_kaydi["AdSoyad"];
            $adresAdres=$adres_kaydi["Adres"];
            $adresIlce=$adres_kaydi["Ilce"];
            $adresSehir=$adres_kaydi["Sehir"];
            $adresTelefon=$adres_kaydi["TelefonNumarasi"];
            $adresToparla=$adresAdres . " " . $adresIlce . "/" . $adresSehir;
            
            if ($urununParaBirimi=="USD") {
              $tlFiyat=$urununFiyati*$dolarKuru;
            }elseif ($urununParaBirimi=="EUR") {
              $tlFiyat=$urununFiyati*$dolarKuru;
            }else{
              $tlFiyat=$urununFiyati;
            }
            $UrununTopFiyati =($tlFiyat*$sepetUrunAdedi);
            $urununTopKargoFiyatHesapla =$urununKargoUcreti;

//urunun siparişlere işliycez ve siparişe eklenen ürünü sepetten silcez
           $siparisEkle=$baglan->prepare("INSERT INTO siparisler (UyeId,SiparisNumarasi,UrunId,UrunTuru,UrunAdi,UrunFiyati,KDVOrani,UrunAdedi,ToplamUrunFiyati,KargoFirmaSecimi,KargoUcreti,UrunResmiBir,VaryantBasligi,VaryantSecimi,AdresAdSoyad,AdresDetay,AdresTelefon,OdemeSecimi,TaksitSecimi,SiparisTarihi,SiparisIpAdresi) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
           
           $siparisEkle->execute([$sepetUyeId,$sepetSepetNum,$sepetUrunId,$urununTuru,$urununAdi,$tlFiyat,$urununKdvOrani,$sepetUrunAdedi,$UrununTopFiyati,$KargoAdi,$urununTopKargoFiyatHesapla,$urununResmi,$urununVaryantBasligi,$varyantAdi,$adresAdSoyad,$adresToparla,$adresTelefon,$GelenodemeTuruSecimi,0,$zaman_damgasi,$ipAdresi]);
           $siparisKontrol=$siparisEkle->rowCount();

           if ($siparisKontrol>0) {//siparislere eklenmiştir artık seppetten silmemiz gerek
                $SepettenSilme_sorgusu=$baglan->prepare("DELETE FROM sepet WHERE id=? AND UyeId=? LIMIT 1");
                $SepettenSilme_sorgusu->execute([$sepetId,$sepetUyeId]);
           }else{
                header("Location:index.php?sk=101");//hata sayfası
                exit();
           }
        }//forun kapaması
         //her döngüden sonra sıfırllasın fiyatları çünkü bir seppette mesela iki sipariş var her sipariş için dngü döneceği için birin siparişin döngüsü bittikten sonra fiyatlar sıfırlansı ve 2. siparişin döngüsü başlasınç.
        $UrununTopFiyati =($tlFiyat*$sepetUrunAdedi);
        $urununTopKargoFiyatHesapla =($urununKargoUcreti);

        $toplamFiyatiIcinSiparis_sorgusu=$baglan->prepare("SELECT SUM(ToplamUrunFiyati) AS toplamUcret FROM siparisler WHERE UyeId=? AND SiparisNumarasi=?");
        $toplamFiyatiIcinSiparis_sorgusu->execute([$KullaniciId,$sepetSepetNum]);
        $topFiyatiKaydi=$toplamFiyatiIcinSiparis_sorgusu->fetch(PDO::FETCH_ASSOC);

        $topUcretiniz=$topFiyatiKaydi["toplamUcret"];
        if ($topUcretiniz>=$ucretsizKargo) {
          $SiparisGuncelle_sorgusu=$baglan->prepare("UPDATE siparisler SET KargoUcreti=? WHERE UyeId=? AND SiparisNumarasi=?");
          $SiparisGuncelle_sorgusu->execute([0,$sepetUyeId,$sepetSepetNum]);
        }
          header("Location:index.php?sk=100");//"alisverissepetibankahavaleodemetamam.php";
          exit();
        }else{
          header("Location:index.php");//sepeti yoksa hile yapanşara karşı
          exit();
        }
        
      }else{ //kredi kartını seçmiştir.
       
        if ($GelentaksitSecimi!="") {//kac taksit
           $sepetGuncelle_sorgusu=$baglan->prepare("UPDATE sepet SET OdemeSecimi=?,TaksitSecimi=? WHERE UyeId=?");
           $sepetGuncelle_sorgusu->execute([$GelenodemeTuruSecimi,$GelentaksitSecimi,$KullaniciId]);
           $sepetkontrol=$sepetGuncelle_sorgusu->rowCount();
           if ($sepetkontrol>0) {
            header("Location:index.php?sk=102");//kredi bilgilerine gçtcek. "alisverissepetikredikartiodeme.php";
            exit();             
           }else{
            header("Location:index.php");
            exit();
           } 
        }else{
          header("Location:index.php");//taksit seçmediyse
          exit();
        }
    }
       
  }else{
       header("Location:index.php");//ödeme türünü seçmedıse hile yapıyo olabilir anasayfaya geri attık
        exit();
  }


}else{ 
        header("Location:index.php");//kullanıcı yoksa
        exit();
}
 
?>