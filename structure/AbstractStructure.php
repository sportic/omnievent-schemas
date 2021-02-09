<?php

namespace Sportic\OmniEvent\Structure;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;

/**
 * Class AbstractStructure
 * @package Sportic\OmniEvent\Structure
 */
abstract class AbstractStructure extends ClassStructure
{
    protected static $idBase = 'https://raw.githubusercontent.com/sportic/omnievent-schemas/main/dist/';

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->setSchema('http://json-schema.org/draft-07/schema');
        $ownerSchema->type = Type::OBJECT;
        $ownerSchema->setId(static::ref());
    }

    /**
     * @return string
     */
    protected static function ref()
    {
        return static::$idBase.''.static::$id;
    }
}