<?php

namespace PowerLog\Views\Templates;

use PowerLog\Views\View;

class Footer extends View
{

    public function view($data){
        echo '
                     <footer class="footer">
                        <div class="content has-text-centered">
                            <p>
                                Lorem ipsum atd footer
                            </p>
                        </div>
                    </footer>
                </body>
            </html>
        ';
    }
}