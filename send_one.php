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

# Indrek, Android
$deviceToken = 'c1V2hWA7Q5WQfUeJE6lunJ:APA91bHwCGae4d5SS89o-TGwv4vsl246uzEiF302caJkaUdjEkZ5kjwpjowrRSlyQpOvFr41dAEXEGD8TQDUC1BIft60Cy6dWQcJhFktnOsTr572FDOv2rG1L9XDre0wRVnwvCRDfTQX';

# Indrek, iOS
# $deviceToken = 'cxugfaIO_EE8jSryMMTCsa:APA91bEvE0Vfs2DvKddr1W7Hn4gJiLTjn41_UqHuq9CcZPSpUDYtxuqHxWLErR0JORagIv0SrOUJChE5nA2bigWJvI0sjxw6MQL4O6_KZJMk7yKc9r86H7PRqERdj4UZBpPEGL-7Wb2R';

$data = [
    'name' => 'Hoiatus (Eesti)?',
    'description' => 'Head koosolekut :)',
    'level' => 1,
    'notification_category' => 'GENERAL_WARNINGS'
];

# Example 1: working!
#$message = CloudMessage::withTarget('token', $deviceToken)
#    ->withNotification($notification);
#$messaging->send($message);

# Example 2: working, but $data not arrive anywhere!
#$message = CloudMessage::withTarget('token', $deviceToken)
#    ->withNotification($notification)
#    ->withData($data);
#$messaging->send($message);

# Example 3: NOT working!
#@Joseph- This should be working in Android. Adding ->withNotification($notification) the onMessageReceived() method will not trigger when the app is in background. So don't call withNotification()
#Please test it using Android app version 1.13
$message = CloudMessage::withTarget('token', $deviceToken)
    ->withData($data);
$result = $messaging->send($message);

print_r($result);
