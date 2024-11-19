<?php

namespace Sportic\OmniEvent\Models\Base\Behaviours;

trait HasGender
{
    public function getGender()
    {
        return $this->getProperty('gender');
    }

    public function isMale()
    {
        return $this->getGender() === 'Male';
    }

    public function isFemale()
    {
        return $this->getGender() === 'Female';
    }
}