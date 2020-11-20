<?php

namespace LegendsGame;

class Response {
    
    public $Service;
    public $_ACCOUNT_;

    public function __construct(?string $Service) {
        $this->Service      = $Service;
        $this->Path         = \realpath( __PATH__ . "/src/Views/" . (!empty($this->Service)? "{$this->Service}/": null) );
        $this->_ACCOUNT_    = (isset($_SESSION["_ACCOUNT_"]) && !empty($_SESSION["_ACCOUNT_"])? $_SESSION["_ACCOUNT_"]: null);
    }
    
    /**
     * Load service
     *
     * @param  string $ModelName
     * @param  array $Binded
     * @param  array $components
     * @return void
     */
    public function Load(string $ModelName, array $Binded = [], array $Schedule = [], array $components = [ true, true ]): void {
        [ $_header, $_footer ] = $components;
        $ModelPath = \realpath( $this->Path . "/" . trim($ModelName, "/") . ".php" );
        if (!empty($ModelPath) && $ModelPath !== false) {
            [ $header, $footer ] = $this->GetComponents();

            // Injected datas
            $_ACCOUNT_      = $this->_ACCOUNT_;
            $_DATAS_        = $Binded;

            require (!empty($header)? $header: __PATH__ . "/src/Components/header.php");

            // Scheduled closures
            $_SCHEDULED_    = $this->ScheduleObjects($Schedule);

            require $ModelPath;

            if ($_footer) {
                require (!empty($footer)? $footer: __PATH__ . "/src/Components/footer.php");
            }

        } else {
            http_response_code(500);
            echo "<b>FATAL INTERNAL ERROR</b>: Model \"{$ModelName}\" not found.";
        }
        return;
    }
    
    /**
     * Add notification
     *
     * @param  string $name
     * @return void
     */
    public function SetNotification(string $name, array $parameters = []): void {
        $_SESSION["_NOTIFICATIONS_"]    = (isset($_SESSION["_NOTIFICATIONS_"])? $_SESSION["_NOTIFICATIONS_"]: []);
        $notify                         = [];
        $notifications                  = (file_exists(__PATH__  . "/src/conf/notifications.json")? json_decode(file_get_contents( __PATH__  . "/src/conf/notifications.json"), false): []);
        foreach ($notifications as $n=>$notification) {
            if ($n == $name) {
                preg_match_all("/{(.*)}/", $notification->message, $matches);
                $matches = (!empty($matches)? $matches: []);
                foreach ($matches[1] as $i=>$match) {
                    foreach ($parameters as $parameter=>$value) {
                        if ($match == $parameter) {
                            $notification->message = str_replace($matches[0][$i], $value, $notification->message);
                        }
                    }
                }
                $notify = $notification;
                break;
            }
        }
        if (!empty($notify)) {
            array_push($_SESSION["_NOTIFICATIONS_"], $notification);
        }
        return;
    }

    /**
     * Refresh client
     *
     * @param  string $URI
     * @return void
     */
    public function HttpClientRefresh(): void {
        header("Refresh: 0");
        exit;
    }
    
    /**
     * Redirect client
     *
     * @param  string $URI
     * @return void
     */
    public function HttpClientRedirect(string $URI): void {
        header("Location: $URI");
        exit;
    }
    
    /**
     * Return current service components
     *
     * @return array
     */
    private function GetComponents(): array {
        $header = \realpath( __PATH__ . "/src/Components/" . (!empty($this->Service)? "{$this->Service}/": null) . "header.php" );
        $footer = \realpath( __PATH__ . "/src/Components/" . (!empty($this->Service)? "{$this->Service}/": null) . "footer.php" );
        return [ $header, $footer ];
    }
    
    /**
     * Schedule objects (Used for execute heavy tasks after send header)
     *
     * @param  array $Schedule
     * @return array
     */
    private function ScheduleObjects(array $Schedule): array {
        foreach ($Schedule as $i=>$Object) {
            $Schedule[$i] = $Object();
        }
        return $Schedule;
    }

}

?>