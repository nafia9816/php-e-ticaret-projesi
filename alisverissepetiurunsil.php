<?php
if (isset($_SESSION["Kullanici"])) {	
	if (isset($_GET["ID"])){
		$GelenId=guvenlik($_GET["ID"]);
	}else{
		$GelenId="";
	}

	if ($GelenId !="") {
		$sepetSilmeSorgusu=$baglan->prepare("DELETE FROM sepet WHERE id=? AND UyeId=? LIMIT 1");
        $sepetSilmeSorgusu->execute([$GelenId,$KullaniciId]);
        $sepet_kayit_sayisi=$sepetSilmeSorgusu->rowCount(); //kayıt varmı
        //sil sede silmsede her halikarda sepet e gitsin
        if ($sepet_kayit_sayisi>0) {
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