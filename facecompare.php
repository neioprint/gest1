<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://face-compare1.p.rapidapi.com/v3/tasks/async/compare/face",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "68bbb910-da9b-4d8a-9a1d-4bd878b19846",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: face-compare1.p.rapidapi.com",
		"X-RapidAPI-Key: dc154f0c0emsha131992871bf320p161f19jsnc07b59a56674",
		"content-type: text/plain"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}