<?php

namespace audrey\CalendarApp\View\Layout;

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
            <style>
                .event {
                    background-color: #ef4444;
                    color: white;
                    padding: 4px 8px;
                    border-radius: 4px;
                    margin-top: 2px;
                    font-size: 0.8rem;
                }

                .day:hover {
                    background-color: #f1f1f1;
                }
            </style>
            <title>CalendarApp</title>
        </head>

        <body>
            <p>END-HEAD</p>
            <hr>
    <?php
    }
}
