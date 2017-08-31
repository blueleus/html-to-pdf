<?php 

require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class ConvertHtmlToPdf
{
  var $savePath = 'pdfs/';

  function __construct($savePath=null)
  {
      //Añadimos la extensión del archivo. Si está vacío el nombre lo creamos 
      if($savePath) 
      {
        $this->savePath .= $savePath.'.pdf';
      }
      else {
        $this->savePath .= $this->createName(10);
      }
  }

  public function convertToPdf($html, $mode)
  {
    if( $html!='' ) 
    {         
      $html2pdf = new Html2Pdf('P', 'A4', 'es');
      $html2pdf->pdf->SetDisplayMode('fullpage');

      ini_set('max_execution_time', 3000);
      $html2pdf->writeHTML($html);

    //Lo guardamos en un directorio y lo mostramos 
    if($mode==true) 
      if( file_put_contents($this->savePath, $html2pdf->output()) ) header('Location: '.$this->savePath); 
    }
  }

  function createName($length) 
  { 
    if( ! isset($length) or ! is_numeric($length) ) $length=6; 

    $str  = "0123456789abcdefghijklmnopqrstuvwxyz"; 
    $name = ''; 

    for($i=1 ; $i<$length ; $i++) 
      $name .= $str{rand(0,strlen($str)-1)}; 

    return $name.'_'.date("d-m-Y_H-i-s").'.pdf';
  } 
}