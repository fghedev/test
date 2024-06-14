<?php
$GLOBALS['url'] = "https://goatbettingtips.com/api/vipyeni.php";

function fetchAndProcessTips($tipType) {
  $payload = array(
    "dlang" => "en",
    "tz" => "Africa/Casablanca",
    "type" => $tipType
  );

  $ch = curl_init($GLOBALS['url']);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

  $response = curl_exec($ch);
  curl_close($ch);

  $data = json_decode($response, true);

  if (json_last_error() === JSON_ERROR_NONE) {
    echo json_encode($data);
  } else {
    echo json_encode(array("error" => "Erreur de décodage JSON"));
  }
}

if (isset($_POST['type'])) {
  fetchAndProcessTips($_POST['type']);
}
?>