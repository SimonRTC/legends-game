<?php

namespace LegendsGame\Actions;

class Questions extends \LegendsGame\Game {
    
    /**
     * Go to next question
     *
     * @param  array $parameters
     * @return void
     */
    public function GoToNextQuestion(array $parameters): void {
        $next = $parameters[0] ?? null;
        if (!empty($next)) {
            $_SESSION["_PLAYER_REAL_TAG"] = $next;
            $this->Database->Request("UPDATE `players` SET level = :level WHERE uuid = :uuid", [
                "uuid"  => $_SESSION["_ACCOUNT_"]->Player->identifier,
                "level" => $next
            ]);
        }
        return;
    }

}

?>