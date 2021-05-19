<?php
   if (isset($_POST["kargotakipno"])) {
   	 $gelenKargoTakipNo=sayiliIcerikleriFiltrele(guvenlik($_POST["kargotakipno"]));
   }else{
   	 $gelenKargoTakipNo="";
   }

   if ($gelenKargoTakipNo!="") {
   	 header("https://www.araskargo.com.tr/trmobile/" . $gelenKargoTakipNo);//linkimde sıkıntı var. bu sayfaya geliyor ama yönlenmiyor
   	 exit();
   }else{
   	 header("Location:index.php?sk=14");
   	 exit();
   }

?>
