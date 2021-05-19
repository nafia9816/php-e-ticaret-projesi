 <div id="TamSayfaCerceveAlani">
     <div id="TamSayfaCerceveSinirlamaAlani">
     	<div id="CerceveIciAlaniElliSolAlan">
     		<div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">HAVALE BİLDİRİM FORMU</div>
                 <div id="AltBaslikMetni">Tamamlanmış olduğunuz ödeme işleminizi aşağıdaki formdan bildiriniz.</div>
            </div>

            <form action="index.php?sk=10" method="POST">
            	<div class="FormBaslikMetni">İsim Soyisim (* zorunlu)</div>
            	<div class="FormSatirAlani"><input type="text" name="IsimSoyisim" class="FormTextInputAlani"></div>

            	<div class="FormBaslikMetni">Email Adresi (* zorunlu)</div>
            	<div class="FormSatirAlani"><input type="text" name="MailAdresi" class="FormTextInputAlani">
                    <!-- name adlarını ben verdin db deki kolon adlarınıda verebilirddim o daha kesin işlem olur aslında.:) --></div>

            	<div class="FormBaslikMetni">Telefon Numarası (* zorunlu)</div>
            	<div class="FormSatirAlani"><input type="text" name="telefonNum" maxlength="11" class="FormTextInputAlani"></div>

            	<div class="FormBaslikMetni">Ödeme Yapılan Banka (* zorunlu)</div>
            	<div class="FormSatirAlani">
            		<select name="BankaSecimi" class="FormSelectAlani">
                    <?php /* db deki kayıtlı bankalardan birini seçmek zorunda yani kayıtlı olmayan bir banka tercih edemez.*/
                        $bankalar_sorgusu=$baglan->prepare("SELECT * FROM bankahesaplari ORDER BY bankaAdi ASC");
                        $bankalar_sorgusu->execute();
                        $banka_sayisi=$bankalar_sorgusu->rowCount();
                        $banka_kayitlari=$bankalar_sorgusu->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($banka_kayitlari as $bankalar) { ?>
                    	<option value="<?php echo $bankalar["id"]; ?>"> <?php echo $bankalar["bankaAdi"]; ?> 
                        </option>
                    	<?php } ?>
                    </select>
            	</div>
            	<div class="FormBaslikMetni">Açıklama</div>
            	<div class="FormSatirAlani"> <textarea name="aciklama" class="textAreaAlanlari"></textarea> </div>

            	<div class="ButonKapsamaAlani">
            		<input type="submit" value="Bildirimi Gönder" class="FormYesilButonu">
            	</div>
            </form>
     	</div> <!-- sol alan kapaması -->
        
        <div id="CerceveIciAlaniElliSagAlan">
     		<div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">İŞLEYİŞ</div>
                 <div id="AltBaslikMetni">Havale/EFT İşlemlerinin Kontrolü</div>
            </div>
            <div class="BilgiParagraflariKapsamaAlani">
            	<div class ="BilgiResimleri">
            		<img src="img/bank-1071.png" border="0"><span class="resimYaniBasligi">HAVALE/EFT İŞLEMİ</span>
            	</div>
            	<div class="BilgiAciklamaAlani">
            		Öncelikle, "Banka Hesapları" sayfasında bulunan herhangibir hesaba ödeme işlemini gerçekleştiriniz.
            	</div>
            </div>
             <div class="BilgiParagraflariKapsamaAlani">
            	<div class ="BilgiResimleri">
            		<img src="img/bildirim.png" border="0" ><span class="resimYaniBasligi">BİLDİRİM İŞLEMİ</span>
            	</div>
            	<div class="BilgiAciklamaAlani">
            		Ödeme işleminizi tamamladıktan sonra "Havale Bildirim Formu" sayfasından, yapmış olduğunuz ödeme için bildirim formunu doldurarak tarafımıza gönderiniz.
            	</div>
            </div>
             <div class="BilgiParagraflariKapsamaAlani">
            	<div class ="BilgiResimleri">
            		<img src="img/control.png" border="0" ><span class="resimYaniBasligi">KONTROLLER</span>
                </div>
            	<div class="BilgiAciklamaAlani">
            		Havale bidirim formunuz tarafımıza ulaştığı anda yapmış olduğunuz havale/eft işlemi ilgili banka üzerinden  ve ilgili departman tarafından kontrol edilir.
            	</div>
            </div>
            <div class="BilgiParagraflariKapsamaAlani">
            	<div class ="BilgiResimleri">
            		<img src="img/onayred.png" border="0"><span class="resimYaniBasligi">ONAY/RED</span>
            	</div>
            	<div class="BilgiAciklamaAlani">
            		Havale Bildirimi geçerli ise yani hesaba ödeme geçmiş ise yönetici ilgili ödeme onayını vererek siparişiniz teslimat birimine iletilir.
            	</div>
            </div>
             <div class="BilgiParagraflariKapsamaAlani">
            	<div class ="BilgiResimleri">
            		<img src="img/teslimat.png" border="0"><span class="resimYaniBasligi">TESLİMAT</span>
            	</div>
            	<div class="BilgiAciklamaAlani">
            		Yönetici ödeme onayından sonra sayfanız üzerinden vermiş olduğunuz sipariş en kısa sürede hazırlanarak kargoya teslim edilir ve tarafınıza ulaştırır.
            	</div>
            </div>
     	</div>  <!-- sağ alan kapaması -->

     </div>
 </div>





