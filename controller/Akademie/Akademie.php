<?php

class Akademie
{
    function showLoadUpcommingEvents($dbCon, $sqlStm)
    {
        $currentDate = date("Y-m-d");

        $sqlRes = mysqli_query($dbCon, $sqlStm->sqlQuery_loadASC($currentDate));
        $recordCount = mysqli_num_rows($sqlRes);
        $_SESSION["recordList"] = $recordCount;

        echo "<table>\n";
        echo "<tr>\n";
        echo "<th>Datum</th>\n";
        echo "<th>Ort</th>\n";
        echo "<th>Fachbereich</th>\n";
        echo "<th>Name</th>\n";
        echo "<th>Details</th>\n";
        echo "</td>\n";

        for ($i = 0;$i < $recordCount;$i++)
        {
            $arCur = mysqli_fetch_array($sqlRes);
            $infoSemEvent = new info_sem_event();

            $infoSemEvent->setEventStartDate(utf8_encode($arCur["Event_StartDate"]));
            $newStartDate = date("d.",strtotime($infoSemEvent->getEventStartDate()));
            $infoSemEvent->setEventEndDate(utf8_encode($arCur["Event_EndDate"]));
            $newEndDate = date("d.m.Y",strtotime($infoSemEvent->getEventEndDate()));
            $_SESSION[$i."eventNumber"] = utf8_encode($arCur["Seminar_ID"]);

            echo "<tr>\n";

            echo "<td>\n";
            echo $newStartDate."-".$newEndDate;
            echo "</td>\n";

            echo "<td>\n";
            echo utf8_encode($arCur["Event_Location"]);
            echo "</td>\n";

            echo "<td>\n";
            echo utf8_encode($arCur["Field_Name"]);
            echo "</td>\n";

            echo "<td>\n";
            echo utf8_encode($arCur["Seminar_Name"]);
            echo "</td>\n";

            echo "<td>\n";
            echo "<a id='linkDescription' href='http://127.0.0.1/wordpress/akademie-events-buchung-schritt-1/?linkDescription".$i."'>
              <span class='btnMore'>Mehr erfahren</span></a>";
            echo "</td>\n";

            echo "</tr>\n";
        }

        echo "</table>\n";

    }

    //Funktion noch umändern und ausbauen
   /* function eventContent($dbCon, $sqlStm)
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordList"];

        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {
                $sqlRes = mysqli_query($dbCon, $sqlStm->sqlQuery_showDownloadDetails($_SESSION[$i."eventNumber"]));
                $arCur = mysqli_fetch_array($sqlRes);

                $downloadSubject = utf8_encode($arCur["Download_Subject"]);
                $downloadDate = utf8_encode($arCur["Download_Date"]);
                $downloadDateConvert = strtotime($downloadDate);
                $newDownloadDate = date("d.m.Y",$downloadDateConvert);
                $downloadNumber = utf8_encode($arCur["Download_Number"]);
                $fieldName = utf8_encode($arCur["Field_Name"]);
                $downloadDescription = utf8_encode($arCur["Download_Description"]);
                //nochmal nachsehen ob richtige Spalte
                $fileSize = utf8_encode($arCur["File_Size"]);

                break;
            }

        }
        mysqli_close($dbCon);

        $content = new downloadContent();

        echo $content->downloadContentDescription($downloadSubject,$newDownloadDate,
            $downloadNumber,$fieldName,$downloadDescription, $fileSize);

    }*/

    function showBuchung_seminarBlock($dbCon, $sqlStm)
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordList"];
        $currentDate = date("Y-m-d");

        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {
                //Statement ggf. nochmal Überarbeiten. Fehler bei gleichen Datum...
                $sqlRes = mysqli_query($dbCon, $sqlStm->tile_content($currentDate));

                for($x = 0; $x < $i+1; $x++)
                {
                    $arCur = mysqli_fetch_array($sqlRes);
                    $arr[$x] = utf8_encode($arCur["Event_StartDate"]);
                    //echo $arr[$i];
                    $arr[$x] = utf8_encode($arCur["Field_Name"]);
                    //echo $arr[$i];
                    $arr[$x] = utf8_encode($arCur["Seminar_Name"]);
                    //echo $arr[$i];
                    $arr[$x] = utf8_encode($arCur["Type_Name"]);
                    //echo $arr[$i];
                }

                $fieldName = utf8_encode($arCur["Field_Name"]);
                $seminarName = utf8_encode($arCur["Seminar_Name"]);

                $startDate = utf8_encode($arCur["Event_StartDate"]);
                $startDateConvert = strtotime($startDate);
                $newStartDate = date("d.",$startDateConvert);

                $endDate = utf8_encode($arCur["Event_EndDate"]);
                $endDateConvert = strtotime($endDate);
                $newEndDate = date("d.m.Y",$endDateConvert);
                $typeName = utf8_encode($arCur["Type_Name"]);

                $_SESSION["linkVarCount"] = $i;

                $semTile = new semTile($fieldName, $seminarName, $newStartDate,
                    $newEndDate, utf8_encode($arCur["Event_Location"]), $typeName , $_SESSION["linkVarCount"]);

                return $semTile->__toString();

            }

        }
        mysqli_close($dbCon);

    }

    function showBuchung_beschreibung($dbCon, $sqlStm)
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordList"];
        $currentDate = date("Y-m-d");

        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {
                $sqlRes = mysqli_query($dbCon, $sqlStm->content_description($currentDate));

                for($x = 0; $x < $i+1; $x++)
                {
                    $arCur = mysqli_fetch_array($sqlRes);
                    $arr[$x] = utf8_encode($arCur["Seminar_Description"]);
                    return "<span class='semBookingDescription'>".$arr[$i]."</span>";
                }
                mysqli_close($dbCon);
            }
        }

    }

    function showBuchung_inhalt($dbCon, $sqlStm)
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordList"];
        $currentDate = date("Y-m-d");

        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {
                $sqlRes = mysqli_query($dbCon, $sqlStm->content_matter($currentDate));

                for($x = 0; $x < $i+1; $x++)
                {
                    $arCur = mysqli_fetch_array($sqlRes);
                    $arr[$x] = utf8_encode($arCur["Seminar_Content"]);
                    $teilung = explode(";",$arr[$i]);
                    //echo $arr[$i];
                    for($z = 0; $z <= substr_count($arr[$i], ";"); $z++)
                    {
                        if(isset($arr[$i]))
                        {
                            return "<img class='semBookingContentImg' width='12'>
                              <span class='semBookingContent'>"
                                .$teilung[$z]."</span><br>";
                        }
                    }
                }
                mysqli_close($dbCon);
            }
        }

    }

    function showBuchung_zielgruppe($dbCon, $sqlStm)
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordList"];
        $currentDate = date("Y-m-d");

        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {
                $sqlRes = mysqli_query($dbCon, $sqlStm->targetGroup($currentDate));

                for($x = 0; $x < $i+1; $x++)
                {
                    $arCur = mysqli_fetch_array($sqlRes);
                    $arr[$x] = utf8_encode($arCur["Seminar_Target"]);
                    return "<span class='semBookingTargetGrp'>".$arr[$i]."</span>";
                }

                mysqli_close($dbCon);
            }
        }

    }

    function showBuchung_voraussetzungen($dbCon, $sqlStm)
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordList"];
        $currentDate = date("Y-m-d");

        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {

                $sqlRes = mysqli_query($dbCon, $sqlStm->requirement($currentDate));

                for($x = 0; $x < $i+1; $x++)
                {
                    $arCur = mysqli_fetch_array($sqlRes);
                    $arr[$x] = utf8_encode($arCur["Seminar_Premises"]);
                    return "<span class='semBookingPreCond'>".$arr[$i]."</span>";
                }

                mysqli_close($dbCon);
            }
        }
    }

    function showBuchung_button_zurBuchung()
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordList"];
        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {
                return "<a id='linkDescription' href='http://127.0.0.1/wordpress/akademie-events-buchung-schritt-2/?linkDescription".$i."'
                ><button class='buttonConfirmReg'>
                REGISTRIEREN</button></a>";
            }
        }
    }

    function showInformation_teilnehmendePerson()
    {
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Funktion muss noch ausgelagert werden. -->
        <script>
            $(document).ready(function(){
                var maxField = 10;
                var addButton = $('.add_button');
                var wrapper = $('.field_wrapper');
                var fieldHTML = '<div><table id=\'formular\'>\n' +
                    '                <tr>\n' +
                    '                    <th>Vorname: <input class=\'formInput\' name=\'vorname\'></th>\n' +
                    '                    <th>Name: <input class=\'formInput\' name=\'nachname\'></th>\n' +
                    '                    <th>E-Mail: <input class=\'formInput\' name=\'email\'></th>' +
                    '                     Teilnehmer | <a href="javascript:void(0);" class="remove_button">Entfernen</a>' +
                    '                </tr>' +
                    '              </table></div>';
                var x = 1;
                let countHTML = '<div>' + x + '</div>';

                $(addButton).click(function(){
                    if(x < maxField){
                        x++;
                        $(wrapper).append(fieldHTML);
                    }
                });

                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
            });
        </script>

        <?php
        $container = new TeilnehmendePerson();
        $recordCount = $_SESSION["recordList"];
        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["linkDescription".$i]))
            {
                echo $container->showRegister($_SESSION["User_Firstname"],$_SESSION["User_Surname"],$_SESSION["User_Email"],$i);

            }
        }
    }
}