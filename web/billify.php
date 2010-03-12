<?php

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('pim', 'prod', false);
# $configuration = ProjectConfiguration::getApplicationConfiguration('pim', 'vetrina', true);
sfContext::createInstance($configuration)->dispatch();
