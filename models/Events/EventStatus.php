<?php

namespace Sportic\OmniEvent\Models\Events;

use Spatie\SchemaOrg\EventStatusType;

/**
 * Class EventStatus
 * @package Sportic\OmniEvent\Models
 */
class EventStatus extends EventStatusType
{
    public static function cancelled()
    {
        return self::createStatus(self::EventCancelled);
    }

    public static function movedOnline()
    {
        return self::createStatus(self::EventMovedOnline);
    }

    public static function postponed()
    {
        return self::createStatus(self::EventPostponed);
    }

    public static function rescheduled()
    {
        return self::createStatus(self::EventRescheduled);
    }

    static $values = [
        self::EventCancelled,
        self::EventMovedOnline,
        self::EventPostponed,
        self::EventRescheduled,
        self::EventScheduled,
    ];

    protected static function createStatus($type)
    {
        $status = new EventStatus();
        return $status->name($type);
    }
}