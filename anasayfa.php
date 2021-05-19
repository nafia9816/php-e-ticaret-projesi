<div class="SlaytAlaniKapsayici">
  <ul class="SlaytAlani">
  <?php
      $banner_sorgusu=$baglan->prepare("SELECT * FROM bannerler WHERE BannerAlani='Ana Sayfa'");// menu adını alfabetik sıraya göre dizcek
      $banner_sorgusu->execute();
      $banner_sayisi=$banner_sorgusu->rowCount();
      $banner_kayit=$banner_sorgusu->fetchAll(PDO::FETCH_ASSOC);
      foreach ($banner_kayit as $satir) {
  ?>
  <li class="SlaytResmi">
    <img src="img/<?php echo $satir["BannerResmi"]; ?>" border="0">
  <?php
    $banner_guncelle=$baglan->prepare("UPDATE bannerler SET GosterimSayisi=GosterimSayisi+1 WHERE id=? LIMIT 1");
    $banner_guncelle->execute([$banner_kayit["id"]]);
    }
  ?>
  </li>  
  </ul>
</div><!-- slayt alanı bitişi-->

<div id="AnasayfaYeniUrunlerAlani">
  <div id="AnasayfaYeniUrunlerBaslikAlani">EN YENİ ÜRÜNLER</div>
  <div id="AnasayfaYeniUrunlerDengelemeAlani">
    <?php
      $enYeni_urun_sorgu=$baglan->prepare("SELECT * FROM urunler WHERE Durumu='1' ORDER BY id DESC LIMIT 5");//durum 1 silinmemiş olan ürünlerden limit 5 yani 5 tane göster
      $enYeni_urun_sorgu->execute();
      $enYeniurun_sayi=$enYeni_urun_sorgu->rowCount();
      $enYeniurun_kayitlari=$enYeni_urun_sorgu->fetchAll(PDO::FETCH_ASSOC);

      $enYenidongu_sayisi=1;
      foreach ($enYeniurun_kayitlari as $EnYenikayit) {
              $enYeniurununTuru=$EnYenikayit["UrunTuru"];
              $enYeniurununFiyati=DonusumleriGeriDondur($EnYenikayit["UrunFiyati"]);
              $enYeniurununBirimi=DonusumleriGeriDondur($EnYenikayit["ParaBirimi"]);

              if ($enYeniurununBirimi=="USD") {
                  $enYeniurunFiyatiTLCinsinden=$enYeniurununFiyati*$dolarKuru;
              }elseif ($enYeniurununBirimi=="EUR") {
                    $enYeniurunFiyatiTLCinsinden=$enYeniurununFiyati*$EuroKuru;
              }else{
                  $enYeniurunFiyatiTLCinsinden=$enYeniurununFiyati;
              }

              if ($enYeniurununTuru=="fincan") {
                  $enYeniurununResimKlasoru="fincan";
              }elseif($enYeniurununTuru=="kupa") {
                  $enYeniurununResimKlasoru="kupa";
              }elseif($enYeniurununTuru=="kahveyanibardak") {
                  $enYeniurununResimKlasoru="kahveyanibardak";
              }elseif($enYeniurununTuru=="sunumluk") {
                  $enYeniurununResimKlasoru="sunumluk";
              }
              $enYeniurununToplamYorumSayisi=DonusumleriGeriDondur($EnYenikayit["YorumSayisi"]);
              $enYeniurununToplamYorumPuani=DonusumleriGeriDondur($EnYenikayit["ToplamYorumPuani"]);
                        
              if ($enYeniurununToplamYorumSayisi>0) {
                  $enYenipuanHesapla=number_format($enYeniurununToplamYorumPuani/$enYeniurununToplamYorumSayisi,2,".","");
              }else{
                  $enYenipuanHesapla=0; // 0 puan olunca 0 a bölme hatası vermesin diye
              }

              if ($enYenipuanHesapla==0) {
                          $enYenipuanResmi="yorumyildiz0.jpg";
                        }elseif(($enYenipuanHesapla>0) and ($enYenipuanHesapla<=1)){
                             $enYenipuanResmi="yorumyildiz1.jpg";
                        }
                        elseif(($enYenipuanHesapla>1) and ($enYenipuanHesapla<=2)){
                             $enYenipuanResmi="yorumyildiz2.jpg";
                        }
                        elseif(($enYenipuanHesapla>2) and ($enYenipuanHesapla<=3)){
                             $enYenipuanResmi="yorumyildiz3.jpg";
                        }
                        elseif(($enYenipuanHesapla>3) and ($enYenipuanHesapla<=4)){
                             $enYenipuanResmi="yorumyildiz4.jpg";
                        }elseif(($enYenipuanHesapla>4)){
                             $enYenipuanResmi="yorumyildiz5.jpg";
                        }
    ?>
    <div class="AnasayfaYeniUrunlerSinirlamaAlani">
      <div class="AnasayfaYeniUrunResmiCerceve">
         <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnYenikayit["id"]); ?>">
              <img src="img/urunler/<?php echo DonusumleriGeriDondur($enYeniurununResimKlasoru) ?>/<?php echo DonusumleriGeriDondur($EnYenikayit["UrunResmiBir"]); ?>" border="0"></a>
      </div>
      <div class="AnasayfaYeniUrunTuru">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnYenikayit["id"]); ?>"><?php echo DonusumleriGeriDondur($enYeniurununTuru); ?></a>
      </div>

      <div class="AnasayfaYeniUrunTuru">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnYenikayit["id"]); ?>"><?php echo DonusumleriGeriDondur($EnYenikayit["UrunAdi"]); ?></a>
      </div>

      <div id="AnasayfaYeniUrunPuani">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnYenikayit["id"]); ?>"><img src="img/<?php echo $enYenipuanResmi; ?>"></a>
      </div>

      <div class="AnasayfaYeniUrunTuru">
        <?php echo fiyatBicimlendir($enYeniurunFiyatiTLCinsinden); ?>TL
      </div>
    </div><!-- <div class="AnasayfaYeniUrunlerSinirlamaAlani">  bitişi-->
     <?php
      } //for döngüsü bitişi
      ?>
  </div>

</div><!-- <div id="AnasayfaYeniUrunlerAlani"> sonu -->

<div id="AnasayfaYeniUrunlerAlani">
  <div id="AnasayfaYeniUrunlerBaslikAlani">EN POPÜLER ÜRÜNLER</div>
  <div id="AnasayfaYeniUrunlerDengelemeAlani">
    <?php
//en çok görüntülemene 5 ürünü göster
      $EnPopuler_urun_sorgu=$baglan->prepare("SELECT * FROM urunler WHERE Durumu='1' ORDER BY GoruntulenmeSayisi  DESC LIMIT 5");
      $EnPopuler_urun_sorgu->execute();
      $EnPopulerurun_sayi=$EnPopuler_urun_sorgu->rowCount();
      $EnPopulerurun_kayitlari=$EnPopuler_urun_sorgu->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($EnPopulerurun_kayitlari as $EnPopulerkayit) {
            $EnPopulerurununTuru=$EnPopulerkayit["UrunTuru"];
            $EnPopulerurununFiyati=DonusumleriGeriDondur($EnPopulerkayit["UrunFiyati"]);
            $EnPopulerurununBirimi=DonusumleriGeriDondur($EnPopulerkayit["ParaBirimi"]);

            if ($EnPopulerurununBirimi=="USD") {
                $EnPopulerurunFiyatiTLCinsinden=$EnPopulerurununFiyati*$dolarKuru;
            }elseif ($EnPopulerurununBirimi=="EUR") {
                $EnPopulerurunFiyatiTLCinsinden=$EnPopulerurununFiyati*$EuroKuru;
            }else{
                $EnPopulerurunFiyatiTLCinsinden=$EnPopulerurununFiyati;
            }

            if ($EnPopulerurununTuru=="fincan") {
                  $EnPopulerurununResimKlasoru="fincan";
            }elseif($EnPopulerurununTuru=="kupa") {
                  $EnPopulerurununResimKlasoru="kupa";
            }elseif($EnPopulerurununTuru=="kahveyanibardak") {
                  $EnPopulerurununResimKlasoru="kahveyanibardak";
            }elseif($EnPopulerurununTuru=="sunumluk") {
                  $EnPopulerurununResimKlasoru="sunumluk";
            }

            $EnPopulerurununToplamYorumSayisi=DonusumleriGeriDondur($EnPopulerkayit["YorumSayisi"]);
            $EnPopulerurununToplamYorumPuani=DonusumleriGeriDondur($EnPopulerkayit["ToplamYorumPuani"]);
                        
            if ($EnPopulerurununToplamYorumSayisi>0) {
                $EnPopulerpuanHesapla=number_format($EnPopulerurununToplamYorumPuani/$EnPopulerurununToplamYorumSayisi,2,".","");
            }else{
              $EnPopulerpuanHesapla=0; // 0 puan olunca 0 a bölme hatası vermesin diye
            }
                        
            if ($EnPopulerpuanHesapla==0) {
              $EnPopulerpuanResmi="yorumyildiz0.jpg";
            }elseif(($EnPopulerpuanHesapla>0) and ($EnPopulerpuanHesapla<=1)){
              $EnPopulerpuanResmi="yorumyildiz1.jpg";
            }
            elseif(($EnPopulerpuanHesapla>1) and ($EnPopulerpuanHesapla<=2)){
                $EnPopulerpuanResmi="yorumyildiz2.jpg";
            }
            elseif(($EnPopulerpuanHesapla>2) and ($EnPopulerpuanHesapla<=3)){
              $EnPopulerpuanResmi="yorumyildiz3.jpg";
            }
            elseif(($EnPopulerpuanHesapla>3) and ($EnPopulerpuanHesapla<=4)){
              $EnPopulerpuanResmi="yorumyildiz4.jpg";
            }elseif(($EnPopulerpuanHesapla>4)){
                $EnPopulerpuanResmi="yorumyildiz5.jpg";
            }

        ?>
    <div class="AnasayfaYeniUrunlerSinirlamaAlani">
      <div class="AnasayfaYeniUrunResmiCerceve">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnPopulerkayit["id"]); ?>">
              <img src="img/urunler/<?php echo DonusumleriGeriDondur($EnPopulerurununResimKlasoru) ?>/<?php echo DonusumleriGeriDondur($EnPopulerkayit["UrunResmiBir"]); ?>" border="0"></a>
      </div>
      <div class="AnasayfaYeniUrunTuru">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnPopulerkayit["id"]); ?>"><?php echo DonusumleriGeriDondur($EnPopulerurununTuru); ?></a>
      </div>

      <div class="AnasayfaYeniUrunTuru">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnPopulerkayit["id"]); ?>"><?php echo DonusumleriGeriDondur($EnPopulerkayit["UrunAdi"]); ?></a>
      </div>

      <div id="AnasayfaYeniUrunPuani">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnPopulerkayit["id"]); ?>"><img src="img/<?php echo $EnPopulerpuanResmi; ?>"></a>
      </div>

      <div class="AnasayfaYeniUrunTuru">
        <?php echo fiyatBicimlendir($EnPopulerurunFiyatiTLCinsinden); ?> TL
      </div>
  
    </div>
     <?php
      }
      ?>
  </div>

</div>

<div id="AnasayfaYeniUrunlerAlani">
  <div id="AnasayfaYeniUrunlerBaslikAlani">EN ÇOK SATAN ÜRÜNLER</div>
  <div id="AnasayfaYeniUrunlerDengelemeAlani">
   <?php

      $EnCokSatan_urun_sorgu=$baglan->prepare("SELECT * FROM urunler WHERE Durumu='1' ORDER BY ToplamSatisSayisi DESC LIMIT 5");

      $EnCokSatan_urun_sorgu->execute();
      $EnCokSatanurun_sayi=$EnCokSatan_urun_sorgu->rowCount();
      $EnCokSatanurun_kayitlari=$EnCokSatan_urun_sorgu->fetchAll(PDO::FETCH_ASSOC);

      foreach ($EnCokSatanurun_kayitlari as $EnCokSatankayit) {
          $EnCokSatanurununTuru=$EnCokSatankayit["UrunTuru"];
          $EnCokSatanurununFiyati=DonusumleriGeriDondur($EnCokSatankayit["UrunFiyati"]);
          $EnCokSatanurununBirimi=DonusumleriGeriDondur($EnCokSatankayit["ParaBirimi"]);
          
          if ($EnCokSatanurununBirimi=="USD") {
              $EnCokSatanurunFiyatiTLCinsinden=$EnCokSatanurununFiyati*$dolarKuru;
          }elseif ($EnCokSatanurununBirimi=="EUR") {
              $EnCokSatanurunFiyatiTLCinsinden=$EnCokSatanurununFiyati*$EuroKuru;
          }else{
              $EnCokSatanurunFiyatiTLCinsinden=$EnCokSatanurununFiyati;
          }

          if ($EnCokSatanurununTuru=="fincan") {
                  $EnCokSatanurununResimKlasoru="fincan";
          }elseif($EnCokSatanurununTuru=="kupa") {
                  $EnCokSatanurununResimKlasoru="kupa";
          }elseif($EnCokSatanurununTuru=="kahveyanibardak") {
                  $EnCokSatanurununResimKlasoru="kahveyanibardak";
          }elseif($EnCokSatanurununTuru=="sunumluk") {
                  $EnCokSatanurununResimKlasoru="sunumluk";
          }

          $EnCokSatanurununToplamYorumSayisi=DonusumleriGeriDondur($EnCokSatankayit["YorumSayisi"]);
          $EnCokSatanurununToplamYorumPuani=DonusumleriGeriDondur($EnCokSatankayit["ToplamYorumPuani"]);
                        
          if ($EnCokSatanurununToplamYorumSayisi>0) {
              $EnCokSatanpuanHesapla=number_format($EnCokSatanurununToplamYorumPuani/$EnCokSatanurununToplamYorumSayisi,2,".","");
          }else{
            $EnCokSatanpuanHesapla=0; // 0 puan olunca 0 a bölme hatası vermesin diye
          }
          if ($EnCokSatanpuanHesapla==0) {
            $EnCokSatanpuanResmi="yorumyildiz0.jpg";
          }elseif(($EnCokSatanpuanHesapla>0) and ($EnCokSatanpuanHesapla<=1)){
            $EnCokSatanpuanResmi="yorumyildiz1.jpg";
          }
          elseif(($EnCokSatanpuanHesapla>1) and ($EnCokSatanpuanHesapla<=2)){
            $EnCokSatanpuanResmi="yorumyildiz2.jpg";
          }
          elseif(($EnCokSatanpuanHesapla>2) and ($EnCokSatanpuanHesapla<=3)){
            $EnCokSatanpuanResmi="yorumyildiz3.jpg";
          }
          elseif(($EnCokSatanpuanHesapla>3) and ($EnCokSatanpuanHesapla<=4)){
            $EnCokSatanpuanResmi="yorumyildiz4.jpg";
          }elseif(($EnCokSatanpuanHesapla>4)){
            $EnCokSatanpuanResmi="yorumyildiz5.jpg";
          }
          

    ?>
    <div class="AnasayfaYeniUrunlerSinirlamaAlani">
      <div class="AnasayfaYeniUrunResmiCerceve">
       <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnCokSatankayit["id"]); ?>">
         <img src="img/urunler/<?php echo DonusumleriGeriDondur($EnCokSatanurununResimKlasoru) ?>/<?php echo DonusumleriGeriDondur($EnCokSatankayit["UrunResmiBir"]); ?>" border="0"></a>
      </div>
      <div class="AnasayfaYeniUrunTuru">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnCokSatankayit["id"]); ?>"><?php echo DonusumleriGeriDondur($EnCokSatanurununTuru); ?></a>
      </div>

      <div class="AnasayfaYeniUrunTuru">
        <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnCokSatankayit["id"]); ?>">><?php echo DonusumleriGeriDondur($EnCokSatankayit["UrunAdi"]); ?></a>
      </div>

      <div id="AnasayfaYeniUrunPuani">
       <a href="index.php?sk=83&ID=<?php echo DonusumleriGeriDondur($EnCokSatankayit["id"]); ?>"><img src="img/<?php echo $EnCokSatanpuanResmi; ?>"></a>
      </div>

      <div class="AnasayfaYeniUrunTuru">
        <?php echo fiyatBicimlendir($EnCokSatanurunFiyatiTLCinsinden); ?> TL
      </div>
  
    </div>
     <?php
      }
      ?>
  </div>

</div>
<!-- 
  <tr><td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="258">
                  <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center">
                        <img src="img/hizli.jfif" style="border-radius:35px; border: 4px solid #FF9900;">
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><b>Bugün Teslimat</b></td>
                    </tr>
                    <tr>
                      <td align="center">Saat 14.00 a kadar verdiğiniz siparişler ay gün kapınızda</td>
                    </tr>
                  </table>
                </td>

                <td width="11">&nbsp;</td>
                <td width="258">
                  <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center">
                        <img src="img/guvenli.jfif" style="border-radius:35px; border: 4px solid #FF9900;">
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><b>Tek Rıkla Güvenli Alışveriş</b></td>
                    </tr>
                    <tr>
                      <td align="center">Ödeme ve adres bilgilerinizi kaydedin güvenli alışverişin keyfini çıkarın.</td>
                    </tr>
                  </table>
                </td>
                <td width="11">&nbsp;</td>
                <td width="258">
                  <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center">
                        <img src="img/mobilerisim.png" style="border-radius:35px; border: 4px solid #FF9900;">
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><b>Mobil Erişim</b></td>
                    </tr>
                    <tr>
                      <td align="center">Dilediğiniz her cihazdan sitemize erişebilmeniz mümkün.</td>
                    </tr>
                  </table>
                </td>
                <td width="11">&nbsp;</td>
                <td width="258">
                  <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center">
                        <img src="img/kolayiade.png" style="border-radius:35px; border: 4px solid #FF9900;">
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><b>Kolay İade</b></td>
                    </tr>
                    <tr>
                      <td align="center">Aldığınız ürünü 15 gün içinde iade edebilirsiniz.</td>
                    </tr>
                  </table>-->