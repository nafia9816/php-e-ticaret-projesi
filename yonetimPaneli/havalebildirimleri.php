<?php
if (isset($_SESSION["Yonetici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin

 $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
 $sayfaBasinaKayitSayisi=2;//bir sayfada kac kayıt gösterilsin
 $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
  
 $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM yorumlar WHERE UyeId=? ORDER BY YorumTarihi DESC");
 $toplamKayitSorgusu->execute([$YoneticiId]);
 $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
 $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);
  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">
      <div class="HaveleIslemlerAlani">
        <div class="HavaleIslemlerBaslik"> HAVALE BİLDİRİMLERİ</div>
        
  <?php
   $havale_sorgu=$baglan->prepare("SELECT * FROM havalebildirimleri ORDER BY islemTarihi ASC");
   $havale_sorgu->execute();
   $havale_sayi=$havale_sorgu->rowCount();
   $havale_kayitlari=$havale_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($havale_sayi>0){
    foreach ($havale_kayitlari as $havale) {

      $banka_sorgu=$baglan->prepare("SELECT * FROM bankahesaplari WHERE id=? LIMIT 1");
      $banka_sorgu->execute([$havale["BankaId"]]);
      $banka_kayitlari=$banka_sorgu->fetch(PDO::FETCH_ASSOC);
  ?>
  <div class="HavaleDetayAlani">
          <div class="HavaleBaslikMetni">&#10148; Müşterinin Adı Soyadı:</div>
          <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($havale["adisoyadi"]); ?></div>
  <div>
  <div class="HavaleDetayAlani">
          <div class="HavaleBaslikMetni">&#10148; İşlem Tarihi:</div>
          <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur(tarihBul($havale["islemTarihi"])); ?></div>
  </div>
  <div class="HavaleDetayAlani">
          <div class="HavaleBaslikMetni">&#10148; Müşterinin Telefon Numarası:</div>
          <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($havale["telefonNum"]); ?></div>
  </div>
  <div class="HavaleDetayAlani">
          <div class="HavaleBaslikMetni">&#10148; Havale Yapılacak Banka:</div>
          <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($banka_kayitlari["bankaAdi"]); ?></div>
  </div>
  <div class="HavaleSilIslemleri">
          <div class="HavaleSilMetni">Sil</div>
          <div class="HavaleSilResim">
              <a href="index.php?SKD=0&SKI=116&ID=<?php echo DonusumleriGeriDondur($havale["id"]); ?>"><img src="../img/sil.png" border="0"></a>
          </div>
  </div>
</div>    
  <?php
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
            echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=1'> << </a> </span>";
            $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
            echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
                /*başka bir kısımda sayfalama yaparken bu kodların aynısını kullanabiliriz sadece sk olan kısmı değiştiririz. mesela yorumlar 61 ise ve yorumlar sayfasında kullanıyorsam sayfalamayı sk=61 yaparım. yoksa sayfalama yanlış çalışır.*/
          }
          for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
            if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
              if ($sayfalama==$i) {
                  echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
              }else{
                echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=" . $i . "'> ". $i. "</a></span>";
              }
            }
                                        
          }
          if ($sayfalama!=$bulunanSayfaSayisi) {
              $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
              echo "<span class='Sayfalamapasif'> <a href='index.php?sk=58&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
              echo "<span class='Sayfalamapasif'><a href='index.php?sk=58&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
          }

          ?>
          </div>
      </div>                        
      <?php 
       }
     }else{
                ?>
<div class="BilgiAciklamaAlani">Kayıtlı havale bildirimi kaydı bulunmamaktadır.</div>
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