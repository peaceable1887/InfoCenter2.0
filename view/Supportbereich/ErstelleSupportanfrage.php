<?php


class ErstelleSupportanfrage
{
    function showContent(array $priorityName)
    {
        $content = "<form action='' method='post'><div class='formContainer'>
            <table id='formular'>
                 <tr>
                    <th>Sachgebiet*<br>
                                         <select>
                                            <option value=\"\" disabled selected hidden>Sachgebiet auswählen...</option>
                                            <option></option>
                                            <option></option>
                                            <option></option>
                                            <option></option>
                                          </select></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Typ der Anfrage* <br><select>
                                            <option value=\"\" disabled selected hidden>Typ der Anfrage auswählen...</option>
                                            <option>Fehlermeldung</option>
                                            <option>Infoanfrage</option>
                                            <option>Änderungswunsch</option>
                                          </select></th></th>
                </tr>
                <tr>
                    <th>Priorität* <br><select>
                                            <option value=\"\" disabled selected hidden>Priorität auswählen...</option>
                                            <option>".$priorityName[0]."</option>
                                            <option>".$priorityName[1]."</option>
                                            <option>".$priorityName[2]."</option>
                                            <option>".$priorityName[3]."</option>
                                            <option>".$priorityName[4]."</option> 
                                          </select></th></th>
                </tr>
                <tr>
                    <th>Betreff*<br><input class='inputField'name='vorname' value=''></th>
                </tr>
                <tr>
                    <th>Beschreibung* <br><textarea class='supportDescription'></textarea></th>
                </tr>
                <tr>
                    <th>Dateianhang* <br><input id=\"fileFile\" type=\"File\" name=\"file\"></th>
                </tr>
              </table>
          
                <span><span style='font-weight: bold'>Hinweis:</span><br>Zur Erfassung Ihrer Supportanfrage füllen Sie 
                bitte alle Felder vollständig aus und klicken dann auf „Daten speichern“.<br><p></p><br>
                Bitte hängen Sie ein Bildschirmfoto oder eine weiterführende Datei an Ihre Anfrage an.</span><br><br>
                <div class='btnDiv'><button class='buttonConfirm'>
                <a id='linkDescription' href='http://127.0.0.1/wordpress/daten-zur-supportanfrage-ergaenzen/'>
                SUPPORT ANFRAGEN</a></button></div>
            
         </div></form>";

        return $content;
    }
}