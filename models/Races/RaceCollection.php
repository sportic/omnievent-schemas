<?php

namespace Sportic\OmniEvent\Models\Races;

use ArrayObject;
use Spatie\SchemaOrg\Type;

class RaceCollection extends ArrayObject implements Type
{

    public function toArray(): array
    {
        return $this->getArrayCopy();
    }

    public function toScript(): string
    {
        // TODO: Implement toScript() method.
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }
}