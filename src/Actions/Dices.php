<?php

namespace LegendsGame\Actions;

class Dices extends Questions {
    
    /**
     * Roll a dice
     *
     * @param  array $parameters
     * @return void
     */
    public function RollDice(array $parameters): void {
        $dice       = rand(1, 20);
        $type       = $parameters[0] ?? null;
        $PlayerStat = (float) $_SESSION["_ACCOUNT_"]->Player->stats->{strtolower($type)} ?? 0;
        $successful = $parameters[1] ?? null;
        $failure    = $parameters[2] ?? null;
        if ($PlayerStat <= $dice) {
            $this->GoToNextQuestion([ $successful ]);
            return;
        }
        $this->GoToNextQuestion([ $failure ]);
        return;
    }

}

?>