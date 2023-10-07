<?php
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://portal.bulkgate.com/api/1.0/simple/transactional',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode([
        'application_id' => '29349',
        'application_token' => 'LQWYFklkcKakJxkeejrZsvyE2iCudOsH5Q5xbRlHgLFUqe7jO8',
        'number' => '213558028352',
        'text' => 'Votre commande est prete',
        'sender_id' => '',
        'sender_id_value' => ''
    ]),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ],
]);

$response = curl_exec($curl);

if($error = curl_error($curl))
{
    echo $error;
}
else
{
    $response = json_decode($response);

    var_dump($response);
}
curl_close($curl);