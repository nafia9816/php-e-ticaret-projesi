<?php
 if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
   
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

?>
<div id="TamSayfaCerceveAlani">
  <div id="TamSayfaCerceveSinirlamaAlani">
    <form action="index.php?sk=98" method="POST" id="SepetFormu">
      <div id="TamSayfadaSepetSolAlan">
        <div id="TamSayfadaAltiCiziliBaslikAlani">
          <div id="BaslikMetni">SEPETİM</div>
          <div id="AltBaslikMetni">Adres ve kargo seçimini aşağıdan belirtebilirsiniz! (250 tl ve üzeri alışverişinizde kargo ücretsizdir.)</div>
        </div>
        
        <div class="SepetAdresAlani">
          <div class="AdresBilgisiSecimiBaslik"><span class="solalan">HESABIM&Adresler</span> <span class="sagalan"> <a href="index.php?sk=70" target="_top" style="text-decoration: none;">+ Adres Ekle</a></span>
          </div>
   <!-- varolan adresleri listeleme-->
          <?php
            $sepetteki_urunler_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC");
            $sepetteki_urunler_sorgusu->execute([$KullaniciId]);
            $sepetteki_urun_sayisi=$sepetteki_urunler_sorgusu->rowCount(); //kayıt varmı
            $sepetteki_urun_kayitlari=$sepetteki_urunler_sorgusu->fetchAll(PDO::FETCH_ASSOC);
            if ($sepetteki_urun_sayisi>0) { 
                  //aşağıda yapacağım işlemlerde tanımsız demesin diye değişkenlere burada 0 a eşitledim tanımlarken
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
             //gerekli işlemlerden sonra adresleri listelemeyle başlıyoruz
                    $adresler_sorgusu=$baglan->prepare("SELECT * FROM adresler WHERE UyeId=? ORDER BY id DESC");
                    $adresler_sorgusu->execute([$KullaniciId]);
                    $adres_sayisi=$adresler_sorgusu->rowCount(); 
                    $adres_kayitlari=$adresler_sorgusu->fetchAll(PDO::FETCH_ASSOC);

                    if ($adres_sayisi>0) {
                      foreach ($adres_kayitlari as $adres)
                    {
                ?>
                <div class="AdreslerDetay">
                    <div class="AdreslerDetayRadioButonAlani">
                    <label class="AdreslerDetayRadioButonKapsama">
                         <input class="AdresRadioInput" type="radio" name="adressecimi" value="<?php echo $adres["id"]; ?>"> 
                         <span class="AdresRadioButonSpanAlani"></span>  
                    </label>
                    </div>

                    <div class="AdresDetaylari">
                        <?php echo DonusumleriGeriDondur($adres["AdSoyad"]); ?> <?php echo DonusumleriGeriDondur($adres["Adres"]); ?>  <?php echo DonusumleriGeriDondur($adres["Ilce"]); ?>  <?php echo DonusumleriGeriDondur($adres["Sehir"]); ?> <?php echo DonusumleriGeriDondur($adres["TelefonNumarasi"]); ?>
                    </div>
                </div>
                <?php
                }//iç foreach
                }else{ //adrrs yoksa buraya gelsin
                ?>
                <div id="sonucSayfalariIcerik">
                    Sisteme kayıtlı adres bulunmaktadır. Öncelikle <a href="index.php?sk=70"> "Hesabım"</a> Alanından adres ekleyiniz.
                </div>
                <?php
                }
                ?>
            </div> <!-- sepet adres alanıın kapaması-->
            <div class="SepetKargoAlani">            <!-- kargo bilgileri baslangıçı-->
              <div class="KargoSecimiBaslikAlani">Kargo Firması Seçimi</div>
              <div class="KargoAlani">
                <div class="SepetKargoDengelemeAlani">
                <?php
                    $kargo_sorgu=$baglan->prepare("SELECT * FROM kargofirmalari");
                    $kargo_sorgu->execute();
                    $kargo_sayi=$kargo_sorgu->rowCount();
                    $kargo_kayitlari=$kargo_sorgu->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($kargo_kayitlari as $kayit) {
                ?>
                <div class="KargoSinirlamaAlani">
                  <div class="KargoLogoAlani">
                    <img src="img/<?php echo DonusumleriGeriDondur($kayit["FirmaLogosu"]); ?>" border="0">
                  </div>
                  <div class="KargoTabloAlani">
                    <table class="KargoTablosu" width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td align="left" valign="top" class="KargoTabloRadioSutunu">
                            <div class="KargoRadioAlani">
                              <label class="KargoTabloRadioSecenekAlani">
                                <input type="radio" name="kargosecimi" value="<?php echo $kayit["id"]; ?>" class="KargoRadioInputu"> 
                                                    <span class="KargoRadioBicimlendirme"></span>
                                </label>
                            </div>
                          </td>
                          <td align="left" valign="top" class="KargoAdi">
                              <?php echo DonusumleriGeriDondur($kayit["FirmaAdi"]); ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div><!-- kargo sınırlama alanı-->
                <?php } ?>
              </div> <!-- kargo dengeleme alanı-->
            </div> <!-- kargo alanı bitişi-->
          </div><!-- sepet katgo lanı bitişi-->
          <?php
          }else{//sepette ürün yoksa sepete yonlesin
              header("Location:index.php?sk=93");
                  exit();
          } 
          ?>   
     </div><!-- sol alan bitisi -->
    </form>
    <div id="TamSayfadaSepetSagAlan">
      <div id="TamSayfadaAltiCiziliSagBaslikAlani">
        <div id="SagBaslikMetni">Sipariş Özeti</div>
        <div id="SagAltBaslikMetni">Sepetinizde <?php echo $sepettekiTopUrun; ?> adet ürün bulunmaktadır.</div>
      </div>

      <div class="SagTutarBaslikAlani">Ödenecek Tutar(KDV Dahil)</div>
      <div class="SagTutarRakamAlani"><?php echo fiyatBicimlendir($odenecekTopFiyatHesaplaBic); ?>TL </div>
      <div class="SagTutarBaslikAlani">Toplam Ürün Fiyatı(KDV Dahil) </div>
      <div class="SagTutarRakamAlani"><?php echo fiyatBicimlendir($sepettekiTopFiyat); ?>TL </div>
      <div class="SagTutarBaslikAlani">Toplam Kargo Ücreti(KDV Dahil) </div>
      <div class="SagTutarRakamAlani"><?php echo $sepettekiTopKargoFiyatBic; ?> TL </div>

      <div class="SagButonAlani" onclick="$.SepetFormGonder()">
        <span><span class="SagButonIkonu"><img src="img/sepetbuton.png"></span><span class="SagButonMetni">Devam Et</span></span>
                   <!-- formun dısında olduğu için formdan aldığu ilgileri js kullanarak göndermesini sağlıcam -->
      </div>
    </div><!-- sağ alan bitişi-->


   </div><!-- sınırlama bitişi --> 
 </div>

<?php
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>