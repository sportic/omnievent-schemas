<?php

namespace Sportic\OmniEvent\Models\Base\Behaviours;

trait HasPersonNames
{
    public function getGivenName()
    {
        return $this->getProperty('givenName');
    }

    public function getFamilyName()
    {
        return $this->getProperty('familyName');
    }

}