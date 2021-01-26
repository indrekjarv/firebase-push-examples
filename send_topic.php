<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

$firebase = (new Factory)->withServiceAccount('ilmateenistus-df438-firebase-adminsdk-wvkwv-3b74a1a5c6.json');

$messaging = $firebase->createMessaging();

$data = [
    'name' => 'Hoiatus (Võru maakond)',
    'description' => '26.01 hommikul ja päeval tihe lumesadu, prognoositav lisanduv lumehulk hilisõhtuks 7-11 cm.',
    'level' => 1
];

$message = CloudMessage::withTarget('topic', 'warnings')
    ->withData($data);

$result = $messaging->send($message);

print_r($result);
