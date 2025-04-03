<?php

namespace audrey\CalendarApp\View\Component;

class Header
{
    public function render()
    {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../dist/styles.css" rel="stylesheet">
            <title>CalendarApp</title>
            <style>
                .menu-item:hover {
                    font-weight: bold;
                }

                .menu {
                    position: fixed;
                    width: 200px;
                    height: 100%;
                    background-color: #f8fafc;
                    border-right: 1px solid #e2e8f0;
                    padding: 20px;
                }

                .menu-item {
                    padding: 10px;
                    border-radius: 4px;
                }
            </style>
        </head>

        <body>
            <div class="bg-fjord-400 text-bone-50 min-h-full w-48 fixed p-5 flex justify-around flex-col">
                <div class="menu-item"><a href="/calendar">Home</a></div>
                <div>
                    <div class="menu-item">Classes</div>
                    <div class="menu-item">Formateurs</div>
                    <div class="menu-item">Modules</div>
                    <div class="menu-item">Année</div>
                </div>
                <div>
                    <div class="menu-item">Profil</div>
                    <div class="menu-item">Déconnexion</div>
                </div>
            </div>
            <div class="content" style="margin-left: 220px; padding: 20px;">

        <?php
    }
}
