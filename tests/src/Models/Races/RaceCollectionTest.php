<?php

namespace Sportic\OmniEvent\Tests\Models\Races;

use PHPUnit\Framework\TestCase;
use Sportic\OmniEvent\Models\Races\Race;
use Sportic\OmniEvent\Models\Races\RaceCollection;

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
