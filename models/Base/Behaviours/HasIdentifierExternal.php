<?php

namespace Sportic\OmniEvent\Models\Base\Behaviours;

trait HasIdentifierExternal
{
    public function getIdentifierExternal(): string
    {
        return $this->getProperty('identifierExternal');
    }

    public function identifierExternal(?string $identifierExternal): static
    {
        $this->setProperty('identifierExternal', $identifierExternal);
        return $this;
    }
}