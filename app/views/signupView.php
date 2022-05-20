<?php


class SignupView
{

    public function view($data = []){
        echo "
            <section class=\"hero is-success is-fullheight-with-navbar\">
                <div class=\"hero-body\">
                    <div class=\"container has-text-centered\">
                        <div class=\"column is-8 is-offset-2\">
                            <h3 class=\"title has-text-white\">Sign up</h3>
                            <hr class=\"login-hr\">
                            <p class=\"subtitle has-text-white\">Sign up to unlock features like PR log, exercise standards and progress tracker!</p>
                        </div>
                        <div class=\"box\">
                            <img src=\"" . BASE_URL . "/public/imgs/barbell2-logo.svg\" width=\"120\" height=\"120\" class=\"is-rounded\">
            
                            <div class=\"title has-text-grey is-5\">Please enter your email and password.</div>
                            <form class=\"box\" method='post'>
                                 <div class=\"field\">
                                    <div class=\"control\">
                                        <input class=\"input is-medium\" id='username' name='username' type=\"text\" placeholder=\"Username\" autofocus=\"true\">
                                    </div>
                                </div>";
        if(!empty($data["errors"]["username"])){
            echo                    '<p class="help is-danger is-size-6">' . htmlspecialchars($data["errors"]["username"]) .'</p>';
        }

        echo "                  
                                <div class=\"field\">
                                    <div class=\"control\">
                                        <input class=\"input is-medium\" id='email' name='email' type=\"email\" placeholder=\"Email\">
                                    </div>
                                </div>";
        if(!empty($data["errors"]["email"])){
            echo                    '<p class="help is-danger is-size-6">' . htmlspecialchars($data["errors"]["email"]) .'</p>';
        }

        echo "                       
                                 <div class=\"field\"\">
                                    <div class=\"control\">
                                        <input class=\"input is-medium\" id='password' name='password' type=\"password\" placeholder=\"Password\">
                                    </div>
                                </div>";
        if(!empty($data["errors"]["password"])){
            echo                    '<p class="help is-danger is-size-5">' . htmlspecialchars($data["errors"]["password"]) .'</p>';
        }

        echo "                  
                                <div class=\"field\"\">
                                    <div class=\"control\">
                                        <input class=\"input is-medium\" id='passwordCheck' name='passwordCheck' type=\"password\" placeholder=\"Check password\">
                                    </div>
                                </div>";
        if(!empty($data["errors"]["passwordCheck"])){
            echo                    '<p class="help is-danger is-size-5">' . htmlspecialchars($data["errors"]["passwordCheck"]) .'</p>';
        }

        echo "                        
                                <div class=\"field\"\">
                                    <div class=\"control\">
                                        <div class=\"field\">
                                          <label class=\"label\">Gender</label>
                                          <div class=\"control\">
                                            <div class=\"select\">
                                              <select id='gender' name='gender'>
                                                <option value='male' selected='selected'>Male</option>
                                                <option value='female'>Female</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>";
        if(!empty($data["errors"]["gender"])){
            echo                    '<p class="help is-danger is-size-6">' . htmlspecialchars($data["errors"]["gender"]) .'</p>';
        }

        echo "                         <div class=\"field\">
                                          <label class=\"label\">Weight</label>
                                          <div class=\"control\">
                                            <div class=\"select\">
                                              <select id='weight' name='weight'>
                                                <option value='1'>more than 90kg</option>                                              
                                                <option value='2'>80kg - 90kg</option>
                                                <option value='3' selected='selected'>70kg - 80kg</option>
                                                <option value='4'>60kg - 70kg</option>
                                                <option value='5'>50kg - 60kg</option>
                                                <option value='6'>less than 50kg</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>";
        if(!empty($data["errors"]["weight"])){
            echo                    '<p class="help is-danger is-size-6">' . htmlspecialchars($data["errors"]["weight"]) .'</p>';
        }

        echo "
                                   </div>
                                </div>
                                <input class=\"button is-block is-danger is-medium is-fullwidth\" type=\"submit\" value=\"Sign up!\">
                            </form>
            
                        </div>
                        <p class=\"has-text-white\">
                            <a href=\"" . BASE_URL . "/login\">Already have account?</a>
                        </p>
                </div>
            </section>
        ";
    }
}