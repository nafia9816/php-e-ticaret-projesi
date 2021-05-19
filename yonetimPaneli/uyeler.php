<?php
 if (isset($_SESSION["Yonetici"])) {
/* arama utusuna birkelşme yazınca o kelimeyi içeren ürünleri filtrelemesi için */
  if (isset($_REQUEST["arama"])) {
    $gelenArama=guvenlik($_REQUEST["arama"]);
    $aramaKosulu="AND (IsimSoyisim LIKE '%" .$gelenArama. "%' OR EmailAdres LIKE '%" .$gelenArama. "%' OR TelefonNumara LIKE '%" .$gelenArama. "%')";
    $sayfalama_kosulu ="&arama=" . $gelenArama;
  }else{
    $gelenArama="";
    $aramaKosulu="";
    $sayfalama_kosulu ="";
  }

  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=5;//bir sayfada kac kayıt gösterilsin
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
  
  $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE SilinmeDurumu=? $aramaKosulu ORDER BY id DESC");
  $toplamKayitSorgusu->execute([0]);//silinme durumu sıfr olanlar yani aktif/silinmemiş üyeler
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);
 
  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
?>
<div id="UyelerTamSayfaCerceveAlani">
  <div id="UyelerTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="UyelerBaslik">ÜYELER</div>
        
      <div class="TamSayfaSagSutunAramaAlani">
          <form action="index.php?SKD=0&SKI=81" method="post">        
            <div class="AramaButonuKapsamaAlani">
                 <input type="submit" value="" class="AramaButonu">
            </div>
            <div class="AramaInputKapsamaAlani">
                 <input type="text" name="arama" class="AramaInput">
            </div>
          </form>
      </div>
 <?php
   $uyeler_sorgu=$baglan->prepare("SELECT * FROM uyeler  WHERE SilinmeDurumu=? $aramaKosulu ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
   $uyeler_sorgu->execute([0]);
   $uyeler_sayi=$uyeler_sorgu->rowCount();
   $uyeler_kayitlari=$uyeler_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($uyeler_sayi>0){
    foreach ($uyeler_kayitlari as $uyeler) {
  ?>
    <div class="UyeIslemlerAlani">
        <div class="SiparisDetayAlaniSag">
               <div class="UyeDetayBaslikMetni"> Adı Soyadı:</div>
               <div class="UyeDetayIcerikMetni"><?php echo DonusumleriGeriDondur($uyeler["IsimSoyisim"]); ?></div>
        </div>
        <div class="SiparisDetayAlaniSag">
               <div class="UyeDetayBaslikMetni"> E-mail Adresi:</div>
               <div class="UyeDetayIcerikMetni"><?php echo DonusumleriGeriDondur($uyeler["EmailAdres"]); ?></div>
        </div>
        <div class="SiparisDetayAlaniSag">
               <div class="UyeDetayBaslikMetni"> Kayıt Tarihi:</div>
               <div class="UyeDetayIcerikMetni"><?php echo tarihBul(DonusumleriGeriDondur($uyeler["KayitTarihi"])); ?></div>
        </div>
        <div class="SiparisDetayAlaniSol">
               <div class="UyeDetayBaslikMetni"> Cinsiyet:</div>
               <div class="UyeDetayIcerikMetni"><?php echo DonusumleriGeriDondur($uyeler["Cinsiyet"]); ?></div>
        </div>
        <div class="SiparisDetayAlaniSol">
               <div class="UyeDetayBaslikMetni"> Telefon Numarası:</div>
               <div class="UyeDetayIcerikMetni"><?php echo DonusumleriGeriDondur($uyeler["TelefonNumara"]); ?></div>
        </div>
        <div class="SiparisDetayAlaniSol">
               <div class="UyeDetayBaslikMetni"> Kayıt IP Adresi:</div>
               <div class="UyeDetayIcerikMetni"><?php echo DonusumleriGeriDondur($uyeler["KayitIpAdresi"]); ?></div>
        </div>
        <div class="HavaleSilIslemleri">
            <div class="HavaleSilMetni">Sil</div>
            <div class="HavaleSilResim">
              <a href="index.php?SKD=0&SKI=83&ID=<?php echo DonusumleriGeriDondur($uyeler["id"]); ?>"><img src="../img/sil.png" border="0"></a>
          </div>
        </div>
      </div>    <!-- üye işlemler alanı bitişi-->
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
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=81' . $sayfalama_kosulu. '&SYF=1'> << </a> </span>";
              $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=81" . $sayfalama_kosulu . "&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
          }
          for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
              if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
                        if ($sayfalama==$i) {
                            echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
                        }else{
                             echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=81" .$sayfalama_kosulu."&SYF=" . $i . "'> ". $i. "</a></span>";
                        }
              }
          }
          if ($sayfalama!=$bulunanSayfaSayisi) {
            $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
            echo "<span class='Sayfalamapasif'> <a href='index.php?SKD=0&SKI=81".$sayfalama_kosulu ."&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
            echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=81".$sayfalama_kosulu. "&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
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
<div class="BilgiAciklamaAlani">Kayıtlı aktif üye bulunmamaktadır.</div>
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