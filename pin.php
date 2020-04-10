<?php 
require('vendor/autoload.php'); 
require_once("kampang/autoload.php"); 

// If account is public you can query Instagram without auth
$user = $_POST['username'];
$jumlah = $_POST['jumlah'];
$email = $_POST['email'];
$userp = $_POST['usernamep'];
$pass = $_POST['password'];

use seregazhuk\PinterestBot\Factories\PinterestBot;

$blogUrl = 'http://google.com';
$keywords = ['cats', 'kittens', 'funny cats', 'cat pictures', 'cats art'];

$bot = PinterestBot::create();
// Login
$bot->auth->login($email, $pass);

if ($bot->user->isBanned()) {
    echo "Account has been banned!\n";
    die();
}

// get board id
$boards = $bot->boards->forUser('my_username');
$boardId = $boards[0]['id'];

// select image for posting
$images = glob('images/*.*');
if(empty($images)) {
    echo "No images for posting\n";
    die();
}
?>

$image = $images[0];

// select keyword
$keyword = $keywords[array_rand($keywords)];

// create a pin
$bot->pins->create($image, $boardId, $keyword, $blogUrl);

// remove image
unlink($image);
