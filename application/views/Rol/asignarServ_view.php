<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script> imagenBoton('botonFiltro', 'ui-icon-search'); $( "#dialog:ui-dialog" ).dialog( "destroy" );</script>
<script>
  $(function() {
    applyPagination();    
  });
</script>
<div id="general">    
    <div id="titulo" class="alinearIzquierda borde_radius_3px separarBordes" >
        <h1><span class="posicitionAbsoluta separarBordes"><?php echo $page_title?></span></h1>
    </div>
    <form id="rol" name="rol" method="POST">
        <div>
            <table id="filtro" class="anchoFiltro borde_radius_3px">
                <tr>                
                    <td class="tamano35"> <?php echo FILTRO_ROL ?>                        
                        <select name="roles">
                            <?php foreach ($roles as $rol):?>
                                <option value="<?php echo $rol->cod_rol ?>"><?php echo $rol->tipo_rol ?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'rol' ,'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/buscarServicios');">Buscar</button>                     
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($numReg != -1){
            if ($numReg == 0){?>
        <div id="SinReg" class="anchoGeneral ui-state-highlight ui-corner-all tamanoMensajes"> 
                <p class='alinearCentro'>
                    <span class='ui-icon ui-icon-notice floatLeft'/>
                    Disculpe no existen servicios disponibles para el rol seleccionado                           
                </p>
        </div>
        <?php }?>        
        <table border="1" cellpadding="0" cellspacing="0" class="anchoTabla borde_radius_3px">
            <thead>
                <tr class="encabezadoFondo alinearCentro">
                        <th class="tamano10"> </th>                        
                        <?php if ($numReg == 0){?> <th> </th> <?php } else {?>
                            <th class="tamano10"><?php echo CODIGO ?></th>
                            <th class="tamano30"><?php echo NOMBRE ?></th>
                            <th class="tamano40"><?php echo DESCRIPCION ?></th>
                            <th class="tamano10"> </th>
                        <?php }?>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($servicio as $serv):?>
                <tr class="alinearCentro fondoTabla">
                    <td><input type="radio" id="eliminarProd" name="eliminarProd" value="<?php echo $serv->cod_servicio ?>" /></td>
                    <td><?php echo sprintf('%03d',$serv->cod_servicio) ?></td>
                    <td><?php echo $serv->nombre_servicio ?></td>
                    <td><?php echo $serv->descr_servicio ?></td>
                    <td>
                        <a><img onclick=" verificaSeleccion('MensajeEliminar', 'rol' , 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/eliminarServRol', <?php echo $serv->cod_servicio ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Delete.ico" /></a>                     
                    </td>
                </tr>
            <?php endforeach;?>
                <input type="hidden" name="rol" value="<?php echo $cod_rol ?>" />
                <?php if($num_serv > 0){ ?>
                    <tr class="alinearCentro fondoTabla">
                        <td>
                            <img onclick="enviarFormPreg('MensajeIngresar', 'rol' ,'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/insertarServRol');" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Add.ico" />                     
                        </td>
                        <td colspan="4">
                            <span class="letraN_13px">Asignar Servicio:</span>
                            <select name="servicios" class="letra_13px">
                                <?php foreach ($servicios as $serv):?>
                                    <option value="<?php echo $serv->cod_servicio ?>"><?php echo $serv->nombre_servicio ?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>                  
                <?php }?>
            </tbody>
        </table>
        <div id="ajax_paging">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </form>
    <div id ="MensajeIngresar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_ASIGANCION ?> servicio al rol?
        </p>
    </div>
    <div id ="MensajeEliminar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_ELIMINAR ?> servicio al rol?
        </p>
    </div>
    <?php }?>     
</div>