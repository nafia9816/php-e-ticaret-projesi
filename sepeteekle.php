<?php
  if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
 	if (isset($_GET["ID"])) {
 		$gelenUrunId=guvenlik($_GET["ID"]);
 	}else{
 		$gelenUrunId="";
 	}
//Varyant=urundetay.php de select te name kısmına vermişyitk bu değişkeni numaraları alabilmek için 
  if (isset($_POST["Varyant"])) {
      $gelenVaryantId=guvenlik($_POST["Varyant"]);
  }else{
      $gelenVaryantId="";
  }
  if (($gelenUrunId!="") and ($gelenVaryantId!="")) {
    
    $uyeninSepetKontrolu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC LIMIT 1"); //KULLANICININ sepetine eklediği en sonki eklenen urunun id sini(yani sepet tabosunun id si mesela bir kisşi 3 urun ekledı ve son eklediği urunden sonra sepet tablosunun id si 3 oldu o 3 o kullanıcının sepet numarası olsun.gibi:) almak için desc dedim çünkü bu id değerini sepetnumarasına vercemki her üye benzersiz sepet numarası alabilsin
    $uyeninSepetKontrolu->execute([$KullaniciId]);
    $uyenin_sepet_sayisi=$uyeninSepetKontrolu->rowCount();
      
    if ($uyenin_sepet_sayisi>0) { //kullanıcının sepette bir veya daha fazla ürünü var yani bir sepeti var

      $urununSepetKontrolu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=? AND UrunId=? AND VaryantId=? LIMIT 1");//sepette urun var eklenen urun aynı urun olmasın diye sorgu yapıcam
      $urununSepetKontrolu->execute([$KullaniciId,$gelenUrunId,$gelenVaryantId]);
      $urunun_sepet_sayisi=$urununSepetKontrolu->rowCount();
      $urunun_sepet_kaydi=$urununSepetKontrolu->fetch(PDO::FETCH_ASSOC);

      if ($urunun_sepet_sayisi>0) {//aynı urun var sadece adedini artırcam
        $urununseppettekimevcutAdedi=$urunun_sepet_kaydi["UrunAdedi"];
        $urununYeniAdedi=$urununseppettekimevcutAdedi+1;
        $urununIdsi=$urunun_sepet_kaydi["id"];//sepetteki urunun id si
        
        $urunGuncelle=$baglan->prepare("UPDATE sepet SET UrunAdedi=? WHERE id=? AND UyeId=? AND UrunId=? LIMIT 1");
        $urunGuncelle->execute([$urununYeniAdedi,$urununIdsi,$KullaniciId,$gelenUrunId]);
        $urunGuncelle_sayisi=$urunGuncelle->rowCount();
        if ($urunGuncelle_sayisi>0) {
            header("Location:index.php?sk=93");//alışveriş sepetine gider
            exit();
        }else{
            header("Location:index.php?sk=91");//sepeteekle hata
            exit();
        }

      }else{//eklenen ürün sepetteki ürünlerden değilse/farklıysa onu normal eklicem
        $UrunEkleme_sorgusu=$baglan->prepare("INSERT INTO sepet (UyeId,UrunId,VaryantId,UrunAdedi) values (?,?,?,?)");
        $UrunEkleme_sorgusu->execute([$KullaniciId,$gelenUrunId,$gelenVaryantId,1]);
        $sepetiniçi_sayisi=$UrunEkleme_sorgusu->rowCount();

        $sonIdDegeri=$baglan->lastInsertId();//sepet tablosundaki en sonki satırın ıd sini alır
        if ($sepetiniçi_sayisi>0) {//ürün sepete eklendiyse sepet tablosunda bir satır eklenmiş oldu ve bu son satırın ıd değerini sepet numarasına vericem.
          $sepetNumarasınıGuncelle=$baglan->prepare("UPDATE sepet SET SepetNumarasi=? WHERE UyeId=?");
          $sepetNumarasınıGuncelle->execute([$sonIdDegeri,$KullaniciId]);
          $sepet_sayisi=$sepetNumarasınıGuncelle->rowCount();
          if ($sepet_sayisi>0) {
            header("Location:index.php?sk=93");//alışveriş sepetine gider
            exit();
          }else{
            header("Location:index.php?sk=91");//sepete ekle hata
            exit();
          }
        }else{//urun sepete eklenmediyse hataya gider
            header("Location:index.php?sk=91");
            exit();
        }
      }
            
    }else{ //kullanıcının seppette ürünü yok. ekleyebilir yani sepeti boş!
      $UrunEkleme_sorgusu=$baglan->prepare("INSERT INTO sepet (UyeId,UrunId,VaryantId,UrunAdedi) values (?,?,?,?)");
      $UrunEkleme_sorgusu->execute([$KullaniciId,$gelenUrunId,$gelenVaryantId,1]);
      $sepetiniçi_sayisi=$UrunEkleme_sorgusu->rowCount();
      
      $sonIdDegeri=$baglan->lastInsertId();
      if ($sepetiniçi_sayisi>0) {
        $sepetNumarasınıGuncelle=$baglan->prepare("UPDATE sepet SET SepetNumarasi=? WHERE UyeId=?");
        $sepetNumarasınıGuncelle->execute([$sonIdDegeri,$KullaniciId]);
        $sepet_sayisi=$sepetNumarasınıGuncelle->rowCount();
        if ($sepet_sayisi>0) {
          header("Location:index.php?sk=93");//alışveriş sepetine gider:)
          exit();
        }else{
          header("Location:index.php?sk=91");//urun eklenmediyse hata
          exit();
        }
      }else{//urun eklenmediyse
        header("Location:index.php?sk=91");
        exit();
      }
    }

 
}else{//gelen veriler boşşsa urun id ile varyant id
       header("Location:index.php");
      exit();
}

}else{//kullanıcı yoksa
      //alert koy varyant seçiniz diye
      header("Location:index.php?sk=92");
      exit();
}

?>