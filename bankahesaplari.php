 <div id="TamSayfaCerceveAlani">
     <div id="TamSayfaCerceveSinirlamaAlani">
         <div id="TamSayfadaYuzlukAlan">
            <div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">BANKA HESAPLARI</div>
                 <div id="AltBaslikMetni">Ödeme işlemleri çin çalışmakta olduğumuz tüm banka hesap bilgileri aşağıda yer almaktadır.</div>
            </div>
            <div id="BankaHesaplariAlani">                 
                <?php
                   $banka_sorgu=$baglan->prepare("SELECT * FROM bankahesaplari");
                   $banka_sorgu->execute();
                   $banka_sayi=$banka_sorgu->rowCount();
                   $banka_kayitlari=$banka_sorgu->fetchAll(PDO::FETCH_ASSOC);

                   foreach ($banka_kayitlari as $kayit) {
                ?>
                    <div id="BankaHesabiSinirlama">
                        <div id="BankaHesabiLogoAlani">
                          <img src="img/<?php echo DonusumleriGeriDondur($kayit["banka_logo"]); ?>" border="0">
                        </div>

                        <table class="BankaHesaplariTablosu" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" class="BaslikMetniSutunu"> Banka Adı</td>
                                <td align="left" valign="top" class="IkiNoktaSutunu">: </td>
                                <td align="left" valign="top" class="IcerikMetniSutunu"><?php echo DonusumleriGeriDondur($kayit["bankaAdi"]); ?></td>
                                </tr>
                            </tr>
                            <tr>
                                <td align="left" valign="top" class="BaslikMetniSutunu">Konum</td>
                                <td align="left" valign="top" class="IkiNoktaSutunu">: </td>
                                <td align="left" valign="top" class="IcerikMetniSutunu">
                                    <?php echo DonusumleriGeriDondur($kayit["konumSehir"]); ?> / <?php echo DonusumleriGeriDondur($kayit["konumUlke"]); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" class="BaslikMetniSutunu"> Şube</td>
                                <td align="left" valign="top" class="IkiNoktaSutunu">: </td>
                                <td align="left" valign="top" class="IcerikMetniSutunu">
                                    <?php echo DonusumleriGeriDondur($kayit["subeAdi"]); ?> /  <?php echo DonusumleriGeriDondur($kayit["subeKodu"]); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" class="BaslikMetniSutunu"> Para Birimi</td>
                                <td align="left" valign="top" class="IkiNoktaSutunu">: </td>
                                <td align="left" valign="top" class="IcerikMetniSutunu">
                                    <?php echo DonusumleriGeriDondur($kayit["paraBirimi"]); ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" class="BaslikMetniSutunu"> Hesap Bilgileri</td>
                                <td align="left" valign="top" class="IkiNoktaSutunu">: </td>
                                <td align="left" valign="top" class="IcerikMetniSutunu">
                                    <?php echo DonusumleriGeriDondur($kayit["hesapSahibi"]); ?> | <?php echo DonusumleriGeriDondur($kayit["hesapNum"]); ?>
                                </td>
                                
                            </tr>
                            <tr>
                                <td align="left" valign="top" class="BaslikMetniSutunu">IBAN</td>
                                <td align="left" valign="top" class="IkiNoktaSutunu">: </td>
                                 <td align="left" valign="top" class="IcerikMetniSutunu"><?php echo IbanBicimlendir(DonusumleriGeriDondur($kayit["ibanNum"])); ?></td>
                            </tr>
                                
                            </tbody>
                        </table>
                
                    </div>
                     <?php } ?>
             </div>
         
     </div>
 </div>

</div>


