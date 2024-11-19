<?php

namespace Sportic\OmniEvent\Models\Races;

use Spatie\SchemaOrg\SportsEvent;
use Sportic\OmniEvent\Models\Base\Behaviours\HasIdentifierExternal;
use Sportic\OmniEvent\Models\Base\Behaviours\HasName;

/**
 * Class Event
 * @package Sportic\OmniEvent\Models
 */
class Race extends SportsEvent
{
    use HasIdentifierExternal;
    use HasName;

    public function getType(): string
    {
        return 'SportsEvent';
    }
}
