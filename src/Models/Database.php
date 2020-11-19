<?php

namespace LegendsGame;

class Database {
    
    public  $dbname;
    private $PDO;
    private $Databases;
    private $Database;
    private $isReady;
    
    /**
     * __construct
     *
     * @param  string $database
     * @param  bool $DefaultInit
     * @return void
     */
    public function __construct(string $database = "default", bool $StartInit = false) {
        $this->PDO          = null;
        $this->dbname       = null;
        $this->Databases    = \json_decode(\file_get_contents( __PATH__ . "/src/conf/databases.json"), false);
        $this->Database     = (isset($this->Databases->{$database}) && !empty($this->Databases->{$database})? $this->Databases->{$database}: null);
        $this->isReady      = true;
        if (empty($this->Database)) {
            $this->isReady = false;
        } elseif ($StartInit) {
            $this->Init();
            $this->dbname = $database;
        }
    }
    
    /**
     * Return true if PDO is ready
     *
     * @return bool
     */
    public function isReady(): bool {
        return $this->isReady;
    }
    
    /**
     * Return created PDO object
     *
     * @return object
     */
    public function GetPDO(): object {
        return $this->PDO;
    }

    /**
     * Switch on other database
     *
     * @param  string $database
     * @return bool
     */
    public function Switch(string $database): bool {
        if (isset($this->Databases->{$database}) && !empty($this->Databases->{$database})) {
            $this->Database = $this->Databases->{$database};
            $this->Init();
            $this->dbname = $database;
            return true;
        }
        return false;
    }
    
    /**
     * Init a new PDO object
     *
     * @return void
     */
    public function Init(): void {
        $this->PDO = new \PDO("mysql:host={$this->Database->host};port={$this->Database->port};dbname={$this->Database->database};charset={$this->Database->charset}", $this->Database->username, $this->Database->password);
        return;
    }
    
    /**
     * Execute request
     *
     * @param  string $SQL
     * @param  array $Parameters
     * @return object
     */
    public function Request(string $SQL, array $Parameters = []): object {
        $Request = $this->PDO->prepare($SQL);
        foreach ($Parameters as $Parameter=>$Value) {
            $Request->bindValue(":{$Parameter}", $Value);
        }
        $Request->execute();
        return $Request;
    }   
    
}

?>