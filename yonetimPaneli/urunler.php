<?php
 if (isset($_SESSION["Yonetici"])) {
  if (isset($_REQUEST["arama"])) {
    $gelenArama=guvenlik($_REQUEST["arama"]);
    $aramaKosulu=" AND UrunTuru LIKE '%" .$gelenArama. "%' ";
    $sayfalama_kosulu ="&arama=" . $gelenArama;
  }else{    
    $aramaKosulu="";
    $sayfalama_kosulu ="";
  }

//NOT: ARAMAYAPTUGIM URUNLER ARSINDA GEÇİŞ YAPINCA SAYFALAMA BOZLULUYOR   yani aradıgım kelimede 3 kayıtvarsa diğer sayfaya geçince tum kayıtlar xıkıyor

  $sayfalamaSolSagButonSayisi=10; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=2;//bir sayfada kac kayıt gösterilsin

  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;

  $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM urunler WHERE Durumu=? $aramaKosulu ORDER BY id DESC");
  $toplamKayitSorgusu->execute([1]);
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);

  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="HavaleIslemlerBaslik">ÜRÜNLER</div>       
      <div class="TamSayfaSagSutunAramaAlani">
        <form action="index.php?SKD=0&SKI=93" method="post">        
            <div class="AramaButonuKapsamaAlani"><input type="submit" value="" class="AramaButonu"></div>
            <div class="AramaInputKapsamaAlani"><input type="text" name="arama" class="AramaInput"></div>
        </form>
      </div>
 <?php
   $urunler_sorgu=$baglan->prepare("SELECT * FROM urunler WHERE Durumu=? $aramaKosulu ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
   $urunler_sorgu->execute([1]);
   $urunler_sayi=$urunler_sorgu->rowCount();
   $urunler_kayitlari=$urunler_sorgu->fetchAll(PDO::FETCH_ASSOC);

   if ($urunler_sayi>0){
    foreach ($urunler_kayitlari as $urunler) {
      $urununMenuSorgusu=$baglan->prepare("SELECT * FROM menuler WHERE id=? ORDER BY id DESC");
      $urununMenuSorgusu->execute([DonusumleriGeriDondur($urunler["MenuId"])]);
      $urunMenu_kaydi=$urununMenuSorgusu->fetch(PDO::FETCH_ASSOC);
      
  ?>
<div class="HaveleIslemlerAlani">
  <div class="UrunlerResimAlani">
    <img src="../img/urunler/<?php echo DonusumleriGeriDondur($urunler["UrunTuru"]); ?>/<?php echo DonusumleriGeriDondur($urunler["UrunResmiBir"]); ?>" border="0" width="60" height="80">
   </div>
   <div class="UrunDetaylari">
      <div class="HavaleDetayAlani">             
        <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($urunler["UrunTuru"]); ?>/ <?php echo DonusumleriGeriDondur($urunMenu_kaydi["MenuAdi"]); ?>
        </div>
      </div>
      <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($urunler["UrunAdi"]); ?></div>
      </div>
      <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni"><?php echo fiyatBicimlendir(DonusumleriGeriDondur($urunler["UrunFiyati"])); ?> <?php echo DonusumleriGeriDondur($urunler["ParaBirimi"]); ?>
        </div>
      </div>
      <div class="HavaleDetayAlani">
        <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($urunler["ToplamSatisSayisi"]); ?> adet satıldı. <?php echo DonusumleriGeriDondur($urunler["YorumSayisi"]); ?> yorum yapıldı. Ürünün toplam puanı <?php echo DonusumleriGeriDondur($urunler["ToplamYorumPuani"]); ?>,görüntüleme sayısı ise <?php echo DonusumleriGeriDondur($urunler["GoruntulenmeSayisi"]); ?> dir. 
        </div>
      </div>
      <div class="HavaleSilIslemleri">
        <div class="HavaleSilMetni">Sil</div>
        <div class="HavaleSilResim">
          <a href="index.php?SKD=0&SKI=102&ID=<?php echo DonusumleriGeriDondur($urunler["id"]); ?>"><img src="../img/sil.png" border="0"></a>
        </div>
        <div class="HavaleSilMetni">Güncelle</div>
          <div class="HavaleSilResim">
            <a href="index.php?SKD=0&SKI=98&ID=<?php echo DonusumleriGeriDondur($urunler["id"]); ?>"><img src="../img/adresguncelle.png" border="0"></a>>
          </div>
      </div>
  </div><!-- ürün detayları bitşi-->
</div>   <!-- havale işlemleri alanı sonu--> 
<?php
  }//for bitisi    
  if ($bulunanSayfaSayisi>1) {
?>
<div class="SayfalamaAlaniKapsayicisi">
    <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
      Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
    </div>
    <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
      <?php 
        if ($sayfalama>1) {
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=93' . $sayfalama_kosulu. '&SYF=1'> << </a> </span>";
              $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=93" . $sayfalama_kosulu . "&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
        }
        for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
          if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
            if ($sayfalama==$i) {
                            echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
            }else{
                             echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=93" .$sayfalama_kosulu."&SYF=" . $i . "'> ". $i. "</a></span>";
            }
          }
        }
        if ($sayfalama!=$bulunanSayfaSayisi) {
          $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
          echo "<span class='Sayfalamapasif'> <a href='index.php?SKD=0&SKI=93".$sayfalama_kosulu ."&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
           echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=93".$sayfalama_kosulu. "&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
        }
      ?>
  </div>
</div>                     
<?php
}//\bulunan sayfa sayısı if i
?>
<?php
    }else{ //if ($urunler_sayi>0){

    ?>
<div class="BilgiAciklamaAlani">Kayıtlı ürün bulunmamaktadır.</div>
<?php
}
?>
        </div> <!-- yüzlük alan kapaması -->
    </div>
</div>

<?php
}else{
  header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
  exit();
}
?>