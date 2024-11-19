<?php

namespace Sportic\OmniEvent\Models\Events;

use Spatie\SchemaOrg\SportsEvent;
use Sportic\OmniEvent\Models\Base\Behaviours\HasName;
use Sportic\OmniEvent\Models\Races\Race;
use Sportic\OmniEvent\Models\Races\RaceCollection;

/**
 * Class Event
 * @package Sportic\OmniEvent\Models
 */
class Event extends SportsEvent
{
    use HasName;

    public function eventStatusScheduled()
    {
        return parent::eventStatus(EventStatus::EventScheduled);
    }

    public function eventStatusCancelled()
    {
        return parent::eventStatus(EventStatus::EventCancelled);
    }

    public function eventStatusMovedOnline()
    {
        return parent::eventStatus(EventStatus::EventMovedOnline);
    }

    public function eventStatusPostponed()
    {
        return parent::eventStatus(EventStatus::EventPostponed);
    }

    public function eventStatusRescheduled()
    {
        return parent::eventStatus(EventStatus::EventRescheduled);
    }

    public function addRace(Race $race)
    {
        $this->getRaces()->append($race);
        return $this;
    }

    public function getRaces()
    {
        $races = $this->getProperty('subEvent');
        if (!$races) {
            $races = new RaceCollection();
            $this->setProperty('subEvent', $races);
        }
        return $races;
    }
}