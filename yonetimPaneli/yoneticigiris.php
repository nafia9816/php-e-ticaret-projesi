<?php
  if (empty($_SESSION["Yonetici"])) {//yonetici sessionu varsa yani yonetci giriş vars abu sayfayı gosterme
?>
<div id="TamSayfaCerceveAlani">
    <div id="TamSayfaCerceveSinirlamaAlani">
      <div id="TamSayfadaYuzlukAlan">
        <div id="BaslikMetni">YÖNETİCİ GİRİŞİ</div>
        <form action="index.php?SKD=2" method="post">
            <div class="FormBaslikMetni">Yönetici Kullanıcı Adı</div>
            <div class="GirisFormSatirAlani"><input type="text" name="YKullanici" class="GirisFormTextInputAlani"></div>
            <div class="FormBaslikMetni">Yönetici Şifresi</div>
            <div class="GirisFormSatirAlani"><input type="text" name="YSifre" class="GirisFormTextInputAlani"></div>
                
            <div class="ButonKapsamaAlani"><input type="submit" value="Giriş Yap" class="FormYesilButonu"></div>

        </form>
        </div>
    </div>
</div>

<?php
}

?>