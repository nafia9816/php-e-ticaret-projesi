$(document).ready(function(){ //fonksiyon hazır olduğunda çalışacak

   $.SoruIcerikGoster=function(ElementIDsi){ //soru başlığına tıklandığında cevap açılacak bunu yapıyoruz
     
     var soruId=ElementIDsi;
     var islenecekAlan="#" + ElementIDsi; //id javascripte # ile belirtilir
     
     $(".SoruIcerigi").slideUp(); //slideup açılam alanı yavaşca yukarı kaydırır.
     $(islenecekAlan).parent().find(".SoruIcerigi").slideToggle();

   }

   /* urundetay.php de  kucuk resimlere basınca buyukresmın yerine geçmedi için bunu yazdık*/   
   $.UrunDetayResmiDegistir=function(klasor,resimDegeri){ //alttaki küçük resimlere basınca buyuk alanda görüntülensin
     var ResimIcinDosyaYolu="img/urunler/" + klasor + "/" + resimDegeri; 
     $("#buyukResim").attr("src",ResimIcinDosyaYolu);
     //id si buyuk resim olna tag için src özelliği verdim ve o src özelliğinede tanımladığım yolu verdim
 /* kodların çalışmazsa geçmişi sil oyle çalıştır*/
   }

//alışveriş sepeti ödeme seçimi sırasında hangi si seçildiyse diğerini kapanması için yapılan işlemler
   $.KrediKartiSecildi=function(klasor,resimDegeri){
      $("#kkAlanlari").css("display","block");
      $("#bhAlanlari").css("display","none");
   }
   $.BankaHavalesiSecildi=function(klasor,resimDegeri){
      $("#kkAlanlari").css("display","none");
      $("#bhAlanlari").css("display","block");
   }

   //ufak cihazlar için menu acöma kapam fonksiyonu
   $("#MenuAcilmaAlani").on("click", function(){
        $("#HeaderAcilirMenuButon").slideToggle("slow");
   });

   //sayfa içeriklerinin header ın altında kalmaması(main ve footeriçin) için top değerini hesaplıycaz
   var DokumanGenisligi=$(window).outerWidth();//ejkranın buyukugunu aldım

   if (!$("#HeaderMesajAlani").length) { // kargo bedava kısmı varya orası yoksa diye once kontrol ettim
     if (DokumanGenisligi>=1200) {
        var usttenVerilecekBoslukDegeri=122;// buradada kargo bedava alanı yani header mesaj alanı yoksa diye media queryde yazdıklarma göre 10 10 10 20 düsrek yazdım 93 93 83 63 du query de 
     }else if((DokumanGenisligi>=992) && (DokumanGenisligi<=1199)){
         var usttenVerilecekBoslukDegeri=112;
     }
     else if((DokumanGenisligi>=768) && (DokumanGenisligi<=991)){
        var usttenVerilecekBoslukDegeri=102;
     
     }else if((DokumanGenisligi>=576) && (DokumanGenisligi<=767)){
          var usttenVerilecekBoslukDegeri=92;
     }else if(DokumanGenisligi<=574){
        var usttenVerilecekBoslukDegeri=72;
     }



   }else{
     if (DokumanGenisligi>=1200) {
        var usttenVerilecekBoslukDegeri=215;
     }else if((DokumanGenisligi>=992) && (DokumanGenisligi<=1199)){
         var usttenVerilecekBoslukDegeri=207;// 5 ve 3 menu sınırlamada padding vrmiştm onları dusuyorum yani 8
     }
     else if((DokumanGenisligi>=768) && (DokumanGenisligi<=991)){
        var usttenVerilecekBoslukDegeri=199;
     
     }else if((DokumanGenisligi>=576) && (DokumanGenisligi<=767)){
          var usttenVerilecekBoslukDegeri=191;
     }else if(DokumanGenisligi<=574){
        var usttenVerilecekBoslukDegeri=188;
     }


   }
   $("main").css("top", usttenVerilecekBoslukDegeri);
   $("footer").css("top", usttenVerilecekBoslukDegeri);

   $(window).resize(function(){

   var DokumanGenisligi=$(window).outerWidth();//ejkranın buyukugunu aldım/
   if (!$("#HeaderMesajAlani").length) { //kargo bedava kısmı varya orası yoksa diye once kontrol ettim/
     if (DokumanGenisligi>=1200) {
        var usttenVerilecekBoslukDegeri=122;// buradada kargo bedava alanı yani header mesaj alanı yoksa diye media queryde yazdıklarma göre 10 10 10 20 düsrek yazdım 93 93 83 63 du query de 
     }else if((DokumanGenisligi>=992) && (DokumanGenisligi<=1199)){
         var usttenVerilecekBoslukDegeri=112;
     }
     else if((DokumanGenisligi>=768) && (DokumanGenisligi<=991)){
        var usttenVerilecekBoslukDegeri=102;
     
     }else if((DokumanGenisligi>=576) && (DokumanGenisligi<=767)){
          var usttenVerilecekBoslukDegeri=92;
     }else if(DokumanGenisligi<=574){
        var usttenVerilecekBoslukDegeri=72;
     }
   }else{
     if (DokumanGenisligi>=1200) {
        var usttenVerilecekBoslukDegeri=215;
     }else if((DokumanGenisligi>=992) && (DokumanGenisligi<=1199)){
         var usttenVerilecekBoslukDegeri=207;// 5 ve 3 menu sınırlamada padding vrmiştm onları dusuyorum yani 8
     }
     else if((DokumanGenisligi>=768) && (DokumanGenisligi<=991)){
        var usttenVerilecekBoslukDegeri=199;
     
     }else if((DokumanGenisligi>=576) && (DokumanGenisligi<=767)){
          var usttenVerilecekBoslukDegeri=191;
     }else if(DokumanGenisligi<=574){
        var usttenVerilecekBoslukDegeri=188;
     }


   }
   $("main").css("top", usttenVerilecekBoslukDegeri);
   $("footer").css("top", usttenVerilecekBoslukDegeri);

   });
//input ile submit etmediğimz zaman kullanılan fonksiyonlar.
   $.SepetFormGonder=function(){
      $("#SepetFormu").submit();
   }

  $.SepetOdemeFormGonder=function(){
      $("#SepetOdemeFormu").submit();
   }

   /* anasayfa slayt alanı*/ 
   $(function(){
      var slaytElementi=$(".SlaytAlaniKapsayici");
      var slaytListeElementi=slaytElementi.find(".SlaytAlani");
      var slaytResmiAdedi=slaytListeElementi.find(".SlaytResmi").length;
      var SlaytIciDokumanGenisligi=slaytElementi.outerWidth();
      var ToplamGenislik=slaytResmiAdedi * SlaytIciDokumanGenisligi;
      var resimSirasi=0;
      var kayacakAlan=0;
      slaytListeElementi.find(".SlaytResmi").width(SlaytIciDokumanGenisligi).end().width(ToplamGenislik);
       $(window).resize(function(){
          slaytElementi=$(".SlaytAlaniKapsayici");
          slaytListeElementi=slaytElementi.find(".SlaytAlani");
          slaytResmiAdedi=slaytListeElementi.find(".SlaytResmi").length;
          SlaytIciDokumanGenisligi=slaytElementi.outerWidth();
          ToplamGenislik=slaytResmiAdedi * SlaytIciDokumanGenisligi;
          
          slaytListeElementi.find(".SlaytResmi").width(SlaytIciDokumanGenisligi).end().width(ToplamGenislik).css("margin-left", "-" + (resimSirasi * SlaytIciDokumanGenisligi) + "px");


       });
       $.otomatikDegistir=function(){
         if (resimSirasi < slaytResmiAdedi - 1) {
              resimSirasi++;
              kayacakAlan = "-" + (resimSirasi * SlaytIciDokumanGenisligi) + "px"
         }else{
             resimSirasi=0;
             kayacakAlan=0;
         }
       
       slaytListeElementi.stop().animate({
        marginLeft:kayacakAlan
       }, 500,function(){
          slaytElementi=$(".SlaytAlaniKapsayici");
          slaytListeElementi=slaytElementi.find(".SlaytAlani");
          slaytResmiAdedi=slaytListeElementi.find(".SlaytResmi").length;
          SlaytIciDokumanGenisligi=slaytElementi.outerWidth();
          ToplamGenislik=slaytResmiAdedi * SlaytIciDokumanGenisligi;
          
          slaytListeElementi.find(".SlaytResmi").width(SlaytIciDokumanGenisligi).end().width(ToplamGenislik).css("margin-left", "-" + (resimSirasi * SlaytIciDokumanGenisligi) + "px");
       });
       }
       var slaytOynat=setInterval("$.otomatikDegistir()", 3000);


});




});
   