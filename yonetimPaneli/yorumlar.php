<?php
 if (isset($_SESSION["Yonetici"])) {

  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=1;//bir sayfada kac kayıt gösterilsin
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
  
  $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM yorumlar ORDER BY id DESC");
  $toplamKayitSorgusu->execute([0]);
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);

  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için

?>
<div id="BankaHesaplariTamSayfaCerceveAlani">
  <div id="BankaHesaplariTamSayfaCerceveSinirlamaAlani">
    <div id="TamSayfadaYuzlukAlan">        
      <div class="HavaleIslemlerBaslik">YORUMLAR</div>

  <?php
   $yorumlar_sorgu=$baglan->prepare("SELECT * FROM yorumlar ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");
   $yorumlar_sorgu->execute([0]);
   $yorumlar_sayi=$yorumlar_sorgu->rowCount();
   $yorumlar_kayitlari=$yorumlar_sorgu->fetchAll(PDO::FETCH_ASSOC);
   if ($yorumlar_sayi>0){
    foreach ($yorumlar_kayitlari as $yorumlar) {
      if (DonusumleriGeriDondur($yorumlar["Puan"]) == "1") {
        $puanResmi="yorumyildiz1.jpg";
      }elseif (DonusumleriGeriDondur($yorumlar["Puan"]) == "2") {
        $puanResmi="yorumyildiz2.jpg";
      }elseif (DonusumleriGeriDondur($yorumlar["Puan"]) == "3") {
        $puanResmi="yorumyildiz3.jpg";
      }elseif (DonusumleriGeriDondur($yorumlar["Puan"]) == "4") {
        $puanResmi="yorumyildiz4.jpg";
      }elseif (DonusumleriGeriDondur($yorumlar["Puan"]) == "5") {
        $puanResmi="yorumyildiz5.jpg";
      }
    ?>
    <div class="HaveleIslemlerAlani">
      <div class="YorumPuanAlani"><img src="../img/<?php echo $puanResmi; ?>" border="0"></div>
      <div class="UrunDetaylari">
        <div class="HavaleDetayAlani">
               <div class="HavaleIcerikMetni"><?php echo DonusumleriGeriDondur($yorumlar["YorumMetni"]); ?>
               </div>
        </div>
        <div class="HavaleSilIslemleri">
          <div class="HavaleSilMetni">Sil</div>
          <div class="HavaleSilResim">
             <a href="index.php?SKD=0&SKI=90&ID=<?php echo DonusumleriGeriDondur($yorumlar["id"]); ?>"><img src="../img/sil.png" border="0"></a>
          </div>        
        </div>
      </div>
    </div>    
    <?php
      }//for bitisi    
          if ($bulunanSayfaSayisi>1) {
    ?>

    <div class="SayfalamaAlaniKapsayicisi">
      <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
        <?php 
          if ($sayfalama>1) {
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=89&SYF=1'> << </a> </span>";
              $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=89&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
          }
          for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
            if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
              if ($sayfalama==$i) {
                            echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
              }else{
                             echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=89&SYF=" . $i . "'> ". $i. "</a></span>";
              }
            }
          }
          if ($sayfalama!=$bulunanSayfaSayisi) {
              $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
              echo "<span class='Sayfalamapasif'> <a href='index.php?SKD=0&SKI=89&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
              echo "<span class='Sayfalamapasif'><a href='index.php?SKD=0&SKI=89&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
          }
        ?>
      </div>
    </div>
    <?php
     }
    }else{

    ?>
    <div class="BilgiAciklamaAlani">Kayıtlı yorum  bulunmamaktadır.</div>
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