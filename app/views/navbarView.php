<?php


class NavbarView
{

    public function view($data = []){
        echo "
            <nav class=\"navbar\" role=\"navigation\" aria-label=\"main navigation\">
                <div class=\"navbar-brand\">
                    <a class=\"navbar-item\" href=\"" . BASE_URL . "/home\">
                        <img src=\"" . BASE_URL . "/public/imgs/PowerLog-logo.svg\" width=\"137\" height=\"37\">
                    </a>
            
                    <a role=\"button\" class=\"navbar-burger\" aria-label=\"menu\" aria-expanded=\"false\" data-target=\"navbarBasicExample\">
                        <span aria-hidden=\"true\"></span>
                        <span aria-hidden=\"true\"></span>
                        <span aria-hidden=\"true\"></span>
                    </a>
                </div>
            
                <div id=\"navbarBasicExample\" class=\"navbar-menu\">
            
                    <div class=\"navbar-start\">
                        <a href=\"" . BASE_URL . "/progressTracker\" class=\"navbar-item\">
                            Progress tracker
                        </a>
            
                        <a href=\"" . BASE_URL . "/exerciseStandards\" class=\"navbar-item\">
                            Exercise standards
                        </a>
            
                        <a href=\"" . BASE_URL . "/prLog\" class=\"navbar-item\">
                            PR log
                        </a>
                    </div>
                    <div class=\"navbar-end\">
                ";
            if(empty($data["username"])){
                echo "      
                        <div class=\"navbar-item\">
                            <div class=\"buttons\">
                                <a href=\"" . BASE_URL . "/signup\" class=\"button is-success\">
                                    <strong>Sign up</strong>
                                </a>
                                <a href=\"" . BASE_URL . "/login\" class=\"button is-info\">
                                    Log in
                                </a>
                            </div>
                        </div>
                        ";
            } else {
                echo "      
                        <div class=\"navbar-item\">
                            <div style='margin-right: 15px;'>
                                Loged as:<span class='has-text-weight-semibold'> ". htmlspecialchars($data["username"]) ."</span>
                            </div>
                        </div>
                        <div class=\"navbar-item\">
                            <div class=\"buttons\">
                                <a href=\"" . BASE_URL . "/social\" class=\"button is-success\">
                                    Social
                                </a>
                            </div>
                        </div>
                        <div class=\"navbar-item\">
                            <div class=\"buttons\">
                                <a href=\"" . BASE_URL . "/settings\" class=\"button is-warning\">
                                    Settings
                                </a>
                            </div>
                        </div>
                        <div class=\"navbar-item\">
                            <div class=\"buttons\">
                                <a href=\"" . BASE_URL . "/logout\" class=\"button is-info\">
                                    Log out
                                </a>
                            </div>
                        </div>
                        ";
            }


            echo    "
                    </div>
                </div>
            </nav>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
            
                    // Get all \"navbar-burger\" elements
                    const \$navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            
                    // Check if there are any navbar burgers
                    if (\$navbarBurgers.length > 0) {
            
                        // Add a click event on each of them
                        \$navbarBurgers.forEach( el => {
                            el.addEventListener('click', () => {
            
                                // Get the target from the \"data-target\" attribute
                                const target = el.dataset.target;
                                const \$target = document.getElementById(target);
            
                                // Toggle the \"is-active\" class on both the \"navbar-burger\" and the \"navbar-menu\"
                                el.classList.toggle('is-active');
                                \$target.classList.toggle('is-active');
            
                            });
                        });
                    }
            
                });
            </script>
        ";
    }
}