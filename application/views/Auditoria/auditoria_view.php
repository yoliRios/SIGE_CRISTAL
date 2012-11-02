<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script> imagenBoton('botonFiltro', 'ui-icon-search'); $( "#dialog:ui-dialog" ).dialog( "destroy" );</script>
<script>
  $(function() {
    aplicarPaginacionAuditoria();    
  });
</script>
<div id="general">
    <div id="titulo" class="alinearIzquierda borde_radius_3px separarBordes" >
        <h1><span class="posicitionAbsoluta separarBordes"><?php echo $page_title?></span></h1>
    </div>
    <form id="auditoria" name="auditoria" method="POST">
        <div>
            <table id="filtro" class="anchoFiltro borde_radius_3px">
                <tr>
                    <td class="tamano30"> Desde: 
                        <input type="text" id="fecha_desde" name="fecha_desde" size="4" maxlength="10" value="<?php echo set_value('fecha_desde'); ?>"/> 
                    </td>                
                    <td class="tamano35"> Hasta: 
                        <input type="text" id="fecha_hasta" name="fecha_hasta" onclick="this.blur" value="<?php echo set_value('fecha_desde'); ?>"/> 
                    </td>
                     <td class="tamano35"> Operación:                       
                        <select id="nomb_operacion" name="nomb_operacion" >
                        <?php while (list($i,$valor)= each($operaciones)) {?>
                            <option value="<?php echo $i ?>"><?php echo $valor ?></option>                                                 
                        <?php } ?>     
                        </select>  
                     </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'auditoria' ,'http://127.0.0.1/SIGE_CRISTAL/Auditoria/Auditoria_controller/consultar_operaciones');">Buscar</button>                     
                    </td>
                </tr>
            </table>
        </div> 
        <!-- Se verifica si existen datos de la consulta -->
        <?php if (num_reg != -1){
            if (num_reg == 0){?>
        <div id="SinReg" class="anchoGeneral tamanoMensajes"> 
                <p class='alinearCentro'>
                    <span class='ui-icon ui-icon-notice floatLeft'/>
                    Disculpe no existen registros disponibles
                </p>
        </div>
        <?php }?>        
        <table border="1" cellpadding="0" cellspacing="0" class="anchoTabla borde_radius_3px">
            <thead> <!-- Encabezado de la tabla -->
                <tr class="encabezadoFondo alinearCentro">
                        <th class="tamano20">Fecha</th>
                        <th class="tamano20">Usuario</th>
                        <th class="tamano20">Operacion</th>
                        <th class="tamano20">Funcionalidad </th>
                        <th class="tamano20">Cant. Registros </th>
                    </tr>
            </thead>
            <tbody>
                <!-- Se recorreo el arreglo que contiene los registros de las operaciones
                y se van mostrando al usuario-->
            <?php foreach (registro_operaciones as $reg_oper):?>
                <tr class="alinearCentro fondoTabla"                    
                    <td><?php echo $reg_oper->fecha_operacion ?></td>
                    <td><?php echo $reg_oper->usuario ?></td>
                    <td><?php echo $reg_oper->operacion ?></td>
                    <td><?php echo $reg_oper->funcionalidad ?></td>
                    <td><?php echo $reg_oper->cant_registros ?></td>         
                </tr>
            <?php endforeach;?>               
            </tbody>
        </table>
        <div id="ajax_paginacion_auditoria">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </form> 
    <?php }?>     
</div>
