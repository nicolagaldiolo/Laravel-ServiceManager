<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use SM\Event\TransitionEvent;

class StateHistoryManager
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    public function postTransition(TransitionEvent $event)
    {

        $sm = $event->getStateMachine();
        $model = $sm->getObject();

        $model->addHistoryLine([
            'transition' => $event->getTransition(),
            'to' => $sm->getState()
        ]);
    }
}
