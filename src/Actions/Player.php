<?php

namespace LegendsGame\Actions;

class Player extends \LegendsGame\Game {
        
    /**
     * Give XP to player
     *
     * @param  array $parameters
     * @return void
     */
    public function GiveXpToPlayer(array $parameters) {
        $amount     = (float) $parameters[0] ?? null;
        $amount     += $_SESSION["_ACCOUNT_"]->Player->experience ?? 0.0;
        $this->Database->Request("UPDATE `players` SET experienceZZZ = :experience WHERE uuid = :uuid", [
            "uuid"          => $_SESSION["_ACCOUNT_"]->Player->identifier,
            "experience"    => $amount
        ]);
        return;
    }

    /**
     * Define player model
     *
     * @param  array $parameters
     * @return void
     */
    public function DefineModel(array $parameters): void {
        $model = (!empty($parameters[0])? $parameters[0]: null);
        $this->Database->Request("UPDATE `players` SET character_name = :character_name WHERE uuid = :uuid", [
            "uuid"              => $_SESSION["_ACCOUNT_"]->Player->identifier,
            "character_name"    => $model
        ]);
        return;
    }

     /**
     * Define player class
     *
     * @param  array $parameters
     * @return void
     */
    public function DefineClass(array $parameters): void {
        $class = (!empty($parameters[0])? $parameters[0]: null);
        $stats = [
            "ARCHER" => [
                "endurance"     => 10,
                "strength"      => 12,
                "agility"       => 9,
                "intelligence"  => 10
            ],
            "MAGE" => [
                "endurance"     => 10,
                "strength"      => 9,
                "agility"       => 10,
                "intelligence"  => 10
            ],
            "ARCHER" => [
                "endurance"     => 10,
                "strength"      => 10,
                "agility"       => 12,
                "intelligence"  => 10
            ]
        ];
        $this->Database->Request("UPDATE `players` SET class = :class, stats = :stats WHERE uuid = :uuid", [
            "uuid"  => $_SESSION["_ACCOUNT_"]->Player->identifier,
            "class" => $class,
            "stats" => \json_encode($stats[$class])
        ]);
        return;
    }

}

?>