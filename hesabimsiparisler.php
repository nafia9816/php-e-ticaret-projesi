<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin

 $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
 $sayfaBasinaKayitSayisi=1;//bir sayfada kac kayıt gösterilsin
 //1 yaptımçunku burada siparş numarasına göre bir sorgulama yaptığım içn bir sayfada bir siparişin ürünleri görünsin mesela sipariş num u 3 olan siparişte 3 ürün var 1 dediğim için ilk sayfaa bu 3 ürünü göstercek.

 
 $toplamKayitSorgusu=$baglan->prepare("SELECT DISTINCT 	SiparisNumarasi FROM siparisler WHERE UyeId=? ORDER BY 	SiparisNumarasi DESC");
 $toplamKayitSorgusu->execute([$KullaniciId]);
 $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
 $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
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
        
                
        </div><!-- MENÜ DENGELEMEM ALANI \-->
        </div><!-- menu alanı kapamsı-->

        <div class="HesabımSiparislerAlani">
        	<div class="HesabımSiparislerBaslikAlani">HESABIM&Siparişler</div>
        	<div class="HesabımSiparislerMetni">Tüm siparişlerinizi bu alandan görüntüleyebilirsiniz!</div>
        </div>

        <?php
        //burada iki sorgu yapacağız. Önce üyenin sipariş numarasını çekeceğz mesela bir siparişinde 1 ürün 2. siparişide 20 ürün olabilir. o yuzden önce üyenin sipariş numaralarını distinc ile çekeceğiz  daha sonra her sipariş numarasının yani siparişin  içindeki ürünlerin ürünadı, adedi, fiyatını çekeçeğiz.
        $siparisNumaralariSorgusu=$baglan->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE UyeId=? ORDER BY 	SiparisNumarasi DESC  LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
        $siparisNumaralariSorgusu->execute([$KullaniciId]);
        $siparis_numara_kayit_sayisi=$siparisNumaralariSorgusu->rowCount(); //kayıt varmı
        $siparis_numara_kayitlari=$siparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if ($siparis_numara_kayit_sayisi>0) {
            foreach ($siparis_numara_kayitlari as $satirlar) {
              $siparisno=DonusumleriGeriDondur($satirlar["SiparisNumarasi"]);
              //ikinci sorgu
              $siparisSorgusu=$baglan->prepare("SELECT *	FROM siparisler WHERE UyeId=? AND  SiparisNumarasi=? ORDER BY id ASC");
              $siparisSorgusu->execute([$KullaniciId,$siparisno]);
              $siparis_kayit_sayisi=$siparisSorgusu->rowCount(); //kayıt varmı
              $siparis_kayitlari=$siparisSorgusu->fetchAll(PDO::FETCH_ASSOC);
                foreach ($siparis_kayitlari as $siparisSatirlar) {
                  $UrunTuru=DonusumleriGeriDondur($siparisSatirlar["UrunTuru"]);
                  if ($UrunTuru == "fincan") {
                          $resimKlasoru="fincan";
                  }elseif($UrunTuru == "kupa"){
                          $resimKlasoru="kupa";
                  }elseif($UrunTuru == "kahveyanibardak"){
                          $resimKlasoru="kahveyanibardak";
                  }elseif($UrunTuru == "sunumluk"){
                          $resimKlasoru="sunumluk";
                  }                           

                  $KargoDurumu=DonusumleriGeriDondur($siparisSatirlar["KargoDurumu"]);
                  if ($KargoDurumu==0) {
                          $KargoDurumuYazdir="Beklemede";
                  }else{
                          $KargoDurumuYazdir=DonusumleriGeriDondur($siparisSatirlar["KargoGonderiKodu"]);
                  }
        ?>
        <div class="HesabimSiparisDetayAlani"> 
        	<div class="HesabimSiparisNumarasiAlani">#<?php echo DonusumleriGeriDondur($siparisSatirlar["SiparisNumarasi"]) ; ?></div>
          
          <div class="HesabimSiparisResimAlani">
            <img src="img/urunler/<?php echo $resimKlasoru; ?>/<?php echo DonusumleriGeriDondur($siparisSatirlar["UrunResmiBir"]); ?>" border="0">
          </div>

          <div class="HesabimSiparisYorumYapAlani">
            <a href="index.php?sk=75&UrunID=<?php echo DonusumleriGeriDondur($siparisSatirlar["UrunId"]); ?>">
						<img src="img/yorum.png" border="0"></a>
          </div>

          <div class="HesabimSiparisUrunAdiAlani"><?php echo DonusumleriGeriDondur($siparisSatirlar["UrunAdi"]); ?></div>

          <div class="HesabimSiparisUrunAddediAlani"><?php echo DonusumleriGeriDondur($siparisSatirlar["UrunAdedi"]); ?> Adet</div>

          <div class="HesabimSiparisKargoDurumu"><?php echo $KargoDurumuYazdir; ?></div>
          
          <div class="HesabimSiparisFiyatAlani"><?php echo fiyatBicimlendir(DonusumleriGeriDondur($siparisSatirlar["ToplamUrunFiyati"])); ?> TL
          </div>

        </div> <!-- sipariş detay alanı bitişi -->
      <?php 
        } //içteki frun kapaması 
      }//dıştaki foren kapaması
      if ($bulunanSayfaSayisi>1) { //sayfalama olaca
      ?>
      <div class="SayfalamaAlaniKapsayicisi">
        <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
          Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
        </div>
      <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
        <?php 
          if ($sayfalama>1) {//gelen sayfayı kontrol ediyoruz
            echo "<span class='Sayfalamapasif'><a href='index.php?sk=61&SYF=1'> << </a> </span>";// ilk sayfaya git
            $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1; 
            echo "<span class='Sayfalamapasif'><a href='index.php?sk=61&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";//bulunduğun sayfadan bir geri git
          }
          /* for un izahı: sayfalam=5 olsun 5-2=3;(3. sayfadayız); 3<= 5+2 de 7 old için dongu 7. sayfaya kadar devam etcek yani en son sayfa 7
          3 4 5 6 7 şeklinde */ 
          for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
              if (($i>0) and ($i<=$bulunanSayfaSayisi)) {// mesela 7 sayfa toplamda. 7 den sonra 8 9 yazmasın diye bu kontrolü yaptık. aynı şekilde 1. sayfadaysa -1 0 yazmasın diye
                if ($sayfalama==$i) {//olduğumuz sayfa
                  echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
                }else{
                  echo "<span class='Sayfalamapasif'><a href='index.php?sk=61&SYF=" . $i . "'> ". $i. "</a></span>";
                }
              }
                                        
          }
          if ($sayfalama!=$bulunanSayfaSayisi) {
            $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
            echo "<span class='Sayfalamapasif'> <a href='index.php?sk=61&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";//bulunduğun sayfadan bir ileri
            echo "<span class='Sayfalamapasif'><a href='index.php?sk=61&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";//en son sayfaya git
          }

        ?>
        </div><!-- <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi"> \ -->
      </div><!-- <div class="SayfalamaAlaniKapsayicisi">-->

      <?php	
        } //if ($bulunanSayfaSayisi>1) { kapaması
        }else{ //if ($sipari_numara_kayit_sayisi>0) { kapaması
      ?>

      <div class="BilgiAciklamaAlani">Kayıtlı adresiniz bulunmamaktadır. </div>
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