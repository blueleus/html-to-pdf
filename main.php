<?php 

require('ViewGenerator.php');
require('ConvertHtmlToPdf.php');

$items = array();
for ($i=1; $i < 50; $i++) { 
  $items[] = [
  'article_id' => $i,
  'description' => 'aqui toy',
  'ref' => 'je*3',
  'url_image' => 'images/renault/image-'.$i.'.jpg',
  'is_import' => false
  ];
}

for ($i=1; $i < 50; $i++) { 
  $items[] = [
  'article_id' => $i,
  'description' => 'aqui toy y que',
  'ref' => 'ji*3',
  'url_image' => '',
  'is_import' => false
  ];
}

$data = [
  'mark' => 'renault',
  'logo' => 'images/renault/tomorrowland.png',
  'records' => [
    [
    'type' => 'motor',
    'items' => $items
    ]
  ]
];

$mark = $data['mark'];
$logo = $data['logo'];
$type = $data['records'][0]['type'];

$viewGenerator = new ViewGenerator();
$convertHtmlToPdf = new ConvertHtmlToPdf();
$html = $viewGenerator->buildHtml($mark, $logo, $type, $items);
//echo $html;
$convertHtmlToPdf->convertToPdf($html, true);