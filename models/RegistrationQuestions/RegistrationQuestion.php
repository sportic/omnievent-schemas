<?php

namespace Sportic\OmniEvent\Models\RegistrationQuestions;

use Spatie\SchemaOrg\Question;
use Sportic\OmniEvent\Models\Base\Behaviours\HasIdentifierExternal;

class RegistrationQuestion extends Question
{
    use HasIdentifierExternal;
}