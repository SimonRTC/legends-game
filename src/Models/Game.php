<?php

namespace LegendsGame;

class Game {

    private $Database;

    public function __construct() {
        $this->Database = new \LegendsGame\Database("default", true);
        $this->action = [
            "SUCCESSFULL" => function(object $Response, string $acting, array $parameters): void {
                if ($acting == "NEXT_QUESTION") {
                    if (isset($_SESSION["CURRENT_LEVEL"]) && !empty($_SESSION["CURRENT_LEVEL"])) {
                        $_SESSION["CURRENT_LEVEL"]->scene++;
                    }
                } elseif ($acting == "NEXT_LEVEL") {
                    $this->NextLevel($Response->_ACCOUNT_->Player);
                }
                return;
            },
            "EARNING" => function(object $Response, string $acting, array $parameters): void {
                if ($acting == "XP") {
                    $amount = (!empty($parameters[0])? $parameters[0]: 0);
                    $Response->SetNotification("EARNING_XP", [ "XP_AMOUNT" => $amount ]);
                }
                return;
            },
            "FAILURE" => function(object $Response, string $acting, array $parameters): void {
                if ($acting == "RETRY_QUESTION") {
                    $Response->SetNotification("SCENE_FAILURE");
                }
                return;
            },
            "REDIRECT_PLAYER" => function(object $Response, string $acting, array $parameters): void {
                $URI = ".";
                if ($acting == "MAIN_MAP") {
                    $URI = "/game/";
                }
                header("Location: {$URI}");
                exit();
            }
        ];
    }
    
    /**
     * Add level to player
     *
     * @param  object $Player
     * @return void
     */
    public function NextLevel(object $Player): void {
        if (isset($_SESSION["_ACCOUNT_"]) && !empty($_SESSION["_ACCOUNT_"])) {
            if ($_SESSION["CURRENT_LEVEL"]->level >= $Player->level) {
                $Player->level++;
                unset($_SESSION["CURRENT_LEVEL"]);
                $_SESSION["_ACCOUNT_"]->Player->level = $Player->level;
                $this->Database->Request("UPDATE `players` SET `level` = :level WHERE `uuid` = :identifier;", [
                    "identifier"    => $Player->identifier,
                    "level"         => $Player->level,
                ]);
            }
        }
        return;
    }
    
    /**
     * Execute action list
     *
     * @param  object $Response
     * @param  array $actions
     * @return void
     */
    public function ExecActions(object $Response, array $actions): void {
        foreach ($actions as $action) {
            $action = explode("::", $action);
            preg_match("/\[(.*)\]/", $action[count($action)-1], $match);
            $parameters = (!empty($match)? explode(",", $match[1]): []);
            $act        = (isset($this->action[$action[0]]) && !empty($this->action[$action[0]])? $this->action[$action[0]]: null);
            if (!empty($act)) {
                $act($Response, $action[1], $parameters);
            }
        }
        return;
    }

}

?>