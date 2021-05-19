<?php
if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
  if (isset($_GET["UrunID"])) {//UrunId de olabilir
    $gelenUrunId=guvenlik($_GET["UrunID"]);
  }else{
    $gelenUrunId="";
  }

  if ($gelenUrunId!="") {

?>
<div id="TamSayfaCerceveAlani">
    <div id="TamSayfaCerceveSinirlamaAlani">
     	<div id="CerceveIciAlaniElliSolAlan">
     		<div id="TamSayfadaAltiCiziliBaslikAlani">
            <div id="BaslikMetni">HESABIM&Yorum Yap</div>
            <div id="AltBaslikMetni">Satın almış olduğunuz ürün ile alakalı aşağıdan düşüncelerinizi paylaşabilirsiniz.</div>
        </div>

        <form action="index.php?sk=76&UrunID=<?php echo $gelenUrunId; ?>" method="POST">
          <div class="FormBaslikMetni">Yorum Metni</div>
          <div class="FormSatirAlani"><textarea name="Yorum" class="textAreaAlanlari"></textarea></div>

          <div class="YorumSinirlamaAlani">
            <div class="YorumPuanlamaTabloAlani">
              <table class="YorumTablosu" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr><!-- 1 puanlı yorum yıldızı -->
                    <td align="left" valign="top" class="YorumTabloRadioSutunu">
                      <div class="YorumRadioAlani">
                        <label class="YorumTabloRadioSecenekAlani">
                          <input type="radio" name="Puan" value="1" class="YorumRadioInputu">
                          <span class="YorumRadioBicimlendirme"></span>
                        </label>
                      </div>
                    </td>                    
                    <td> <div class="HesabimYorumYapResimAlani"><img src="img/yorumyildiz1.jpg" border="0"></div><td>
                  </tr>

                  <tr><!-- 2 puanlı yorum yıldızı -->
                    <td align="left" valign="top" class="YorumTabloRadioSutunu2">
                      <div class="YorumRadioAlani">
                        <label class="YorumTabloRadioSecenekAlani">
                          <input type="radio" name="Puan" value="2" class="YorumRadioInputu">
                            <span class="YorumRadioBicimlendirme"></span>
                        </label>
                      </div>
                    </td>
                    <td> <div class="HesabimYorumYapResimAlani"><img src="img/yorumyildiz2.jpg" border="0"></div><td>
                  </tr>

                  <tr><!-- 3 puanlı yorum yıldızı -->
                    <td align="left" valign="top" class="YorumTabloRadioSutunu3">
                      <div class="YorumRadioAlani">
                        <label class="YorumTabloRadioSecenekAlani">
                          <input type="radio" name="Puan" value="3" class="YorumRadioInputu">
                            <span class="YorumRadioBicimlendirme"></span>
                        </label>
                      </div>
                    </td>
                    <td> <div class="HesabimYorumYapResimAlani"><img src="img/yorumyildiz3.jpg" border="0"></div><td>
                  </tr>
                                    
                  <tr><!-- 4 puanlı yorum yıldızı -->
                    <td align="left" valign="top" class="YorumTabloRadioSutunu4">
                      <div class="YorumRadioAlani">
                        <label class="YorumTabloRadioSecenekAlani">
                          <input type="radio" name="Puan" value="4" class="YorumRadioInputu">
                            <span class="YorumRadioBicimlendirme"></span>
                        </label>
                      </div>
                    </td>
                    <td> <div class="HesabimYorumYapResimAlani"><img src="img/yorumyildiz4.jpg" border="0"></div><td>
                  </tr>
                  
                  <tr><!-- 5 puanlı yorum yıldızı -->
                    <td align="left" valign="top" class="YorumTabloRadioSutunu5">
                      <div class="YorumRadioAlani">
                        <label class="YorumTabloRadioSecenekAlani">
                          <input type="radio" name="Puan" value="5" class="YorumRadioInputu">
                            <span class="YorumRadioBicimlendirme"></span>
                        </label>
                      </div>
                    </td>
                    <td> <div class="HesabimYorumYapResimAlani"><img src="img/yorumyildiz5.jpg" border="0"></div><td>
                  </tr>
                </tbody>
            </table>
          </div><!-- -yorum puanlama tablo alanı sonu -->
      </div><!-- yorm sınırlaa alanı sonu-->
    
     <div class="ButonKapsamaAlani">
        <input type="submit" value="Yorumu Gönder" class="FormYesilButonu">
     </div>
     
     </form>
     </div> <!-- sol alan bitşi -->
    
    <div id="CerceveIciAlaniElliSagAlan">
     	<div id="TamSayfadaAltiCiziliBaslikAlani">
        <div id="BaslikMetni">DEĞERLENDİRMEYE ALINMAYAN YORUMLAR</div>
        <div id="AltBaslikMetni">Sitemiz tarafından geçersiz gördüğümüz yorumlar aşağıdaki gibidir.</div>
      </div>
      
      <div class="BilgiParagraflariKapsamaAlani">
        <div class ="BilgiResimleri">
          <img src="img/reklam.png" border="0"><span class="resimYaniBasligi">REKLAM&TANITIM</span>
        </div>
        <div class="BilgiAciklamaAlani">Site,kurum veya kuruluşlar ile ilgili reklam veya tanıtım içeren yorumlar.</div>
      </div>

      <div class="BilgiParagraflariKapsamaAlani">
        <div class ="BilgiResimleri">
          <img src="img/siyaset.png" border="0" ><span class="resimYaniBasligi">POLİTİKA&SİYASET</span>
        </div>
        <div class="BilgiAciklamaAlani">Politika veta siyaset içerikli yorumlar.</div>
      </div>

      <div class="BilgiParagraflariKapsamaAlani">
        <div class ="BilgiResimleri">
          <img src="img/kufur.png" border="0" ><span class="resimYaniBasligi">KÜFÜR/ARGO/ŞİDDET</span>
        </div>
        <div class="BilgiAciklamaAlani">Küfür,argo kelime veya şiddet içerikli yorumlar.</div>
      </div>

      <div class="BilgiParagraflariKapsamaAlani">
        <div class ="BilgiResimleri">
          <img src="img/sahteicerik.png" border="0"><span class="resimYaniBasligi">SAHTE İÇERİK</span>
        </div>
        <div class="BilgiAciklamaAlani">İlgili ürün haricinde yazılmış olan yorumlar. Örneğin X ürününe başka ürünle alakalı yorum yazılmışsa.</div>
      </div>

      <div class="BilgiAciklamaAlani">Yukarıda belirtlen içeriklere sahip yorumlar değerlendirmeye alınmayıp ayrıca "Ürün Detay" sayfasında gösterilmeyecektir.
      </div>  
</div>  <!-- sağ alan kapamsı-->

</div><!--  <div id="TamSayfaCerceveSinirlamaAlani">-->
</div>

<?php
}else{
  header("Location:index.php?sk=78");//hata
  exit();
}
}else{
  header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
  exit();
}

?>


