<?php

class izarusTwitterPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $event->getSubject()->prependRoute('twitter_signin', new sfRoute('/twitter/login', array('module' => 'sfTwitterAuth', 'action' => 'signin')));
  }
}

