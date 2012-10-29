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
    <form id="sucursal" name="sucursal" method="POST">
        <div>
            <table id="filtro" class="anchoFiltro borde_radius_3px">
                <tr>
                    <td class="tamano30"> Código: 
                        <input type="text" id="codigo" name="codigo" size="4" maxlength="10" onclick="this.value = '';" onkeypress="return acceptNumPos(event,this, true);" /> 
                    </td>                
                    <td class="tamano35"> Nombre: 
                        <input type="text" id="nombre" name="nombre" onclick="this.value = '';"/> 
                    </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'sucursal' ,'http://127.0.0.1/SIGE_CRISTAL/empresa/buscarSucursal');">Buscar</button>                     
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($numReg != -1){
            if ($numReg == 0){?>
        <div id="SinReg" class="anchoGeneral tamanoMensajes"> 
                <p class='alinearCentro'>
                    <span class='ui-icon ui-icon-notice floatLeft'/>
                    Disculpe no existen registros disponibles
                </p>
        </div>
        <?php }?>        
        <table border="1" cellpadding="0" cellspacing="0" class="anchoTabla borde_radius_3px">
            <thead>
                <tr class="encabezadoFondo alinearCentro">
                        <th class="tamano10"> </th>
                        <th class="tamano40">Código</th>
                        <th class="tamano40">Nombre</th>
                        <th class="tamano40">Dirección</th>
                        <th class="tamano40">RIF</th>
                        <th class="tamano40">Telefono</th>
                        <th class="tamano40">Email</th>
                        <th class="tamano10"> </th>
                    </tr>
            </thead>
            <tbody>
            <?php foreach ($sucursal as $sucsal):?>
                <tr class="alinearCentro fondoTabla">
                    <td><input type="radio" id="eliminarProd" name="eliminarProd" value="<?php echo $sucsal->cod_sucursal ?>" /></td>
                    <td><?php echo sprintf('%03d',$sucsal->cod_sucursal) ?></td>
                    <td><?php echo $sucsal->nombre_sucursal ?></td>
                    <td><?php echo $sucsal->direccion ?></td>
                    <td><?php echo $sucsal->rif ?></td>
                    <td><?php echo $sucsal->telefono ?></td>
                    <td><?php echo $sucsal->email ?></td>
                    <td>
                        <?php if ($sucsal->cant_reg == 0){ ?>
                            <a><img onclick=" verificaSeleccion('MensajeEliminar', 'sucursal' , 'http://127.0.0.1/SIGE_CRISTAL/empresa/deleteSucursal', <?php echo $sucsal->cod_dpto ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Delete.ico" /></a>                     
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach;?>
                <tr class="alinearCentro fondoTabla">
                    <td>
                        <img onclick="verificarIngresoSucursal('sucursal', 'http://127.0.0.1/SIGE_CRISTAL/empresa/insertSucursal');" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Add.ico" />                     
                    </td>
                    <td>
                        <input type="hidden" id="codigoNew" name="codigoNew" value="<?php echo $ultCod ?>" />
                        <?php echo sprintf('%03d',$ultCod) ?>
                    </td>
                    <td><input type="text" id="nombreSucursal" name="nombreSucursal" size="20" maxlength="20" onclick="this.value = '';"/> </td>
                    <td><input type="text" id="direccion" name="direccion" size="40" maxlength="40" onclick="this.value = '';"/> </td>
                    <td><input type="text" id="rif" name="rif" size="15" maxlength="15" onclick="this.value = '';"/> </td>
                    <td><input type="text" id="telefono" name="telefono" size="11" maxlength="11" onclick="this.value = '';"/> </td>
                    <td><input type="text" id="email" name="email" size="30" maxlength="30" onclick="this.value = '';"/> </td>
                    <td></td>
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
                Disculpe todos los campos deben estar llenos
        </p>
    </div>
    <div id ="MensajeIngresar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Está seguro de ingresar la sucursal?
        </p>
    </div>
    <div id ="MensajeEliminar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Está seguro de Eliminar la sucursal?
        </p>
    </div>
    <?php }?>     
</div>