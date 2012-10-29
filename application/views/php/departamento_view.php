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
                    <td class="tamano30"> Código: 
                        <input type="text" id="codigo" name="codigo" size="4" maxlength="10" onclick="this.value = '';" onkeypress="return acceptNumPos(event,this, true);" /> 
                    </td>                
                    <td class="tamano35"> Nombre: 
                        <input type="text" id="nombre" name="nombre" onclick="this.value = '';"/> 
                    </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'departamento' ,'http://127.0.0.1/SIGE_CRISTAL/empresa/buscarDepartamento');">Buscar</button>                     
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
                        <th class="tamano10"> </th>
                    </tr>
            </thead>
            <tbody>
            <?php foreach ($departamento as $dpto):?>
                <tr class="alinearCentro fondoTabla">
                    <td><input type="radio" id="eliminarProd" name="eliminarProd" value="<?php echo $dpto->cod_dpto ?>" /></td>
                    <td><?php echo sprintf('%03d',$dpto->cod_dpto) ?></td>
                    <td><?php echo $dpto->nombre_dpto ?></td>
                    <td>
                        <?php if ($dpto->cant_reg == 0){ ?>
                            <a><img onclick=" verificaSeleccion('MensajeEliminar', 'departamento' , 'http://127.0.0.1/SIGE_CRISTAL/empresa/deleteDpto', <?php echo $dpto->cod_dpto ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Delete.ico" /></a>                     
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach;?>
                <tr class="alinearCentro fondoTabla">
                    <td>
                        <img onclick="verificarIngresoDpto('departamento', 'http://127.0.0.1/SIGE_CRISTAL/empresa/insertDpto');" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Add.ico" />                     
                    </td>
                    <td>
                        <input type="hidden" id="codigoNew" name="codigoNew" value="<?php echo $ultCod ?>" />
                        <?php echo sprintf('%03d',$ultCod) ?>
                    </td>
                    <td><input type="text" id="nombreDPTO" name="nombreDPTO" size="40" maxlength="40" onclick="this.value = '';"/> </td>
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
                Disculpe el campo nombre debe estar lleno
        </p>
    </div>
    <div id ="MensajeIngresar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Está seguro de ingresar el departamento?
        </p>
    </div>
    <div id ="MensajeEliminar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Está seguro de Eliminar el departamento?
        </p>
    </div>
    <?php }?>     
</div>