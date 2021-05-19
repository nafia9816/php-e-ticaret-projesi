<?php
   if (isset($_GET["AktivasyonKodu"])) {
       $GelenAktivasyonKodu=guvenlik($_GET["AktivasyonKodu"]);
   }else{
      $GelenAktivasyonKodu="";
   }

   if (isset($_GET["Email"])) {
   	//bu email ve sktivasyon kodu nu şifremiunuttumsonuc.php deli mesajdan aldık.&Email=" .$kullaniciKaydi["EmailAdres" dan
       $GelenEmail=guvenlik($_GET["Email"]);
   }else{
       $GelenEmail="";
   }
//mutlaka dol olması gereken yerler
   if (($GelenEmail!="") and ($GelenAktivasyonKodu!="")) {
       
      $kontrolSorgusu=$baglan->prepare("SELECT * FROM uyeler WHERE EmailAdres= ? AND  AktivasyonKodu=?"); 
      $kontrolSorgusu->execute([$GelenEmail,$GelenAktivasyonKodu]);
      $kontrolSayisi=$kontrolSorgusu->rowCount();
      $kullaniciKaydi=$kontrolSorgusu->fetch(PDO::FETCH_ASSOC);
      if ($kontrolSayisi>0) {     
?>
<!DOCTYPE html>
<body>
   <table width="1065" align="center" cellspacing="0" cellpadding="0">
	<tr>
		<td width="500" valign="top">
			<form action="index.php?sk=44&EmailAdres=<?php echo $GelenEmail; ?>&AktivasyonKodu=<?php echo $GelenAktivasyonKodu; ?>" method="POST">
				<!-- bu şekilde  yönlendirmede email ve koduda göndermemin sebebi bu iki bilgi olmadan kimse şifre yenileme sayfasına girmesin diye  -->
			<table width="500" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr height="50">
					<td  colspan="2" style="color:#FF9900"><h3>Üye Girişi</h3> 
					</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Aşağıdan hesabına giriş şifreni değiştirebilirsin 
					</td>
				</tr>


                <tr height=30>
					<td  colspan="2" valign="bottom" align="left">Yeni Şifre (* zorunlu)</td>
				</tr>

				<tr height=30>
					<td colspan="2" valign="top" align="left"><input type="password" name="YeniSifre" class="inputAlanlari"></td>
				</tr>

				<tr height=30>
					<td valign="bottom" align="left" colspan="2">Yeni Şifre Tekrar (* zorunlu)</td>

					
				</tr>

				<tr height=30>
					<td colspan="2" valign="top" align="left"><input type="password" name="YeniSifreTekrar" class="inputAlanlari"></td>
				</tr>

				<tr height="40">
					<td align="center"><input type="submit" value="Şifremi Güncelle" class="yesilbuton"></td>
				</tr>
			</table>
			</form>
		</td>
		<td width="500" valign="top"> 
		<table width="535" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr height="50">
					<td style="color:#FF9900" colspan="2"><h3>Yeni Şifre Oluşturma</h3> 
					</td>
				</tr>
				<tr height=30>
					<td valign="top" style="border-bottom: 1px dashed #CCCCCC;" colspan="2"><b> Çalışma ve İşleyiş</b>
					</td>
				</tr>
                
                <td colspan="2" height="5">&nbsp;</td>

				<tr height="30">
					<td align="left"><img src="img/kontrol.jpg" border="0"></td>
					<td style="color:#FF9900"><b>Bilgi Kontrolü </b></td>
				</tr>

				<tr height="30">
					<td colspan="2" align="left">Kullanıcının form aalnında girmiş olduğu bilgiler veritabanında tam detaylı olarak filtrelenerek kontrol edilir.</td>
					
				</tr>



				<td colspan="2" height="5">&nbsp;</td>

				<tr height="30">
                   <td align="left"><img src="img/kontrol.jpg" border="0"></td>
                   <td style="color:#FF9900"><b>Mail Gönderimi&İçerik </b></td>
               </tr>
       

               <tr height="30">
                  <td colspan="2" align="left">Bilgi kontrolübaşarılı olursa kullanıcının veritabanımızda kayıtla olan email adresine yeni şifre oluşturma içerikli bir mail gönderilir.</td>
          
               </tr>

				<td colspan="2" height="5">&nbsp;</td>

				<tr height="30">
					<td align="left"><img src="img/hizli.jfif" border="0"></td>
					<td style="color:#FF9900"><b>Şifre Sıfırlama VE oLUŞTURMA</b></td>
				</tr>

				<tr height="30">
					<td colspan="2" align="left">Kullanıcı kendisine iletilen mail içerisindekiyeni şifre oluştur metnine tıklayacak olursa site yeni şifre oluşturma açılır ve kullanıcıdan yeni hesap şifresini oluşturması istenir.</td>
					
				</tr>

				<td colspan="2" height="5">&nbsp;</td>

				<tr height="30">
					<td align="left"><img src="img/destek.png" border="0"></td>
					<td style="color:#FF9900"><b>Sonuc</b></td>
				</tr>

				<tr height="30">
					<td colspan="2" align="left">Kullanıcı yeni oluşturmuş olduğu hesap şifresi ile siteye giriş yapar.</td>
					
				</tr>

		</table>
		</td>
	</tr>
</table>

</body>

</html>
<?php

   }else{
      header("Location:index.php");
      exit();
   }
  }else{
  	header("Location:index.php");
    exit();
  }

?>




