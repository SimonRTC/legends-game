<?php

namespace LegendsGame\Controllers;

class Account {

    private $Account;

    public function __construct() {
        $this->Account = new \LegendsGame\Account;
    }

     /**
     * Sign in
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function SignIn(\LegendsGame\Response $Response, array $Binded = [], ?object $_ACCOUNT_): void {
        if (empty($_ACCOUNT_)) {
            if (!empty($_POST)) {
                $username = (!empty($_POST["username"])? $_POST["username"]: null);
                $password = (!empty($_POST["password"])? $_POST["password"]: null);
                if (!empty($username) && !empty($password)) {
                    $cb = $this->Account->SignIn($username, $password);
                    if (!$cb) {
                        $Response->SetNotification("SIGN-IN_FAILURE");
                    }
                    $Response->HttpClientRefresh();
                    return;
                }
            }
            $Response->load("account/signin", [], [], [ true, false ]);
            return;
        }
        $Response->HttpClientRedirect("/");
        return;
    }

    /**
     * Sign up
     *
     * @param  object $Response
     * @param  array $Binded
     * @return void
     */
    public function SignUp(\LegendsGame\Response $Response, array $Binded = [], ?object $_ACCOUNT_): void {
        if (empty($_ACCOUNT_)) {
            if (!empty($_POST)) {
                $username   = $_POST["username"] ?? null;
                $email      = $_POST["email"] ?? null;
                $password   = $_POST["password"] ?? null;
                if (!empty($username) && !empty($email) && !empty($password)) {
                    $cb = $this->Account->SignUp($username, $email, $password);
                    if (!$cb) {
                        $Response->SetNotification("SIGN-UP_FAILURE");
                    } else {
                        $this->Account->SignIn($username, $password);
                    }
                    $Response->HttpClientRefresh();
                    return;
                }
            }
            $Response->load("account/signup");
            return;
        }
        $Response->HttpClientRedirect("/");
        return;
    }
    
    /**
     * Logout
     *
     * @return void
     */
    public function Logout(\LegendsGame\Response $Response): void {
        SESSION_DESTROY();
        $Response->HttpClientRedirect("/");
        return;
    }

}

?>