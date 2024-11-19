<?php

namespace Sportic\OmniEvent\Tests\Models\Participants;

use PHPUnit\Framework\TestCase;
use Sportic\OmniEvent\Models\Participants\Participant;

class ParticipantTest extends TestCase
{
    public function test_club()
    {
        $participant = new Participant();
        $club = $participant->getClub();
        self::assertNull($club);

        $participant->clubByName('Club Name');
        $club = $participant->getClub();
        self::assertSame('Club Name', $club->getProperty('name'));
    }
}
