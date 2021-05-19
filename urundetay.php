<?php
  /* urun id si detay sayfasına gelmediyse sayfanın en aşağısında onu index.php ye yönlerdirdim. id geldiyse de buradan başlıcak */
  /* buraya id yada Id kabul etmedı direk anasayfaya atıyordu cunku kadın ve erkek ayakkabılarında url e ID YAZMISIZ O YUZDEN  href="index.php?sk=83&ID=<?php
  */
  if (isset($_GET["ID"])) {

  $gelenUrunId=sayiliIcerikleriFiltrele(guvenlik($_GET["ID"]));
  
  $UrunGuncelleSorgusu=$baglan->prepare("UPDATE urunler SET GoruntulenmeSayisi=GoruntulenmeSayisi+1 WHERE id=? AND Durumu=? LIMIT 1");
  $UrunGuncelleSorgusu->execute([$gelenUrunId,1]);
  
  $UrunSorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? AND Durumu=? LIMIT 1");
  $UrunSorgusu->execute([$gelenUrunId,1]);
  $urunSayisi=$UrunSorgusu->rowCount();
  $UrunSorgusuKaydi=$UrunSorgusu->fetch(PDO::FETCH_ASSOC);

  if ($urunSayisi>0) { /* if in kapaması en aşağıda*/

    $UrunTuru=$UrunSorgusuKaydi["UrunTuru"];
    if ($UrunTuru=="fincan") {
      $resimKlasoru="fincan";
    }elseif($UrunTuru=="kupa"){
      $resimKlasoru="kupa";
    }elseif($UrunTuru=="kahveyanibardak"){
      $resimKlasoru="kahveyanibardak";
    }elseif($UrunTuru=="sunumluk"){
      $resimKlasoru="sunumluk";
    }

    $urununFiyati=DonusumleriGeriDondur($UrunSorgusuKaydi["UrunFiyati"]);
    $urununBirimi=DonusumleriGeriDondur($UrunSorgusuKaydi["ParaBirimi"]);

    if ($urununBirimi=="USD") {
          $urunFiyatiTLCinsinden=$urununFiyati*$dolarKuru;
    }elseif ($urununBirimi=="EUR") {
          $urunFiyatiTLCinsinden=$urununFiyati*$EuroKuru;
    }else{
          $urunFiyatiTLCinsinden=$urununFiyati;
    }
?>
<div id="TamSayfaAlani">
  <div id="TamSayfaSinirlamaAlani">
    <div id="TamSayfaUrunDetayAlani">

      <div id="UrunDetayResimlerAlani">
        <div id="UrunDetayBuyukResimAlani">
          <div id="UrunDetayBuyukResimCercevesi">
            <img id="buyukResim" src="img/urunler/<?php echo $resimKlasoru;?>/<?php echo $UrunSorgusuKaydi["UrunResmiBir"]; ?>"  border="0">
          </div>
        </div>

        <div id="UrunDetayKucukResimlerAlani">
          <div id="UrunDetayKucukResimlerDengelemeAlani">

            <div class="UrunDetayKucukResimSinirlamaAlani">
              <div class="UrunDetayKucukResimCercevesi">
                  <img src="img/urunler/<?php echo $resimKlasoru;?>/<?php echo $UrunSorgusuKaydi["UrunResmiBir"]; ?>"  border="0" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $UrunSorgusuKaydi["UrunResmiBir"]; ?>');">
              </div>
            </div>

            <div class="UrunDetayKucukResimSinirlamaAlani">
              <div class="UrunDetayKucukResimCercevesi">
                  <!-- eğer urunun urunresmı2 yoksa orayı boş bır sutun  olrak göstersin -->
                <?php if ($UrunSorgusuKaydi["UrunResmiIki"]!="") {
                ?>
                <img src="img/urunler/<?php echo $resimKlasoru;?>/<?php echo $UrunSorgusuKaydi["UrunResmiIki"]; ?>" border="0" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $UrunSorgusuKaydi["UrunResmiIki"]; ?>');">
                <?php
                 }else{
                ?>
                   <div class="UrunDetayBosKucukResimCercevesi"></div>
                <?php
                 }
                ?>
              </div>
            </div>

            <div class="UrunDetayKucukResimSinirlamaAlani">
              <div class="UrunDetayKucukResimCercevesi">
                <?php if ($UrunSorgusuKaydi["UrunResmiUc"]!="") {
                ?>
                <img src="img/urunler/<?php echo $resimKlasoru;?>/<?php echo $UrunSorgusuKaydi["UrunResmiUc"]; ?>" border="0" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $UrunSorgusuKaydi["UrunResmiUc"]; ?>');">
                <?php
                 }else{
                ?>
                   <div class="UrunDetayBosKucukResimCercevesi"></div>
                <?php
                 }
                ?>
              </div>
            </div>

            <div class="UrunDetayKucukResimSinirlamaAlani">
              <div class="UrunDetayKucukResimCercevesi">
                 <?php if ($UrunSorgusuKaydi["UrunResmi4"]!="") {
                ?>
               <img src="img/urunler/<?php echo $resimKlasoru;?>/<?php echo $UrunSorgusuKaydi["UrunResmi4"]; ?>" border="0" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $UrunSorgusuKaydi["UrunResmi4"]; ?>');">
                <?php
                 }else{
                ?>
                  <div class="UrunDetayBosKucukResimCercevesi"></div>
                <?php
                 }
                ?>
              </div>
            </div>
       </div> <!-- kücük resimler dengeleme alanı  \ -->
      </div><!-- kücük resimler bitişi alanı -->
    </div><!-- resim lanının bitişi -->

    <div id="UrunDetayIslemlerAlani">
      <div id="UrunBaslikAlani"><?php echo $UrunSorgusuKaydi["UrunAdi"]; ?></div>
      <form action="index.php?sk=90&ID=<?php echo $UrunSorgusuKaydi["id"]; ?>" method="post">
        <div id="UrunDetayPaylasFavoriEkleVeSepeteEkleAlani">
           <div id="UrunDetayFacedePaylasAlani">
             <a href="<?php echo DonusumleriGeriDondur($face); ?>" target="_blank"><img src="img/facebook.png"></a>
           </div>
           <div id="UrunDetayTwitterPaylasAlani">
             <a href="<?php echo DonusumleriGeriDondur($twit); ?>" target="_blank"><img src="img/twitter.png"></a>
           </div>
           <div id="UrunDetayFavoriyeEkleAlani">
              <?php  //kullnıcı varsa burası favorilere ekle linki çıkcak giriş yapılmamıssa giriş yapsayfasına gitsin
               if (isset($_SESSION["Kullanici"])){
              ?>
              <a href="index.php?sk=86&ID=<?php echo $UrunSorgusuKaydi["id"]; ?>"><img src="img/favori.png" border="0"></a>
              <?php }else{ ?>
              <a href="index.php?sk=31"><img src="img/favori.png" border="0"></a>
              <?php } ?>
           </div> <!-- id="UrunDetayPaylasFavoriEkleVeSepeteEkleAlani"> bitisi -->

           <div id="UrunDetaySepeteEkleAlani">
             <input type="submit" value="SEPETE EKLE" id="UrunDetaySepeteEkleMetni">
           </div>
        </div>

        <div id="UrunDetayVaryantVeFiyatAlani">
           <div id="UrunDetayVaryantAlani">
             <select name="Varyant" class="FormSelectAlani">
                <option value=""> Lütfen <?php echo $UrunSorgusuKaydi["VaryantBasligi"]; ?> seçiniz </option>
                <?php
                  $varyantSorgusu=$baglan->prepare("SELECT * FROM urunvaryantlari WHERE UrunId=? AND StokAdedi > ? ORDER BY VaryantAdi ASC");
                  $varyantSorgusu->execute([$UrunSorgusuKaydi["id"],0]);
                  $varyantSayisi=$varyantSorgusu->rowCount();
                  $varyantKaydi=$varyantSorgusu->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($varyantKaydi as $varyantSecimi) {
                ?>
                <option value="<?php echo $varyantSecimi["id"]; ?>"><?php echo $varyantSecimi["VaryantAdi"]; ?></option>
                <?php
                  }
                ?>
              </select>
           </div> <!-- varyant alanı bitişi-->

           <div id="UrunDetayFiyatAlani">
             <div id="UrunDetayFiyatMetni">(Birim Fiyat)
             <?php echo fiyatBicimlendir($urunFiyatiTLCinsinden); ?> TL
             </div>
           </div>

        </div> <!-- <div id="UrunDetayVaryantVeFiyatAlani"> bitişi -->
    </form>     
    
    <div id="UrunDetayUrununAciklamaAlani">
      <div id="UrunDetayUrununAciklamaBaslikMetni">Ürün Açıklaması</div>
      <div id="UrunDetayUrununAciklamaIcerikMetni"><?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunAciklamasi"]); ?></div>
    </div>

    <div id="UrunDetayUrununAciklamaAlani">
      <div id="UrunDetayUrununAciklamaBaslikMetni">Ürün Hakkında Yorumlar </div>
      <?php
          $yorum_sorgusu=$baglan->prepare("SELECT * FROM yorumlar WHERE UrunId= ? ORDER BY YorumTarihi DESC");
          $yorum_sorgusu->execute([DonusumleriGeriDondur($UrunSorgusuKaydi["id"])]);
          $yorum_sayisi=$yorum_sorgusu->rowCount();
          $yorum_kayit=$yorum_sorgusu->fetchAll(PDO::FETCH_ASSOC);
          if ($yorum_sayisi>0) {
            foreach ($yorum_kayit as $key => $satir) {
            $yorumPuani=DonusumleriGeriDondur($satir["Puan"]);
            if ($yorumPuani==1) {
                             $yorumPuanResmi="yorumyildiz1.jpg";
            }elseif ($yorumPuani==2) {
                            $yorumPuanResmi="yorumyildiz2.jpg";
            }elseif ($yorumPuani==3) {
                             $yorumPuanResmi="yorumyildiz3.jpg";
            }elseif ($yorumPuani==4) {
                             $yorumPuanResmi="yorumyildiz4.jpg";
            }elseif ($yorumPuani==5) {
                             $yorumPuanResmi="yorumyildiz5.jpg";
            }

            $yorum_yapanUyeSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE id= ? LIMIT 1"); /* lımıt1= sadece 1 kişi gelsin demek*/
            $yorum_yapanUyeSorgusu->execute([DonusumleriGeriDondur($satir["UyeId"])]);
            $yorum_yapankişi_sayisi=$yorum_yapanUyeSorgusu->rowCount();
            $yorum_yapankisi_kaydi=$yorum_yapanUyeSorgusu->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="UrunDetayYorumAlani"> 
          <div class="YorumDetaylari"> <?php echo DonusumleriGeriDondur($satir["YorumMetni"]); ?> </div>
          <div class="UrunDetayYorumSahibiVeTarihi">
              <?php echo DonusumleriGeriDondur($yorum_yapankisi_kaydi["IsimSoyisim"]); ?>
              <?php echo tarihBul(DonusumleriGeriDondur($satir["YorumTarihi"])); ?>
          </div>
          <div class="HesabimYorumYapResimAlani"><img src="img/<?php echo $yorumPuanResmi; ?>" border="0"></div>
      </div>
      <?php
          }//for kapaması
          }else{ // yorum varsa if ini kapması
      ?>
      <div class="BilgiAciklamaAlani">Ürün için yorum eklenmemiştir.</div>
      <?php
          }
      ?>

    </div> <!-- <div id="UrunDetayUrununAciklamaAlani"> bitişi-->
    <div class="UrunDetayKargoBilgiAlani">
       <div class="UrunDetayKargoBilgiResimAlani"><img src="img/zaman.png" border="0"></div>
       <div class="UrunDetayKargoBilgiMetinAlani">
         Siparişiniz <?php echo UcGunIleriTarihBul(); ?> tarihine kadar kargoya verilecektir.
       </div>       
     </div>

     <div class="UrunDetayHizliBilgiAlani">
       <div class="UrunDetayHizliBilgiResimAlani"><img src="img/hızlısevkiyat.png" border="0"></div>
       <div class="UrunDetayHizliMetinAlani">
         İlgili ürün süper hızlı gönderi kapsamındadır. Aynı gün içinde teslimat yapılabilir.
       </div>
     </div>

     <div class="UrunDetayKrediBilgiAlani">
       <div class="UrunDetayKrediBilgiResimAlani"><img src="img/urundetaykredi.png" border="0"></div>
       <div class="UrunDetayKrediBilgiMetinAlani">
         Tüm bankaların kredi kartları ile peşin veya taksitli ödeme seçeneği.
       </div>
     </div>

     <div class="UrunBankaDetayBilgiAlani">
       <div class="UrunDetayBankaBilgiResimAlani"><img src="img/urundetaybank.png" border="0"></div>
       <div class="UrunDetayBankaBilgiMetinAlani">
         Tüm bankalardan havale veya EFT ile ödeme seçeneği
       </div>
     </div>

    </div> <!-- urundetay işlemler alanı kapaması -->
    </div> <!-- <div id="TamSayfaUrunDetayAlani"> kapaması -->
  

  </div><!-- tam sayfa sinirlama alanı bitişi -->
</div><!-- tam sayfa  alanı bitişi -->

<?php
    }else{
    //urun sayısı 0 dan kucukse yanı urun yoksa anasayfaya git
    header("Location:index.php");
    exit();
    }



 }else{
   header("Location:index.php");
   exit();
 }

?>
<!--  <?php
               /* $banner_sorgusu=$baglan->prepare("SELECT * FROM bannerler WHERE BannerAlani='urunDetay' ORDER BY GosterimSayisi ASC LIMIT 1");// menu adını alfabetik sıraya göre dizcek
                $banner_sorgusu->execute();
                $banner_sayisi=$banner_sorgusu->rowCount();
                $banner_kayit=$banner_sorgusu->fetch(PDO::FETCH_ASSOC);
             ?>
                          
                             <tr height="350">
                              <td>
                                <img src="img/<?php echo $banner_kayit["BannerResmi"]; ?>" border="0">
                              </td>
                             </tr>
                             <?php
                           $banner_guncelle=$baglan->prepare("UPDATE bannerler SET* GosterimSayisi=GosterimSayisi+1 WHERE id=? LIMIT 1");// menu adını alfabetik sıraya göre dizcek
                           $banner_guncelle->execute([$banner_kayit["id"]]);*/
                           ?>

                          -->