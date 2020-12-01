<?php

namespace LegendsGame\Controllers;

class Ranks {

    /**
     * Show ranks page
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function Show(\LegendsGame\Response $Response, array $Binded = []): void {
        $Response->load("ranks");
        return;
    }

}

?>