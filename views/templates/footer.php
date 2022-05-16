<?php

namespace PowerLog\Views\Templates;

use PowerLog\Views\View;

class Footer extends View
{

    public function view($data){
        echo '
            </body>
            </html>
        ';
    }
}