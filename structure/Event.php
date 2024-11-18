<?php

namespace Sportic\OmniEvent\Structure;

use Sportic\OmniEvent\Models\Events\EventStatus;
use Swaggest\JsonSchema\Constraint\Format;
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

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $url;

    /**
     * @var \DateTime
     */
    public $startDate;

    /**
     * @var \DateTime
     */
    public $endDate;

    /**
     * @var string
     */
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
        $ownerSchema->setRequired(['name', 'startDate', 'eventStatus']);

        $properties->name = Schema::string();

        $properties->description = Schema::string();

        $properties->startDate = Schema::string();
        $properties->startDate->format = Format::DATE;

        $properties->endDate = Schema::string();
        $properties->endDate->format = Format::DATE;

        $properties->eventStatus = Schema::string();
        $properties->eventStatus->setDefault(EventStatus::EventScheduled);
        $properties->eventStatus->setEnum(EventStatus::$values);

        $properties->url = Schema::string();
        $properties->url->format = Format::URI;

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