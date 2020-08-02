<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

// https://firebase-php.readthedocs.io/en/latest/cloud-messaging.html

$firebase = (new Factory)->withServiceAccount('estbujin-firebase-adminsdk-cv9vm-da1ecc6d7b.json');

$messaging = $firebase->createMessaging();

$title = "Story Title";
$message = "Message Body.";

$notification = Notification::fromArray(
    [
        'title' => $title,
        'body' => $message,
    ]
);

$deviceToken = 'ds-QNKowQGik1jOnYBq8Qq:APA91bH_AdakdACOzA808oMj7Df3AgRHwOals704f9-_5HJVUVOb-vjFHjOWT20A8Q3q8zgo4V9PxeyB_h-J-bTAGar7I8LXUaKFLoxuohqgYJQWNuUPah_DMOEjD9jWfJqnSsGa_rLW';

$message = CloudMessage::withTarget('token', $deviceToken)
    ->withNotification($notification);

$messaging->send($message);

print "Push message are sent!";