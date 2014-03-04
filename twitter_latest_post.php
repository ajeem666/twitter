<?php
require_once('feed.php');
echo '<ul>';

// Setting our Authentication Variables that we got after creating an application
$settings = array(
		'oauth_access_token' => "",
		'oauth_access_token_secret' => "",
		'consumer_key' => "",
		'consumer_secret' => ""
);

// We are using GET Method to Fetch the latest tweets.
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

// Set your screen_name to your twitter screen name. Also set the count to the number of tweets you want to be fetched. Here we are fetching 5 latest tweets.
$getfield = '?screen_name=intel&count=5';
$requestMethod = 'GET';

// Making an object to access our library class
$twitter = new TwitterAPIExchange($settings);
$store = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
// Since the returned result is in json format, we need to decode it             
  $result = json_decode($store);

// After decoding, we have an standard object array, so we can print each tweet into a list item.
  $multi_array = objectToArray($result);
 foreach($multi_array as $key => $value ){

// printing each tweet wrapped in a <li> tag
 echo '<li>'.$value["text"].'</li>';

 }
echo '</ul>'; ?>