<?php

class SettingsView{

    public function view($data = []){
        echo "
            <section class=\"hero is-warning is-fullheight-with-navbar\">
                <div class=\"hero-body\">
                    <div class=\"container has-text-centered\">
                        <div class=\"column is-8 is-offset-2\">
                            <h3 class=\"title has-text-white\">Change your password</h3>
                        </div>
                        <div class=\"box\">
               
            
                            <form class=\"box\" method='post'>                       
                                 <div class=\"field\"\">
                                    <div class=\"control\">
                                        <input class=\"input is-medium\" id='oldPassword' name='oldPassword' type=\"password\" placeholder=\"Old password\">
                                    </div>
                                </div>";
        if(!empty($data["errors"]["oldPassword"])){
            echo                    '<p class="help is-danger is-size-5">' . htmlspecialchars($data["errors"]["oldPassword"]) .'</p>';
        }

        echo "                       
                                 <div class=\"field\"\">
                                    <div class=\"control\">
                                        <input class=\"input is-medium\" id='newPassword' name='newPassword' type=\"password\" placeholder=\"New password\">
                                    </div>
                                </div>";
        if(!empty($data["errors"]["newPassword"])){
            echo                    '<p class="help is-danger is-size-5">' . htmlspecialchars($data["errors"]["newPassword"]) .'</p>';
        }

        echo "                  
                                <div class=\"field\"\">
                                    <div class=\"control\">
                                        <input class=\"input is-medium\" id='newPasswordCheck' name='newPasswordCheck' type=\"password\" placeholder=\"Check new password\">
                                    </div>
                                </div>";
        if(!empty($data["errors"]["newPasswordCheck"])){
            echo                    '<p class="help is-danger is-size-5">' . htmlspecialchars($data["errors"]["newPasswordCheck"]) .'</p>';
        }
        if(!empty($data["success"])){
            echo                    '<p class="help is-success is-size-6">' . htmlspecialchars($data["success"]) .'</p>';
        }

        echo "                        <input class=\"button is-block is-danger is-large is-fullwidth\" type=\"submit\" value=\"Change your password!\">
                            </form>
            
                        </div>
                </div>
            </section>
        ";
    }
}