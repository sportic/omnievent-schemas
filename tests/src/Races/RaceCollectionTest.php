<?php

namespace Sportic\OmniEvent\Tests\Races;

use Sportic\OmniEvent\Models\Races\Race;
use Sportic\OmniEvent\Models\Races\RaceCollection;
use PHPUnit\Framework\TestCase;

class RaceCollectionTest extends TestCase
{
    public function test_array_functions()
    {
        $collection = new RaceCollection();
        $race = new Race();
        $race->identifier('1');
        $collection->append($race);

        self::assertCount(1, $collection);
        self::assertSame($race, $collection->current());
    }
}
