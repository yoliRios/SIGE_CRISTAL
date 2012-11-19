<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">    
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>El Lugar del Cristal</title>
    <meta name="keywords" content="eye candy, free website template, CSS, HTML" />
    <meta name="description" content="Eye Candy - free website template using blue and dark gray background. This layout includes a Flash XML Slider." />
    <link href="<?php echo base_url(); ?>application/views/css/templatemo_style.css" rel="stylesheet" type="text/css" />  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/views/css/estilosJquery/jquery-ui.custom.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>application/views/js/swfobject.js"></script>
    <script type="text/javascript">
            var flashvars = {};
            flashvars.xml_file = "<?php echo base_url(); ?>application/views/photo_list.xml";
            var params = {};
            params.wmode = "transparent";
            var attributes = {};
            attributes.id = "slider";
            swfobject.embedSWF("<?php echo base_url(); ?>application/views/flash_slider.swf", "flash_grid_slider", "940", "280", "9.0.0", false, flashvars, params, attributes);
    </script>                    
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery.min.js"></script>  
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>application/views/js/general.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>application/views/js/inicio.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>application/views/js/jquery-ui.custom.min.js"></script>
</head>
<body>

<div id="templatemo_wrapper">

	<div id="templatemo_header">

        <div id="site_title" >
          <h1><a href="http://www.templatemo.com/page/1" target="_parent"> <img src="<?php echo base_url(); ?>application/views/images/templatemo_logo.png" alt="Eye Candy" /> </a></h1>
        </div>
    
    </div> <!-- end of header -->
    
    <div id="templatemo_menu">
    
        <ul>
            <li><a href="javascript:abrirHtml('ajaxHTML', '' , 'http://127.0.0.1/SIGE_CRISTAL/inicio/cargaLogin');" class="current">Inicio</a></li>
            <li><a href="">Empresa</a></li>
            <li><a href="">Productos</a></li>
            <li><a href="">Galería</a></li>
            <li><a href="" class="last">Contacto</a></li>
        </ul>    	
    
    </div> <!-- end of templatemo_menu -->
 	<div id="templatemo_slider">
			<div id="flash_grid_slider">
            	<a href="http://www.flashmo.com/preview/flashmo_224_grid_slider" target="_blank">
                	Flash XML Grid Slider
                </a>
                <br /><br />
                <a href="http://www.adobe.com/go/getflashplayer">
                    <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                </a>
			</div>
    </div> <!-- end of slider -->
    
    <div id="templatemo_content">
    	
        <h1>EL Lugar del Cristal</h1>
        <div class="image_wrapper fl_img">
	        <a href="http://www.templatemo.com"><img src="<?php echo base_url(); ?>application/views/images/templatemo_image_01.jpg" alt="image 1" /></a>        </div>
        <p align="justify">El Lugar Del Cristal o Grupo Cristal es una compañía familiar creada en el año 1.999 con el propósito de 
		satisfascer las necesidades de cada uno de nuestros clientes, diseñando sus ideas y gustos más exigentes con la mejor calidad 
		y servicio que usted merece. Somos una cadena de mueblerías con 4 tiendas, con la selección de muebles más amplia y estilos a la vanguardia de la moda.</p>
        <p align="justify">El Lugar Del Cristal ofrece a sus clientes facilidades de pago, así como los precios más bajos del mercado.</p>
      <div class="cleaner_h40"></div>
        
		<div class="two_column float_l">
        
        	<ul class="small_gallery">
            
            	<li><a href="#"><img src="images/templatemo_image_02.jpg" alt="image 2" /></a></li>
                
                <li><a href="#"><img src="images/templatemo_image_03.jpg" alt="image 3" /></a></li>
                
                <li><a href="#"><img src="images/templatemo_image_04.jpg" alt="image 4" /></a></li>
                
                <li><a href="#"><img src="images/templatemo_image_05.jpg" alt="image 5" /></a></li>
                
                <li><a href="#"><img src="images/templatemo_image_06.jpg" alt="image 6" /></a></li>
                
                <li><a href="#"><img src="images/templatemo_image_07.jpg" alt="image 7" /></a></li>
                
            </ul>
            
            <div class="cleaner_h30"></div>
            <div class="button"><a href="#">Ver más</a></div>
	</div>
		

	<div class="two_column float_r">
        
       	  <h3>Web Design Ideas</h3>
        	<p>In ac libero urna. Suspendisse sed odio ut mi auctor blandit. Duis luctus nulla metus, a vulputate mauris.</p>
            
            <ul>
                <li>Morbi sed nulla ac est cursus <a href="#">suscipit</a> eu ac lectus.</li>
                <li>Curabitur <a href="#">ullamcorper</a> nibh nisi, sed eleifend dolor. </li>
                <li>Pellentesque adipiscing <a href="#">sollicitudin</a> sapien nec aliquet.</li>
                <li>Cras rutrum ullamcorper metus,<a href="#"> vitae consectetur</a>.</li>
                <li>Sed nec eros <a href="#">egestas</a> nisl tincidunt aliquet at in est.</li>
            </ul>
        
        </div>
    	<div class="cleaner"></div>
		
		<div id="cuerpoHTML" class="posicition">
                <div id="ajaxHTML" >

                </div>
        </div>
	</div> <!-- end of content --> 
</div> <!-- end of wrapper -->

<div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    
    	<div class="footer_box">
        
        	<h3>Redes Sociales</h3>
        
            <ul class="footer_menu">
                <li><a href="http://www.templatemo.com" target="_parent">Facebook</a></li> 
                <li><a href="http://www.flashmo.com" target="_parent">Twitter</a></li>             

		   </ul>
        
        </div>
        
        <div class="footer_box">
            
                <h3>Navegación</h3>
    
                <ul class="footer_menu">
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="news.html">Empresa</a></li>
                    <li><a href="gallery.html">Productos</a></li>
                    <li><a href="about.html">Galería</a></li>
                  	<li><a href="contact.html">Contacto</a></li>
				</ul>

		</div>
        
        <div class="footer_box">
        
              <h3>Visítenos</h3>
    			
                <p> El Lugar Del Cristal diseña sus ideas y gustos más exigentes, con la mejor calidad y servicio que usted merece.</p>
                <p> ¡Sólo venga visítenos y compruébelo!</p>
		</div>
	
    	<div class="cleaner"></div>
		

    </div> <!-- end of footer -->
</div> <!-- end of footer wrapper -->    

<div id="templatemo_copyright_wrapper">

	<div id="templatemo_copyright">
    
		Copyright © 2012 <a href="#">El Lugar del Cristal, C.A.</a> | 
						 <a>RIF: J-00002961-0.</a> | 
						 <a>Todos los derechos reservados</a>
    </div> <!-- end of templatemo_copyright -->
    
</div> <!-- end of copyright wrapper -->

</body>
</html>
