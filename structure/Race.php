<?php

namespace Sportic\OmniEvent\Structure;

use Sportic\OmniEvent\Models\RaceParticipation;
use Swaggest\JsonSchema\Constraint\Format;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;

/**
 * Class Race
 * @package Sportic\OmniEvent\Structure
 */
class Race extends AbstractStructure
{
    protected static $id = 'race/schema.json';

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $participation;

    /**
     * @var \DateTime
     */
    public $startTime;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        parent::setUpProperties($properties, $ownerSchema);

        $ownerSchema->setTitle('Race schema');
        $ownerSchema->setRequired(['name']);

        $properties->name = Schema::string();

        $properties->startTime = Schema::string();
        $properties->startTime->format = Format::DATE_TIME;

        $properties->participation = Schema::string();
        $properties->participation->setDefault(RaceParticipation::SOLO);
        $properties->participation->setEnum(RaceParticipation::$values);
    }
}