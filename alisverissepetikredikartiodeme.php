<?php

 if (isset($_SESSION["Kullanici"])) {//kullanıcı girişi varsa bu sayfayı görüntüleyebilsin
     $sepetteki_urunler_sorgusu=$baglan->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC");
    $sepetteki_urunler_sorgusu->execute([$KullaniciId]);

    $sepetteki_urun_sayisi=$sepetteki_urunler_sorgusu->rowCount(); //kayıt varmı
    $sepetteki_urun_kayitlari=$sepetteki_urunler_sorgusu->fetchAll(PDO::FETCH_ASSOC);

                     if ($sepetteki_urun_sayisi>0) {
                        $sepettekiTopUrun=0;
                        $sepettekiTopFiyat=0;
                        $sepettekiTopKargoFiyatHesapla=0;
                        $odenecekTopFiyatHesapla=0;
                       
                        foreach ($sepetteki_urun_kayitlari as $sepet) {
                            //burda bize gerekli olan bilgileri değişkenlere ilk önce atıyoruz bunun içinde once veritabanından bu bilgileri alabilmek için sorgularımızı yazıyoruz
                            $sepetId=$sepet["id"];
                            $sepettekiUrunId=$sepet["UrunId"];
                            $sepettekiVaryantId=$sepet["VaryantId"];
                            $sepettekiUrunAdedi=$sepet["UrunAdedi"];
                            $sepetNumarasi=$sepet["SepetNumarasi"];


                            $UrunBilgileri_sorgusu=$baglan->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
                            $UrunBilgileri_sorgusu->execute([$sepettekiUrunId]);
                            $sepetteki_urun_kaydi=$UrunBilgileri_sorgusu->fetch(PDO::FETCH_ASSOC);

                                $urununFiyati=$sepetteki_urun_kaydi["UrunFiyati"];
                                $urununParaBirimi=$sepetteki_urun_kaydi["ParaBirimi"];
                                $kargoUcreti=$sepetteki_urun_kaydi["KargoUcreti"];
                               

                            if ($urununParaBirimi=="USD") {
                                $tlFiyat=$urununFiyati;//fiyati biçimlendir fonksiyonunda sayıyı , lü yazdırdım hesaplama yaparken , le olan sayılar toplanmadığı için bunu yazdım bunu fiyatları toplamada kullanıcam
                                $tlFiyat=$urununFiyati*$dolarKuru;
                                $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);

                                $UrunTopFiyat=($tlFiyat* $sepettekiUrunAdedi);
                                $UrunTopFiyatBic=fiyatBicimlendir($UrunTopFiyat);


                            }elseif ($urununParaBirimi=="EUR") {
                                $tlFiyat=$urununFiyati*$dolarKuru;
                                $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);

                                $UrunTopFiyat=($tlFiyat* $sepettekiUrunAdedi);
                                $UrunTopFiyatBic=fiyatBicimlendir($UrunTopFiyat);
                            }else{
                                $tlFiyat=$urununFiyati;
                                $tlFiyatBicimlendir=fiyatBicimlendir($tlFiyat);

                                $UrunTopFiyat=($tlFiyat* $sepettekiUrunAdedi);
                                $UrunTopFiyatBic=fiyatBicimlendir($UrunTopFiyat);
                            }

                            $sepettekiTopUrun +=$sepettekiUrunAdedi;
                            $sepettekiTopFiyat +=($tlFiyat * $sepettekiUrunAdedi);

                            $sepettekiTopKargoFiyatHesapla+=($kargoUcreti* $sepettekiUrunAdedi);
                            $sepettekiTopKargoFiyatBic =fiyatBicimlendir($sepettekiTopKargoFiyatHesapla);

                        }
                        if ($sepettekiTopFiyat>=$ucretsizKargo) {

                            $sepettekiTopKargoFiyatHesapla=0;
                            $sepettekiTopKargoFiyatBic =fiyatBicimlendir($sepettekiTopKargoFiyatHesapla);

                            
                            $odenecekTopFiyatHesapla=$sepettekiTopFiyat;
                        }else{
                            $odenecekTopFiyatHesapla=($sepettekiTopFiyat + $sepettekiTopKargoFiyatBic);
                            $odenecekTopFiyatHesaplaBic=fiyatBicimlendir($odenecekTopFiyatHesapla);
                        }

                    
    //sanal pos için
    $clientId=DonusumleriGeriDondur($ClientID);
    $amount=$odenecekTopFiyatHesapla;
    $oid=$sepetNumarasi;
    $okUrl="http://www.kahvefincan.com/alisverissepetikredikartiodemesonuctamam.php";
    $failUrl="http://www.kahvefincan.com/alisverissepetikredikartiodemesonuchata.php";
    $rnd=@microtime();
    $storekey=DonusumleriGeriDondur($StoreKey);
    $storetype="3d";
    $hashstr=$clientId.$oid.$amount.$okUrl.$failUrl.$rnd.$storekey;
    $hash=@base64_encode(@pack('H*',@sha1($hashstr)));
    $description="ürün satışı";
    $xid="";
    $lang="";
    $email="";
    $userid="";
?>

<form action="https://<sunucu_adresi>/3dgate_path" method="post">
    <input type="hidden" name="clientId" value="<?=$clientId?>" />
    <input type="hidden" name="amount" value="<?=$amount?>" />
    <input type="hidden" name="oid" value="<?=$oid?>" />
    <input type="hidden" name="okUrl" value="<?=$okUrl?>" />
    <input type="hidden" name="failUrl" value="<?=$failUrl?>" />
    <input type="hidden" name="rnd" value="<?=$rnd?>" />
    <input type="hidden" name="hash" value="<?=$hash?>" />
    <input type="hidden" name="storetype" value="3d" />
    <input type="hidden" name="lang" value="tr" />
<table width="1065" align="center" cellspacing="0" cellpadding="0">

	<tr>
		<td width="765" valign="top">
			<table width="765" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr height="50">
					<td style="color:#FF9900"><h3>Alışveriş Sepetim</h3> 
					</td>
				</tr>
				<tr height=30>
					<td  valign="top" style="border-bottom: 1px dashed #CCCCCC;">Kredi kartı bilgilerini aşağıdan belirtebilir ve ödeme yapabilirsiniz.
					</td>
				</tr>
                
                <tr height="10"><td style="font-size: 8px;">&nbsp;</td></tr>

                <tr>
                    <td><table width="765" align="center" border="0" cellspacing="0" cellpadding="0">
                        <tr height="45">
                            <td width="200">Kredi Kartı Numarası</td>
                            <td width="565" colspan="4" ><input type="text" name="pan" class="inputAlanlari"></td>
                        </tr>
                        <tr height="45">
                            <td>Son Kullanma Tarihi</td>
                            <td width="100"> <select name="Ecom_Payment_Card_ExpDate_Month" class="selectAlanlari">
                                <option value=""></option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                </select></td>
                                <td width="20" align="center"> - </td>
                                <td width="100"><select name="Ecom_Payment_Card_ExpDate_Year" class="selectAlanlari">
                                    <option value="2013">2013</option>
                                    <option value="2014">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                            </select></td>
                            <td width="345">&nbsp;</td>
                        </tr>
                        <tr height="45">
                            <td>Kart Türü</td>
                            <td colspan="4"><input type="radio" value="1" name="cardType">Visa <input type="radio" value="2" name="cardType">MasterCard</td>
                        </tr>
                        <tr>
                            <td>Güvenlik Kodu</td>
                            <td width="100" colspan="4"><input type="text" name="cv2" value="" class="inputAlanlari"></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr height="45">
                            <td align="center">&nbsp;</td>
                            <td align="left" colspan="4"><input type="submit" value="Ödeme Yap" class="yesilbuton"></td>
                        </tr>
                        
                    </table>
                    </td>
                </tr>
    
        

            </table>   
        </td>
               






        
        <td width="50">
            &nbsp;
        </td>

<!--sağ alan-->
		<td width="270" valign="top"> 
		<table width="270" align="center" border="0" cellspacing="0" cellpadding="0">

				<tr height="50">
					<td style="color:#FF9900" align="left"><h3>Sipariş Özeti</h3> 
					</td>
				</tr>
				<tr height=30>
					<td valign="top" style="border-bottom: 1px dashed #CCCCCC;"><b> Sepetinizde <b style="color: #FF9900;"> <?php echo $sepettekiTopUrun; ?> </b> adet ürün bulunmaktadır.</b>
					</td>
				</tr>
                
                <tr height=5>
                <td height="5" style="font-size: 5px;">&nbsp;</td>
                </tr>

               <tr>
               	<td align="left" style="font-weight: bold;"> Ödenecek Tutar(KDV Dahil)</td>
               </tr>

               <tr>
               	<td align="left" style="font-weight: bold; font-size: 20px; color: #FF9900;"> <?php echo fiyatBicimlendir($odenecekTopFiyatHesapla); ?>TL</td>
               </tr>
               <tr><td>&nbsp;</td></tr>

               <tr>
                <td align="left" style="font-weight: bold;"> Toplam Ürün Fiyatı(KDV Dahil)</td>
               </tr>

               <tr>
                <td align="left" style="font-weight: bold; font-size: 20px; color: #FF9900;"> <?php echo fiyatBicimlendir($sepettekiTopFiyat); ?>TL</td>
               </tr>
               <tr><td>&nbsp;</td></tr>



               <tr>
                <td align="left" style="font-weight: bold;"> Toplam Kargo Ücreti(KDV Dahil)</td>
               </tr>

               <tr>
                <td align="left" style="font-weight: bold; font-size: 20px; color: #FF9900;"> <?php echo $sepettekiTopKargoFiyatBic; ?> TL</td>
               </tr>
               <tr><td>&nbsp;</td></tr>

               


				

				
       

		</table>
		</td>
	</tr>
</table>
</form>


<?php
}else{
    header("Location:index.php");//sepete ulaşamadıysa
    exit();
}
}
else{
    header("Location:index.php");//kargo ve adres seçilmediyse
    exit();
}
/*
}else{
	header("Location:index.php");//kullanıcı yoksa index e atıcak bu sayfaya girmek istediğimde
	exit();
}*/

?>