<?php
if (isset($_SESSION["Kullanici"])) {	
	if (isset($_GET["ID"])){
		$GelenId=guvenlik($_GET["ID"]);
	}else{
		$GelenId="";
	}
	
	if ($GelenId !="") {
		$sepetGuncelleSorgusu=$baglan->prepare("UPDATE sepet SET UrunAdedi=UrunAdedi+1  WHERE id=? AND UyeId=? LIMIT 1");
        $sepetGuncelleSorgusu->execute([$GelenId,$KullaniciId]);

        $sepetGuncelle_kayit_sayisi=$sepetGuncelleSorgusu->rowCount(); //kayıt varmı
        //sil sede silmsede her halikarda sepet e gitsin
        if ($sepetGuncelle_kayit_sayisi>0) {
        	header("Location: index.php?sk=93");
	        exit();
        }else{
        	header("Location: index.php?sk=93");
	        exit();
        }

	}else{
		header("Location: index.php?sk=93");
	    exit();
	}

}else{
	header("Location: index.php");
	exit();
}
























?>