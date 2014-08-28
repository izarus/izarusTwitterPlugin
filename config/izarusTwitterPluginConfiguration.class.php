<?php

class izarusTwitterPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    $this->dispatcher->connect('routing.load_configuration', array('izarusTwitterPluginRouting', 'listenToRoutingLoadConfigurationEvent'));
  }
}