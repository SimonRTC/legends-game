<?php

namespace LegendsGame\Controllers;

class _Game {

    public function __construct() {
        $this->Game = new \LegendsGame\Game;
    }

    /**
     * Show map
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function ShowMap(\LegendsGame\Response $Response, array $Binded = []): void {
        $Response->load("game/map", [
            "CHAPTERS" => $this->Game->Chapters
        ], [], [ false, false ]);
    }

    /**
     * Show level
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function ShowLevel(\LegendsGame\Response $Response, array $Binded = [], ?object $_ACCOUNT_): void {
        $permalien  = $Binded["permalien"] ?? null;
        $plytag     = $_ACCOUNT_->Player->lvltag ?? "0.0.0";
        $Chapters   = $this->Game->Chapters;
        foreach ($Chapters as $chapter) {
            if ($chapter->permalien == $permalien) {
                foreach ($chapter->questions as $question) {
                    $question->characters = $this->Game->GetCharacters($question->characters);
                    if ($question->tag == $plytag) {
                        $Response->load("game/scene", [
                            "CHAPTER"   => $chapter->name,
                            "QUESTION"  => $question
                        ]);
                    }
                }
            }
        }
    }

}

?>