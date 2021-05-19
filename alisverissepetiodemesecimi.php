<?php

 if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
    if (isset($_POST["adressecimi"])) {
     $Gelenadressecimi=guvenlik($_POST["adressecimi"]);
   }else{
     $Gelenadressecimi="";
   }

    if (isset($_POST["kargosecimi"])) {
     $Gelenkargosecimi=guvenlik($_POST["kargosecimi"]);
   }else{
     $Gelenkargosecimi="";
   }
   //bir önceki sayfadan geeln adres ve kargo seçiminin doluluklarını kontrol ediyoruz.
   if (($Gelenadressecimi!="") and ($Gelenkargosecimi!="")) {
        //gelen değerleri sepette güncelledim.
        $sepetGuncelle_sorgusu=$baglan->prepare("UPDATE sepet SET KargoId=?, AdresId=? WHERE UyeId=?");
        $sepetGuncelle_sorgusu->execute([$Gelenkargosecimi,$Gelenadressecimi,$KullaniciId]);
        $sepetGuncelle_sorgusu_sayi=$sepetGuncelle_sorgusu->rowCount();
   
  //STOK OLAYI!
    $StokIcinsepetteki_urunler_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=?");
    $StokIcinsepetteki_urunler_sorgusu->execute([$KullaniciId]);

    $stoktaki_urun_sayisi=$StokIcinsepetteki_urunler_sorgusu->rowCount();
    $stoktaki_urun_kayitlari=$StokIcinsepetteki_urunler_sorgusu->fetchAll(PDO::FETCH_ASSOC);
    if ($stoktaki_urun_sayisi>0) {
      foreach ($stoktaki_urun_kayitlari as $satir) {
      $StokIcinSepetId=$satir["id"];
      $StokIcinsepettekiVaryantId=$satir["VaryantId"];
      $StokIcinsepettekiUrunAdedi=$satir["UrunAdedi"];

      $StokIcinUrunVaryantBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");
      $StokIcinUrunVaryantBilgileri_sorgusu->execute([$StokIcinsepettekiVaryantId]);
      $StokIcinsepetteki_urun_varyant_kaydi=$StokIcinUrunVaryantBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);
      $StokIcinurununStokAdedi=$StokIcinsepetteki_urun_varyant_kaydi["StokAdedi"];

      if ($StokIcinurununStokAdedi==0) {
          $sepetSilmeSorgusu=$baglan->prepare("DELETE FROM sepet WHERE id=? AND UyeId=? LIMIT 1");
          $sepetSilmeSorgusu->execute([$StokIcinSepetId,$KullaniciId]);

      }elseif ($StokIcinsepettekiUrunAdedi>$StokIcinurununStokAdedi){
           $sepetGuncelleSorgusu=$baglan->prepare("UPDATE sepet SET UrunAdedi=?  WHERE id=? AND UyeId=? LIMIT 1");
             $sepetGuncelleSorgusu->execute([$StokIcinurununStokAdedi,$StokIcinSepetId,$KullaniciId]);

      }
    }//for kapaması
    }//if kapaması
    $sepetteki_urunler_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC");
    $sepetteki_urunler_sorgusu->execute([$KullaniciId]);
    $sepetteki_urun_sayisi=$sepetteki_urunler_sorgusu->rowCount(); //kayıt varmı
    $sepetteki_urun_kayitlari=$sepetteki_urunler_sorgusu->fetchAll(PDO::FETCH_ASSOC);
    if ($sepetteki_urun_sayisi>0) {
        $sepettekiTopUrun=0;
        $sepettekiTopFiyat=0;
        $sepettekiTopKargoFiyatHesapla=0;
        foreach ($sepetteki_urun_kayitlari as $sepet) {
        //burda bize gerekli olan bilgileri değişkenlere ilk önce atıyoruz bunun içinde once veritabanından bu bilgileri alabilmek için sorgularımızı yazıyoruz
          $sepetId=$sepet["id"];
          $sepettekiUrunId=$sepet["UrunId"];
          $sepettekiVaryantId=$sepet["VaryantId"];
          $sepettekiUrunAdedi=$sepet["UrunAdedi"];
          
          $UrunBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
          $UrunBilgileri_sorgusu->execute([$sepettekiUrunId]);
          $sepetteki_urun_kaydi=$UrunBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);

          $urununFiyati=$sepetteki_urun_kaydi["UrunFiyati"];
          $urununParaBirimi=$sepetteki_urun_kaydi["ParaBirimi"];
          $kargoUcreti=$sepetteki_urun_kaydi["KargoUcreti"];
          
          if ($urununParaBirimi=="USD") {
                        //fiyati biçimlendir fonksiyonunda sayıyı , lü yazdırdım hesaplama yaparken , le olan sayılar toplanmadığı için bunu yazdım bunu(tlfiyatı) fiyatları toplamada kullanıcam
                        $tlFiyat=$urununFiyati*$dolarKuru;
                        $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);
          }elseif ($urununParaBirimi=="EUR") {
                                $tlFiyat=($urununFiyati*$dolarKuru);
                                $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);
          }else{
                                $tlFiyat=$urununFiyati;
                                $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);
          }
          $UrunTopFiyat=($tlFiyat* $sepettekiUrunAdedi);
          $UrunTopFiyatBic=fiyatBicimlendir($UrunTopFiyat);

          $sepettekiTopUrun +=$sepettekiUrunAdedi;
          $sepettekiTopFiyat +=($tlFiyat * $sepettekiUrunAdedi);

          $sepettekiTopKargoFiyatHesapla=$kargoUcreti;
          $sepettekiTopKargoFiyatBic =fiyatBicimlendir($sepettekiTopKargoFiyatHesapla);
          }//foracın kapaması
          if ($sepettekiTopFiyat>=$ucretsizKargo) {
                            $sepettekiTopKargoFiyatHesapla=0;
                            $sepettekiTopKargoFiyatBic =fiyatBicimlendir($sepettekiTopKargoFiyatHesapla);
                            $odenecekTopFiyatHesaplaBic=$sepettekiTopFiyat;
          }else{
                            $odenecekTopFiyatHesapla=($sepettekiTopFiyat + $sepettekiTopKargoFiyatHesapla);
                            $odenecekTopFiyatHesaplaBic=$odenecekTopFiyatHesapla;
          }                       
                        $ikiTaksitAylikTutar=number_format(($sepettekiTopFiyat/2), "2", ",", ".");
                        $ucTaksitAylikTutar=number_format(($sepettekiTopFiyat/3),"2",",",".");
                        $dortTaksitAylikTutar=number_format(($sepettekiTopFiyat/4),"2",",",".");
                        $besTaksitAylikTutar=number_format(($sepettekiTopFiyat/5),"2",",",".");
                        $altiTaksitAylikTutar=number_format(($sepettekiTopFiyat/6),"2",",",".");
                        $yediTaksitAylikTutar=number_format(($sepettekiTopFiyat/7),"2",",",".");
                        $sekizTaksitAylikTutar=number_format(($sepettekiTopFiyat/8),"2",",",".");
                        $dokuzTaksitAylikTutar=number_format(($sepettekiTopFiyat/9),"2",",",".");
          }//if kapaması

?>
<div id="TamSayfaCerceveAlani">
  <div id="TamSayfaCerceveSinirlamaAlani">
    <form action="index.php?sk=99" method="POST" id="SepetOdemeFormu">
      <div id="TamSayfadaSepetSolAlan">
        <div id="TamSayfadaAltiCiziliBaslikAlani">
          <div id="BaslikMetni">SEPETİM</div>
          <div id="AltBaslikMetni">Ödeme işlemlerinizi istediğiniz yöntemle aşağıdan kolaylıkla gerçekleştirebilirsiniz.</div>
        </div>

        <div class="SepetOdemeSecenekleri">
          <div class="SepetOdemeSecenekleriBaslik">Ödeme Türü Seçimi </div>
            <div class="SepetOdemeSecenekleriAlani">
                <div class="SepetOdemeDengelemeAlani">
                   <!-- kredi kartı seçimi kısmı-->
                 <div class="SepetOdemeSecenekleriSinirlamaAlani">
                   <div class="SepetOdemeLogosuAlani"><img src="img/kredikarti.png" border="0"></div>
                   <div class="SepetOdemeSecimiTabloAlani">
                     <table class="SepetOdemeSecimiTablosu" width="100%" border="0" cellpadding="0" cellspacing="0">
                       <tbody>
                         <tr>
                           <td align="left" valign="top" class="SepetOdemeSecimiTablosuRadioSutunu">
                              <div class="SepetOdemeSecimiTablosuRadioAlani">
                                <label class="SepetOdemeSecimiTablosuRadioSecenekKapsamaAlani">
                                        <input type="radio" name="odemeTuruSecimi" value="Kredi Kartı" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetOdemeRadioInputu">
                                        <span class="SepetOdemeRadioBicimlendirma"></span>
                                </label>
                              </div>
                           </td>
                           <td class="SepetOdemeTablosuBaslikSutunu">Kredi Kartı ile Ödeme</td>
                         </tr>
                       </tbody>
                     </table>
                   </div><!-- tablo alanı bitişi-->
                  </div><!-- <div class="SepetOdemeSecenekleriSinirlamaAlani">-->

                 <!-- banka havalesi seçimi kısmı-->
                 <div class="SepetOdemeSecenekleriSinirlamaAlani">
                   <div class="SepetOdemeLogosuAlani"> <img src="img/bank.png" border="0"></div>
                   <div class="SepetOdemeSecimiTabloAlani">
                     <table class="SepetOdemeSecimiTablosu" width="100%" border="0" cellpadding="0" cellspacing="0">
                       <tbody>
                         <tr>
                           <td align="left" valign="top" class="SepetOdemeSecimiTablosuRadioSutunu">
                              <div class="SepetOdemeSecimiTablosuRadioAlani">
                                <label class="SepetOdemeSecimiTablosuRadioSecenekKapsamaAlani">
                                        <input type="radio" name="odemeTuruSecimi" value="Banka Havalesi" checked="checked" onClick="$.BankaHavalesiSecildi();" class="SepetOdemeRadioInputu">
                                        <span class="SepetOdemeRadioBicimlendirma"></span>

                                        
                                </label>
                              </div>
                           </td>
                           <td class="SepetOdemeTablosuBaslikSutunu">Banka Havalesi ile Ödeme</td>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div><!-- banka alanı seçimi bitişi-->
               </div><!-- tüm odeme secenekleri alanının kap-->
             </div><!-- dendeleme alani -->
            </div><!-- sepet odeme xsecenekleri alanı kap-->

           <!-- KREDİ KARTI SEÇİLİNCE AÇILACAK ALANIN BAŞI--> 
            <div id="kkAlanlari" class="SepetOdemeSecimiKrediAlani" style="display: none;">
              <div class="SepetOdemeSecimiKrediBaslikAlani">Kredi Kartı İle Ödeme </div>
              <div class="SepetOdemeSecimiKrediAciklama">
                Lütfen Ödeme işleminizde kullanmak istediğiniz kredi kartı markasını seçiniz. Kredi kartınızın markası aşağıdaki listede yer almıyorsa "diğer" ödeme seçeneğini kullanabilirsiniz. ATM(Bankamatik) kartı ile ödeme yapmak istiyorsanız "ATM Kart" seçeneğini kullanabilirsiniz.
              </div>

              <div class="SepetOdemeSecimiKrediMarkaAlani">
                <div class="SepetOdemeSecimiKrediMarkaDengelemeAlani">
                   <?php
                   $krediKarti_sorgu=$baglan->prepare("SELECT * FROM kredikartlari");
                   $krediKarti_sorgu->execute();
                   $krediKarti_sayi=$krediKarti_sorgu->rowCount();
                   $krediKarti_kayitlari=$krediKarti_sorgu->fetchAll(PDO::FETCH_ASSOC);

                   foreach ($krediKarti_kayitlari as $kayit) {
                ?>
                <div class="SepetOdemeSecimiKrediMarkaSinirlamaAlani">
                  <div class="SepetOdemeSecimiKrediMarkaLogoAlani">
                    <img src="img/<?php echo DonusumleriGeriDondur($kayit["KrediKartiResmi"]); ?>" border="0">
                  </div>
                  <div class="SepetOdemeKrediMarkaSecimiTabloAlani">
                     <table class="SepetOdemeKrediMarkaSecimiTablosu" width="100%" border="0" cellpadding="0" cellspacing="0">
                       <tbody>
                         <tr>
                           <td align="left" valign="top" class="SepetOdemeKrediMarkaSecimiTablosuRadioSutunu">
                              <div class="SepetOdemeKrediMarkaSecimiTablosuRadioAlani">
                                <label class="SepetOdemeKrediMarkaSecimiTablosuRadioSecenekKapsamaAlani">
                                        <input type="radio" name="KrediKartiSecimi" value="<?php echo $kayit["Id"]; ?>" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediMarkaOdemeRadioInputu">
                                        <span class="SepetOdemeKrediMarkaRadioBicimlendirma"></span>
                                </label>
                              </div> 
                           </td>
                           <td><div class="KrediKatiMetni"><?php echo DonusumleriGeriDondur($kayit["KrediKartiAdi"]); ?></div></td>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                  </div><!-- sınırlama alanı bitişi-->
                  <?php } ?>
                </div>         
              </div><!-- kredi kart resimleri alanı bitişi--> 
            <!-- taksit seçimleri buraya-->
              <div class="SepetOdemeSecimiKrediAciklama">Lütfen ödeme işleminde uygulanmasını istediğiniz taksit sayısını seçiniz.Kredi Kartınızın markası yukarıdaki listede yer almıyorsa ödeme işleminde herhangibir taksitlendirme yapılmaz.
              </div>
              <div class="SepetOdemeKrediTaksitAlani"><div class="SepetOdemeKrediTaksitBaslikAlani">Taksit Seçimi</div>

              <div class="SepetOdemeKrediTaksitDetayAlani">
                <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="1" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                </div>
                <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                  <div class="SepetOdemeKrediTaksitSayisiMetni">Tek Çekim </div>
                  <div class="SepetOdemeKrediTaksitTutari">1 * <?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                  <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                </div>
              </div><!-- detayalanı kapaması -->

              <div class="SepetOdemeKrediTaksitDetayAlani">
                <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="2" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                </div>
                <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                  <div class="SepetOdemeKrediTaksitSayisiMetni">İki Taksit </div>
                  <div class="SepetOdemeKrediTaksitTutari">2 * <?php echo $ikiTaksitAylikTutar; ?>TL</div>
                  <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                </div>
              </div><!-- detayalanı kapaması -->
              
              <div class="SepetOdemeKrediTaksitDetayAlani">
                <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="2" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                </div>
                <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                  <div class="SepetOdemeKrediTaksitSayisiMetni">Üç Taksit</div>
                  <div class="SepetOdemeKrediTaksitTutari">3 * <?php echo $ucTaksitAylikTutar; ?>TL</div>
                  <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                </div>
              </div>

              <div class="SepetOdemeKrediTaksitDetayAlani">
                <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="4" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                </div>
                <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                  <div class="SepetOdemeKrediTaksitSayisiMetni">Dört Taksit</div>
                  <div class="SepetOdemeKrediTaksitTutari">4 * <?php echo $dortTaksitAylikTutar; ?>TL</div>
                  <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                </div>
              </div><!-- detayalanı kapaması -->

              <div class="SepetOdemeKrediTaksitDetayAlani">
                <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="5" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                </div>
                <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                  <div class="SepetOdemeKrediTaksitSayisiMetni">Beş Taksit</div>
                  <div class="SepetOdemeKrediTaksitTutari"> 5 * <?php echo $besTaksitAylikTutar; ?>TL</div>
                  <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                </div>
              </div><!-- detayalanı kapaması -->

              <div class="SepetOdemeKrediTaksitDetayAlani">
                  <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="6" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                  </div>
                  <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                    <div class="SepetOdemeKrediTaksitSayisiMetni">Altı Taksit</div>
                    <div class="SepetOdemeKrediTaksitTutari">6 * <?php echo $altiTaksitAylikTutar; ?>TL</div>
                    <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                  </div>
              </div><!-- detayalanı kapaması -->

              <div class="SepetOdemeKrediTaksitDetayAlani">
                <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="7" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                </div>
                <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                  <div class="SepetOdemeKrediTaksitSayisiMetni">Yedi Taksit</div>
                  <div class="SepetOdemeKrediTaksitTutari">7 * <?php echo $yediTaksitAylikTutar; ?>TL</div>
                  <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                </div>
              </div><!-- detayalanı kapaması -->

              <div class="SepetOdemeKrediTaksitDetayAlani">
                <div class="SepetOdemeKrediTaksitRadioAlani">
                    <label class="SepetOdemeKrediTaksitRadioSecenekKapsamaAlani">
                        <input type="radio" name="taksitSecimi" value="8" checked="checked" onClick="$.KrediKartiSecildi();" class="SepetKrediTaksitRadioInputu">
                           <span class="SepetOdemeKrediTaksitRadioBicimlendirma"></span>
                    </label>
                </div>
                <div class="SepetOdemeKrediTaksitSayisiMetniKapsamaAlani">
                  <div class="SepetOdemeKrediTaksitSayisiMetni">Sekiz Taksit</div>
                  <div class="SepetOdemeKrediTaksitTutari"> 8 * <?php echo $sekizTaksitAylikTutar; ?>TL</div>
                  <div class="SepetOdemeKrediTaksitToplamTutari"><?php echo $odenecekTopFiyatHesaplaBic; ?>TL</div>
                </div>
              </div><!-- detayalanı kapaması -->
            </div><!--taksit alanı bitişi--->
          </div> <!-- KREDİ KARTI SEÇİLİNCE AÇILACAK ALANIN SONU-->

          <div id="bhAlanlari" class="SepetOdemeBankaHavaleAlani">
            <div class="SepetOdemeBankaHavaleBaslikAlani">Banka Havalesi/EFT İle Ödeme </div>
            <div class="SepetOdemeBankaHavaleAciklamaAlani">
                Banka Havalesi/EFT İle ürün alabilme için öncelikle alışveriş sepeti tutarınızı banka hesapları sayfasında bulunan herhangibir hesaba ödeme yaptıktan sonra havalebildirim formu aracılığı ile lütfen tarafımıza bilgi veriniz. Devam et butonuna tıkladığınız ansa siparişiniz sisteme kayıt edilecektir.
            </div>
          </div>
        </div><!-- sol alan bitisi -->
        </form>
        <div id="TamSayfadaSepetSagAlan">
          <div id="TamSayfadaAltiCiziliSagBaslikAlani">
            <div id="SagBaslikMetni">Sipariş Özeti</div>
            <div id="SagAltBaslikMetni">Sepetinizde <?php echo $sepettekiTopUrun; ?> adet ürün bulunmaktadır.</div>
          </div>

          <div class="SagTutarBaslikAlani">Ödenecek Tutar(KDV Dahil)</div>
          <div class="SagTutarRakamAlani"><?php echo fiyatBicimlendir($odenecekTopFiyatHesaplaBic); ?>TL</div>
          <div class="SagTutarBaslikAlani">Toplam Ürün Fiyatı(KDV Dahil)</div>
          <div class="SagTutarRakamAlani"><?php echo fiyatBicimlendir($sepettekiTopFiyat); ?>TL</div>
          <div class="SagTutarBaslikAlani">Toplam Kargo Ücreti(KDV Dahil)</div>
          <div class="SagTutarRakamAlani"><?php echo $sepettekiTopKargoFiyatBic; ?> TL</div>

          <div class="SagButonAlani" onclick="$.SepetOdemeFormGonder()">
            <span><span class="SagButonIkonu"><img src="img/sepetbuton.png"></span><span class="SagButonMetni">Alışverişi Tamamla</span></span>
                   <!-- formun dısında olduğu için formdan aldığu ilgileri js kullanarak fonksiyon ile(SepetOdemeFormGonder())  göndermesini sağlıcam -->
          </div>

        </div>

   </div><!-- sınırlama bitişi --> 
 </div>
<?php
}else{
    header("Location:index.php");//kargo ve adres seçilmediyse
    exit();
}
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>