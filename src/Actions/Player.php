<?php

namespace LegendsGame\Actions;

class Player {
    
    /**
     * Define player model
     *
     * @param  array $parameters
     * @return void
     */
    public function DefineModel(array $parameters): void {
        $model      = (!empty($parameters["MODEL"])? $parameters["MODEL"]: null);

        dump($model);

        return;
    }

}

?>