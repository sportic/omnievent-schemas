<?php

require '../vendor/autoload.php';

$distFolder = dirname(__DIR__).DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR;

$content = json_encode(\Sportic\OmniEvent\Structure\Event::schema(), JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
file_put_contents($distFolder.'event/schema.json', $content);

$content = json_encode(\Sportic\OmniEvent\Structure\Race::schema(), JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
file_put_contents($distFolder.'race/schema.json', $content);

$content = json_encode(\Sportic\OmniEvent\Structure\Course::schema(), JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
file_put_contents($distFolder.'course/schema.json', $content);