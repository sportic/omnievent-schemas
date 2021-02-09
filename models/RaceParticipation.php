<?php

namespace Sportic\OmniEvent\Models;

/**
 * Class RaceParticipation
 * @package Sportic\OmniEvent\Models
 */
class RaceParticipation
{
    const SOLO = 'solo';
    const TEAM = 'team';
    const RELAY = 'relay';

    static $values = [
        self::SOLO,
        self::TEAM,
        self::RELAY,
    ];
}
