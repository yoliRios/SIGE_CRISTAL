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
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>application/views/js/empresa.js"></script>
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
                <li><a href="" class="current">Personal</a></li>
                <li><a href="">Pedidos</a></li>
                <li><a href="">Clientes</a></li>
                <li><a href="">Facturas</a></li>
                <li><a href="">Orden de Pago</a></li>
                <li><a href="javascript:abrirHtml('ajaxHTML', '' , 'http://127.0.0.1/SIGE_CRISTAL/Empresa/departamento');" >Departamento</a></li>
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
            <div id="ingresar" class="posicition" style="color: #fff">
                <span id="bienvenida" class="floatLeft">Bienvenido: Suhjail Caldera</span>
                <span id="fecha_hora" class="floatRight">Fecha: <?php echo date("d/m/Y"); ?> Hora: <?php echo date("H:i"); ?></span>
            </div>
            <div id="cuerpoHTML" class="posicition">
                <div id="ajaxHTML" >

                </div>
            </div>
            <div class="cleaner"></div>
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
                <div class="button"><a href="#">More</a></div>
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
