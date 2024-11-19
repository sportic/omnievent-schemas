<?php

namespace Sportic\OmniEvent\Models\Participants;

use Spatie\SchemaOrg\Person;
use Sportic\OmniEvent\Models\Base\Behaviours\HasPersonMethods;

class EmergencyContact extends Person
{
    use HasPersonMethods;

    public function role($role)
    {
        return $this->setProperty('description', $role);
    }

    public function getRole()
    {
        return $this->getProperty('description');
    }
}