<?php

namespace App\Conversations;

use App\Services\DogService;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;


class ExampleConversation extends Conversation
{
    
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("Entonce tu quiere ve perro e singa piso!?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Foto de perro random')->value('random'),
                Button::create('Foto por raza')->value('breed'),
                Button::create('Foto por sub raza')->value('sub-breed'),

            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch($answer->getValue()) {
                    case 'random':
                        $this->say((new App\Services\DogService)->random());
                    break;
                    case 'breed':
                        $this->askForBreedName();
                    break;
                    case 'sub-breed':
                        $this->askForSubBreed();
                    break;
                }
            }
        });
    }

    public function askForBreedName()
    {
        $this->ask('De cual raza??', function(Answer $anser){
            $name = $anser->getText();
            
            $dService = new App\Services\DogService;
            $this->say($dService->byBreed($name));
        });
    }

    public function askForSubBreed()
    {
        $this->ask('Cual sub raza? lol', function(Answer $answer){
            $answer = explode(':', $answer->getText());

            $this->say((new App\Services\DogService)->bySubBreed($answer[0], $answer[0]));
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
