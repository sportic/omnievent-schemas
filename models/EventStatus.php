<?php

namespace Sportic\OmniEvent\Models;

/**
 * Class EventStatus
 * @package Sportic\OmniEvent\Models
 */
class EventStatus
{
    const CANCELLED = 'EventCancelled';
    const MOVED_ONLINE = 'EventMovedOnline';
    const POSTPONED = 'EventPostponed';
    const RESCHEDULED = 'EventRescheduled';
    const SCHEDULED = 'EventScheduled';

    static $values = [
        self::CANCELLED,
        self::MOVED_ONLINE,
        self::POSTPONED,
        self::RESCHEDULED,
        self::SCHEDULED
    ];
}