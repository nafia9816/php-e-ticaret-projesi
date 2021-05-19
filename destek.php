 <div id="TamSayfaCerceveAlani">
     <div id="TamSayfaCerceveSinirlamaAlani">
         <div id="TamSayfadaYuzlukAlan">         
            <div id="TamSayfadaAltiCiziliBaslikAlani">
                 <div id="BaslikMetni">SIK SORULAN SORULAR</div>
                 <div id="AltBaslikMetni">Aklınıza takılan sorularınızın cevaplarını bu sayfada cevapladık. Eğer farklı birsorunuz varsa "iletişim" alanından bize ulaşabilirsiniz.</div>
            </div>
            
            <?php
               $soruSorgusu=$baglan->prepare("SELECT * FROM  sorular");
               $soruSorgusu->execute();
               $soruSayisi=$soruSorgusu->rowCount();
               $soruKayitlari=$soruSorgusu->fetchAll(PDO::FETCH_ASSOC);

               foreach ($soruKayitlari as $kayitlar) {     
            ?>
           
            <div class="TamSayfasikSorulanSoru">
             <div id="<?php echo $kayitlar["id"]; ?>"  class="SoruBasligi" onClick="$.SoruIcerikGoster(<?php echo $kayitlar["id"]; ?>)" >
                <?php echo $kayitlar["soru"]; ?>
             </div>
                
             <div class="SoruIcerigi" style="display: none;">
                    <?php echo $kayitlar["cevap"]; ?>
             </div>

            </div>
             <?php
                }
            ?>
         </div>
     </div>
 </div>


<!-- yönetim panelinden sık sorulan soruları girebilmek için buraya veritabanından veri çekicem sorular tablosundan:) -->
               

