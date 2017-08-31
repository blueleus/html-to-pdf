<?php 

require('ViewGenerator.php');
require('ConvertHtmlToPdf.php');

$items = array();
for ($i=1; $i < 1800; $i++) { 
  $items[] = [
  'article_id' => $i,
  'description' => 'aqui toy',
  'ref' => 'je*3',
  'url_image' => 'images/renault/image-'.$i.'.jpg',
  'is_import' => false
  ];
}

$data = [
  'mark' => 'renault',
  'records' => [
    [
    'type' => 'motor',
    'items' => $items
    ]
  ]
];

$mark = $data['mark'];
$type = $data['records'][0]['type'];

//var_dump($mark);

$viewGenerator = new ViewGenerator();
$convertHtmlToPdf = new ConvertHtmlToPdf();
$html = $viewGenerator->buildHtml($mark, $type, $items);
//echo $html;
$convertHtmlToPdf->convertToPdf($html, true);