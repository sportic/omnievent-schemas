<?php

namespace Sportic\OmniEvent\Tests\Models\Events;

use Sportic\OmniEvent\Models\Events\Event;
use Sportic\OmniEvent\Models\Races\Race;
use Sportic\OmniEvent\Tests\AbstractTest;

class EventTest extends AbstractTest
{
    public function test_generate_full()
    {
        $event = new Event();
        $event->name('World Marathon');
        $event->eventStatusScheduled();

        $race = new Race();
        $race->name('Race 1');
        $event->addRace($race);

        $race = new Race();
        $race->name('Race 2');
        $event->addRace($race);

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/samples/events/event_complete.json'),
            json_encode($event)
        );
    }
}
