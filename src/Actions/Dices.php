<?php

namespace LegendsGame\Actions;

class Dices {
    
    /**
     * Roll a dice
     *
     * @param  array $parameters
     * @return void
     */
    public function RollDice(array $parameters): void {
        $type       = (!empty($parameters["DICE_TYPE"])? $parameters["DICE_TYPE"]: null);
        $successful = (!empty($parameters["SUCESSFULL_TAG"])? $parameters["SUCESSFULL_TAG"]: null);
        $failure    = (!empty($parameters["FAILURE_TAG"])? $parameters["FAILURE_TAG"]: null);
        
        dump($type, $successful, $failure);

        return;
    }

}

?>