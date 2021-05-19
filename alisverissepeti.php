<?php

 if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin  
    //STOK OLAYI!: ürün yoksa urunsilçphp ye gidir urunusilip buraya döncek
    $StokIcinsepetteki_urunler_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=?");
    $StokIcinsepetteki_urunler_sorgusu->execute([$KullaniciId]);
    $stoktaki_urun_sayisi=$StokIcinsepetteki_urunler_sorgusu->rowCount();
    $stoktaki_urun_kayitlari=$StokIcinsepetteki_urunler_sorgusu->fetchAll(PDO::FETCH_ASSOC);

    if ($stoktaki_urun_sayisi>0) { //sepette urun varsa urunun adedini ve varyantının da adedini  eksilticez.
       foreach ($stoktaki_urun_kayitlari as $satir) {
        $StokIcinSepetId=$satir["id"];
        $StokIcinsepettekiVaryantId=$satir["VaryantId"];
        $StokIcinsepettekiUrunAdedi=$satir["UrunAdedi"];

        $StokIcinUrunVaryantBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");
        $StokIcinUrunVaryantBilgileri_sorgusu->execute([$StokIcinsepettekiVaryantId]);
        $StokIcinsepetteki_urun_varyant_kaydi=$StokIcinUrunVaryantBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);
        $StokIcinurununStokAdedi=$StokIcinsepetteki_urun_varyant_kaydi["StokAdedi"];

        if ($StokIcinurununStokAdedi==0) {//URUN STOKTA YOKSA
          $sepetSilmeSorgusu=$baglan->prepare("DELETE FROM sepet WHERE id=? AND UyeId=? LIMIT 1");
          $sepetSilmeSorgusu->execute([$StokIcinSepetId,$KullaniciId]);
        }
        elseif ($StokIcinsepettekiUrunAdedi>$StokIcinurununStokAdedi){//ÜRÜN STOKTA VARSA
             $sepetGuncelleSorgusu=$baglan->prepare("UPDATE sepet SET UrunAdedi=?  WHERE id=? AND UyeId=? LIMIT 1");//urun adedine stoktaki urun adedi değerini yazdırdım.
             $sepetGuncelleSorgusu->execute([$StokIcinurununStokAdedi,$StokIcinSepetId,$KullaniciId]);

        }
    }//for bitişi
    }//if ($stoktaki_urun_sayisi>0) { kapaması

    //sepette geri gelip tktar seçmek istediğim değerleri aynı seçersem beni anasayfaya atmasın diye. mesala taksiti tekrar 3 seçmek isteyince yada aynı adresi seçmek istediğimde  index.e yönlendirmesin diye
    $sepetSifirlamaSorgusu=$baglan->prepare("UPDATE sepet SET AdresId=?, KargoId=?,OdemeSecimi=?,TaksitSecimi=?  WHERE UyeId=?");
    $sepetSifirlamaSorgusu->execute([0,0,"",0,$KullaniciId]);

?>
<div id="TamSayfaCerceveAlani">
    <div id="TamSayfaCerceveSinirlamaAlani">
           <!-- SEPETTE ÜRÜN VARSA ALANI --> 
        <div id="TamSayfadaSepetSolAlan">
             <div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">SEPETİM</div>
                 <div id="AltBaslikMetni">Sepetinize eklediğiniz ürünleri aşağıdan görebilirsiniz!</div>
            </div>
            <?php
                $sepetteki_urunler_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC");
                $sepetteki_urunler_sorgusu->execute([$KullaniciId]);
                $sepetteki_urun_sayisi=$sepetteki_urunler_sorgusu->rowCount(); //kayıt varmı
                $sepetteki_urun_kayitlari=$sepetteki_urunler_sorgusu->fetchAll(PDO::FETCH_ASSOC);

                if ($sepetteki_urun_sayisi>0) {//SEPETTE ÜRÜN VARSA
                    $sepettekiTopUrun=0;
                    $sepettekiTopFiyat=0;
                    foreach ($sepetteki_urun_kayitlari as $sepet) {
            //burda bize gerekli olan bilgileri değişkenlere ilk önce atıyoruz bunun içinde once veritabanından bu bilgileri alabilmek için sorgularımızı yazıyoruz
                        $sepetId=$sepet["id"];
                        $sepettekiUrunId=$sepet["UrunId"];
                        $sepettekiVaryantId=$sepet["VaryantId"];
                        $sepettekiUrunAdedi=$sepet["UrunAdedi"];

                        $UrunBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");//SEPETTEKİ İLGİLİ ÜRÜNÜN BİLGİLERİNİ ÇEKTİK
                        $UrunBilgileri_sorgusu->execute([$sepettekiUrunId]);
                        $sepetteki_urun_kaydi=$UrunBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);

                        $urununResmi=$sepetteki_urun_kaydi["UrunResmiBir"];
                        $urununTuru=$sepetteki_urun_kaydi["UrunTuru"];
                        $urununAdi=$sepetteki_urun_kaydi["UrunAdi"];
                        $urununFiyati=$sepetteki_urun_kaydi["UrunFiyati"];
                        $urununParaBirimi=$sepetteki_urun_kaydi["ParaBirimi"];
                        $urununVaryantBasligi=$sepetteki_urun_kaydi["VaryantBasligi"];

                        $UrunVaryantBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");
                        $UrunVaryantBilgileri_sorgusu->execute([$sepettekiVaryantId]);//İLGİLİ ÜRÜNÜN VARYANT BİLGİLERİNİ ÇEKTİK
                        $sepetteki_urun_varyant_kaydi=$UrunVaryantBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);
                              
                        $urununVaryantAdi=$sepetteki_urun_varyant_kaydi["VaryantAdi"];
                        $urununStokAdedi=$sepetteki_urun_varyant_kaydi["StokAdedi"];

                        if ($urununTuru=="fincan") {
                                $klasor="fincan";
                        }elseif ($urununTuru=="kupa") {
                                $klasor="kupa";
                        }elseif ($urununTuru=="kahveyanibardak") {
                                $klasor="kahveyanibardak";
                        }elseif ($urununTuru=="sunumluk") {
                                $klasor="sunumluk";
                        }

                        if ($urununParaBirimi=="USD") {
                            $tlFiyat=$urununFiyati;//fiyati biçimlendir fonksiyonunda sayıyı , lü yazdırdım hesaplama yaparken , le olan sayılar toplanmadığı için once hesaplıyıp sınra biçimlnedircem
                            $tlFiyat=$urununFiyati*$dolarKuru;
                            $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);
                        }elseif ($urununParaBirimi=="EUR") {
                            $tlFiyat=$urununFiyati*$dolarKuru;
                            $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);
                        }else{
                            $tlFiyat=$urununFiyati;
                            $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);              
                        }
                        $UrunTopFiyat=($tlFiyat* $sepettekiUrunAdedi);
                        $UrunTopFiyatBic=fiyatBicimlendir($UrunTopFiyat);

                        $sepettekiTopUrun +=$sepettekiUrunAdedi;
                        $sepettekiTopFiyat +=($tlFiyat * $sepettekiUrunAdedi);
                ?>
            <div class="SepetUrunlerAlani">
                <div class="SepetUrunResmiAlani">
                    <img src="img/urunler/<?php echo $klasor; ?>/<?php  echo DonusumleriGeriDondur($urununResmi); ?>" border="0">
                </div>
                <div class="SepetUrunSilAlani">
                    <a href="index.php?sk=94&ID=<?php echo DonusumleriGeriDondur($sepetId)?>">
                        <img src="img/silsepet.png" border="0">
                    </a>
                </div>
                <div class="SepetUrunBilgiAlani">
                    <?php echo DonusumleriGeriDondur($urununAdi); ?> <br><?php echo DonusumleriGeriDondur($urununVaryantBasligi); ?> : <?php echo DonusumleriGeriDondur($urununVaryantAdi); ?>
                </div>
                <div class="SepetUrunAdediAlani">
                    <div class="SepetUrunAdediIslAlani">
                        <div class="SepetUrunAdediEksiltAlani">
                            <?php if ($sepettekiUrunAdedi>1) { ?>
                              <a href="index.php?sk=95&ID=<?php echo DonusumleriGeriDondur($sepetId)?>">
                                <img src="img/eksi.png" border="0" width="20" height="20">
                              </a>
                            <?php }?>
                        </div>
                        <div class="SepetUrunAdediRakamAlani"><?php echo DonusumleriGeriDondur($sepettekiUrunAdedi); ?></div>
                        <div class="SepetUrunAdediArtAlani">                             
                           <a href="index.php?sk=96&ID=<?php echo DonusumleriGeriDondur($sepetId)?>">
                                <img src="img/arti.png" border="0" width="20" height="20">
                            </a>                           
                        </div>
                    </div>
                </div> <!-- urun adedi alanı kapaması -->
                <div class="SepetUrunFiyatiAlani">
                    <?php echo DonusumleriGeriDondur($tlFiyatBicimlendir); ?> TL(brm.fiyat)<br><?php echo DonusumleriGeriDondur($UrunTopFiyatBic); ?> TL(top.fiyat)                                 
                </div>
            </div> <!-- sepet ürünler alanı kapaması-->
                       
            <?php
                } //for each kaoaması
                }else{ //sepette ürün yoksa değerleri sıfırladık.
                    $sepettekiTopUrun=0;
                    $sepettekiTopFiyat="0.00";
            ?>

        </div><!-- sol alan bitişi -->
        <div id="TamSayfadaYuzlukAlan">            
            <div id="sepetteUrunYokAlani">
                <div id="sepetteUrunYokIslemİkonu"><img src="img/dikkat.jpg"></div>
                <div id="sepetteUrunYokBaslik">Sepetinizde ürün bulunmamaktadır!</div>
                <div id="sepetteUrunYokIcerik">
                    Sitemizdeki ürünleri inceleyerek, ihtiyacınız olan ürünleri sepetinize ekleyip alışveriş yapabilirsiniz. Anasayfa ya dönmek için <a href="index.php"> buraya </a> tıklayınız.
                </div>
            </div>        
        </div>
        <?php } ?><!-- else in kapaması-->
    </div><!--tam sayfa çerceve  sinirlama bitisi  sağ aln bitşinden sonra koyunca sağ aln boluluyo!-->
    <div id="TamSayfadaSepetSagAlan">
        <div id="TamSayfadaAltiCiziliSagBaslikAlani">
            <div id="SagBaslikMetni">Sipariş Özeti</div>
            <div id="SagAltBaslikMetni">Sepetinizde <?php echo $sepettekiTopUrun; ?> adet ürün bulunmaktadır.</div>
        </div>
        <div class="SagTutarBaslikAlani">Ödenecek Tutar(KDV Dahil)</div>
        <div class="SagTutarRakamAlani"><?php echo fiyatBicimlendir($sepettekiTopFiyat); ?>TL</div>
        <div class="SagButonAlani">
            <a href="index.php?sk=97" target="_top"><span class="SagButonIkonu"><img src="img/sepetbuton.png"></span><span class="SagButonMetni">Devam Et</span></a>
        </div>
    </div>
    
 </div><!-- tam sayfa alanı bitişi-->
<?php
}else{
    header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
    exit();
}

?>