<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script> imagenBoton('botonFiltro', 'ui-icon-search'); $( "#dialog:ui-dialog" ).dialog( "destroy" );</script>
<script>
  $(function() {
    applyPagination();    
  });
</script>
<div id="general">    
    <div class="alinearIzquierda">        
        <ul id="subMenu" >
            <li><a href="javascript:abrirHtml('ajaxHTML', '' , 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/rol');">Crear Roles</a></li>
            <li><a href="javascript:abrirHtml('ajaxHTML', '' , 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/servicio');" >Asignar Servicios</a></li>
            <li><a href="javascript:abrirHtml('ajaxHTML', '' ,'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/usuario');" >Asignar Roles</a></li>
        </ul>
    </div>
    <div id="titulo" class="alinearIzquierda borde_radius_3px separarBordes" >
        <h1><span class="posicitionAbsoluta separarBordes"><?php echo $page_title?></span></h1>
    </div>
    <form id="rolUser" name="rolUser" method="POST">
        <div>
            <table id="filtro" class="anchoFiltro borde_radius_3px">
                <tr>    
                    <td class="tamano30"> Cédula: 
                        <input type="text" id="cedula" name="cedula" size="10" maxlength="10" onclick="this.value = '';" onkeypress="return acceptNumPos(event,this, true);" /> 
                    </td>                
                    <td class="tamano35"> Usuario: 
                        <input type="text" id="user" name="user" onclick="this.value = '';"/> 
                    </td>
                    <td class="tamano35 alinearDerecha"> 
                        <button id="botonFiltro" class="botonExpande" onclick="abrirHtml('ajaxHTML', 'rol' ,'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/buscarRolUser');">Buscar</button>                     
                    </td>
                </tr>
            </table>
        </div>
        <?php if ($numReg != -1){
            if ($numReg == 0){?>
        <div id="SinReg" class="anchoGeneral tamanoMensajes"> 
                <p class='alinearCentro'>
                    <span class='ui-icon ui-icon-notice floatLeft'/>
                    Disculpe no existen servicios disponibles para la consulta
                </p>
        </div>
        <?php }?>        
        <table border="1" cellpadding="0" cellspacing="0" class="anchoTabla borde_radius_3px">
            <thead>
                <tr class="encabezadoFondo alinearCentro">
                        <th class="tamano10"> </th> 
                            <th colspan="2" class="tamano10">Cédula</th>
                            <th class="tamano20">Nombre</th>
                            <th class="tamano20">Apellido</th>
                            <th class="tamano10">Usuario</th>
                            <th class="tamano20">Rol</th>
                            <th class="tamano5">Estado</th>
                            <th class="tamano10">Mod</th>
                            <th class="tamano10">Desac</th>
                    </tr>
            </thead>
            <tbody>
            <?php foreach ($userRol as $user):?>
                <tr class="alinearCentro fondoTabla">
                    <input type="hidden" id="seleccion" />
                    <td><input type="radio" id="eliminarProd" name="eliminarProd" value="<?php echo $user->cod_usuario ?>" onclick="verificaSeleccionModUser('<?php echo $user->cod_usuario ?>', '<?php echo $user->estado ?>');"/></td>
                    <td colspan="2"><?php echo $user->cedula ?></td>
                    <td><?php echo $user->nombre ?></td>
                    <td><?php echo $user->apellido ?></td>
                    <td><?php echo $user->usuario ?></td>
                    <td>
                        <label id="rolEmpL<?php echo $user->cod_usuario ?>"><?php echo $user->tipo_rol ?> </label>                   
                        <select id="rolEmp<?php echo $user->cod_usuario ?>" name="rolEmp<?php echo $user->cod_usuario ?>" class="letra_13px ocultarCampo">
                            <?php foreach ($roles as $rol):?>
                                <option value="<?php echo $rol->cod_rol ?>"><?php echo $rol->tipo_rol ?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <label id="estadoL<?php echo $user->cod_usuario ?>"><?php echo $user->estado == 'E' ? 'Inactivo' : 'Activo' ?> </label>                   
                        <select id="estado<?php echo $user->cod_usuario ?>" name="estado<?php echo $user->cod_usuario ?>" class="letra_13px ocultarCampo">
                            <option value="A">Activo</option>
                        </select>
                    </td>
                    <td>
                        <a><img onclick=" verificaSeleccion('MensajeModificar', 'rolUser' , 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/updateUserRol', <?php echo $user->cod_usuario ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Write Document.ico" /></a>                     
                    </td>
                    <td>
                        <?php if ($user->estado == 'A'){ ?>
                            <a><img onclick=" verificaSeleccion('MensajeEliminar', 'rolUser' , 'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/deleteUserRol', <?php echo $user->cod_usuario ?>)" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Delete.ico" /></a>                     
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach;?>
            <?php if($num_emp > 0){ ?>
                <tr class="alinearCentro fondoTabla">
                    <td>
                        <img id="ingreso" onclick="enviarFormPreg('MensajeIngresar', 'rolUser' ,'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/insertUserRol');" class="tamano_botones cursorPointer ocultarCampo" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Add.ico" />                     
                    </td>
                    <td>
                        <select id="ced" name="ced" class="letra_13px">
                            <?php foreach ($cedulas as $ced):?>
                                <option value="<?php echo $ced->cedula ?>"><?php echo $ced->cedula ?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <img onclick="buscarEmpleado('rolUser' ,'http://127.0.0.1/SIGE_CRISTAL/Rol/Rol_Controller/buscarEmp');" class="tamano_botones cursorPointer" src="http://127.0.0.1/SIGE_CRISTAL/application/views/img/iconos/Search.ico" />                     
                    </td>
                <td>
                    <label id="nombreEmp"></label>
                </td>
                <td>
                    <label id="apellidoEmp"></label>
                </td>
                <td>
                    <label id="usuarioEmp" name="usuarioEmp"></label>
                </td>
                <td>
                    <select id="rolesEmp" name="rolesEmp" class="letra_13px ocultarCampo">
                        <?php foreach ($roles as $rol):?>
                            <option value="<?php echo $rol->cod_rol ?>"><?php echo $rol->tipo_rol ?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                </td>
                <td></td>
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
                Está seguro de crear el usuario?
        </p>
    </div>
    <div id ="MensajeEliminar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Está seguro de Desactivar el usuario?
        </p>
    </div>
    <div id ="MensajeModificar" title="Pregunta" class="anchoGeneral tamanoMensajes ocultarCampo ">
        <p class='alinearCentro'>
            <span class='ui-icon ui-icon-notice floatLeft'/>
                Está seguro de Modificar el rol del usuario?
        </p>
    </div>
    <?php }?>     
</div>