<?php

 if (isset($_SESSION["Yonetici"])) {

   

   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   


   if(($Gelenid!="")){
      
         $yoneticiler_Silme_sorgusu=$baglan->prepare("DELETE FROM yoneticiler WHERE id=? AND KullaniciAdi!= ? AND    SilinmeyecekYoneticiDurum=? LIMIT 1");
         //KULLNICI ADI eşit olmayan
         $yoneticiler_Silme_sorgusu->execute([$Gelenid,$YoneticiKullaniciAdi,0]);//kendimizi silmemeize imkan vermez. bu sayede illakibir yönetici kalır.
         //yada yönetici tablosuna silinemeyecek yonetici durumu tanımlar ve 1 veririm. bunu kimse silemez
         //SADECE 0 OLANI SİLEBİLRİSİN
         $yoneticilerSil_sayi=$yoneticiler_Silme_sorgusu->rowCount();
         if ($yoneticilerSil_sayi>0) {
         
            header("Location:index.php?SKD=0&SKI=79");
            exit();
         }else{
             header("Location:index.php?SKD=0&SKI=80");
              exit();
         }
      }else{
      header("Location:index.php?SKD=0&SKI=80");
      exit();
   }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}






?>