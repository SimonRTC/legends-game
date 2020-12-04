<?php

namespace LegendsGame\Controllers;

class GameScene {
        
    /**
     * Welcome page (Hello World!)
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function Scene(\LegendsGame\Response $Response, array $Binded = []): void {
        $Response->load("game/gameScene");
        return;
    }

}

?>