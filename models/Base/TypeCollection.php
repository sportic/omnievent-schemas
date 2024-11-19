<?php

namespace Sportic\OmniEvent\Models\Base;

use ArrayIterator;
use ArrayObject;
use Spatie\SchemaOrg\Type;

abstract class TypeCollection  extends ArrayIterator implements Type
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