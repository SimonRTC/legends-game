<?php

namespace LegendsGame;

class Game {

    public  $Chapters;
    public  $Characters;
    public  $Actions;
    private $Database;
    private $GameCore;

    public function __construct() {
        $this->Database     = new \LegendsGame\Database("default", true);
        $this->GameCore     = $this->GetGameCore();
        $this->Chapters     = $this->GameCore["chapters"];
        $this->Characters   = $this->GameCore["characters"];
        $this->Actions      = $this->ParseActions($this->GameCore["actions"]);
    }
    
    /**
     * Return merged characters informations
     *
     * @param  array $characters
     * @return array
     */
    public function GetCharacters(array $characters): array {
        foreach ($characters as &$character) {
            $character = (object) array_merge((array) $character, (isset($this->Characters->{$character->identifier}) && !empty($this->Characters->{$character->identifier})? (array) $this->Characters->{$character->identifier}: []));
        }
        return $characters;
    }
        
    /**
     * Parse actions commands
     *
     * @param  object $actions
     * @return object
     */
    private function ParseActions(object $actions): object {
        foreach ($actions as &$action) {
            $action = function ($parameters) use ($action): ?bool {
                [ $class, $function ] = explode("::", $action->callable);
                try {
                    $callable = new $class();
                    $callable = $callable->{$function}($parameters);
                    if ($action->refresh && !headers_sent()) {
                        header("Refresh: 0");
                    }
                } catch (\Throwable $e) {
                    dump("ACTION DEBUG:", $e);
                    $callable = null;
                }
                return $callable;
            };
        }
        return $actions;
    }

    /**
     * Return game core configurations
     *
     * @return array
     */
    private function GetGameCore(): array {
        $cores  = [];
        $path   = realpath(__PATH__ . "/src/conf/game-core");
        if (!empty($path)) {
            foreach (scandir($path) as $dir) {
                if ($dir != "." && $dir != "..") {
                    [ $filename, $ext ] = explode(".", basename("{$path}/{$dir}"));
                    $content            = file_get_contents("{$path}/{$dir}");
                    $content            = ($ext == "json"? json_decode($content, false): $content);
                    if (!empty($content)) {
                        $cores = array_merge($cores, [ "{$filename}" => $content ]);
                    }
                }
            }
        }
        return $cores;
    }

}

?>