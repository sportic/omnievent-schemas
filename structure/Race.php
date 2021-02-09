<?php

namespace Sportic\OmniEvent\Structure;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;

/**
 * Class Race
 * @package Sportic\OmniEvent\Structure
 */
class Race extends AbstractStructure
{
    protected static $id = 'race/schema.json';

    public $name;


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
    }
}