<?php

namespace LegendsGame\Controllers;

class Ranks {

    private $Game;

    public function __construct() {
        $this->Game = new \LegendsGame\Game;
    }

    /**
     * Show ranks page
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function Show(\LegendsGame\Response $Response, array $Binded = []): void {
        $Response->load("ranks", [
            "PLAYERS" => $this->Game->GetAllPlayersRanked()
        ]);
        return;
    }

}

?>