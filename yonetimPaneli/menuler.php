<?php
 if (isset($_SESSION["Yonetici"])) {
  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=10;//bir sayfada kac kayıt gösterilsin
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
 
  $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM menuler ORDER BY id DESC");//sorguda yanlışlık olabilir
  $toplamKayitSorgusu->execute();
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);
  
 
  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
  $sayfalama_kosulu="";

?>
<div id="UyelerTamSayfaCerceveAlani">
  <div id="UyelerTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="UyelerBaslik">MENÜLER</div>

  <?php
   $menuler_sorgu=$baglan->prepare("SELECT * FROM menuler ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
   $menuler_sorgu->execute();
   $menuler_sayi=$menuler_sorgu->rowCount();
   $menuler_kayitlari=$menuler_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($menuler_sayi>0){
    foreach ($menuler_kayitlari as $menuler) {
  ?>
  <div class="UyeIslemlerAlani">
    <div class="SiparisDetayAlaniSag">
      <div class="UyeDetayBaslikMetni"> Ürün Türü:</div>
      <div class="UyeDetayIcerikMetni"><?php echo $menuler["UrunTuru"]; ?></div>
    </div>
    <div class="SiparisDetayAlaniSol">
      <div class="UyeDetayBaslikMetni"> Ürün Sayısı:</div>
      <div class="UyeDetayIcerikMetni"><?php echo $menuler["MenuAdi"]; ?>(<?php echo $menuler["UrunSayisi"]; ?>)</div>
    </div>
    <div class="HavaleSilIslemleri">
      <div class="HavaleSilMetni">Sil</div>
      <div class="HavaleSilResim">
          <a href="index.php?SKD=0&SKI=66&ID=<?php echo DonusumleriGeriDondur($menuler["id"]); ?>"><img src="../img/sil.png" border="0"></a>
      </div>
      <div class="HavaleSilMetni">Güncelle</div>
      <div class="HavaleSilResim">
        <a href="index.php?SKD=0&SKI=62&ID=<?php echo DonusumleriGeriDondur($menuler["id"]); ?>"><img src="../img/adresguncelle.png" border="0"></a>
      </div>
    </div>  
  </div> <!-- üye işlemlerialanı sonu-->
  <?php  
    } //for un sonu
    if ($bulunanSayfaSayisi>1) {
  ?>
  <div class="SayfalamaAlaniKapsayicisi">
      <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
        Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
      </div>
      <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
        <?php 
          if ($sayfalama>1) {
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=57' . $sayfalama_kosulu. '&SYF=1'> << </a> </span>";

              $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;

              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=57" . $sayfalama_kosulu . "&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
          }
           for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
              if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
                        if ($sayfalama==$i) {
                            echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
                        }else{
                             echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=57" .$sayfalama_kosulu."&SYF=" . $i . "'> ". $i. "</a></span>";
                        }
                        }
            }
            if ($sayfalama!=$bulunanSayfaSayisi) {
                        $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;

                        echo "<span class='Sayfalamapasif'> <a href='index.php?SKD=0&SKI=57".$sayfalama_kosulu ."&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";

                        echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=57".$sayfalama_kosulu. "&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
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
<div class="BilgiAciklamaAlani">Kayıtlı menü bulunmamaktadır.</div>
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