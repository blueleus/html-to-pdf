<?php

require('ViewGenerator.php');
require('ConvertHtmlToPdf.php');

class PdfGenerator
{
  public function generate($json)
  {
    $data = json_decode($json, true);
    $mark = $data[0];
    foreach ($data[1] as $key => $records) {
      $type = $records[0];
      $items = $records[1];
      $this->toPDF($mark, $type, $items);
    }
  }

  public function toPDF($mark, $type, $items)
  {
    viewGenerator = new ViewGenerator();
    convertHtmlToPdf = new ConvertHtmlToPdf();
    $html = viewGenerator->buildHtml($mark, $type, $items);
    $convertHtmlToPdf->convertToPdf($html, true);
  }
}