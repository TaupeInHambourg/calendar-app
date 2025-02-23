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
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <link href="localhost:5001/src/assets/output.css" rel="stylesheet">
            <link href="../assets/css/styles.css" rel="stylesheet">
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

                .menu-item:hover {
                    background-color: #e2e8f0;
                }
            </style>
        </head>

        <body>
            <div class="menu">
                <div class="menu-item">Home</div>
                <div class="menu-item">Classes</div>
                <div class="menu-item">Formateurs</div>
                <div class="menu-item">Modules</div>
                <div class="menu-item">Année</div>
                <div class="menu-item">Profil</div>
                <div class="menu-item">Déconnexion</div>
            </div>
            <div class="content" style="margin-left: 220px; padding: 20px;">

        <?php
    }
}
