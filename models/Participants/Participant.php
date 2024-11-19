<?php

namespace Sportic\OmniEvent\Models\Participants;

use Spatie\SchemaOrg\Person;
use Sportic\OmniEvent\Models\Base\Behaviours\HasPersonMethods;
use Sportic\OmniEvent\Models\Base\Behaviours\HasRegistrationAnswersList;

class Participant extends Person
{
    use HasRegistrationAnswersList;
    use HasPersonMethods;

    public function emergencyContact(EmergencyContact $contact): static
    {
        return $this->setProperty('emergencyContact', $contact);
    }

    public function getEmergencyContact()
    {
        return $this->getProperty('emergencyContact');
    }
}