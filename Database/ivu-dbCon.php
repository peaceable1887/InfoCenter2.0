<?php
//noch auf PDO wechseln !
class infoCenterDbCon extends mysqli
{
    public function __construct()
    {
        parent::__construct("192.168.254.10", "ossy_system", "N8express", "ivu-ossy-prod");
        if($this->connect_error)
        {
            echo("Datenbankverbindung fehlgeschlagen" . $this->conncet_error);
        }
    }
}
