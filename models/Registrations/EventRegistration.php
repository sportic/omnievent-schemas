<?php

namespace Sportic\OmniEvent\Models\Registrations;

use Spatie\SchemaOrg\EventReservation;
use Sportic\OmniEvent\Models\Base\Behaviours\HasRegistrationAnswersList;
use Sportic\OmniEvent\Models\Participants\Participant;
use Sportic\OmniEvent\Models\Participants\ParticipantsCollection;

class EventRegistration extends EventReservation
{
    use HasRegistrationAnswersList;

    public function addParticipant(Participant $race): static
    {
        $this->getParticipants()->append($race);
        return $this;
    }

    public function getParticipants()
    {
        $items = $this->getProperty('attendee');
        if (!$items) {
            $items = new ParticipantsCollection();
            $this->setProperty('attendee', $items);
        }
        return $items;
    }

}