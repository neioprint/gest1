<!-- https://portal.bulkgate.com/api/1.0/simple/transactional
    ?application_id=29349
    &application_token=LQWYFklkcKakJxkeejrZsvyE2iCudOsH5Q5xbRlHgLFUqe7jO8
    &number=213541035548
    &text=test_sms
    &unicode=yes
    &sender_id=gText
    &sender_id_value=BulkGate
    &country=gb -->

    $connection = fopen('https://portal.bulkgate.com/api/1.0/simple/transactional', 'r', false,
    stream_context_create(['http' => [
        'method' => 'POST',
        'header' => [
            'Content-type: application/json'
        ],
        'content' => json_encode([
            'application_id' => '29349',
            'application_token' => 'LQWYFklkcKakJxkeejrZsvyE2iCudOsH5Q5xbRlHgLFUqe7jO8',
            'number' => '213541035548',
            'text' => 'Message text 1',
            'sender_id' => 'gText',
            'sender_id_value' => 'BulkGate'
        ]),
        'ignore_errors' => true
    ]])
);

if($connection)
{
    $response = json_decode(
        stream_get_contents($connection)
    );
    var_dump($response);

    fclose($connection);
}










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
        'number' => '213541035548',
        'text' => 'Votre commande est prete',
        'sender_id' => 'NEIO',
        'sender_id_value' => 'BulkGate'
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












