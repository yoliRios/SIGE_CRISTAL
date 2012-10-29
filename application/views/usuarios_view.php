<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script> imagenBoton('botonFiltro', 'ui-icon-search'); </script>
<div id="general">
    <div id="titulo" class="encabezado borde_radius_3px" >
        <span class="posicitionAbsoluta separarBordes"><?php echo $page_title?></span>
    </div>
    <div>
        <table id="filtro" class="anchoFiltro">
            <tr>
                <td class="tamano30"> Cédula: 
                    <input type="text" id="cedula" name="cedula" size="20" maxlength="10" onclick="this.value = '';" onkeypress="return acceptNumPos(event,this, true);" /> 
                </td>                
                <td class="tamano35"> Nombre/Apellido: 
                                      <input type="text" id="nombre" name="nombre" onclick="this.value = '';"/> 
                </td>
                <td class="tamano35 alinearDerecha"> <button id="botonFiltro" class="botonExpande">Buscar</button> </td>
            </tr>
        </table>
    </div>
    
</div>

