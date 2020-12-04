<?php

namespace LegendsGame\Controllers;

class Profile {

    /**
     * Show ranks page
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function Profile(\LegendsGame\Response $Response, array $Binded = []): void {
        $Response->load("profile");
        return;
    }

}

?>