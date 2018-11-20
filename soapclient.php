<?php
  $wsdl = "http://localhost:8080/TTTWebApplication/TTTWebService?wsdl";
  $client = new SoapClient($wsdl, array('trace'=>1));
?>