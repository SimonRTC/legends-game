<?php

namespace LegendsGame\Controllers;

class Welcome {
        
    /**
     * Welcome page (Hello World!)
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function Welcome(\LegendsGame\Response $Response, array $Binded = []): void {
        $Response->load("home");
        return;
    }

}

?>