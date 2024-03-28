<?php
   include 'afficher_lots.php';
   $xml = new DOMDocument('1.0', 'utf-8');
   $tag = $xml->createElement('items',$options);
   $xml->appendChild($tag);
   echo $xml->saveXML();
?>