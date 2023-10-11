
<!-- CONTENT='{"type":"text","auth": {"username":"14421_Promo","password":"EdDpJzdu"}, "sender":"BulkTest", "receiver":"213541035548", "dcs":"GSM",cl"text":"This is test message", "dlrMask":19, "dlrUrl":"http://my-server.com/dlrjson.php"}' -->




<!-- //curl -L "http://rest.sobersys.com" -XPOST -d "CONTENT"; -->


<?php
  curl_setopt_array($sobap, array(
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_URL => "http://rest.sobersys.com -XPOST -d",
 CURLOPT_POSTFIELDS =>'{"type":"text","auth": {"username":"14421_Promo","password":"EdDpJzdu"}, "sender":"BulkTest", "receiver":"213541035548", "dcs":"GSM",cl"text":"This is test message", "dlrMask":19, "dlrUrl":"http://my-server.com/dlrjson.php"}' ,
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_HTTPHEADER => array(
 "accept: application/json",
 "content-type: application/json",
 ),
 ));
 $retour = curl_exec($sobap);
 $erreur =
 curl_error($sobap);
 curl_close($sobap);
