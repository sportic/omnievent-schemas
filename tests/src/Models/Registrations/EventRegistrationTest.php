<?php

namespace Sportic\OmniEvent\Tests\Models\Registrations;

use PHPUnit\Framework\TestCase;
use Sportic\OmniEvent\Models\Events\Event;
use Sportic\OmniEvent\Models\Participants\Participant;
use Sportic\OmniEvent\Models\Races\Race;
use Sportic\OmniEvent\Models\Registrations\EventRegistration;

class EventRegistrationTest extends TestCase
{
    public function test_base()
    {
        $event = new Event();
        $event->name('World Marathon');
        $event->eventStatusScheduled();

        $race = new Race();
        $race->name('Race 1');
        $race->superEvent($event);

        $registration = new EventRegistration();
        $registration->reservationFor($race);

        $participant = new Participant();
        $participant->givenName('John');
        $participant->familyName('Doe');
        $registration->addRace($participant);

        self::assertJsonStringEqualsJsonFile(
            TEST_FIXTURE_PATH . '/samples/registrations/base.json',
            json_encode($registration)
        );
    }
}
