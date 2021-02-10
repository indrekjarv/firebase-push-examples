<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

$firebase = (new Factory)->withServiceAccount('ilmateenistus-df438-firebase-adminsdk-wvkwv-3b74a1a5c6.json');

$messaging = $firebase->createMessaging();

$notification = Notification::fromArray(
    [
        'title' => "Imateenistus",
        'body' => "Ilusat talveilma.",
    ]
);

# Indrek, Android
#$deviceToken = 'dxJPGa5hTmS5wZ4BsgYJm0:APA91bFqmb5m-dvjnx-8l3cOr1EtIODKtoLP3SEcENp2U77yAdW5zFZ-f3tyR98gn7VuLCd0nh87WxAOIUsze8qic46-xCcwfUm0bDrgpi9D5sNJYLmSixxhnhg1wBeejHCcELNCcRmV';

# Indrek, iOS
$deviceToken = 'cE67AO3LdElar5N9yIFFVe:APA91bFk0y51Ajq9G51nozhHkGqmqgvBYxPH5r40LM1xmMAjrFWoC3BS_W1bCBliTiJw2pybFdd6sSU2R3reV3uvgVbvZ_rFoRdM4YcAp-y3DSZ8JmSK47dOUUhVpVjbrMato2-N-JvL';

$data = [
    'name' => 'Hoiatus (Võru maakond)!!!!!',
    'description' => '26.01 hommikul ja päeval tihe lumesadu, prognoositav lisanduv lumehulk hilisõhtuks 7-11 cm.',
    'level' => 1
];

# Example 1: working!
$message = CloudMessage::withTarget('token', $deviceToken)
    ->withNotification($notification);
$messaging->send($message);

# Example 2: working, but $data not arrive anywhere!
$message = CloudMessage::withTarget('token', $deviceToken)
    ->withNotification($notification)
    ->withData($data);
$messaging->send($message);

# Example 3: NOT working!
#@Joseph- This should be working in Android. Adding ->withNotification($notification) the onMessageReceived() method will not trigger when the app is in background. So don't call withNotification()
#Please test it using Android app version 1.13
$message = CloudMessage::withTarget('token', $deviceToken)
    ->withData($data);
$messaging->send($message);
