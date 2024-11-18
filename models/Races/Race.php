<?php

namespace Sportic\OmniEvent\Models\Races;

use Spatie\SchemaOrg\SportsEvent;

/**
 * Class Event
 * @package Sportic\OmniEvent\Models
 */
class Race extends SportsEvent
{
    public function getType(): string
    {
        return 'SportsEvent';
    }
}
