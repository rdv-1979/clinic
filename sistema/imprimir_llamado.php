<?php
    require('../fpdf/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',8);
    //$pdf->Image('img/logo.png',10,12,30,0,'');
    $fecha = date(':i:s');

    $fecha_actual = "Hoy ".date('d')." de ".date('m').utf8_decode(" del año ").date('Y');
    $hora_actual = date('H')-5;
  
    $pdf->Cell(100,20);
    $pdf->Cell(130,20,$fecha_actual.' '.$hora_actual.''.$fecha,0,1,'C');

    $pdf->SetFont('Arial','I',16);

    $pdf->Cell(55,10);
    $pdf->Cell(75,10,utf8_decode('Código Azul'),1,1,'C');
        
    $pdf->Cell(55,10,"",0,1);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetDrawColor(0,80,180);
    $pdf->SetFillColor(100,34,112);
    $pdf->SetTextColor(45,23,89);
    $pdf->Cell(7,10,"ID",1,0,'C',True);
    $pdf->Cell(30,10,"Tipo",1,0,'C',True);
    $pdf->Cell(20,10,"T-Respuesta",1,0,'C',True);
    $pdf->Cell(30,10,"Fecha",1,0,'C',True);
    $pdf->Cell(25,10,"Area",1,0,'C',True);
    $pdf->Cell(7,10,utf8_decode("N°"),1,0,'C',True);
    $pdf->Cell(18,10,"DNI",1,0,'C',True);
    $pdf->Cell(28,10,"Nombre",1,0,'C',True);
    $pdf->Cell(28,10,"Apellido",1,1,'C',True);

    include('../bd/conectar.php');
    
    $id_l = $_REQUEST['id_l'];

    $sql = mysqli_query($conexion, "SELECT * FROM area a INNER JOIN llamados l ON l.id_area=a.id
                                    INNER JOIN pacientes p ON l.id_paciente=p.id WHERE id_l='$id_l'");
    
    while($datos = mysqli_fetch_array($sql)){
        $pdf->Cell(7,10,$datos['id_l'],1,0,'C');
        $pdf->Cell(30,10,utf8_decode($datos['tipo']),1,0,'C');
        $pdf->Cell(20,10,$datos['t_respuesta'],1,0,'C');
        $pdf->Cell(30,10,$datos['fecha_hora'],1,0,'C');
        $pdf->Cell(25,10,utf8_decode($datos['nombre']),1,0,'C');
        $pdf->Cell(7,10,$datos['numero'],1,0,'C');
        $pdf->Cell(18,10,$datos['dni'],1,0,'C');
        $pdf->Cell(28,10,$datos['nombre_p'],1,0,'C');
        $pdf->Cell(28,10,$datos['apellido_p'],1,1,'C');
    }
   
    $pdf->Output();
?>