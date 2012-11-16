<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<?php header('Access-Control-Allow-Origin: *'); ?>
<div id="menu">    
    <div class="alinearIzquierda">        
        <ul id="subMenu" >
            <?php foreach ($subMenu as $m): ?>
                <li id="opcion" value="<?php echo $m->cod_servicio ?>"><a href="javascript:abrirHtml('ajaxHTML', '' , 'http://127.0.0.1/SIGE_CRISTAL/<?php echo $m->ruta ?>');"><?php echo $m->nombre_servicio ?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
</div>