<?php

namespace Sportic\OmniEvent\Models\Participants;

use Spatie\SchemaOrg\Person;

class EmergencyContact extends Person
{
    public function role($role)
    {
        return $this->setProperty('description', $role);
    }

    public function getRole()
    {
        return $this->getProperty('description');
    }
}