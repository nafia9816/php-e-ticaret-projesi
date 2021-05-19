<?php
namespace Verot\upload;//resim yukleme classı 

if (isset($_SESSION["Yonetici"])) {
   if (isset($_POST["siteAdi"])) {
   	 $GelensiteAdi=guvenlik($_POST["siteAdi"]);
   }else{
   	 $GelensiteAdi="";
   }
   if (isset($_POST["siteBaslik"])) {
   	 $GelensiteBaslik=guvenlik($_POST["siteBaslik"]);
   }else{
   	 $GelensiteBaslik="";
   }
   if (isset($_POST["siteAciklama"])) {
   	 $GelensiteAciklama=guvenlik($_POST["siteAciklama"]);
   }else{
   	 $GelensiteAciklama="";
   }
   if (isset($_POST["siteAnahtar"])) {
   	 $GelensiteAnahtar=guvenlik($_POST["siteAnahtar"]);
   }else{
   	 $GelensiteAnahtar="";
   }
   if (isset($_POST["sitecopy"])) {
   	 $Gelensitecopy=guvenlik($_POST["sitecopy"]);
   }else{
   	 $Gelensitecopy="";
   }
   if (isset($_POST["sitelink"])) {
   	 $Gelensitelink=guvenlik($_POST["sitelink"]);
   }else{
   	 $Gelensitelink="";
   }
   if (isset($_POST["sitemail"])) {
   	 $Gelensitemail=guvenlik($_POST["sitemail"]);
   }else{
   	 $Gelensitemail="";
   }
   if (isset($_POST["sitesifre"])) {
   	 $Gelensitesifre=guvenlik($_POST["sitesifre"]);
   }else{
   	 $Gelensitesifre="";
   }
   if (isset($_POST["sitehost"])) {
   	 $Gelensitehost=guvenlik($_POST["sitehost"]);
   }else{
   	 $Gelensitehost="";
   }
   if (isset($_POST["siteface"])) {
   	 $Gelensiteface=guvenlik($_POST["siteface"]);
   }else{
   	 $Gelensiteface="";
   }
   if (isset($_POST["sitetwit"])) {
   	 $Gelensitetwit=guvenlik($_POST["sitetwit"]);
   }else{
   	 $Gelensitetwit="";
   }
   if (isset($_POST["sitelinkedin"])) {
   	 $Gelensitelinkedin=guvenlik($_POST["sitelinkedin"]);
   }else{
   	 $Gelensitelinkedin="";
   }
   if (isset($_POST["siteinstagram"])) {
   	 $Gelensiteinstagram=guvenlik($_POST["siteinstagram"]);
   }else{
   	 $Gelensiteinstagram="";
   }
   if (isset($_POST["sitepinterest"])) {
   	 $Gelensitepinterest=guvenlik($_POST["sitepinterest"]);
   }else{
   	 $Gelensitepinterest="";
   }
   if (isset($_POST["siteyoutube"])) {
   	 $Gelensiteyoutube=guvenlik($_POST["siteyoutube"]);
   }else{
   	 $Gelensiteyoutube="";
   }
   if (isset($_POST["sitedolarKuru"])) {
   	 $GelensitedolarKuru=guvenlik($_POST["sitedolarKuru"]);
   }else{
   	 $GelensitedolarKuru="";
   }
   if (isset($_POST["siteEuroKuru"])) {
   	 $GelensiteEuroKuru=guvenlik($_POST["siteEuroKuru"]);
   }else{
   	 $GelensiteEuroKuru="";
   }
   if (isset($_POST["sitekargobaraj"])) {
   	 $Gelensitekargobaraj=guvenlik($_POST["sitekargobaraj"]);
   }else{
   	 $Gelensitekargobaraj="";
   }
   if (isset($_POST["siteClientID"])) {
   	 $GelensiteClientID=guvenlik($_POST["siteClientID"]);
   }else{
   	 $GelensiteClientID="";
   }
   if (isset($_POST["siteStoreKey"])) {
   	 $GelensiteStoreKey=guvenlik($_POST["siteStoreKey"]);
   }else{
   	 $GelensiteStoreKey="";
   }
   if (isset($_POST["siteApiKulanicisi"])) {
   	 $GelensiteApiKulanicisi=guvenlik($_POST["siteApiKulanicisi"]);
   }else{
   	 $GelensiteApiKulanicisi="";
   }
   if (isset($_POST["siteApiSifre"])) {
   	 $GelensiteApiSifre=guvenlik($_POST["siteApiSifre"]);
   }else{
   	 $GelensiteApiSifre="";
   }

   $gelensitelLogo=$_FILES["sitelogo"];
   if(($GelensiteAdi!="") and ($GelensiteBaslik!="") and ($GelensiteAciklama!="") and ($GelensiteAnahtar!="") and ($Gelensitecopy!="") and ($Gelensitelink!="") and ($Gelensitemail!="") and ($Gelensitesifre!="") and ($Gelensitehost!="") and ($Gelensiteface!="") and ($Gelensitetwit!="") and ($Gelensitelinkedin!="") and ($Gelensiteinstagram!="") and ($Gelensitepinterest!="") and ($Gelensiteyoutube!="") and ($GelensitedolarKuru!="") and ($GelensiteEuroKuru!="") and ($Gelensitekargobaraj!="") and ($GelensiteClientID!="") and ($GelensiteStoreKey!="") and ($GelensiteApiKulanicisi!="") and ($GelensiteApiSifre!="")){


   	   $ayar_guncelle=$baglan->prepare("UPDATE ayarlar SET SiteAdi=?, SiteTitle=?, SiteLinki=?,SiteDescription=?,SiteKeywords=?,SiteCopyRightMetni=?,SiteMail=?, SiteMailSifre=?,SiteHostAdresi=?,sosyal_link_face=?,sosyal_link_twit=?,sosyal_link_linked=?,sosyal_link_ins=?,sosyal_link_pint=?,sosyal_link_you=?,UsdKuru=?,EuroKuru=?,UcretsizKargoBaraji=?,ClientID=?, StoreKey=?,ApiKullanicisi=?,ApiSifresi=?");
   	   $ayar_guncelle->execute([$GelensiteAdi,$GelensiteBaslik,$Gelensitelink,$GelensiteAciklama,$GelensiteAnahtar,$Gelensitecopy,$Gelensitemail,$Gelensitesifre,$Gelensitehost,$Gelensiteface,$Gelensitetwit,$Gelensitelinkedin,$Gelensiteinstagram,$Gelensitepinterest,$Gelensiteyoutube,$GelensitedolarKuru,$GelensiteEuroKuru,$Gelensitekargobaraj,$GelensiteClientID,$GelensiteStoreKey,$GelensiteApiKulanicisi,$GelensiteApiSifre]);


            if (($gelensitelLogo["name"]!="") and ($gelensitelLogo["type"]!="") and ($gelensitelLogo["tmp_name"]!="") and ($gelensitelLogo["error"]==0) and ($gelensitelLogo["size"]>0)) {

               //verot sınıfını kullnıyoruz. https://www.verot.net/php_class_upload.htm den aldım aşağıdaki kodu
               $siteLogosuYukle=new upload($gelensitelLogo, "tr-TR");
               if ($siteLogosuYukle->uploaded) {
                  $siteLogosuYukle->mime_magic_check =true;//geeln resmin mime turunu aşagıda belirrtiğim ture check ediyo. ben image turunde dedim pdf gelirse hata verir
                  $siteLogosuYukle->allowed = array("image/*");//butun resim uzantılarını kaubl eder
                  $siteLogosuYukle->file_new_name_body = "images";//resim dosyasının adı ne olsun
                  $siteLogosuYukle->file_overwrite= true;//dosya varsa ustune yaz
                  $siteLogosuYukle->image_convert= "png";//dosya her halikarda png olsun
                  $siteLogosuYukle->image_quality= 100;//kalitesi yuzde 100 oslun
                  $siteLogosuYukle->image_background_color= null;//png gelirse arka planı olmasın boyamasın dedim.
                  $siteLogosuYukle->image_resize = true;//belirttiğim boyuttan buyuk resim gelirse kırp
                  $siteLogosuYukle->image_x = 1175;//resmimin en boyunu ayarladım
                  $siteLogosuYukle->image_y= 382;
                 
                  
                  $siteLogosuYukle->process($verot_icin_klasorYolu);

                  if ($siteLogosuYukle->processed) {//resim yukleme olduysa
                     $siteLogosuYukle->clean();
                 } else {
                   header("Location:index.php?SKD=0&SKI=4");
                   exit();//resim yujleme basarusız hata sayfasına gider
                  }
               } 
               

            }//resim yükleme alanı sonu
   	      header("Location:index.php?SKD=0&SKI=3");//tamam
            exit();
      }else{
   	   header("Location:index.php?SKD=0&SKI=4");
         exit();
      }

}else{
  header("Location:index.php?SKD=0");//kullanıcı anasayfaya gitsin
  exit();
}

?>