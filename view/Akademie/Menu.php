<?php

class Menu
{
    function showMenu()
    {
        $menu = "<div class=\"menu\">
                    <a href='http://127.0.0.1/wordpress/meine-gebuchten-veranstaltungen/' class=\"btnMenu\">
                        <div class=\"btnMenuImg\">
                            <img src='http://127.0.0.1/wordpress/wp-content/uploads/2021/10/akademie-bild.png'>
                        </div>
                        <span class=\"btnMenuText\">Meine gebuchten Veranstaltungen</span>
                    </a>
                    <a href='http://127.0.0.1/wordpress/akademie-events-uebersicht/' class=\"btnMenu\">
                        <div class=\"btnMenuImg\">
                             <img src='http://127.0.0.1/wordpress/wp-content/uploads/2021/10/akademie-bild.png'>
                        </div>
                        <span class=\"btnMenuText\">Gesamte Kursübersicht</span>
                    </a>
                    <a href='http://127.0.0.1/wordpress/informationen-und-downloads/' class=\"btnMenu\">
                        <div class=\"btnMenuImg\">
                             <img src='http://127.0.0.1/wordpress/wp-content/uploads/2021/10/akademie-bild.png'>
                        </div>
                        <span class=\"btnMenuText\">Informationen und Downloads</span>
                    </a>                    
                    </div>
                   ";

        return $menu;
    }
}