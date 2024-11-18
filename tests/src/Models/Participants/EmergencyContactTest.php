<?php

namespace Sportic\OmniEvent\Tests\Models\Participants;

use PHPUnit\Framework\TestCase;
use Sportic\OmniEvent\Models\Participants\EmergencyContact;

class EmergencyContactTest extends TestCase
{

    public function test_base()
    {
        $contact = new EmergencyContact();
        $contact->givenName('John');
        $contact->familyName('Doe');
        $contact->email('john@gmail.com');
        $contact->telephone('123456789');
        $contact->role('Father');

        self::assertJsonStringEqualsJsonFile(
            TEST_FIXTURE_PATH . '/samples/participants/emergency_contact_base.json',
            json_encode($contact)
        );
    }
}
