<?php


class Supportbereich extends infoCenterDbCon
{
    function showTableSupportCalls($sqlStatement)
    {
        $sqlRes = $this->getMySqlQuery($this->dbCon(), $sqlStatement->myCompleted($_SESSION['userid']));
        $countCalls = $this->getNumRows($sqlRes);
        $_SESSION["recordSupportCalls"] = $countCalls;

        echo "<table class='tableList'>\n";
        echo "<tr>\n";
        echo "<th>Nummer</th>\n";
        echo "<th>Datum</th>\n";
        echo "<th>Status</th>\n";
        echo "<th>Sachgebiet</th>\n";
        echo "<th>Betreff</th>\n";
        echo "<th>Mitarbeiter/-in</th>\n";
        echo "<th>Details</th>\n";
        echo "</td>\n";

        for ($i = 0;$i < $countCalls;$i++)
        {
            $arCur = $this->getFetchArray($sqlRes);
            $_SESSION[$i."ticket_number"] = utf8_encode($arCur["Call_Number"]);

            echo "<tr>\n";

            echo "<td>\n";
            echo  $_SESSION[$i."ticket_number"];
            echo "</td>\n";

            echo "<td>\n";
            //aus dem DateConverter noch eine Klasse bauen
            $callDateReceived = utf8_encode($arCur["Call_Date_Received"]);
            $callDateReceivedConv = strtotime($callDateReceived);
            $newCallDateReceived = date("d.m.Y",$callDateReceivedConv);

            echo $newCallDateReceived;
            echo "</td>\n";

            echo "<td>\n";
            echo utf8_encode($arCur["Status_Name"]);
            echo "</td>\n";

            echo "<td>\n";
            echo utf8_encode($arCur["Field_Name"]);
            echo "</td>\n";

            echo "<td>\n";
            echo utf8_encode($arCur["Call_Subject"]);
            echo "</td>\n";

            echo "<td>\n";
            echo utf8_encode($arCur["User_Surname"]);
            echo "</td>\n";

            echo "<td>\n";
            echo "<a id='linkDescription' href='http://127.0.0.1/wordpress/support-anfrage-nummer/?ticket_number_".$i."'>
              <span class='btnMore'>Anzeigen</span></a>";
            echo "</td>\n";

            echo "</tr>\n";
        }


        echo "</table>\n";

    }

    function showTicketContent($sqlStm)
    {
        //Anzahl der Termine
        $recordCount = $_SESSION["recordSupportCalls"];

        for($i = 0; $i < $recordCount; $i++)
        {
            if(isset($_GET["ticket_number_".$i]))
            {
                $sqlRes = $this->getMySqlQuery($this->dbCon(), $sqlStm->loadTicketContent($_SESSION[$i."ticket_number"]));
                $arCur = $this->getFetchArray($sqlRes);

                $callNumber = utf8_encode($arCur["Call_Number"]);
                $callDate = utf8_encode($arCur["Call_Date_Received"]);
                $callDateConvert = strtotime($callDate);
                $newCallDate = date("d.m.Y",$callDateConvert);
                $statusName = utf8_encode($arCur["Status_Name"]);
                $fieldName = utf8_encode($arCur["Field_Name"]);
                $callSubject = utf8_encode($arCur["Call_Subject"]);
                $userFirst = utf8_encode($arCur["User_Firstname"]);
                $userSurname = utf8_encode($arCur["User_Surname"]);
                $priorityName = utf8_encode($arCur["Priority_Name"]);
                $categoryName = utf8_encode($arCur["Category_Name"]);
                $callDescription = utf8_encode($arCur["Call_Description"]);

            }

        }
        $this->closeDbCon($this->dbCon());

        $content = new TicketUebersicht();

        echo $content->showContent($callNumber,$newCallDate,$fieldName,
            $statusName,$priorityName,$categoryName,$userFirst, $userSurname,$callSubject,$callDescription);


    }

    function showTicketChat($sqlStm)
    {

        $recordCount = $_SESSION["recordSupportCalls"];

        for($i = 0; $i < $recordCount; $i++)
        {
            $sqlRes = $this->getMySqlQuery($this->dbCon(), $sqlStm->loadTicketContent($_SESSION[$i."ticket_number"]));
            $arCur = $this->getFetchArray($sqlRes);
            $_SESSION[$i."ticket_number"] = utf8_encode($arCur["Call_Number"]);

            if(isset($_GET["ticket_number_".$i]))
            {
                $sql = mysqli_query($this->dbCon(), $sqlStm->loadTicketChat($_SESSION[$i."ticket_number"]));
                /*echo $_SESSION[$i."ticket_number"];*/
            }

        }
        $this->closeDbCon($this->dbCon());
    }

    function show_createNewCallContent($sql)
    {
        $sqlRes = $this->getMySqlQuery($this->dbCon(), $sql->load_call_priority());
        $countRows = $this->getNumRows($sqlRes);

        for($i = 0; $i <= $countRows; $i++)
        {
            $arCur = $this->getFetchArray($sqlRes);
            $priorityName[] = utf8_encode($arCur["Priority_Name"]);
        }

        $supportRequest = new ErstelleSupportanfrage();

        return $supportRequest->showContent($priorityName);

    }

    function readOutDatabaseContent($dbCon, $sqlStm)
    {
        $sqlRes = mysqli_query($dbCon, $sqlStm);
        $row = mysqli_fetch_assoc($sqlRes);
        $colNames = array_keys($row);

        while ($row = $sqlRes->fetch_assoc()) {
            echo "a1<br>";
        }

        /*for($i = 0; $i <= $countColummns; $i++)
        {
            echo $countColummns."tt";
            $countRows = mysqli_num_rows($sqlRes);

            for($j = 0; $j <= $countRows; $i++)
            {
                $arCur = mysqli_fetch_array($sqlRes);
                $arRow = utf8_encode($arCur[$countColummns]);

                echo $arRow."<br>";
            }


        }*/

        mysqli_close($dbCon);
    }

}