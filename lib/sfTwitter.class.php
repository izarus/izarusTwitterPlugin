<?php

use TwitterOAuth\TwitterOAuth;

class sfTwitter
{

  protected $twitter = null;

  public function __construct()
  {
    $config = array(
      'consumer_key'       => sfConfig::get('app_twitter_consumer_key'),
      'consumer_secret'    => sfConfig::get('app_twitter_consumer_secret'),
      'oauth_token'        => sfConfig::get('app_twitter_oauth_token'),
      'oauth_token_secret' => sfConfig::get('app_twitter_oauth_token_secret'),
      'output_format'      => 'object',
      );

    $this->twitter = new TwitterOAuth($config);
  }

}