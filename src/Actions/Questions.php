<?php

namespace LegendsGame\Actions;

class Questions {
    
    /**
     * Go to next question
     *
     * @param  array $parameters
     * @return void
     */
    public function GoToNextQuestion(array $parameters): void {
        $next = $parameters[0] ?? null;
        
        dd($next);

        return;
    }

}

?>