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
        'body' => "Ilusat kevadilma.",
    ]
);

$deviceTokens = [];
$deviceTokens[] = 'cCxO8L4pR8WDuyaY5Kmf3-:APA91bG74gpebtKaGT3IIk-39X1bhwJAM_WNaXp9-obdW5F0C5GI5yGLCnmFCSxZAm9q-1P3U1ZuNxBX16OcXopIbVUassC3w5BVFdLWNof7F5idbaOnt_iVRfixhQoPxVIwM9uEyEcK';
$deviceTokens[] = 'fJpTdJCcjUhElCTp--dw68:APA91bGL1ySi4f7eyD6D2oRPLsQYgdMZke_6U8tMekV4oOMdaXWeMVdgDPcu1I4LdQHzeN_2S0GB8sEbl2x3lcVK8uWV3Ak_tWz93WdF7Rnp-ZgSqzwEGgs-lXO5Cxtt8s7P6BLYTFir';
$deviceTokens[] = 'f7yR6jbSS2yE61N8T6u3Xm:APA91bGJuEfP7SaILk6lhMjq9KnamRLzs0AOnDBC6qcoovsmJYf7GqnHBWuqsnfna27h3o3detuETkVqxoG-qyk1IjwTV08YqCw6Yw4KqXQIfiTdc_L8jfpukG3pDM8UTjn8AtdPRrTI';

$data = [
    'name' => 'Hoiatus (Eesti)',
    'description' => 'testime, level 2 ...',
    'level' => 2,
    'notification_category' => 'GENERAL_WARNINGS'
];

$message = CloudMessage::new();
$message = $message->withData($data);
$report = $messaging->sendMulticast($message, $deviceTokens);

print_r($report);
