<?php







$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => 'https://6j8xze.api.infobip.com',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"text":"Test Voice message.","language":"en","voice":{"name":"Joanna","gender":"female"},"from":"41793026727","to":"213541035548"}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: {App 46769e2a93441a5c6662a27f069cbdd6-ef720db7-7b06-4352-9942-be6e3464aff3}',
            'Content-Type: application/json',
            'Accept: application/json'
        ),
    )
);

$response = curl_exec($curl);

curl_close($curl);
echo $response;









// {
//     "bulkId": "187bd824-d3a0-47ed-8f87-fb53d8a2d420",
//     "messages": [
//       {
//         "to": "213541035548",
//         "status": {
//           "groupId": 1,
//           "groupName": "PENDING",
//           "id": 26,
//           "name": "PENDING_ACCEPTED",
//           "description": "Message accepted, pending for delivery."
//         },
//         "messageId": "ddc71cf5-d2ae-4f72-93c3-d91a0c7b7b91"
//       }
//     ]
//   }




// POST /tts/3/advanced
// Host: 6j8xze.api.infobip.com
// Authorization: App 46769e2a93441a5c6662a27f069cbdd6-ef720db7-7b06-4352-9942-be6e3464aff3
// Content-Type: application/json
// Accept: application/json

// {
//   "messages": [
//     {
//       "from": "41793026727",
//       "destinations": [
//         {
//           "to": "213541035548"
//         }
//       ],
//       "text": "ok MERCI NKLJKLJLKJLJKLJKLJLKJKJLKLKJLK",
//       "language": "en",
//       "voice": {
//         "name": "Joanna",
//         "gender": "female"
//       },
//       "speechRate": 1
//     }
//   ]
// }
