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
        $next = (!empty($parameters["NEXT_TAG"])? $parameters["NEXT_TAG"]: null);
        
        dump($next);

        return;
    }

}

?>