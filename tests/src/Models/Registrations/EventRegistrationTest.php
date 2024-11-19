<?php

namespace Sportic\OmniEvent\Tests\Models\Registrations;

use PHPUnit\Framework\TestCase;
use Sportic\OmniEvent\Models\Events\Event;
use Sportic\OmniEvent\Models\Participants\EmergencyContact;
use Sportic\OmniEvent\Models\Participants\Participant;
use Sportic\OmniEvent\Models\Races\Race;
use Sportic\OmniEvent\Models\RegistrationQuestions\RegistrationAnswer;
use Sportic\OmniEvent\Models\RegistrationQuestions\RegistrationQuestion;
use Sportic\OmniEvent\Models\Registrations\EventRegistration;

class EventRegistrationTest extends TestCase
{
    public function test_base()
    {
        $event = $this->generateEvent();
        $race = $this->generateRace($event);

        $registration = new EventRegistration();
        $registration->reservationFor($race);

        $participant = $this->generateParticipant();
        $emergencyContact = $this->generateEmergencyContact();
        $participant->emergencyContact($emergencyContact);

        $registration->addParticipant($participant);

        self::assertJsonStringEqualsJsonFile(
            TEST_FIXTURE_PATH . '/samples/registrations/base.json',
            json_encode($registration)
        );
    }

    /**
     * @return EmergencyContact
     */
    protected function generateEmergencyContact(): EmergencyContact
    {
        $emergencyContact = new EmergencyContact();
        $emergencyContact->givenName('Jane');
        $emergencyContact->familyName('Doe');
        $emergencyContact->email('jane@gmail.com');
        $emergencyContact->telephone('987654321');
        $emergencyContact->role('Mother');
        return $emergencyContact;
    }

    /**
     * @return Participant
     */
    protected function generateParticipant(): Participant
    {
        $participant = new Participant();
        $participant->givenName('John');
        $participant->familyName('Doe');
        $participant->birthDate('1990-12-31');
        $participant->gender('Male');
        $participant->nationality('US');

        $questions = $this->generateQuestionAnswers();
        $participant->registrationAnswers($questions);
        return $participant;
    }

    /**
     * @return Event
     */
    protected function generateEvent(): Event
    {
        $event = new Event();
        $event->name('World Marathon');
        $event->eventStatusScheduled();
        return $event;
    }

    /**
     * @param Event $event
     * @return Race
     */
    protected function generateRace(Event $event): Race
    {
        $race = new Race();
        $race->name('Race 1');
        $race->superEvent($event);
        return $race;
    }

    protected function generateQuestionAnswers(): array
    {
        $answers = [];

        $question = new RegistrationQuestion();
        $question->text('Question 1');
        $question->identifier('question-1');
        $question->identifierExternal('ext-q1');
        $answer = new RegistrationAnswer();
        $answer->question($question);
        $answer->text('Answer 1');
        $answer->identifier('answer-1');
        $answer->identifierExternal('ext-a1');
        $answers[] = $answer;

        $question = new RegistrationQuestion();
        $question->text('Question 2');
        $question->identifier('question-2');
        $question->identifierExternal('ext-q2');
        $answer = new RegistrationAnswer();
        $answer->question($question);
        $answer->text('Answer 2');
        $answer->identifier('answer-2');
        $answer->identifierExternal('ext-a2');
        $answers[] = $answer;

        return $answers;
    }
}
