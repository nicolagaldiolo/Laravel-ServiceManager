<?php

namespace App\Http\Traits;

use App\Renewal;
use App\Service;
use SM\Factory\FactoryInterface;

trait StatableTrait {

    /**
     * @var StateMachine $stateMachine
     */

    protected $stateMachine;

    public function stateMachine()
    {

        if(!$this->stateMachine){
            $this->stateMachine = app(FactoryInterface::class)->get($this, self::SM_CONFIG);
        }
        return $this->stateMachine;
    }

    public function stateIs()
    {
        return $this->stateMachine()->getState();
    }

    public function getStateAttribute(){
        $states = config('state-machine.' . self::SM_CONFIG . '.states_attribute');
        return array_filter($states, function($v, $k){
            return $k == $this->stateIs();
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function transition($transition)
    {
        return $this->stateMachine()->apply($transition);
    }

    public function transitionAllowed($transition)
    {
        return $this->stateMachine()->can($transition);
    }

    // setto la relazione con la tabella "history"
    public function history()
    {
        return $this->hasMany(self::HISTORY_MODEL['name']);
    }

    public function addHistoryLine(Array $transitionData)
    {
        $this->save();
        $this->history()->create($transitionData);
    }

    public function possibleTransitions(){
        return $this->stateMachine()->getPossibleTransitions();
    }

    public function getPossibleTransitions(){
        $possibleTransitions = $this->stateMachine()->getPossibleTransitions();

        return array_filter($this->getAllTransition(), function($v, $k) use($possibleTransitions){
            return in_array($k, $possibleTransitions);
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function getAllTransition()
    {
        return config('state-machine.' . self::SM_CONFIG . '.transitions');
    }

    public function pippo(Renewal $renewal)
    {

        //$renewal->service;
        //dd($renewal);

        $new = Renewal::create([
            'service_id' =>  $renewal->service_id,
            'deadline' => '05-11-2020',
            'amount' => $renewal->amount,
        ]);


        //d-m-Y
        //logger($renewal);
        //return $a;
        //$renewal->service()->create($renewal);
        //dd($renewal);

    }

}
