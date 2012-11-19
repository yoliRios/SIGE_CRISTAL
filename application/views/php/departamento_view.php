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
    <form id="departamento" name="departamento" method="POST">
        <div>
            <table id="filtro" class="anchoFiltro borde_radius_3px">
                <tr>
                    <td class="tamano30"> <?php echo FILTRO_CODIGO ?> 
                        <input type="text" id="codigo" name="codigo" size="4" maxlength="10" value="<?php if (isset($_POST['codigo'])) echo $_POST['codigo'];?>" onclick="this.value = '';" onkeypress="return acceptNumPos(event,this, true);" /> 
                    </td>                
                    <td class="tamano35"> <?php echo FILTRO_NOMBRE ?> 
                        <input type="text" id="nombre" name="nombre" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>" onclick="this.value = '';"/> 
                    </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'departamento' ,'http://127.0.0.1/SIGE_CRISTAL/empresa/buscarDepartamento');">Buscar</button>                     
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($numReg != -1){
            if ($numReg == 0){?>
        <div id="SinReg" class="anchoGeneral ui-state-highlight ui-corner-all tamanoMensajes"> 
                <p class='alinearCentro'>
                    <span class='ui-icon ui-icon-notice floatLeft'/>
                    <?php echo NO_EXISTEN_REGISTROS ?></p>            
                </p>
        </div>
        <?php }?>        
        <table border="1" cellpadding="0" cellspacing="0" class="anchoTabla borde_radius_3px">
            <thead>
                <tr class="encabezadoFondo alinearCentro">
                        <th class="tamano10"> </th>
                        <th class="tamano10"><?php echo CODIGO ?></th>
                        <th class="tamano40"><?php echo NOMBRE ?></th>
                        <th class="tamano10"><?php echo ESTADO ?></th>
                        <th class="tamano10"><?php echo MOD ?></th>
                        <th class="tamano10"><?php echo DESAC ?></th>
                    </tr>
            </thead>
            <tbody>
            <?php foreach ($departamento as $dpto):?>
                <tr class="alinearCentro fondoTabla">
                    <input type="hidden" id="seleccion" />
                    <td><input type="radio" id="eliminarProd" name="eliminarProd" value="<?php echo $dpto->cod_dpto ?>" onclick="verificaSeleccionModDpto('<?php echo $dpto->cod_dpto ?>', '<?php echo $dpto->estado ?>');" /></td>
                    <td><?php echo sprintf('%03d',$dpto->cod_dpto) ?></td>
                    <td>
                        <label id="nombreDptoL<?php echo $dpto->cod_dpto ?>"><?php echo $dpto->nombre_dpto ?></label>                   
                        <input type="text" id="nombreDpto<?php echo $dpto->cod_dpto ?>" name="nombreDpto<?php echo $dpto->cod_dpto ?>" class="ocultarCampo" size="40" maxlength="40" value="<?php echo $dpto->nombre_dpto ?>" />
                    </td>
                    <td>
                        <label id="estadoL<?php echo $dpto->cod_dpto ?>"><?php echo $dpto->estado == 'E' ? 'Inactivo' : 'Activo' ?> </label>                   
                        <select id="estado<?php echo $dpto->cod_dpto ?>" name="estado<?php echo $dpto->cod_dpto ?>" class="letra_13px ocultarCampo">
                            <option value="A">Activo</option>
                        </select>
                    </td>
                    <td>
                        <a><img onclick=" verificaSeleccion('MensajeModificar', 'departamento' , 'http://127.0.0.1/SIGE_CRISTAL/empresa/modificarDpto', <?php echo $dpto->cod_dpto ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Write Document.ico" /></a>                     
                    </td>
                    <td>
                        <?php if ($dpto->cant_reg == 0 && $dpto->estado == 'A'){ ?>
                            <a><img onclick=" verificaSeleccion('MensajeEliminar', 'departamento' , 'http://127.0.0.1/SIGE_CRISTAL/empresa/desactivarDpto', <?php echo $dpto->cod_dpto ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Delete.ico" /></a>                     
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach;?>
                <tr class="alinearCentro fondoTabla">
                    <td>
                        <img onclick="verificarIngresoDpto('departamento', 'http://127.0.0.1/SIGE_CRISTAL/empresa/insertarDpto');" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Add.ico" />                     
                    </td>
                    <td>
                        <input type="hidden" id="codigoNew" name="codigoNew" value="<?php echo $ultCod ?>" />
                        <?php echo sprintf('%03d',$ultCod) ?>
                    </td>
                    <td><input type="text" id="nombreDPTO" name="nombreDPTO" size="40" maxlength="40" onclick="this.value = '';"/> </td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
        <div id="ajax_paging">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </form>
    <div id ="MensajeError" title="Verifique nombre" class="anchoGeneral tamanoMensajes ocultarCampo">
        <p class='alinearCentro '>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Disculpe el campo nombre debe estar lleno
        </p>
    </div>
    <div id ="MensajeIngresar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_INGRESO ?> departamento?
        </p>
    </div>
    <div id ="MensajeModificar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_ACTUALIZAR ?> departamento?
        </p>
    </div>
    <div id ="MensajeEliminar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
            <?php echo MENSAJE_ELIMINAR ?> departamento?
        </p>
    </div>
    <?php }?>     
</div>