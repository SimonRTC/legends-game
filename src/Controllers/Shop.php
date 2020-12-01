<?php

namespace LegendsGame\Controllers;

class Shop {
        
    /**
     * Welcome page (Hello World!)
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function Main(\LegendsGame\Response $Response, array $Binded = []): void {
        $Response->load("shop/main");
        return;
    }

}

?>