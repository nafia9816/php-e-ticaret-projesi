<?php
if (isset($_REQUEST["MenuId"])) { //request yaptım çunku hem post la hem get le alabilmek için
    $gelenMenuId=sayiliIcerikleriFiltrele(guvenlik($_REQUEST["MenuId"]));
    $menuKosulu=" AND MenuId='" . $gelenMenuId . "' ";
    /* menu koşulu amacı:mesela karaca ya bastım sadece karaca daki ürünler gelsin
    menuıd si olmayan urunlerde olabilir yanı bu kısım dinamik olduğundan direkt prepare li sorguların içine yazmadık. gerekli sorgularda .menukosulu şeklinde değişkeni veririz. */
   $sayfalama_kosulu="&MenuId=" . $gelenMenuId;
    /* mesela karaca ya girdim 2. sayfaya geçince koşul bozuluyor tüm ürünleri gösteriyor onun önune gecmek için burayı kodladım */
  }else{
    $gelenMenuId="";
    $menuKosulu="";
    $sayfalama_kosulu="";
  }

/* arama kutusuna bir kelime yazınca o kelimeyi içeren ürünleri filtrelemesi için */
  if (isset($_REQUEST["arama"])) {
    $gelenArama=guvenlik($_REQUEST["arama"]);
    $aramaKosulu=" AND UrunAdi LIKE '%" . $gelenArama . "%' ";
    $sayfalama_kosulu .= "&arama=" . $gelenArama;//bu rada requestten gelen deger ne ise synen onu yazmam alazım. mesela arama yazmak yerine aranna yazdım aradığım urunleri gösterirken sayfalama bozluyordu. mesela mek gecen 3 ürün var 2. sayfaya geçtiğimde içinde mek olanlarıda gösteriyordu.
  }else{
    $gelenArama="";
    $aramaKosulu="";
    $sayfalama_kosulu .="";
  }
  $sayfalamaSolSagButonSayisi=2; //3. sayfa acıkken 1 ve 2. sayfa bide 4 ve 5 . sayfa yanlarında gözüksün
  $sayfaBasinaKayitSayisi=4;//bir sayfada kac kayıt gösterilsin
  $sayfalamayaBaslanacakKayitSayisi=($sayfalama * $sayfaBasinaKayitSayisi)-$sayfaBasinaKayitSayisi;
  
  $toplamKayitSorgusu=$baglan->prepare("SELECT * FROM urunler WHERE UrunTuru='kahveyanibardak' AND Durumu='1' $menuKosulu $aramaKosulu ORDER BY id DESC");//durumu=1 yanisilinmemiş ürünleri göster
  $toplamKayitSorgusu->execute();
  $toplam_kayit_sayisi=$toplamKayitSorgusu->rowCount(); //kayıt varmı
  $siparis_kayitlari=$toplamKayitSorgusu->fetch(PDO::FETCH_ASSOC);
  
  $bulunanSayfaSayisi=ceil($toplam_kayit_sayisi/$sayfaBasinaKayitSayisi); //urunler 6,5 sayfada gösterilirse toplam 7 sayfada gösterilmesi için
  //tüm ürünlerin toplam sayısını yazdırmak için yaılan sorgu
  $tumUrunSayisi_sorgu=$baglan->prepare("SELECT SUM(UrunSayisi) AS toplamUrun FROM menuler WHERE UrunTuru='kahveyanibardak'");
  $tumUrunSayisi_sorgu->execute();
  $tumUrunSayisi_sorgu=$tumUrunSayisi_sorgu->fetch(PDO::FETCH_ASSOC);
?>
<div id="TamSayfaAlani">
  <div id="TamSayfaSinirlamaAlani">
    
    <div id="TamSayfaSolSutunSinirlamaAlani">
      <div id="TamSayfaSolSutunIcMenuAlani">
        <div id="TamSayfaSolSutunIcMenuAlaniUstMenuBaslik"><a href="index.php?sk=106">KAHVE YANI BARDAKLAR</a></div>
        <div id="TamSayfaSolSutunIcMenuAltMenuBaslik">
          <img src="img/UstMenuOk.png" border="0">
          <span class="AltMenuBaslik">
            <a href="index.php?sk=106">Tüm Ürünler(<?php echo $tumUrunSayisi_sorgu["toplamUrun"]; ?>)</a>
          </span>
        </div>
        <?php
          $menuler_sorgusu=$baglan->prepare("SELECT * FROM menuler WHERE UrunTuru='kahveyanibardak' ORDER BY MenuAdi ASC");// menu adını alfabetik sıraya göre dizcek
          $menuler_sorgusu->execute();
          $menu_sayisi=$menuler_sorgusu->rowCount();
          $menu_kayitlari=$menuler_sorgusu->fetchAll(PDO::FETCH_ASSOC);

          foreach ($menu_kayitlari as $menu) {
        ?>

        <div id="MenuSecenekleriKapsayiciAlani">
          <ul id="MenuSeceneklerAlani">
            <li class="MenuSecenekleri">
              <img src="img/menuok.png" border="0"> <a href="index.php?sk=106&MenuId=<?php echo $menu["id"]; ?>"><?php echo  DonusumleriGeriDondur($menu["MenuAdi"]); ?> (<?php echo  DonusumleriGeriDondur($menu["UrunSayisi"]); ?>)</a>
            </li>
          </ul>
        </div>
        <?php
          } //for kapaması
        ?>
       
        <div id="MenuSecenekleriReklamKapsayiciAlani">
          <?php
              $banner_sorgusu=$baglan->prepare("SELECT * FROM bannerler WHERE BannerAlani='Menu Altı' ORDER BY GosterimSayisi ASC LIMIT 1");// menu adını alfabetik sıraya göre dizcek
              $banner_sorgusu->execute();
              $banner_sayisi=$banner_sorgusu->rowCount();
              $banner_kayit=$banner_sorgusu->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="img/<?php echo $banner_kayit["BannerResmi"]; ?>" border="0">
            <?php
              $banner_guncelle=$baglan->prepare("UPDATE bannerler SET GosterimSayisi=GosterimSayisi+1 WHERE id=? LIMIT 1");// menu adını alfabetik sıraya göre dizcek
              $banner_guncelle->execute([$banner_kayit["id"]]);
            ?>
        </div>
      </div> <!-- TamSayfaSolSutunIcMenuAlani sonu -->

    </div><!--sol sütün sınırlama alanı kapaması -->
    <div id="TamSayfaSagSutunSinirlamaAlani">
      <div id="TamSayfaSagSutunAramaAlani">
        <form action="
                    <?php
                       if($menuKosulu!=""){ ?>index.php?sk=106&MenuId=<?php echo $gelenMenuId; ?>
                    <?php   //arma yapıyosun ikinci sayfaya geçince bozuluyo
                    }else{
                    ?>
                    index.php?sk=106
                    <?php
                     }
                    ?>
                    " method="post">
                    <!--
                    gunluk ayakkabıda a harfi içeren leri arayınca tum urunler içinden arama yapmasında sadece gunluk ayakkabı menusu içindeki ürünlerin içinden bir arama yapsun diye--> 
              <div class="AramaButonuKapsamaAlani"> <input type="submit" value="" class="AramaButonu"></div>
             <div class="AramaInputKapsamaAlani"><input type="text" name="arama" class="AramaInput"></div>         
        </form>
      </div> <!-- arama alanı bitişi -->
     <div id="TamSayfaSagSutunUrunlerAlani">
        <div id="TamSayfaSagSutunUrunlerDengelemeAlani">
            <?php
              $urun_sorgu=$baglan->prepare("SELECT * FROM urunler WHERE UrunTuru='kahveyanibardak' AND Durumu='1' $menuKosulu $aramaKosulu ORDER BY id DESC LIMIT $sayfalamayaBaslanacakKayitSayisi,$sayfaBasinaKayitSayisi");//silinen ürünün durumu 0 olcak. o yuzden 1 ola silinmemiş olnları listeliycez
            $urun_sorgu->execute();
            $urun_sayi=$urun_sorgu->rowCount();
            $urun_kayitlari=$urun_sorgu->fetchAll(PDO::FETCH_ASSOC);

            foreach ($urun_kayitlari as $kayit) {
              $urununFiyati=DonusumleriGeriDondur($kayit["UrunFiyati"]);
              $urununBirimi=DonusumleriGeriDondur($kayit["ParaBirimi"]);
              if ($urununBirimi=="USD") {
                          $urunFiyatiTLCinsinden=$urununFiyati*$dolarKuru;
              }elseif ($urununBirimi=="EUR") {
                          $urunFiyatiTLCinsinden=$urununFiyati*$EuroKuru;
              }else{
                          $urunFiyatiTLCinsinden=$urununFiyati;
              }

              $urununToplamYorumSayisi=DonusumleriGeriDondur($kayit["YorumSayisi"]);
              $urununToplamYorumPuani=DonusumleriGeriDondur($kayit["ToplamYorumPuani"]);
              if ($urununToplamYorumSayisi>0) {
                          $puanHesapla=number_format($urununToplamYorumPuani/$urununToplamYorumSayisi,2,".","");
              }else{
                          $puanHesapla=0; // 0 puan olunca 0 a bölme hatası vermesin diye
              }

              if ($puanHesapla==0) {
                          $puanResmi="yorumyildiz0.jpg";
              }elseif(($puanHesapla>0) and ($puanHesapla<=1)){
                          $puanResmi="yorumyildiz1.jpg";
              }elseif(($puanHesapla>1) and ($puanHesapla<=2)){
                          $puanResmi="yorumyildiz2.jpg";
              }elseif(($puanHesapla>2) and ($puanHesapla<=3)){
                          $puanResmi="yorumyildiz3.jpg";
              }elseif(($puanHesapla>3) and ($puanHesapla<=4)){
                          $puanResmi="yorumyildiz4.jpg";
              }elseif(($puanHesapla>4)){
                          $puanResmi="yorumyildiz5.jpg";
              }

       ?>
      <div class="TamSayfaSagSutunUrunlerSinirlamaAlani">
          <div class="TamSayfaSagSutunUrunResmiDisiAlani">
            <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($kayit["id"]); ?>">
                <img src="img/urunler/kahveyanibardak/<?php echo DonusumleriGeriDondur($kayit["UrunResmiBir"]); ?>" border="0" >
            </a>
          </div>

          <div class="TamSayfaSagSutunUrunUstBaslik">
              <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($kayit["id"]); ?>" >Kahve Yanı Bardaklar</a>
          </div>
          <div class="TamSayfaSagSutunUrunUstBaslik">
              <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($kayit["id"]); ?>"><?php echo DonusumleriGeriDondur($kayit["UrunAdi"]); ?></a>
          </div>

          <div class="TamSayfaSagSutunUrunPuanResmiAlani">
              <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($kayit["id"]); ?>"><img src="img/<?php echo $puanResmi; ?>"></a>
          </div>

          <div class="TamSayfaSagSutunUrunFiyatiAlani">
              <div class="TamSayfaSagSutunUrunFiyati"><?php echo fiyatBicimlendir($urunFiyatiTLCinsinden); ?> TL</div>
          </div>




      </div> <!-- <div class="TamSayfaSagSutunUrunlerSinirlamaAlani"> bitişi -->
      <?php } // for kapaması alttaki 2 div den sonra kapatırsam sadece bir ürün gösterir ?>
      </div><!-- dengeleme bitşi-->
   </div> <!-- sağ sutun uruner alanı bitişi-->
  <?php
      if ($bulunanSayfaSayisi>1) {
  ?>
  <div class="SayfalamaAlaniKapsayicisi">
    <div class="sayfalamaAlaniIciMetinAlaniKapsayicisi">
        Toplam <?php echo $bulunanSayfaSayisi; ?> sayfada, <?php echo $toplam_kayit_sayisi; ?> adet kayıt bulunmaktadır.
    </div>
    <div class="sayfalamaAlaniIciNumaraAlaniKapsayicisi">
      <?php 
        if ($sayfalama>1) {
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=106' . $sayfalama_kosulu. '&SYF=1'> << </a> </span>";
          $sayfalamaIcınSayfalamaDegeriniBirGeriAl=$sayfalama-1;
          echo "<span class='Sayfalamapasif'><a href='index.php?sk=106" . $sayfalama_kosulu . "&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirGeriAl . "'> < </a> </span>";
        }
        for ($i=$sayfalama-$sayfalamaSolSagButonSayisi; $i<=$sayfalama+$sayfalamaSolSagButonSayisi;$i++) { 
          if (($i>0) and ($i<=$bulunanSayfaSayisi)) {
            if ($sayfalama==$i) {
                echo "<span class='Sayfalamaaktif'>" .$i. "</span>";
            }else{
                echo "<span class='Sayfalamapasif'><a href='index.php?sk=106" .$sayfalama_kosulu."&SYF=" . $i . "'> ". $i. "</a></span>";
            }
          }
        }
        if ($sayfalama!=$bulunanSayfaSayisi) {
            $sayfalamaIcınSayfalamaDegeriniBirIleriAl=$sayfalama+1;
            echo "<span class='Sayfalamapasif'> <a href='index.php?sk=106".$sayfalama_kosulu ."&SYF=" . $sayfalamaIcınSayfalamaDegeriniBirIleriAl . "'> > </a> </span>";
            echo "<span class='Sayfalamapasif'><a href='index.php?sk=106".$sayfalama_kosulu. "&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
        }
    ?>
    </div>
  </div>
  <?php } ?>







    </div> <!-- tam sayfa sutunu sınırlama bitişi-->
 </div>
</div>