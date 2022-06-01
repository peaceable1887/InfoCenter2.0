<?php


class GlobalContent
{
    function showSiteDirection()
    {
        $linkDir = new LinkVerzeichnis();
        $linkPatternDownl = "/\?d.*/";
        $linkPatternCall = "/\?t.*/";
        $linkPatternSem = "/\?l.*/";
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //links noch dynamisch gestalten....
        $links = array
        (
            "infoCenter" => "http://127.0.0.1/wordpress/",
            "settings" => "http://127.0.0.1/wordpress/einstellungen/",
            "akademie" => array
            (
                "akademieStartseite" => "http://127.0.0.1/wordpress/akademie-events/",
                "akademieUebersicht" => "http://127.0.0.1/wordpress/akademie-events-uebersicht/",
                "kursuebersicht" => "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-1/$linkPatternSem",
                "registrierung" => "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-2/$linkPatternSem",
                "buchungErfolgreich" => "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-3/$linkPatternSem",
                "infosUndDownloads" => "http://127.0.0.1/wordpress/informationen-und-downloads/"
            ),
            "supportanfrage" => array
            (
                "supportCenter" => "http://127.0.0.1/wordpress/support-center/",
                "overviewSupportcall" => "http://127.0.0.1/wordpress/uebersicht-supportanfragen/",
                "newSupportcall" => "http://127.0.0.1/wordpress/neue-supportanfrage/",
                "extendSupportData" => "http://127.0.0.1/wordpress/daten-zur-supportanfrage-ergaenzen/",
                "supportcallNumber" => "http://127.0.0.1/wordpress/support-anfrage-nummer/$linkPatternCall",
            ),
            "downloads" => array
            (
                "downloadCenter" => "http://127.0.0.1/wordpress/download-center/",
                "alleDownloads" => "http://127.0.0.1/wordpress/downloads/",
                "detailDownloads" => "http://127.0.0.1/wordpress/download-details/$linkPatternDownl",
                "meineDownloads" => "http://127.0.0.1/wordpress/download-details/",
            ),

            "hilfe" => "http://127.0.0.1/wordpress/hilfe/",
            "infos" => "http://127.0.0.1/wordpress/infos/",
        );

        if($url === $links["infoCenter"])
        {
            echo "";
        }
        else if($url === $links["settings"])
        {
            echo $linkDir->settings();
        }
        else if($url === $links["akademie"]["akademieStartseite"])
        {
            echo $linkDir->akademieStartseite();
        }
        else if($url === $links["akademie"]["akademieUebersicht"])
        {
            echo $linkDir->akademieUebersicht();
        }
        else if(preg_match_all($linkPatternSem, $url))
        {
            echo $linkDir->kursuebersicht();
        }
        else if($url === $links["akademie"]["registrierung"])
        {
            echo $linkDir->registrierung();
        }
        else if(preg_match_all($linkPatternSem, $url))
        {
            echo $linkDir->buchungErfolgreich();
        }
        else if($url === $links["akademie"]["infosUndDownloads"])
        {
            echo $linkDir->infosAndDownloads();
        }
        else if($url === $links["downloads"]["downloadCenter"])
        {
            echo $linkDir->downloadCenter();
        }
        else if($url === $links["downloads"]["alleDownloads"])
        {
            echo $linkDir->allDownloads();
        }
        else if(preg_match_all($linkPatternDownl, $url))
        {
            echo $linkDir->detailDownloads();
        }
        else if($url === $links["supportanfrage"]["supportCenter"])
        {
            echo $linkDir->supportCenter();
        }
        else if($url === $links["supportanfrage"]["overviewSupportcall"])
        {
            echo $linkDir->overviewSupportcall();
        }
        else if($url === $links["supportanfrage"]["newSupportcall"])
        {
            echo $linkDir->newSupportcall();
        }
        else if($url === $links["supportanfrage"]["extendSupportData"])
        {
            echo $linkDir->extendSupportData();
        }
        else if(preg_match_all($linkPatternCall, $url))
        {
            echo $linkDir->supportcallNumber();
        }
        else if($url === $links["hilfe"])
        {
            echo $linkDir->hilfe();
        }
        else if($url === $links["infos"])
        {
            echo $linkDir->infos();
        }
    }

    function showUserGreeting()
    {
        $userFirstname = $_SESSION["User_Firstname"];
        $welcome = "Hallo";

        return $welcome." ".$userFirstname;
    }
    function showUserData()
    {
        return "<a href='http://127.0.0.1/wordpress/einstellungen/'>Persönliche Daten</a>";
    }

    function showLogout()
    {
        $logout = "<form method='post'><button name='logout'>Abmelden</button></form>";

        if(isset($_POST["logout"]))
        {
            session_destroy();
            return "<meta http-equiv=\"refresh\" content=\"0; URL=http://127.0.0.1/wordpress/login\">";
        }

        return $logout;
    }

    function showHeadline()
    {

        $linkPatternDownl = "/\?d.*/";
        $linkPatternSem = "/\?l.*/";
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $headline = "";

        if($url === "http://127.0.0.1/wordpress/")
        {
            $headline = "<img src=\"http://127.0.0.1/wordpress/wp-content/uploads/2022/02/IVU-Logo_Transparent_zuschnitt.png\" width=\"300\" height=\"400\">";
            return $headline;
        }
        /*else if($url ===  "http://127.0.0.1/wordpress/akademie-events/")
        {
            $headline = "<h1>AKADEMIE UND EVENTS</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events-uebersicht/")
        {
            $headline = "<h1>AKADEMIE UND EVENTS</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-1/")
        {
            $headline = "<h1>AKADEMIE UND EVENTS</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-2/")
        {
            $headline = "<h1>AKADEMIE UND EVENTS</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-3/")
        {
            $headline = "<h1>AKADEMIE UND EVENTS</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/einstellungen/")
        {
            $headline = "<h1>EINSTELLUNGEN</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/download-center/")
        {
            $headline = "<h1>DOWNLOAD CENTER</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/downloads/")
        {
            $headline = "<h1>DOWNLOAD CENTER</h1>";
            return $headline;
        }
        else if(preg_match_all($linkPatternDownl, $url))
        {
            $headline = "<h1>DOWNLOAD CENTER</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/hilfe/")
        {
            $headline = "<h1>HILFE UND INFOS</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/support-center/")
        {
            $headline = "<h1>SUPPORT CENTER</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/infos/")
        {
            $headline = "<h1>INFORMATIONEN</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/neue-supportanfrage/")
        {
            $headline = "<h1>NEUE SUPPORTANFRAGE</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/daten-zur-supportanfrage-ergaenzen/")
        {
            $headline = "<h1>NEUE SUPORTANFRAGE</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/support-anfrage-nummer/")
        {
            $headline = "<h1>NEUE SUPORTANFRAGE</h1>";
            return $headline;
        }
        else if($url ===  "http://127.0.0.1/wordpress/uebersicht-supportanfragen/")
        {
            $headline = "<h1>ÜBERSICHT SUPPORTANFRAGEN</h1>";
            return $headline;
        }
        else
        {
            $headline = "<h1>AKADEMIE UND EVENTS</h1>";
            return $headline;
        }*/
    }

    function showSubheadline()
    {
        $linkPatternDownl = "/\?d.*/";
        $linkPatternSem = "/\?l.*/";
        $linkPatternCall = "/\?t.*/";
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if($url === "http://127.0.0.1/wordpress/")
        {
            echo "<span class='subHeadline'>INFOCENTER<br>IVU INFORMATIONSSYSTEME</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events/")
        {
            echo "<span class='subHeadline'>Akademie und Events</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events-uebersicht/")
        {
            echo "<span class='subHeadline'>Gesamte Kursübersicht</span>";
        }
        else if(preg_match_all($linkPatternSem, $url))
        {
            echo "<span class='subHeadline'>Kurs Buchen</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-2/")
        {
            echo "<span class='subHeadline'>Kurs Buchen</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/akademie-events-buchung-schritt-3/")
        {
            echo "<span class='subHeadline'>Kurs Buchen</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/meine-gebuchten-veranstaltungen/")
        {
            echo "<span class='subHeadline'>Meine gebuchten Veranstaltungen und Events</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/informationen-und-downloads/")
        {
            echo "<span class='subHeadline'>Informationen und Downloads</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/einstellungen/")
        {
            echo "<span class='subHeadline'>Persönliche Daten</span>";

        }
        else if($url ===  "http://127.0.0.1/wordpress/downloads/")
        {
            echo "<span class='subHeadline'>Alle Downloads</span>";
        }
        else if(preg_match_all($linkPatternDownl, $url))
        {
            echo "<span class='subHeadline'>Download Details</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/hilfe/")
        {
            echo "<span class='subHeadline'>Hilfe und Infos</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/support-anfragen/")
        {
            echo "<span class='subHeadline'>Support Center</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/infos/")
        {
            echo "<span class='subHeadline'>Informationen</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/uebersicht-supportanfragen/")
        {
            echo "<span class='subHeadline'>Übersicht Supportanfragen</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/neue-supportanfrage/")
        {
            echo "<span class='subHeadline'>Neue Supportanfrage</span>";
        }
        else if($url ===  "http://127.0.0.1/wordpress/daten-zur-supportanfrage-ergaenzen/")
        {
            echo "<span class='subHeadline'>Daten zur Supportanfrage ergänzen</span>";
        }
        else if(preg_match_all($linkPatternCall, $url))
        {
            echo "<span class='subHeadline'>Supportanfrage Übersicht</span>";
        }
        else
        {
            echo "<span class='subHeadline'>Akademie und Events</span>";
        }
    }
}