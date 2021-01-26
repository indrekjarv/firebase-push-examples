<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

// https://firebase-php.readthedocs.io/en/latest/cloud-messaging.html

$firebase = (new Factory)->withServiceAccount('ilmateenistus-df438-firebase-adminsdk-wvkwv-3b74a1a5c6.json');

$messaging = $firebase->createMessaging();

$title = "Imateenistus";
$message = "Tormi hoiatus!";

$notification = Notification::fromArray(
    [
        'title' => $title,
        'body' => $message,
    ]
);

# Indrek
$deviceToken = 'dP-2UkD7SLyjUvbpRBTUwj:APA91bFyYAqxc97HZ_dUZWGq-P7gVSPaQFLCanJWqpRiuZHwZ-c5Uwyj1cHsM-zXDBwyhd0D3Olg8idZAPlcPk9P85l_h79hVh9DtIz0DQvE3Imj8csdtY-qVp0Wx5LtMdWS7mQvwId0';

$message = CloudMessage::withTarget('token', $deviceToken)
    ->withNotification($notification);

$messaging->send($message);

print "Push message are sent!";