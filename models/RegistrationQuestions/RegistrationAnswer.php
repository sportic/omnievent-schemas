<?php

namespace Sportic\OmniEvent\Models\RegistrationQuestions;

use Spatie\SchemaOrg\Answer;
use Sportic\OmniEvent\Models\Base\Behaviours\HasIdentifierExternal;

class RegistrationAnswer extends Answer
{
    use HasIdentifierExternal;

    public function question(RegistrationQuestion $question): static
    {
        return $this->setProperty('parentItem', $question);
    }

    public function getQuestion()
    {
        return $this->getProperty('parentItem');
    }
}
