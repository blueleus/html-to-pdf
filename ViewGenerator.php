<?php 


class ViewGenerator
{
  public function buildHtml($mark, $type, $items)
  {
    $items = $this->normalizeItems($items);

/*    $contentTable = '<tr>';
    foreach ($items[0] as $key => $value) {
      $contentTable .= '<td>'.$value['article_id'].'</td>'
                      .'<td>'.$value['description'].'</td>'
                      .'<td>'.$value['ref'].'</td>';
    }
    $contentTable .= '</tr>';

$html = <<<EOD
<table class="table1">
  <thead>
    <tr>
      <th>Articulo</th>
      <th>Descripcion</th>
      <th>Cod. Barras</th>
    </tr>
  </thead>
  <tbody>
  $contentTable
  </tbody>
</table>
EOD;*/

$paginated_array = array_chunk($items[1], 4);
$contentImages = '';

foreach ($paginated_array as $subset)
{
  $contentImages .= '<tr>';
  foreach ($subset as $value) {
    $contentImages .= '<th><div class="box"><img src="'.$value['url_image'].'"/></div></th>';
  }
  $contentImages .= '</tr>';
}

$html = <<<EOD

<style type="text/css">
table td:first-child {
  width: 170px;
}
 
table td:nth-child(2) {
  width: 170px;
}
 
table td:nth-child(3) {
  width: 170px;
}
 
table td:last-child {
  width: 170px;
}
.box {
  height: 170px;
}
img {
  height: 100%;
  width: 100%;
}
</style>
<page>
  <table>
  {$contentImages}
  </table>
</page>
EOD;

    return $html;
  }

  public function normalizeItems($items)
  {
    $itemsOfTable = array();
    $itemsWithImage = array();
    foreach ($items as $item) 
    {
      if($item['url_image']) 
      {
        $itemsWithImage[] = $item;
      }
      else 
      {
        $itemsOfTable[] = $item;
      }
    }
    return array($itemsOfTable, $itemsWithImage);
  }
}