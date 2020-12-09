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
            $this->Database->Request("UPDATE `players` SET level = :level WHERE uuid = :uuid", [
                "uuid"  => $_SESSION["_ACCOUNT_"]->Player->identifier,
                "level" => $next
            ]);
            $Account                        = new \LegendsGame\Account;
            $PlayerAccount                  = $_SESSION["_ACCOUNT_"];
            $PlayerAccount->Player->lvltag  = $next;
            $Account->ReloadPlayerAccount($PlayerAccount);
        }
        return;
    }

    /**
     * Go to next chapter
     *
     * @param  array $parameters
     * @return void
     */
    public function NextChapter(array $parameters): void {
        $next = $parameters[0] ?? null;
        if (!empty($next)) {
            $this->Database->Request("UPDATE `players` SET level = :level WHERE uuid = :uuid", [
                "uuid"  => $_SESSION["_ACCOUNT_"]->Player->identifier,
                "level" => $next
            ]);
            $Account                        = new \LegendsGame\Account;
            $PlayerAccount                  = $_SESSION["_ACCOUNT_"];
            $PlayerAccount->Player->lvltag  = $next;
            $Account->ReloadPlayerAccount($PlayerAccount);
        }
        header("Location: /game/");
        return;
    }

}

?>