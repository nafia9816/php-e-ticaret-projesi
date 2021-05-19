<?php

 if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
?>

<table width="1065" align="center" cellspacing="0" cellpadding="0">

     <tr>
	   <td colspan="3"><hr></td>
	  </tr>

	  <tr>
	  	<td colspan="3">
	  		<table width="1065" align="center" cellspacing="0" cellpadding="0">

	  			<td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;">
	  				<a href="index.php?sk=50" style="text-decoration: none; color: black;">
	  			    Üyelik Bilgilerim
	  			    </a>
	  			</td>
	  			<td width="10">&nbsp;</td>

	  			<td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;">
	  				<a href="index.php?sk=58" style="text-decoration: none; color: black;">
	  			    Adresler
	  			    </a>
	  			</td>

	  			<td width="10">&nbsp;</td>

	  			<td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;">
                    <a href="index.php?sk=59" style="text-decoration: none; color: black;">
	  			    Favoriler
	  			    </a>
	  		   </td>
	  			<td width="10">&nbsp;</td>

	  			<td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;">
	  			    <a href="index.php?sk=60" style="text-decoration: none; color: black;">
	  			    Yorumlar
	  			   </a>
	  			</td>
	  			<td width="10">&nbsp;</td>

	  			<td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;">
	  			<a href="index.php?sk=50" style="text-decoration: none; color: black;">
	  			Siparişler
	  		    </a>
	  		</td>
	  		</table>
	  	</td>
	  </tr>

	  <tr>
		<td colspan="3"><hr></td>
	  </tr>











	<tr>
		<td width="500" valign="top">
			
			<table width="500" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr height="50">
					<td  colspan="2" style="color:#FF9900"><h3>Hesabım & Üyelik Bilgilerim</h3> 
					</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Aşağıdan hesabına ait bilgileri güncelleyebilirsin!
					</td>
				</tr>


                <tr height=30>
					<td  colspan="2" valign="bottom" align="left">Email Adresi</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" align="left"><?php echo $KullaniciEmail; ?></td>
					<!-- bu değişkenler ayarlar.ph de kulanıcı giriş yaptığı anda veritbanından çelilen bilgileri atadığım değişkenler -->
				</tr>
	

				<tr height=30>
					<td valign="bottom" align="left">İsim Soyisim</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" align="left"><?php echo $KullaniciIsimSoyisim; ?></td>
				</tr>

				<tr height=30>
					<td valign="bottom" align="left">Telefon Numarası</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" align="left"><?php echo $KullaniciNumara; ?></td>
				</tr>

				<tr height=30>
					<td valign="bottom" align="left">Cinsiyet</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" align="left"><?php echo $KullaniciCinsiyet; ?></td>
				</tr>

				<tr height=30>
					<td valign="bottom" align="left">Kayıt Tarihi</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" align="left"><?php echo tarihBul($KullaniciKayitTarihi); ?></td>
				</tr>

				<tr height=30>
					<td valign="bottom" align="left">Kayıt Ip Adresi</td>
				</tr>
				<tr height=30>
					<td colspan="2" valign="top" align="left"><?php echo $KullaniciKayitIpAdresi; ?></td>
				</tr>

				<tr height=30>
					<td colspan="2" align="center">
						<a href="index.php?sk=51" class="GuncelleButonu">Bilgilerimi Güncellemek istiyorum.</a>
						<!-- bu linki buto görğnümğüne getirmek için css ile biçmlendiriyorum style.css de -->
					</td>
				</tr>
				

			</table>
			
		</td>


        <td width="30">
        	&nbsp;
        </td>



		<td width="500" valign="top"> 
		<table width="535" align="center" border="0" cellspacing="0" cellpadding="0">

				<tr height="50">
					<td style="color:#FF9900"><h3>Reklam</h3> 
					</td>
				</tr>
				<tr height=30>
					<td valign="top" style="border-bottom: 1px dashed #CCCCCC;"><b> kahvefincan.com reklamları</b>
					</td>
				</tr>
                
                <tr height=5>
                <td height="5" style="font-size: 5px;">&nbsp;</td>
                </tr>

                <tr>
                	<td><img src="img/reklam.jpg" border="0"></td>
                </tr>


				

				
       

		</table>
		</td>
	</tr>
</table>



<?php
}else{
	header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
	exit();
}

?>