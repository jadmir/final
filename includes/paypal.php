<?php

define("URL_SITIO", "http://localhost:80/GDLWebCamp");
require 'paypal/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
new \PayPal\Auth\OAuthTokenCredential(
'ARwbvnwOcHF7i7YvAPzqYrbenQmqRxNj1ufiUIl_DjKeDIK0e2djh8GEMzYNmOtK8wqGQa4BXqm0ayny',
'EEu4bRdXnV6pL1arKvsaTqWmsk2hf6Qd4SZM0W7zm2muaXorHBJQYYPRXp2RFJJm6T5W-QfKy9WLIfRU'
)
);


?>
