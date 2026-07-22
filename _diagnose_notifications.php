<?php

use App\Http\Controllers\NotificationController;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

// Test notifications
$user = User::find(1);
echo "=== USER 1 INFO ===\n";
echo 'Name: '.$user->name."\n";
echo 'Token exists: '.($user->api_token ? 'YES' : 'NO')."\n";
echo 'Profile: '.($user->profile?->name ?? 'NONE')."\n\n";

$notifs = Notification::where('user_id', 1)->get();
echo "=== NOTIFICATIONS FOR USER 1 ===\n";
echo 'Count: '.$notifs->count()."\n";
foreach ($notifs as $n) {
    echo "  - [{$n->id}] {$n->title} | is_read: ".($n->is_read ? 'YES' : 'NO')."\n";
}

echo "\n=== TOTAL NOTIFICATIONS IN DB ===\n";
echo 'Total: '.Notification::count()."\n";

echo "\n=== TESTING CONTROLLER ===\n";
try {
    $controller = app()->make(NotificationController::class);
    $request = new Request;
    $request->headers->set('X-Auth-Token', $user->api_token);
    $request->headers->set('Accept', 'application/json');
    $response = $controller->index($request);
    $data = $response->getData(true);
    echo 'Response status: '.$response->getStatusCode()."\n";
    echo 'Response keys: '.implode(', ', array_keys($data))."\n";
    echo 'Notifications count in response: '.count($data['notifications'] ?? [])."\n";
} catch (Exception $e) {
    echo 'ERROR: '.$e->getMessage()."\n";
    echo 'File: '.$e->getFile().':'.$e->getLine()."\n";
}
