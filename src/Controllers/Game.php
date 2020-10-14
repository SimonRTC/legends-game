<?php

namespace LegendsGame\Controllers;

class Game {

    public function __construct() {
        $this->Game = new \LegendsGame\Game;
        $this->levels = [
            [
                "name"      => "CHARACTER_INSTALLATION",
                "permalien" => "character-installation",
                "level"     => 0,
                "location"  => [
                    "x" => 150.2546,
                    "y" => 245.6529
                ],
                "earnings"  => [],
                "scenes"    => [
                    [
                        "name"      => "SIBEL_LIKE_STRAWBERRY",
                        "question"  => "Sibel aime les fraises? || Sibel kiff les fraises? || Sibel adore les fraises?",
                        "answers"   => [
                            [
                                "name"      => "YES",
                                "label"     => "Oui",
                                "actions"   => "SUCCESSFULL::NEXT_QUESTION"
                            ],
                            [
                                "name"      => "NO",
                                "label"     => "Non",
                                "actions"   => "FAILURE::RETRY_QUESTION"
                            ],
                            [
                                "name"      => "YES-MORE",
                                "label"     => "Elle KIFF trop!",
                                "actions"   => "EARNING::XP::[100];SUCCESSFULL::NEXT_QUESTION"
                            ]
                        ]
                    ],
                    [
                        "name"      => "SIBEL_LIKE_STRAWBERRY2",
                        "question"  => "Sibel aime les fraises2? || Sibel kiff les fraises2? || Sibel adore les fraises2?",
                        "answers"   => [
                            [
                                "name"      => "YES",
                                "label"     => "Oui",
                                "actions"   => "SUCCESSFULL::NEXT_LEVEL;REDIRECT_PLAYER::MAIN_MAP"
                            ],
                            [
                                "name"      => "NO",
                                "label"     => "Non",
                                "actions"   => "FAILURE::RETRY_QUESTION"
                            ],
                            [
                                "name"      => "YES-MORE",
                                "label"     => "Elle KIFF trop!",
                                "actions"   => "EARNING::XP::[100];SUCCESSFULL::NEXT_LEVEL;REDIRECT_PLAYER::MAIN_MAP"
                            ]
                        ]
                    ]
                ]
            ],
            [
                "name"      => "HELL_WORLD",
                "permalien" => "hell-world",
                "level"     => 1,
                "location"  => [
                    "x" => 123.9562,
                    "y" => 141.4321
                ],
                "earnings"  => [],
                "scenes"    => [
                    [
                        "name"      => "SIBEL_LIKE_APPLE2",
                        "question"  => "Sibel aime les pommes? || Sibel kiff les pommes? || Sibel adore les pommes?",
                        "answers"   => [
                            [
                                "name"      => "YES",
                                "label"     => "Wep",
                                "actions"   => "SUCCESSFULL::NEXT_QUESTION"
                            ],
                            [
                                "name"      => "NO",
                                "label"     => "Non",
                                "actions"   => "FAILURE::RETRY_QUESTION"
                            ],
                            [
                                "name"      => "YES-MORE",
                                "label"     => "Elle KIFF trop trop!",
                                "actions"   => "EARNING::XP::[100];SUCCESSFULL::NEXT_QUESTION"
                            ]
                        ]
                    ],
                    [
                        "name"      => "SIBEL_LIKE_APPLE2",
                        "question"  => "Sibel aime les pommes2? || Sibel kiff les pommes2? || Sibel adore les pommes2?",
                        "answers"   => [
                            [
                                "name"      => "YES",
                                "label"     => "Wep!",
                                "actions"   => "SUCCESSFULL::NEXT_LEVEL;REDIRECT_PLAYER::MAIN_MAP"
                            ],
                            [
                                "name"      => "NO",
                                "label"     => "Non",
                                "actions"   => "FAILURE::RETRY_QUESTION"
                            ],
                            [
                                "name"      => "YES-MORE",
                                "label"     => "Elle KIFF trop trop!",
                                "actions"   => "EARNING::XP::[100];SUCCESSFULL::NEXT_LEVEL;REDIRECT_PLAYER::MAIN_MAP"
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $this->levels = \json_decode(\json_encode($this->levels), false);
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
            "BLIPS" => $this->levels
        ]);
    }

    /**
     * Show level
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function ShowLevel(\LegendsGame\Response $Response, array $Binded = [], ?object $_ACCOUNT_): void {
        $levelname                  = (!empty($Binded["level-name"])? $Binded["level-name"]: null);
        $_SESSION["CURRENT_LEVEL"]  = (isset($_SESSION["CURRENT_LEVEL"]) && !empty($_SESSION["CURRENT_LEVEL"])? $_SESSION["CURRENT_LEVEL"]: (object) [
            "levelname" => $levelname,
            "level"     => null,
            "scene"     => 0
        ]);
        $current                    = $_SESSION["CURRENT_LEVEL"];
        $response                   = (!empty($_POST["response"])? $_POST["response"]: null);
        $levels                     = $this->levels;
        foreach ($levels as $level) {
            if ($level->permalien == $levelname) {
                if ($_ACCOUNT_->Player->level >= $level->level) {
                    if ($_SESSION["CURRENT_LEVEL"]->level === null || $_SESSION["CURRENT_LEVEL"]->level != $level->level) {
                        $_SESSION["CURRENT_LEVEL"]->levelname   = $level->permalien;
                        $_SESSION["CURRENT_LEVEL"]->level       = $level->level;
                        $_SESSION["CURRENT_LEVEL"]->scene       = 0;
                        header("Refresh: 0");
                        return;
                    }
                    foreach ($level->scenes as $index=>$scene) {
                        if ($current->scene == $index) {
                            $scene->question = explode("||", $scene->question);
                            $scene->question = trim($scene->question[array_rand($scene->question, 1)]);
                            if ($response) {
                                foreach ($scene->answers as $answer) {
                                    if ($answer->name == $response) {
                                        $answer->actions = explode(";", $answer->actions);
                                        $this->Game->ExecActions($Response, $answer->actions);
                                        header("Refresh: 0");
                                        return;
                                    }
                                }
                            } else {
                                $Response->load("game/scene", [
                                    "SCENE" => $scene
                                ]);
                                return;
                            }
                        } else {
                            if ($current->scene >= count($level->scenes)) {
                                $_SESSION["CURRENT_LEVEL"] = null;
                                unset($_SESSION["CURRENT_LEVEL"]);
                                if ($_ACCOUNT_->Player->level == $level->level) {
                                    $this->Game->NextLevel($_ACCOUNT_->Player);
                                }
                                header("Refresh: 0");
                                return;
                            }
                        }
                    }
                    break;
                }
            }
        }
    }

}

?>