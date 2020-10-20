<?php

namespace LegendsGame;

class EnvVars {
    
    private $Parser;
    private $Vars;

    public function __construct() {
        $this->Parser   = \json_decode(\file_get_contents( __PATH__ . "/src/conf/parser.json"), false);
        $this->Vars     = getenv();
        
        if (!empty($this->Parser)) {
            $this->FetchAllVars();
        }
    }
    
    /**
     * Fetch all environment variables
     *
     * @return void
     */
    private function FetchAllVars(): void {
        foreach ($this->Parser->vars as $varname => $path) {
            $path = str_replace("{PATH}", __PATH__, $path);
            if (!file_exists($path)) {
                [ $path, $data ] = $this->GetEnvVarContent($path, $varname);
                if (!empty($data)) {
                    file_put_contents($path, $data);
                } 
            }
        }
        return;
    }
    
    /**
     * Return environment variable data
     *
     * @param  string $path
     * @param  string $varname
     * @return array
     */
    private function GetEnvVarContent(string $path, string $varname): array {
        foreach ($this->Vars as $var => $value) {
            if ("{$this->Parser->namesapce}{$varname}" == $var) {
                [ $format, $value ] = explode($this->Parser->semantic, $value);
                if ($format == "JSON") {
                    $path   = str_replace("{format}", strtolower($format), $path);
                    $data   = $value;
                } else {
                    throw new \Exception("The format \"{$format}\" is not recognized.");
                }
                break;
            }
        }
        return [ $path, (!empty($data)? $data: null) ];
    }

}

?>