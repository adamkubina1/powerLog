<?php

class Header
{

    public function view($data = []){
        echo '
            <!doctype html>
                <html lang="en">
                <head>
                    <title>' . htmlspecialchars(strval($data["title"])) . '</title>
                    <link rel="stylesheet" href="'.  BASE_URL . '/public/css/bulma.min.css">
                    <link rel="stylesheet" href="'.  BASE_URL . '/public/css/style.css">
                </head>
            <body>
        ';
    }
}

