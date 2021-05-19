<?php
if (isset($_SESSION["Kullanici"])) {
	if (isset($_GET["ID"])){
		$GelenId=guvenlik($_GET["ID"]);
	}else{
		$GelenId="";
	}
    
if ($GelenId !="") {
		
	$adresSilmeSorgusu=$baglan->prepare("DELETE FROM adresler WHERE id=? LIMIT 1");
    $adresSilmeSorgusu->execute([$GelenId]);
    $adres_kayit_sayisi=$adresSilmeSorgusu->rowCount(); //kayıt varmı
    if ($adres_kayit_sayisi>0) {
      header("Location: index.php?sk=68");//   $sayfa[68]="hesabimadreslersiltamam.php";
	  exit();
    }else{
      header("Location: index.php?sk=69");//  $sayfa[69]="hesabimadreslersilhata.php";
	  exit();
    }

}else{
	header("Location: index.php?sk=74");//"hesabimadreslersileksikalan.php";
	exit();
}





}else{
	header("Location: index.php");
	exit();
}
?>