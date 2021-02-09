<?php

namespace Sportic\OmniEvent\Structure;

use Sportic\OmniEvent\Models\RaceParticipation;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;

/**
 * Class Course
 * @package Sportic\OmniEvent\Structure
 */
class Course extends AbstractStructure
{
    protected static $id = 'course/schema.json';

    /**
     * @var string
     */
    public $topology;


    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        parent::setUpProperties($properties, $ownerSchema);

        $ownerSchema->setTitle('Course schema');
        $ownerSchema->setRequired([]);

        $properties->topology = Schema::string();
    }
}