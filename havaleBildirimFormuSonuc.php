<?php
//FORMADAN GELEN VERİLERİ HER ZAMAN TEMİZLETECEZ Kİ SQL INJEKSION AÇIĞI OLMASIN bunuda guvenlik fonksiyonumla yaptım.
   if (isset($_POST["IsimSoyisim"])) {
   	 $GelenIsimSoyisim=guvenlik($_POST["IsimSoyisim"]);
   }else{
   	 $GelenIsimSoyisim="";
   }

   if (isset($_POST["MailAdresi"])) {
   	 $GelenMailAdresi=guvenlik($_POST["MailAdresi"]);
   }else{
   	 $GelenMailAdresi="";
   }

   if (isset($_POST["telefonNum"])) {
   	 $GelenTelefonNum=guvenlik($_POST["telefonNum"]);
   }else{
   	 $GelenTelefonNum="";
   }

   if (isset($_POST["BankaSecimi"])) {
   	 $GelenBankaSecimi=guvenlik($_POST["BankaSecimi"]);
   }else{
   	 $GelenBankaSecimi="";
   }

   if (isset($_POST["aciklama"])) {
   	 $GelenAciklama=guvenlik($_POST["aciklama"]);
   }else{
   	 $GelenAciklama="";
   }


//mutlaka dol olması gereken yerler
   if (($GelenIsimSoyisim!="") and ($GelenMailAdresi!="") and ($GelenTelefonNum!="") and ($GelenBankaSecimi!="")) {
      
      $havale_bildirimi_kaydet=$baglan->prepare("INSERT INTO havalebildirimleri (bankaId,adisoyadi,emailAdresi,telefonNum,Aciklama,islemTarihi,durum) values(?,?,?,?,?,?,?)"); //burdaki değişken adları db deki tablonun kolon adları
      $havale_bildirimi_kaydet->execute([
        $GelenBankaSecimi,$GelenIsimSoyisim,$GelenMailAdresi,$GelenTelefonNum,$GelenAciklama,$zaman_damgasi,0]);
        //durum kolonunun anlamı: yönetim paneli tarafında onaylanırsa durum 1 olsun onaylanmazsa 0 olsun :)
      //fonksiyonlar.php den zaman damgasini aldık
      //GELEN DEĞERLERİ EXECUTE İÇİNDE YAPIYORUM KI SQL INJEKSION AÇIĞI OLMASIN

      $havale_bildirim_sayisi=$havale_bildirimi_kaydet->rowCount();
      $havale_bildirimi_kayitlari=$havale_bildirimi_kaydet->fetchAll(PDO::FETCH_ASSOC);

      if ($havale_bildirim_sayisi>0) {
      		header("Location:index.php?sk=11");//tamam
      	    exit();
      }else{
      	header("Location:index.php?sk=12");//hata
      	exit();
      }
   }/* mutlaka dolması gereken kısımlardan herhangi biri boşsa eksil alana yönlendirdim.*/
   else{
      	header("Location:index.php?sk=13");
      	exit();
      }


   
   
   
   



?>