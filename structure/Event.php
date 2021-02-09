<?php

namespace Sportic\OmniEvent\Structure;

use Sportic\OmniEvent\Models\EventStatus;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;

/**
 * Class Event
 * @package Sportic\OmniEvent\Structure
 */
class Event extends AbstractStructure
{
    protected static $id = 'event/schema.json';

    public $name;
    public $eventStatus;

    /** @var Race[] */
    public $races;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        parent::setUpProperties($properties, $ownerSchema);

        $ownerSchema->setTitle('Event schema');
        $ownerSchema->setRequired(['name', 'eventStatus']);

        $properties->name = Schema::string();

        $properties->eventStatus = Schema::string();
        $properties->eventStatus->setDefault(EventStatus::SCHEDULED);
        $properties->eventStatus->setEnum(EventStatus::$values);

        // Property can be any complex structure
        $properties->races = Schema::create();
        $properties->races->type = Type::ARR;

        $raceSchema = Schema::create();
        $raceSchema->ref = Race::ref();
        $racesSchema = Schema::create();
        $racesSchema->anyOf = [$raceSchema];
        $properties->races->setItems($racesSchema);

    }
}