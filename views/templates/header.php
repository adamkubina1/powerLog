<?php

namespace PowerLog\Views\Templates;

use PowerLog\Views\View;

class Header extends View
{

    public function view($data){
        echo '
            <!doctype html>
                <html lang="en">
                <head>
                    <title>' . htmlspecialchars($data["title"]) . '</title>
                    <link rel="stylesheet" href="/css/bulma.min.css">
                    <link rel="stylesheet" href="/css/style.css">
                </head>
            <body>
        ';
    }
}

