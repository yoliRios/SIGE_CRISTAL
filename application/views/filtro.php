<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
        <table id="filtro" class="anchoFiltro">
            <tr>
                <td class="tamano30"> Cédula: 
                    <input type="text" id="cedula" name="cedula" size="20" maxlength="12" onkeypress="return acceptNumPos(event,this, true);" /> 
                </td>                
                <td class="tamano35"> Departamento: 
                                      <input type="text" id="depto" name="depto" /> 
                </td>
                <td class="tamano35 alinearDerecha"> <button id="botonFiltro" class="botonExpande">Buscar</button> </td>
            </tr>
        </table>

