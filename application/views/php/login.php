<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script> imagenBoton('botonFiltro', 'ui-icon-search'); $( "#dialog:ui-dialog" ).dialog( "destroy" );</script>

    <div id="general">
        <form id="login" name="login" method="POST" >
            <table class="anchOTablaLogin borde_radius_3px alinearCentro">
                <tr>
                    <td class="tamano35">
                        Usuario: 
                    </td >
                    <td>
                        <input type="text" name="usuario" class="letra_13px" value="<?php echo set_value('usuario'); ?>" size="10" maxlength="10"/>
                    </td>
                    <td class="letras_Naranjas">
                        <?php echo form_error('usuario'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="tamano35">
                        Contraseña:
                    </td>
                    <td>                        
                        <input type="password" name="password" class="letra_13px" value="" size="10" maxlength="10"/>
                    </td>
                    <td class="letras_Naranjas">                        
                        <?php echo form_error('password'); ?>
                    </td>
                </tr>
            </table>
            <div class="alinearCentro letra_12px">
                <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'login' ,'http://127.0.0.1/SIGE_CRISTAL/inicio/ingresar');">Buscar</button>                     
            </div>
        </form>
	</div>