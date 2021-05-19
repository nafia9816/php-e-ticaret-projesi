<?php
 if (isset($_SESSION["Yonetici"])) {
?>

<body class="nav-md" >
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title">
                <img src="../img/yonetim.jpeg" border="0">
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              
              <div class="profile_info">
                <span>Hoşgeldin,</span>
                <h2><?php echo $YoneticiKullaniciAdi; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="index.php?SKD=0&SKI=0"><i class="fa fa-home"></i> Anasayfa </a></li>
                  <li><a><i class="fa fa-angle-double-right"></i>Havale Bildirimleri<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=115">Kayıtlı Haveleler</a></li>
                      
                    </ul>
                  </li> 
                  <li><a><i class="fa fa-angle-double-right"></i> Siparişler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=105">Bekleyen Siparişler</a></li>
                      <li><a href="index.php?SKD=0&SKI=107">Tamamlanan Siparişler</a></li>
                    </ul>
                  </li>                  
                  <li><a><i class="fa fa-angle-double-right"></i> Ürünler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=93">Ürünler Listesi</a></li> 
                      <li><a href="index.php?SKD=0&SKI=94">Yeni Ürün Ekle</a></li>                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Üyeler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=82">Silinmiş Üyeler</a></li>
                      <li><a href="index.php?SKD=0&SKI=81">Aktif Üyeler</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Menüler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=57"> Menüler Listesi</a></li>
                      <li><a href="index.php?SKD=0&SKI=58"> Yeni Menü Ekle</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Banka Hesap Ayarları<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=9">Kayıtlı Hesaplar</a></li>
                      <li><a href="index.php?SKD=0&SKI=10">Yeni Banka Hesabı Ekle</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Sözleşmeler Ve Metinler<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=5">Sözleşmeler Ve Metinler</a></li>                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Kargo Ayarları<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=21">Anlaşmalı Kargo Firmaları</a></li>  
                      <li><a href="index.php?SKD=0&SKI=22">Yeni Kargo Firması Ekle</a></li>                    
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Banner Ayarları<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=33">Banner Listesi</a></li>  
                      <li><a href="index.php?SKD=0&SKI=34">Yeni Banner Ekle</a></li>                    
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Destek İçerikleri<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=45">Sık Sorulan Sorular</a></li>  
                      <li><a href="index.php?SKD=0&SKI=46">Yeni Destek İçeriği Ekle</a></li>                    
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Yöneticiler<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=69">Yöneticiler Listesi</a></li>  
                      <li><a href="index.php?SKD=0&SKI=70">Yeni Yönetici Ekle</a></li>                    
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i>Yorumlar<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=89">Yorumlar Listesi</a></li>  
                                         
                    </ul>
                  </li>
                  <li><a><i class="fa fa-angle-double-right"></i> Site Ayarları<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?SKD=0&SKI=1">Site Bilgileri</a></li> 

                                     
                    </ul>
                  </li>
                  <li><a href="index.php?SKD=4"><i class="fa fa-angle-double-right"></i>Çıkış<span class="fa fa-chevron-down"></span></a>
              </ul>
              </div>
           </div>
            <!-- /sidebar menu -->            
          </div>
        </div>

        <!-- top navigation üç cizgili menu ıkonu -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles 
          <div class="row tile_count">
            
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Toplam Kullanıcı</span>
              <div class="count">2500</div>
             
            </div>  --> 
             <?php //burda iç sayfaları kontrol edicez.
             if((!$icsayfakoduDegeri) or ($icsayfakoduDegeri=="") or ($icsayfakoduDegeri==0)){ //iç sayfa kodu değeri yoksa
                include($sayfaic[0]); //pano gelcek
              }else{
                include($sayfaic[$icsayfakoduDegeri]);   
              }?>      
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>    
  </body>
</html>
<?php
}else{
  header("Location:index.php?SKD=1");
  exit();
}

  ?>