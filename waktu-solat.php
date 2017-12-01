<?php
    header_remove ('X-Frame-Options');
    libxml_disable_entity_loader(false);
    $curl = curl_init(); 
    curl_setopt ($curl, CURLOPT_URL, "http://www2.e-solat.gov.my/xml/today/index.php?" . $_SERVER['QUERY_STRING']); 
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec ($curl); 
    curl_close ($curl); 
    $xml = simplexml_load_string($result); 
?>
    
    <table align="center" border="0">
      <thead>
      <tr><th colspan="12" align="center"><strong><? echo $xml->channel->title; ?></strong></th></tr>
      <tr><th colspan="12" align="center"><strong><? echo $xml->channel->description; ?></strong></th></tr>
      </thead>
      <tbody>
      <?php foreach ($xml->channel->item as $value) { ?>
          <tr>
          <td align="right" valign="top"> <?php echo $value->title; ?> :</td>
          <td align="left" valign="top">  <?php echo date("g:i a", strtotime($value->description)); ?></td>
          </tr>
      <?php } ?>
      </tbody>
    </table>
