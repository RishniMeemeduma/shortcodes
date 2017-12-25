<?php
/*Plugin Name:Tweeter Shortcode
Plugin URI:http://www.wordpress.ibase_commit
Description:testing Shortcode
Author:Rishni Meemeduma
Author URI:http://www.ris.tt
version:1.0
*/

add_shortcode('twitter',function($attr,$content){
  //To test wheter recordes are showing or not
  //print_r($attr);
  //print_r($content);

  //When There is no username and content given in post page then default
//  if(!isset($attr['username'])) $attr['username']="envatowebdev";
//  if(empty($content)) $content='Follow me';
//return '<a href="http://www.twitter.com/'.$attr['username'].'">'.$content.'</a>'

//In below it sets default values
/*$attr=Shortcode_atts(
   array(
     'username' =>'envatowebdev' ,
      'content'=> !empty($content)? $content:'Follow me on twitter!'
    ),$attr
  );
  extract($attr);

  return "<a href='http://www.twitter.com/$username'>$content</a>";

*/

//Create tweet project part
$attr=Shortcode_atts(
   array(
     'username' =>'envatowebdev' ,
      'content'=> !empty($content)? $content:'Follow me on twitter!',
      'show_tweets' => false,
      'tweet_reset_time' => 10,
      'num_tweets' =>5,
    ),$attr
  );
  extract($attr);
  if($show_tweets)
{
  $tweets=fetch_tweets($num_tweets,$username,$tweet_reset_time);
}

  return "<a href='http://www.twitter.com/$username'>$content</a>";

});
function fetch_tweets($num_tweets,$username,$tweet_reset_time){
  $tweets=curl("http://twitter.com/statuses/user_timeline/$username.json");
  print_r($tweets);

}
function curl($url){
  $c = curl_init($url );
  curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($c,CURLOPT_CONNECTTIMEOUT,3);
  curl_setopt($c,CURLOPT_TIMEOUT,5);

return json_decode(curl_exec($c));

}

?>
