<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["certificado"])) {
    $html = $_POST["certificado"];

    // Generar un nombre único para el archivo PDF
    $pdfFileName = "Certificado_" . date("Ymd_His") . ".pdf";

    // Configurar las cabeceras para indicar que el contenido es un archivo PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');

    // Convertir el HTML a PDF y enviarlo al navegador
    require 'vendor/autoload.php'; // Asegúrate de incluir la biblioteca necesaria para convertir HTML a PDF (puedes usar TCPDF o mPDF)

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output();

    exit();
} else {
    // Redirigir a una página de error si no se reciben los datos correctamente
    header("Location: error.php");
    exit();
}
