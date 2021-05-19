<?php
  require_once("ayarlar/ayarlar.php");
  require_once("ayarlar/fonksiyonlar.php");
  require_once("ayarlar/sitesayfalari.php");

  $oid=$_POST["oid"];
  $sepetinTaksit_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE SepetNumarasi=?");
    $sepetinTaksit_sorgusu->execute([$oid]);
    $sepetTaksitsayisi=$sepetinTaksit_sorgusu->rowCount();
    $sepetTaksitKaydi=$sepetinTaksit_sorgusu->fetch(PDO::FETCH_ASSOC);
    $taksit_sayisi=$sepetTaksitKaydi["TaksitSecimi"];  /* krei kartı seöimini de alcaz*/
    if ($taksit_sayisi==1) {
      $taksit_sayisi="";
    }



  $hashparams=$_POST["HASHPARAMS"];
  $hashparamsval=$_POST["HASHPARAMSVAL"];
  $hashparam=$_POST["HASH"];
  $storekey=DonusumleriGeriDondur($StoreKey);
  $paramsval="";
  $index1=0;
  $index2=0;
    while ($index1<@strlen($hashparams)) {
      $index2=@strpos($hashparams, ":",$index1);
      $vl=$_POST[@substr($hashparams, $index1,$index2-$index1)];
        if ($vl==null) {
          $vl="";
          $paramsval=$paramsval.$vl;
          $index1=$index2+1;
        }
    }
  $hashval=$paramsval.$storekey;
  $hash=@base64_encode(@pack('H*', @sha1($hashval)));
    if ($paramsval !=$hashparamsval || $hashparam!=$hash) {
      echo "<h4>Güvenlik Uyarısı! Sayısal imza geçerli değil.</h4>";
    }
  $name=DonusumleriGeriDondur($ApiKulanicisi);
  $password=DonusumleriGeriDondur($ApiSifre);
  $clientid=$_POST["clientid"];
  $mode="P";
  $type="Auth";
  $expires=$_POST["Ecom_Payment_Card_ExpDate_Month"]. "/".$_POST["Ecom_Payment_Card_ExpDate_Year"];
  $cv2=$_POST['cv2'];
  $tutar=$_POST["amount"];
  $taksit=$taksit_sayisi;
  $lip=GetHostByName($REMOTE_ADDR);
  $email="";
  $mdStatus=$_POST['mdStatus'];
  $xid=$_POST['xid'];
  $eci=$_POST['eci'];
  $cavv=$_POST['cavv'];
  $md=$_POST['md'];





 


?>