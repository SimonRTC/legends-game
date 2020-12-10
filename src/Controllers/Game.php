<?php

namespace LegendsGame\Controllers;

class Game {
    
    private $Game;

    public function __construct() {
        $this->Game = new \LegendsGame\Game;
    }

    /**
     * Liste game scenes
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function ListScene(\LegendsGame\Response $Response, array $Binded = []): void {
        $plytag     = $_SESSION["_ACCOUNT_"]->Player->lvltag ?? "0.0.0";
        $Chapters   = $this->Game->Chapters;
        $explorer   = function ($tag) {
            $tag = \explode(".", $tag)[0];
            $tag = (int) $tag;
            return $tag;
        };
        $Response->load("game/gamelist", [
            "PLYTAG"    => $explorer($plytag),
            "CHAPTERS"  => $Chapters,
            "EXPLORER"  => $explorer
        ]);
        return;
    }
        
    /**
     * Game Scene
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function Scene(\LegendsGame\Response $Response, array $Binded = []): void {
        $permalien  = $Binded["permalien"] ?? null;
        $plytag     = $_SESSION["_ACCOUNT_"]->Player->lvltag ?? "0.0.0";
        $Chapters   = $this->Game->Chapters;
        foreach ($Chapters as $chapter) {
            if ($chapter->permalien == $permalien) {
                foreach ($chapter->questions as $question) {
                    $question->characters = $this->Game->GetCharacters($question->characters);
                    if ($question->tag == $plytag) {
                        $Response->load("game/scene", [
                            "permalien" => $permalien,
                            "CHAPTER"   => $chapter->name,
                            "QUESTION"  => $question
                        ]);
                        return;
                    }
                }
            }
        }
        die("ERROR!");
        return;
    }

    /**
     * Execute game scene action
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function doIt(\LegendsGame\Response $Response, array $Binded = []): void {
        $permalien  = $Binded["permalien"] ?? null;
        $qid        = $Binded["question"] ?? null;
        $plytag     = $_SESSION["_ACCOUNT_"]->Player->lvltag ?? "0.0.0";
        $Chapters   = $this->Game->Chapters;
        foreach ($Chapters as $chapter) {
            if ($chapter->permalien == $permalien) {
                foreach ($chapter->questions as $question) {
                    if ($question->tag == $plytag) {
                        $question = $question->responses[$qid] ?? null;
                        if (!empty($question)) {
                            $this->Game->ExecActions($question->actions);
                        }
                    }
                }
            }
        }
        die("END!");
        return;
    }

}

?>