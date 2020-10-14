<?php

namespace LegendsGame;

class Account {


    public function __construct() {
        $this->Database = new \LegendsGame\Database("default", true);
    }
    
    /**
     * Sign in player
     *
     * @param  string $username
     * @param  string $password
     * @return bool
     */
    public function SignIn(string $username, string $password): bool {
        $username   = htmlentities($username);
        $password   = hash("sha256", $password);
        $response = $this->Database->Request("SELECT * FROM `players` WHERE `username` = :username OR `email` = :username", [
            "username" => $username
        ]);
        $Player = $response->fetch();
        if (!empty($Player)) {
            if ($Player["password"] == $password) {
                $_SESSION["_ACCOUNT_"] = (object) [
                    "Player"        => (object) [
                        "identifier"    => $Player["uuid"],
                        "username"      => $Player["username"],
                        "email"         => $Player["email"],
                        "level"         => (int) $Player["level"],
                        "character"     => (object) [
                            "name"  => $Player["character_name"],
                            "skin"  => (!empty($Player["skin"])? json_decode($Player["skin"], false): [])
                        ]
                    ],
                    "Inventory"     => (!empty($Player["inventory"])? json_decode($Player["inventory"], false): [])
                ];
                return true;
            }
        }
        return false;
    }

    /**
     * Sign up player
     *
     * @param  string $username
     * @param  string $password
     * @return bool
     */
    public function SignUp(string $username, string $email, string $password): bool {
        $username   = htmlentities($username);
        $email      = htmlentities($email);
        $password   = hash("sha256", $password);
        if ($this->SearchAccount($username, $username, $email) === null) {
            $response   = $this->Database->Request("INSERT INTO `players` (`uuid`, `email`, `username`, `password`, `character_name`, `skin`, `level`, `inventory`, `created`) VALUES (:uuid, :email, :username, :password, null, null, 0, null, :created);", [
                "uuid"      => $this->CreateRandomString(64),
                "email"     => $email,
                "username"  => $username,
                "password"  => $password,
                "created"   => date(__DATE_FORMAT__),
            ]);
        }
        return (!empty($response) && !isset($response->errorInfo)? true: false);
    }
    
    /**
     * Search player account
     *
     * @param  string $username
     * @param  string $email
     * @return object
     */
    private function SearchAccount(string $identifier, string $username, $email): ?object {
        $identifier = htmlentities($identifier);
        $username   = htmlentities($username);
        $email      = htmlentities($email);
        $response = $this->Database->Request("SELECT * FROM `players` WHERE `uuid` = :identifier OR `username` = :username  OR `email` = :email", [
            "identifier"    => $identifier,
            "username"      => $username,
            "email"         => $email
        ]);
        $Player = $response->fetch();
        return (empty($Player)? null: (object) [
            "identifier"    => $Player["uuid"],
            "username"      => $Player["username"],
            "email"         => $Player["email"]
        ]);
    }
    
    /**
     * Create random string
     *
     * @param  int $length
     * @param  float $characters
     * @return string
     */
    private function CreateRandomString(int $length, string $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"): string {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
