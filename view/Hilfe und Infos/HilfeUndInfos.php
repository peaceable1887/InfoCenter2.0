<?php
/*besserer Pfeil &#129094; (noch einfügen)*/

class HilfeUndInfos
{
    function showContent()
    {
        $content = "<div class='mainContainer'>
            <div class='infoText'><p>Die telefonische Hotline ist unter folgenden Nummern erreichbar (Wochentage + Uhrzeit)<p></div>
            <div class='infoTextNumber'><p>&#10142; Hotline Rufnummer: 040 / 30 98 30 - Durchwahl<p></div>
            <div class='callNumberCollections'>
                <div class='callEndNumber'>Rechenzentrum: - 00</div>
                <div class='callEndNumber'><b>ENER:GY / EDM</b><br>
                                            ENER:GY: - 26<br>
                                            EDM: - 29
                                            </div>
                <div class='callEndNumber'><b>Technischer Support</b><br>
                                            ORACLE: - 41<br>
                                            UNIX: - 42<br>
                                            Windows: - 43
                                            </div>
                <div class='callEndNumber'><b>Kaufmännische Module</b><br>
                                            CSA: - 25<br>
                                            CSF: - 22<br>
                                            CSE: - 27<br>
                                            CSL: - 27<br>
                                            CSP: - 27<br>
                                            CSV: - 27
                                            </div>
            </div>
          </div>";

        return $content;
    }

    function handbookInfo()
    {
        $test = "<div class='handbookInfo'>                
                      <img src='http://127.0.0.1/wordpress/wp-content/uploads/2021/07/iconmonstr-warning-2-240.png'>
                      <p>Handbuch zum Einstellen von Supportanfragen<br>
                      <img src='http://127.0.0.1/wordpress/wp-content/uploads/2021/08/terminblatt.png'></img></p>         
                 </div>";

        return $test;
    }
}