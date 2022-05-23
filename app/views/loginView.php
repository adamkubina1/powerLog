<?php


class LoginView
{

    public function view($data = []){
        echo "
            <section class=\"hero is-info is-fullheight-with-navbar\">
                <div class=\"hero-body\">
                        <div class=\"container has-text-centered\">
                            <div class=\"column is-8 is-offset-2\">
                                <h3 class=\"title has-text-white\">Login</h3>
                                <hr class=\"login-hr\">
                                <p class=\"subtitle has-text-white\">Already have an account? Log in!</p>
                            </div>
                            <div class=\"box\">
            
                                    <img src=\"" . BASE_URL . "/public/imgs/barbell-logo.svg\" width=\"120\" height=\"120\" class=\"is-rounded\">
            
                                <div class=\"title has-text-grey is-5\">Please enter your email and password.</div>
                                <form class=\"box\" method='post'>
                                    <div class=\"field\">
                                        <div class=\"control\">
                                            <input class=\"input is-large\" type=\"email\" id='email' name='email' placeholder=\"Email\" autofocus=\"true\">
                                        </div>
                                    </div>
                                    <div class=\"field\">
                                        <div class=\"control\">
                                            <input class=\"input is-large\" type=\"password\" id='password' name='password' placeholder=\"Password\">
                                        </div>
                                    </div>";
        if(!empty($data["errors"])){
            echo                    '<p class="help is-danger is-size-5">' . htmlspecialchars($data["errors"]) .'</p>';
        }

        echo "
                                        <input class=\"button is-block is-danger is-large is-fullwidth\" type=\"submit\" value=\"Log in!\">
                                </form>
            
                        </div>
                        <p class=\"has-text-white\">
                            <a href=\"" . BASE_URL . "/signup\">Sign Up</a>
                        </p>
                </div>
            </section>
        ";
    }
}
