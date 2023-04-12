<?php
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

ob_start();
include(dirname('__FILE__').'includes/lap.php');
$content = ob_get_clean();

try
{
    $html2pdf = new HTML2PDF('P', 'Legal', 'fr', true, 'UTF-8', array(20, 20, 20, 20));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('asesmen.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}