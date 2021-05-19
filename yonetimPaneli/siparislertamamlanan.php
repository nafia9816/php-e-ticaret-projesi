<?php
 if (isset($_SESSION["Yonetici"])) {
  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=1;//bir sayfada kac kayıt gösterilsin

  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;

  $toplamKayitSorgusu=$baglan->prepare("SELECT DISTINCT  SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=? ORDER BY  id DESC");
  $toplamKayitSorgusu->execute([1,1]);
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);

  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="HavaleIslemlerBaslik">TAMAMLANAN SİPARİŞLER</div>
        
  <?php
    $siparisNumaralariSorgusu=$baglan->prepare("SELECT DISTINCT   SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=? ORDER BY  id DESC  LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");//kullanıcın önce sipariş numaralarını çekiyoruz. yani 1 nolusipariş inde 3 ürün 2 nolu siparişinde 5 ürün. sonrada altta sipariş nosuna gre koşul yazcaz  önce 1 nolu siparişin detaylarını alcaz sonra diğerinin bunu da sorguyla yapıcaz
    $siparisNumaralariSorgusu->execute([1,1]);// kargo ve onay durumu 1 olan yanş tamalana siparişi aldık.
    $siparis_numara_kayit_sayisi=$siparisNumaralariSorgusu->rowCount(); //kayıt varmı
    $siparis_numara_kayitlari=$siparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if ($siparis_numara_kayit_sayisi>0) {
        foreach ($siparis_numara_kayitlari as $satirlar) {
          //burada kullanıcın yakaladığımız sipariş no suna göre tek tek çekecek
        $siparisler_sorgu=$baglan->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi=? AND KargoDurumu=? AND OnayDurumu=?");
        $siparisler_sorgu->execute([$satirlar["SiparisNumarasi"],1,1]);
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
            <div class="HavaleSilMetni">Detay</div>
            <div class="HavaleSilResim">
              <a href="index.php?SKD=0&SKI=108&SiparisNo=<?php echo DonusumleriGeriDondur($siparisler["SiparisNumarasi"]); ?>"><img src="../img/urundetay.png" border="0"></a>
            </div>

          </div>
</div>    
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
            echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=107&SYF=1'> << </a> </span>";
            $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
            echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=107&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
                /*başka bir kısımda sayfalama yaparken bu kodların aynısını kullanabiliriz sadece sk olan kısmı değiştiririz. mesela yorumlar 61 ise ve yorumlar sayfasında kullanıyorsam sayfalamayı sk=61 yaparım. yoksa sayfalama yanlış çalışır.*/
          }
          for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
            if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
              if ($sayfalama==$i) {
                  echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
              }else{
                echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=107&SYF=" . $i . "'> ". $i. "</a></span>";
              }
            }
                                        
          }
          if ($sayfalama!=$bulunanSayfaSayisi) {
              $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
              echo "<span class='Sayfalamapasif'> <a href='index.php?SKD=0&SKI=107&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=107&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
          }

          ?>
          </div>
      </div>                        
      <?php 
       }
     }else{
                ?>
<div class="BilgiAciklamaAlani">Kayıtlı tamamlanan siparis bulunmamaktadır.</div>
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