<?php

require '../vendor/autoload.php';

$config = [];
$event = new \Sportic\OmniEvent\Models\Event();
$event->name = 'My event name';
$output = JSONSchemaGenerator\Generator::from($event, $config);

echo $output;