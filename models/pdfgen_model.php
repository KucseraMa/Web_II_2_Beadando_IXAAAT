<?php

// autoloader when using Composer

require_once('includes/TCPDF/examples/tcpdf_include.php');


class Pdfgen_Model{


    public function gen_munkalap($vars)

    {

        $connection = Database::getConnection();
        $sql = 'select munkalap.bedatum,munkalap.javdatum,hely.telepules,hely.utca,szerelo.nev,munkalap.munkaora,munkalap.anyagar from munkalap INNER JOIN hely on munkalap.helyaz=hely.az INNER join szerelo on munkalap.szereloaz=szerelo.az where hely.telepules="'.$vars["tel"].'" and utca="'.$vars["ut"].'" and javdatum="'.$vars["jav"].'";';
        $stmt = $connection->query($sql);
        $adat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $retData['eredmeny'] = "OK";

// create new PDF document
        //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
        $pdf->setCreator(PDF_CREATOR);
        $pdf->setAuthor("Plumber");
        $pdf->setTitle('Szerelési Munkalap');
        $pdf->setSubject('Munkalap');
        $pdf->setKeywords('Munkalap,PDF');

// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->setMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/hun.php')) {
            require_once(dirname(__FILE__).'/lang/hun.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------
        var_dump($adat);
// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
        $pdf->setFont('dejavusans', '', 14, '', true);
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        $pdf->SetFont('dejavusans', '', 25);
        $pdf->Ln();
        $pdf->Cell(0,5,"Munkalap",0,false,'C',0, '', 0, false, 'M');
        $pdf->Ln();
        $pdf->SetFont('dejavusans', '', 15);
        $pdf->Cell(55,5,"Bejelentés dátuma:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', '', 15);
        $pdf->SetTextColor(255,0,0);
        $pdf->Cell(35,5,$adat[0]["bedatum"],1,false,'C',0, '', 0);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('dejavusans', '', 15);
        $pdf->Cell(55,5,"Javítás dátuma:",1,false,'L',0, '', 0);
        $pdf->SetTextColor(255,0,0);
        $pdf->Cell(35,5,$adat[0]["javdatum"],1,false,'C',0, '', 0);
        $pdf->SetTextColor(0,0,0);
        $pdf->Ln();
        $pdf->Ln(2);
        $pdf->Cell(180,7,"Megrendelő adatai",1,false,'C',0, '', 0);
        $pdf->Ln();
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(25,5,"Név:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(155,5,"",1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->Cell(25,5,"Település:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(65,5,$adat[0]["telepules"],1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(40,5,"Közterület:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(50,5,$adat[0]["utca"],1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->Cell(25,5,"Telefon:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(65,5,"",1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(25,5,"E-mail:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(65,5,"",1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->Ln(5);
        $pdf->SetFont('dejavusans', '', 15);
        $pdf->Cell(180,7,"Szerelés",1,false,'C',0, '', 0);
        $pdf->Ln();
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(25,5,"Végezte:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(155,5,$adat[0]["nev"],1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->Cell(40,5,"Kiszállás km:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(50,5,"",1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(40,5,"Szerelési idő:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(50,5,$adat[0]["munkaora"],1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->Cell(180,5,"Szerelési megjegyzés",1,false,'C',0, '', 0);
        $pdf->Ln();
        $pdf->Cell(180,50,"",1,false,'L',0, '', 0);
        $pdf->Ln();
        $pdf->Ln(20);


        $kiszallas=5000;
        $oradij=3500;

        $pdf->SetFont('dejavusans', '', 15);
        $pdf->Cell(180,7,"Fizetendő",1,false,'C',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Ln();
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(140,5,"Kiszállási díj:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(40,5,$kiszallas." Ft",1,false,'R',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(140,5,"Munka díj:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(40,5,$oradij." Ft/óra",1,false,'R',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(140,5,"Anyag díj:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(40,5,$adat[0]["anyagar"]." Ft",1,false,'R',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(100,5,"",0,false,'L',0, '', 0);
        $pdf->Cell(40,5,"Összesen:",1,false,'L',0, '', 0);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(40,5,$kiszallas+$adat[0]["anyagar"]+$adat[0]["munkaora"]*$oradij." Ft",1,false,'R',0, '', 0);
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Ln();



        ob_end_clean();
        $pdf->Output('Plr.pdf', 'I');

    }


}
class MYPDF extends TCPDF {

    //Page header
    public function Header() {



        // Set font
        $this->SetFont('dejavusans', 'B', 30);


    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'oldal '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
