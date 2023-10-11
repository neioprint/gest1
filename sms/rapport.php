<?php
$sobap = curl_init();
curl_setopt_array($sobap, array(
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_URL => "https://api.sobersys.com/sms/1/reports",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array(
"accept: application/json",
"content-type: application/json",
"authorization:Basic bmVpbzpAQEBOMzEwcHJpbnQ="
),
));
$retour = curl_exec($sobap);
$erreur = curl_error($sobap);
curl_close($sobap);
if ($erreur) {echo "ERREUR: " . $erreur;}
else {echo $retour;}
?> 



<!-- {"results":[{"messageId":"31312246549203574542","to":"213558028352","from":"NEIOPrint","sentAt":"2021-02-12T09:34:25.557+0000","doneAt":"2021-02-12T09:34:33.246+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"messageId":"31312257925503574100","to":"213770416421","from":"NEIOPrint","sentAt":"2021-02-12T09:36:19.377+0000","doneAt":"2021-02-12T09:36:22.914+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"messageId":"31312265202903598589","to":"213770416421","from":"ImprimShop","sentAt":"2021-02-12T09:37:32.204+0000","doneAt":"2021-02-12T09:37:35.821+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"messageId":"31313143451903573252","to":"213770416421","from":"ImprimShop","sentAt":"2021-02-12T12:03:54.627+0000","doneAt":"2021-02-12T12:03:57.979+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"messageId":"31313173391703574946","to":"213770416421","from":"ImprimShop","sentAt":"2021-02-12T12:08:54.027+0000","doneAt":"2021-02-12T12:08:57.561+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"bulkId":"31313253106903572090","messageId":"31313253106903572091","to":"213770416421","from":"ImprimShop","sentAt":"2021-02-12T12:22:11.154+0000","doneAt":"2021-02-12T12:22:15.101+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"bulkId":"31313253106903572090","messageId":"31313253106903572093","to":"213558028352","from":"ImprimShop","sentAt":"2021-02-12T12:22:11.212+0000","doneAt":"2021-02-12T12:22:16.927+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"bulkId":"31313253106903572090","messageId":"31313253106903572092","to":"213541035548","from":"ImprimShop","sentAt":"2021-02-12T12:22:11.133+0000","doneAt":"2021-02-12T12:22:17.661+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}},{"bulkId":"31313253106903572090","messageId":"31313253106903572094","to":"213770446361","from":"ImprimShop","sentAt":"2021-02-12T12:22:11.269+0000","doneAt":"2021-02-12T12:22:22.976+0000","smsCount":1,"mccMnc":"null","price":{"pricePerMessage":15.8627,"currency":"CREDITS"},"status":{"groupId":3,"groupName":"DELIVERED","id":5,"name":"DELIVERED_TO_HANDSET","description":"Message delivered to handset"},"error":{"groupId":0,"groupName":"OK","id":0,"name":"NO_ERROR","description":"No Error","permanent":false}}]} -->






