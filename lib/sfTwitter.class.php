<?php

class sfTwitter
{

  protected $twitter = null;
  protected $oauth_token = null;
  protected $oauth_token_secret = null;

  public function __construct()
  {
    $consumer_key     = sfConfig::get('app_twitter_consumer_key');
    $consumer_secret  = sfConfig::get('app_twitter_consumer_secret');

    $this->twitter = new TwitterOAuth($consumer_key,$consumer_secret);

  }

  public function getRequestToken($redirect_url)
  {
    $data = $this->twitter->getRequestToken($redirect_url);
    $this->oauth_token = $data['oauth_token'];
    $this->oauth_token_secret = $data['oauth_token_secret'];
  }

  public function getAuthorizeUrl()
  {
    if ($this->oauth_token) {
      return $this->twitter->getAuthorizeUrl($this->oauth_token);
    } else {
      return null;
    }
  }

}