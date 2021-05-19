<?php
if (isset($_SESSION["Yonetici"])) {

  if (isset($_POST["hakkimizdaMetni"])) {
     $GelenhakkimizdaMetni=guvenlik($_POST["hakkimizdaMetni"]);
  }else{
     $GelenhakkimizdaMetni="";
  }
  if (isset($_POST["uyelikSozMetni"])) {
     $GelenuyelikSozMetni=guvenlik($_POST["uyelikSozMetni"]);
  }else{
     $GelenuyelikSozMetni="";
  }
  if (isset($_POST["kullanımKosullariMetni"])) {
     $GelenkullanımKosullariMetni=guvenlik($_POST["kullanımKosullariMetni"]);
  }else{
     $GelenkullanımKosullariMetni="";
  }
  if (isset($_POST["gizlilikSozMetni"])) {
     $GelengizlilikSozMetni=guvenlik($_POST["gizlilikSozMetni"]);
  }else{
     $GelengizlilikSozMetni="";
  }
  if (isset($_POST["mesafeliSatisMetni"])) {
     $GelenmesafeliSatisMetni=guvenlik($_POST["mesafeliSatisMetni"]);
  }else{
     $GelenmesafeliSatisMetni="";
  }
  if (isset($_POST["teslimatMetni"])) {
     $GelenteslimatMetni=guvenlik($_POST["teslimatMetni"]);
  }else{
     $GelenteslimatMetni="";
  }
  if (isset($_POST["iptalIadeDegisimMetni"])) {
     $GeleniptalIadeDegisimMetni=guvenlik($_POST["iptalIadeDegisimMetni"]);
  }else{
     $GeleniptalIadeDegisimMetni="";
  }



   if(($GelenhakkimizdaMetni!="") and ($GelenuyelikSozMetni!="") and ($GelenkullanımKosullariMetni!="") and ($GelengizlilikSozMetni!="") and ($GelenmesafeliSatisMetni!="") and ($GelenteslimatMetni!="") and ($GeleniptalIadeDegisimMetni!="")){

   	   $ayar_guncelle=$baglan->prepare("UPDATE sozlesmelervemetinler SET hakkimizdaMetni=?, uyelikSozMetni=?, kullanımKosullariMetni=?, gizlilikSozMetni=?, mesafeliSatisMetni=?, teslimatMetni=?, iptalIadeDegisimMetni=?");
   	   $ayar_guncelle->execute([$GelenhakkimizdaMetni, $GelenuyelikSozMetni, $GelenkullanımKosullariMetni,$GelengizlilikSozMetni,$GelenmesafeliSatisMetni,$GelenteslimatMetni,$GeleniptalIadeDegisimMetni]);
       $ayar_guncelle_kontrol=$ayar_guncelle->rowCount();

      
          header("Location:index.php?SKD=0&SKI=7");//tmm
            exit();
       }else{
        header("Location:index.php?SKD=0&SKI=8");//hata
        exit();
       }


   	   

   	










   }else{
   	 header("Location:index.php?SKD=0&SKI=8");//hata
     exit();
   }


?>