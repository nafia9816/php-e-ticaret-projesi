<?php
 if (isset($_SESSION["Yonetici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=1;//bir sayfada kac kayıt gösterilsin
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;

  $toplamKayitSorgusu=$baglan->prepare("SELECT DISTINCT  SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=? ORDER BY  id DESC");
  $toplamKayitSorgusu->execute([0,0]);
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);

  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
        <div class="HavaleIslemlerBaslik"> BEKLEYEN SİPARİŞLER</div>
        
  <?php
    $siparisNumaralariSorgusu=$baglan->prepare("SELECT DISTINCT   SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=? ORDER BY  id DESC  LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
    $siparisNumaralariSorgusu->execute([0,0]);
    $siparis_numara_kayit_sayisi=$siparisNumaralariSorgusu->rowCount(); //kayıt varmı
    $siparis_numara_kayitlari=$siparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if ($siparis_numara_kayit_sayisi>0) {
        foreach ($siparis_numara_kayitlari as $satirlar) {

       $siparisler_sorgu=$baglan->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi=? AND KargoDurumu=? AND OnayDurumu=?");
       $siparisler_sorgu->execute([$satirlar["SiparisNumarasi"],0,0]);
       $siparisler_sayi=$siparisler_sorgu->rowCount();
       $siparisler_kayitlari=$siparisler_sorgu->fetchAll(PDO::FETCH_ASSOC);
       if ($siparisler_sayi>0){
         $toplamFiyat=0;
         foreach ($siparisler_kayitlari as $siparisler) {
          $urunSiparisTarihi=tarihBul($siparisler["SiparisTarihi"]);
          $urunTopFiyati=$siparisler["ToplamUrunFiyati"];
          $toplamFiyat += $urunTopFiyati;
          
         }
?>
<div class="HaveleIslemlerAlani">
  <div class="HavaleDetayAlani">
            <div class="HavaleBaslikMetni">&#10148; Sipariş Tarihi:</div>
            <div class="HavaleIcerikMetni"><?php echo $urunSiparisTarihi; ?></div>
  </div>
  <div class="HavaleDetayAlani">
            <div class="HavaleBaslikMetni">&#10148; Sipariş Tutarı:</div>
            <div class="HavaleIcerikMetni"><?php echo fiyatBicimlendir($toplamFiyat); ?> TL</div>
  </div>
  <div class="HavaleSilIslemleri">
            <div class="HavaleSilMetni">Sil</div>
            <div class="HavaleSilResim">
              <a href="index.php?SKD=0&SKI=112&SiparisNo=<?php echo DonusumleriGeriDondur($siparisler["SiparisNumarasi"]); ?>"><img src="../img/sil.png" border="0"></a>
            </div>          
            <div class="HavaleSilMetni">Detay</div>
            <div class="HavaleSilResim">
              <a href="index.php?SKD=0&SKI=106&SiparisNo=<?php echo DonusumleriGeriDondur($siparisler["SiparisNumarasi"]); ?>"><img src="../img/urundetay.png" border="0"></a>
            </div>
  </div>
</div>    <!-- HAVALE İŞLEMLEİ ALANI BİTİŞİ-->
<?php
         }else{
          header("Location:index.php?SKD=0&SKI=0");//hata sayfasın pano olsun
          exit();
        }
        }//for bitisi    
        if ($bulunanSayfaSayisi>1) { //sayfalama olaca
?>
  <div class="SayfalamaAlaniKapsayicisi">
    <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
        Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
    </div>
    <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
        <?php 
          if ($sayfalama>1) {
            echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=105&SYF=1'> << </a> </span>";
            $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
            echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=105&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
                /*başka bir kısımda sayfalama yaparken bu kodların aynısını kullanabiliriz sadece sk olan kısmı değiştiririz. mesela yorumlar 61 ise ve yorumlar sayfasında kullanıyorsam sayfalamayı sk=61 yaparım. yoksa sayfalama yanlış çalışır.*/
          }
          for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
            if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
              if ($sayfalama==$i) {
                  echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
              }else{
                echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=105&SYF=" . $i . "'> ". $i. "</a></span>";
              }
            }                                        
          }
          if ($sayfalama!=$bulunanSayfaSayisi) {
              $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
              echo "<span class='Sayfalamapasif'> <a href='index.php?SKD=0&SKI=105&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=105&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
         }
        ?>
          </div>
      </div>                        
      <?php 
       }
     }else{
      ?>
    <div class="BilgiAciklamaAlani">Kayıtlı bekleyen siparis bulunmamaktadır.</div>
</div>
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