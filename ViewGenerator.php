<?php 


class ViewGenerator
{
  public function buildHtml($mark, $logo, $type, $items)
  {
    $items = $this->normalizeItems($items);

    $contentTable = '';
    foreach ($items[0] as $key => $value) {
      $contentTable .= '<tr><td>'.$value['article_id'].'</td>'
                      .'<td>'.$value['description'].'</td>'
                      .'<td>'.$value['ref'].'</td></tr>';
    }

$subhtml = <<<EOD
<table class="data" align="center">
    <tr>
      <th class="column1">Articulo</th>
      <th class="column2">Descripcion</th>
      <th class="column3">Cod. Barras</th>
    </tr>
  $contentTable
</table>
EOD;

$paginated_array = array_chunk($items[1], 4);
$contentImages = '';

foreach ($paginated_array as $subset)
{
  $contentImages .= '<tr>';
  foreach ($subset as $value) {
    $contentImages .= '<td><div class="box"><img src="'.$value['url_image'].'" class="product"/></div></td>';
  }
  $contentImages .= '</tr>';
}

$html = <<<EOD

<style type="text/css">
  table.images td {
    width: 170px;
  }

  .box {
    height: 170px;
  }

  img.product {
    height: 100%;
    width: 100%;
  }

  img.logo {
    height: 100%;
    width: 100%;
  }

  .titulo {
    background-image: url(./res/fondo_logo.png);
  }

  table.data {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  table.data td, table.data th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
  }

  .column1 {
    width: 80px;
  }

  .column2 {
    width: 350px;
  }

  .column3 {
    width: 150px;
  }

</style>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
  <page_footer>
    <table style="width: 100%; border: solid 1px black;">
      <tr>
        <td style="text-align: left;    width: 50%"></td>
        <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
      </tr>
    </table>
  </page_footer>
  {$subhtml}
  <table class="images">
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