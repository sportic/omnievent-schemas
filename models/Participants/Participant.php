<?php

namespace Sportic\OmniEvent\Models\Participants;

use Spatie\SchemaOrg\Person;

class Participant extends Person
{
    public function emergencyContact(EmergencyContact $contact): static
    {
        return $this->setProperty('emergencyContact', $contact);
    }

    public function getEmergencyContact()
    {
        return $this->getProperty('emergencyContact');
    }
}