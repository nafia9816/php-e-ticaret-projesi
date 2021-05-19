 <?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
 if (isset($_GET["ID"])) {
 	$gelenUrunId=guvenlik($_GET["ID"]);
 }else{
 	$gelenUrunId="";
 }

 if ($gelenUrunId!="") {
  //favorilere eklenecek urunu kontrol ediyorum ki favorilere dha önce eklenmişşe aynı urunden ikinci kez eklenmesin
 	$favoriKontrol_sorgusu=$baglan->prepare("SELECT * FROM favoriler WHERE UrunId=? AND UyeId=? LIMIT 1 ");
      $favoriKontrol_sorgusu->execute([$gelenUrunId,$KullaniciId]);
      $favoriKontrol_sorgusu_sayisi=$favoriKontrol_sorgusu->rowCount();

      if ($favoriKontrol_sorgusu_sayisi>0) {
        header("Location:index.php?sk=89");//bu urun daha önce eklenmiş
 	  exit();
      }else{ //bu uye bu urunu daha once eklememiş o yuzden ekleme yapılabilir
        $favorilereEkle_sorgusu=$baglan->prepare("INSERT INTO favoriler (UrunId,UyeId) values (?,?) ");
        $favorilereEkle_sorgusu->execute([$gelenUrunId,$KullaniciId]);
        $favori_sayisi=$favorilereEkle_sorgusu->rowCount();
        if ($favori_sayisi>0) {
       	header("Location:index.php?sk=87");//tmm
 		exit();
        }else{
       	header("Location:index.php?sk=88");//hata
 		exit();
        }
      }

 	}else{//gelen urun ıd boşşsa
 		header("Location:index.php");
 		exit();
 	}


 	}else{//kullanıcı giriş yapmamıssa
 		header("Location:index.php");
 		exit();
 	}
?>
?>