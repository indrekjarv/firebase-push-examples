<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

$firebase = (new Factory)->withServiceAccount('ilmateenistus-df438-firebase-adminsdk-wvkwv-3b74a1a5c6.json');
$messaging = $firebase->createMessaging();

$deviceToken = 'ftsYnK7YQN2CW13zeZ6L0o:APA91bFTtXJ-6lr32NwgfFw7x3tJ6FNzF4nBVQysB3Ee6HND3CDULq7HZVe-n41EdY9IuLus8XTKaqrXTcfjh9Tq-bF06C7tFKTn4oYrSf0nUDMC3NAIeMNqW2Qg6oZ4PyLUJPHf38ZG';

$data = [
    'name' => 'Hoiatus (Eesti) 4?',
    'description' => 'Head koosolekut 4 :)',
    'level' => 1,
    'notification_category' => 'NORTHERN_PART_OF_THE_BALTIC_SEA'
];

$message = CloudMessage::withTarget('token', $deviceToken)
    ->withData($data);
$result = $messaging->send($message);

print_r($result);
