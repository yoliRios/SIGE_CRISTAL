<?php

$this->load->library('fpdf');

class Auditoria_PDF extends FPDF
{
   
    function Header()
    {  
        //Fecha de realizacion del reporte
        $fecha = date(FECHA_COMPLETA);
    
        // Arial bold 8
        $this->SetFont('Arial','B',8);      
        $this->Cell(187,10,'El Lugar del Cristal C.A '.$fecha,0,1,'R');
        
        // Arial bold 12
        $this->SetFont('Arial','B',14);
        // Calculamos ancho y posición del título.
        $w = $this->GetStringWidth('Reporte de Auditoría')+6;
        $this->SetX((210-$w)/2); 
        $this->SetTextColor(27,104,166);   
        // Título
        $this->Cell($w,9,iconv('UTF-8', 'windows-1252', 'Reporte de Auditoría'),0,1,'C');
        // Salto de línea
        $this->Ln(8);
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }

    function Footer()
    {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Arial itálica 8
        $this->SetFont('Arial','I',8);
        // Color del texto en gris
        $this->SetTextColor(128);
        // Número de página
        $this->Cell(0,10,'Pag '.$this->PageNo(),0,0,'C');
    }
    
    function SetCol($col)
    {
        // Establecer la posición de una columna dada
        $this->col = $col;
        $x = 10+$col*65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

    function AcceptPageBreak()
    {
        // Método que acepta o no el salto automático de página
        if($this->col<2)
        {
            // Ir a la siguiente columna
            $this->SetCol($this->col+1);
            // Establecer la ordenada al principio
            $this->SetY($this->y0);
            // Seguir en esta página
            return false;
        }
        else
        {
            // Volver a la primera columna
            $this->SetCol(0);
            // Salto de página
            return true;
        }
    }
    
    // Tabla que va a contener los registros
    function crearTabla($header, $regOperaciones)
    {
        // Anchuras de las columnas
        $w = array(35, 35, 35, 45, 38);
       
        // Estableciendo colores y fuentes de las cabeceras  
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(255);
        $this->SetFillColor(27,104,166);

        //Imprimiendo cabeceras
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        
         //Restauración de colores y fuentes para los registros        
        $this->SetFont('Arial','',8);
        $this->SetTextColor(0);
        // Imprimiendo datos
         foreach ($regOperaciones as $regOper) {
            $this->Cell($w[0],6,date(FECHA_COMPLETA, strtotime($regOper->fecha_operacion)),'1','L');
            $this->Cell($w[1],6,$regOper->usuario,'1','L');
            $this->Cell($w[2],6,$regOper->operacion,'1','L');
            $this->Cell($w[3],6,$regOper->funcionalidad,'1','L');
            $this->Cell($w[4],6,$regOper->cant_registros,'1',0,'C');
            $this->Ln();
         }
         // Línea de cierre
         $this->Cell(array_sum($w),0,'','T');
    }
}

   
?>
