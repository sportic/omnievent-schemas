<?php

namespace Sportic\OmniEvent\Models\Base\Behaviours;

trait HasName
{
    public function getName(): string
    {
        return $this->getProperty('name');
    }
}