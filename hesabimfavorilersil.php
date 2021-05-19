<?php
if (isset($_SESSION["Kullanici"])) {
	if (isset($_GET["ID"])){
		$GelenId=guvenlik($_GET["ID"]);
	}else{
		$GelenId="";
	}

	if ($GelenId !="") {
		
		$favoriSilmeSorgusu=$baglan->prepare("DELETE FROM favoriler WHERE id=? AND UyeId=?	LIMIT 1");
        $favoriSilmeSorgusu->execute([$GelenId,$KullaniciId]);
        $favori_kayit_sayisi=$favoriSilmeSorgusu->rowCount(); //kayıt varmı
        if ($favori_kayit_sayisi>0) {
        	header("Location: index.php?sk=59");//$sayfa[59]="hesabimfavoriler.php";
        	exit();
        }else{
        	header("Location: index.php?sk=82");//   $sayfa[82]="hesabimfavorilersilhata.php";
	        exit();
        }


	}else{
		header("Location: index.php?sk=82");
	    exit();
	}





}else{
	header("Location: index.php");
	exit();
}

?>