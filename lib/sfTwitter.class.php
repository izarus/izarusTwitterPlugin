<?php

class sfTwitter
{

  protected $twitter = null;
  protected $consumer_key = null;
  protected $consumer_secret = null;
  protected $oauth_token = null;
  protected $oauth_token_secret = null;
  protected $user_id = null;
  protected $access_token = null;

  public function __construct($oauth_token=null,$oauth_token_secret=null)
  {
    $this->consumer_key     = sfConfig::get('app_twitter_consumer_key');
    $this->consumer_secret  = sfConfig::get('app_twitter_consumer_secret');
    $this->oauth_token      = $oauth_token;
    $this->oauth_token_secret  = $oauth_token_secret;

    if ($this->oauth_token && $this->oauth_token_secret) {
      $this->twitter = new TwitterOAuth($this->consumer_key,$this->consumer_secret,$this->oauth_token,$this->oauth_token_secret);
    } else {
      $this->twitter = new TwitterOAuth($this->consumer_key,$this->consumer_secret);
    }

  }

  public function getRequestToken($redirect_url)
  {
    $data = $this->twitter->getRequestToken($redirect_url);
    $this->oauth_token = $data['oauth_token'];
    $this->oauth_token_secret = $data['oauth_token_secret'];
    return $data;
  }

  public function getAuthorizeUrl()
  {
    if ($this->oauth_token) {
      return $this->twitter->getAuthorizeUrl($this->oauth_token);
    } else {
      return null;
    }
  }

  public function getAccessToken($oauth_verifier)
  {
    $data = $this->twitter->getAccessToken($oauth_verifier);
    return $data;
  }

  public function getOauthToken()
  {
    return $this->oauth_token;
  }

  public function getOauthTokenSecret()
  {
    return $this->oauth_token_secret;
  }

  public function getUserId()
  {
    return $this->user_id;
  }

  // CALLS

  public function get($request)
  {
    return $this->twitter->get($request);
  }

}