<?php

namespace Sportic\OmniEvent\Models\Base\Behaviours;

use Sportic\OmniEvent\Models\RegistrationQuestions\RegistrationAnswer;
use Sportic\OmniEvent\Models\RegistrationQuestions\RegistrationAnswersList;

trait HasRegistrationAnswersList
{

    public function addRegistrationAnswer(RegistrationAnswer $answer): static
    {
        $answers = $this->getRegistrationAnswers();
        $answers->append($answer);
        return $this;
    }

    public function registrationAnswers(array $answers): static
    {
        $answersList = new RegistrationAnswersList();
        foreach ($answers as $answer) {
            $answersList->append($answer);
        }
        $this->setProperty('registrationAnswers', $answersList);
        return $this;
    }

    public function getRegistrationAnswers()
    {
        $races = $this->getProperty('registrationAnswers');
        if (!$races) {
            $races = new RegistrationAnswersList();
            $this->setProperty('registrationAnswers', $races);
        }
        return $races;
    }
}
