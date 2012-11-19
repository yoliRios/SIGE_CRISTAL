<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script> imagenBoton('botonFiltro', 'ui-icon-search'); $( "#dialog:ui-dialog" ).dialog( "destroy" );</script>
<script>
    $(function() {
        applyPagination();    
    });
    $(function() {
        calendarioDesdeHasta('#fecha_desde','#fecha_hasta','01/09/2012',fechaActual());
    });
</script>
<div id="general">
    <div id="titulo" class="alinearIzquierda borde_radius_3px separarBordes" >
        <h1><span class="posicitionAbsoluta separarBordes"><?php echo $page_title?></span></h1>
    </div>
    <form id="auditoria" name="auditoria" method="POST">
        <input type="hidden" id="indicador" name="indicador" value="R" /> 
        <div>
          <table id="filtro" class="anchoFiltro borde_radius_3px">
                <tr>
                    <td class="tamano20"> <?php echo FILTRO_DESDE ?> 
                        <input type="text" class="letra_Cen_12px cursorPointer" id="fecha_desde" name="fecha_desde" value="<?php if (isset($_POST['fecha_desde'])) echo $_POST['fecha_desde'];?>" size="7" maxlength="10" onclick="this.value='';this.blur();"/> 
                    </td>                                                                                                                   
                    <td class="tamano20"> <?php echo FILTRO_HASTA ?> 
                        <input type="text" class="letra_Cen_12px cursorPointer" id="fecha_hasta" name="fecha_hasta" value="<?php if (isset($_POST['fecha_hasta'])) echo $_POST['fecha_hasta'];?>" size="7" maxlength="10" onclick="this.value='';this.blur();"/>
                    </td>
                    <td class="tamano20"> <?php echo FILTRO_OPERACION ?>
                        <select id="nomb_operacion" name="nomb_operacion" class="letra_Cen_12px cursorPointer" >
                            <?php while (list($i,$valor)= each($operaciones)) {?>
                                    <option value="<?php echo $i ?>"<?php if ($tipo_operacion==$i) echo 'selected="selected"';?> ><?php echo $valor ?></option>                                                 
                            <?php }; ?>     
                        </select> 
                    </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" type="button" class="botonExpande" onclick="verificarBuscarAuditoria('P')">Buscar</button>                     
                    </td>
                </tr>
            </table>
         </div> 
        <div id="error_fecha"class=" ui-state-error ui-corner-all estiloMensaje ocultarCampo">            
            <p> <span class="ui-icon ui-icon-alert floatLeft"></span>
                <strong><?php echo ERROR ?></strong><?php echo ERROR_FECHA_DESDE ?> </p>
        </div>
        <?php if($ind_reporte == 0){?>
            <div id="mensaje_reporte"  class="ui-state-highlight ui-corner-all estiloMensaje" >
                <p><span class="ui-icon ui-icon-info floatLeft"></span>
                    <strong><?php echo ATENCION ?></strong><?php echo MENSAJE_REPORTE ?></p>
            </div>            
        <?php }?> 
        <!-- Se verifica si existen datos de la consulta -->
        <?php if ($num_reg != -1){
                if ($num_reg == 0){?>
                    <div id="SinReg"  class="anchoGeneral ui-state-highlight ui-corner-all tamanoMensajes" >
                        <p class='alinearCentro'><span class="ui-icon ui-icon-notice floatLeft"></span>
                        <?php echo NO_EXISTEN_REGISTROS ?></p>                            
                    </div>
            <?php }else{?>
            <table border="1" cellpadding="" cellspacing="0" class="anchoTabla borde_radius_3px">
                <thead> <!-- Encabezado de la tabla -->
                    <tr class="encabezadoFondo alinearCentro">
                            <th class="tamano20 cursorPointer"><?php echo FECHA ?></th>
                            <th class="tamano20 cursorPointer"><?php echo USUARIO ?></th>
                            <th class="tamano20 cursorPointer"><?php echo OPERACION ?></th>
                            <th class="tamano20 cursorPointer"><?php echo FUNCIONALIDAD ?></th>
                            <th class="tamano20 cursorPointer"><?php echo NUM_REGISTROS ?></th>
                    </tr>
                </thead>
                    <!-- Se recorreo el arreglo que contiene los registros de las operaciones
                    y se van mostrando al usuario-->
                <?php foreach ($registro_operaciones as $reg_oper):?>                
                        <tr class="alinearCentro fondoTabla">                    
                            <td><?php echo date(FECHA_COMPLETA, strtotime($reg_oper->fecha_operacion))?></td>
                            <td><?php echo $reg_oper->usuario ?></td>
                            <td><?php echo $reg_oper->operacion ?></td>
                            <td><?php echo $reg_oper->funcionalidad ?></td>
                            <td><?php echo $reg_oper->cant_registros ?></td>         
                        </tr>                 
                <?php endforeach;?> 
            </table>  
            <div id="ajax_paging">
                <?php echo $paginate; ?>
            </div>
            <script>imagenBoton('botonReporte', 'ui-icon-note');</script>
            <div>
                <button id="botonReporte"  class="botonExpande" onclick="verificarBuscarAuditoria('R');">Reporte</button>                     
            </div>
    </form>     
       <?php } 
     }?>      
</div>
