<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin

  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=4;//bir sayfada kac kayıt gösterilsin
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
  
  $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM yorumlar WHERE UyeId=? ORDER BY YorumTarihi DESC");
  $toplamKayitSorgusu->execute([$KullaniciId]);
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);

  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için

?>
 <div id="TamSayfaCerceveAlani">
     <div id="TamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        
        <div id="HesaplarMenuAlani"> 
          <div id="HesaplarMenuDengelemeAlani">
          
          <div class="HesaplarMenuSinirlamaAlani">
              <div class="HesaplarMenuTumMenulerAlani">
                <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=50" target="_top">Üyelik Bilgilerim</a></div>
              </div>
          </div>
          
          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=61" >Siparişler</a></div>
            </div>
          </div>

          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=60">Yorumlar</a></div>
            </div>
          </div>

          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=58">Adreslerim</a></div>
            </div>
          </div>

          <div class="HesaplarMenuSinirlamaAlani">
            <div class="HesaplarMenuTumMenulerAlani">
              <div class="HesaplarMenuTumMenulerMetni"><a href="index.php?sk=59">Favorilerim</a></div>
            </div>
          </div>
        
                
        </div> 
      </div><!-- -menu alanı bitişi -->

      <div class="HesabımSiparislerAlani">
        <div class="HesabımSiparislerBaslikAlani">HESABIM&Yorumlar</div>
        <div class="HesabımSiparislerMetni">Tüm yorumlarınızı bu alandan görüntüleyebilirsiniz!</div>
      </div>

      <?php
        $yorumlarSorgusu=$baglan->prepare("SELECT * FROM yorumlar WHERE  UyeId=? ORDER BY  YorumTarihi DESC  LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
        $yorumlarSorgusu->execute([$KullaniciId]);
        $yorumlar_kayit_sayisi=$yorumlarSorgusu->rowCount(); //kayıt varmı
        $yorumlar_kayitlari=$yorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
        if ($yorumlar_kayit_sayisi>0) {
          foreach ($yorumlar_kayitlari as $satirlar) {
                        $verilenPuan=$satirlar["Puan"];
          if ($verilenPuan==1) {
                $resim="yorumyildiz1.jpg";
          }elseif ($verilenPuan==2) {
                $resim="yorumyildiz2.jpg";
          }elseif ($verilenPuan==3) {
                $resim="yorumyildiz3.jpg";
          }elseif ($verilenPuan==4) {
                $resim="yorumyildiz4.jpg";
          }else {
                $resim="yorumyildiz5.jpg";
          }
          $urunlerSorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
          $urunlerSorgusu->execute([$satirlar["UrunId"]]);
          $urun_kaydi=$urunlerSorgusu->fetch(PDO::FETCH_ASSOC);          
          $urununAdi=$urun_kaydi["UrunAdi"];

          $uyelerSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE id=? LIMIT 1");
          $uyelerSorgusu->execute([$satirlar["UyeId"]]);
          $uyeler_kaydi=$uyelerSorgusu->fetch(PDO::FETCH_ASSOC);
          $uyeninAdi=$uyeler_kaydi["IsimSoyisim"];
      ?>
      <div class="HesabimYorumDetayAlani"> 
        <div class="HesabimYorumUrunAdiAlani">
          <span class="solalan"><?php echo DonusumleriGeriDondur($urununAdi); ?></span>
          <span class="sagalan"><?php echo DonusumleriGeriDondur($uyeninAdi); ?> | <?php echo tarihBul(DonusumleriGeriDondur($satirlar["YorumTarihi"])); ?> </span>
        </div>
        <div class="HesabimYorumYapResimAlani"><img src="img/<?php echo $resim; ?>" border="0"></div>
        <div class="YorumDetaylari"><?php echo DonusumleriGeriDondur($satirlar["YorumMetni"]); ?></div>

      </div>
      <?php
        } //içteki frun kapaması

        if ($bulunanSayfaSayisi>1) { //sayfalama olaca
       ?>
       <div class="SayfalamaAlaniKapsayicisi">
          <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
            Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
          </div>
          <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
            <?php 
              if ($sayfalama>1) {
                echo "<span class='Sayfalamapasif'><a href='index.php?sk=60&SYF=1'> << </a> </span>";
                $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
                echo "<span class='Sayfalamapasif'><a href='index.php?sk=60&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
              }
              for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
                if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
                  if ($sayfalama==$i) {
                    echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
                  }else{
                    echo "<span class='Sayfalamapasif'><a href='index.php?sk=60&SYF=" . $i . "'> ". $i. "</a></span>";
                  }
                }                                        
              }
              if ($sayfalama!=$bulunanSayfaSayisi) {
                $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
                echo "<span class='Sayfalamapasif'> <a href='index.php?sk=60&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
                echo "<span class='Sayfalamapasif'><a href='index.php?sk=60&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
              }

          ?>
          </div>
        </div>
        <?php 
          }
          }else{
        ?>
        <div class="BilgiAciklamaAlani">Kayıtlı yorumunuz bulunmamaktadır.</div>
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