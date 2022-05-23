<?php

class SocialView{

    public function view($data = []){
        echo '<section class="hero is-primary is-fullheight-with-navbar">
                <div class="hero-body">
                    <div class="container has-text-centered is-flex-mobile">
                        <p class="title">
                            Social
                        </p>
                        <div class="columns is-centered">
                            <div class="column is-4 panel has-text-centered">
                                <h2 class="is-size-4 has-text-dark is-bold panel-heading" style="margin-top: 10px; margin-bottom: 10px;">Send friend request</h2>
                                <form method="post">
                                    <input class="input is-medium" type="text" name="send" placeholder="Username" autofocus="true">
                                    <input class="button is-block is-info is-medium" type="submit" value="Send friend request!">
                                </form>
                            </div>
                            <div class="column is-4 panel">
                                <h2 class="is-size-4 has-text-dark is-bold panel-heading" style="margin-top: 10px; margin-bottom: 10px;">Your friend requests</h2>';


        if(!empty($data["friendRequests"])){
            foreach ($data["friendRequests"] as $fr){
                echo '
                        <div class="box is-flex is-justify-content-center is-align-items-center">
                           <h3 class="is-size-4">'. htmlspecialchars($fr["requesterUsername"]).'</h3>  
                           <form method="post" style="margin-left: 10px;">
                                <input type="hidden" name="accept" value="' . htmlspecialchars($fr["requester"]). '">
                                <input class="button is-block is-success is-medium" type="submit" value="Accept!" onClick="window.location.reload();">
                           </form>
                            <form method="post" style="margin-left: 10px;">
                                <input type="hidden" name="delete" value="' . htmlspecialchars($fr["requester"]). '">
                                <input class="button is-block is-danger is-medium " type="submit" value="Delete!" onClick="window.location.reload();">
                            </form>
                        </div>';
            }
        } else {
            echo '<p style="margin-top: 10px;">No friend requests :(</p>';
        }


        echo '              </div>
                            <div class="column is-4 panel has-text-centered">
                                <h2 class="is-size-4 has-text-dark is-bold panel-heading" style="margin-top: 10px; margin-bottom: 10px;">See your friends progress</h2>';
        if(!empty($data["friends"])){
            foreach ($data["friends"] as $fr){
                echo '<a class="button is-link is-medium" href="'. BASE_URL .'/friendProgress?name='. htmlspecialchars($fr["username"]).'">'. htmlspecialchars($fr["username"]) .'</a>';
            }
        } else {
            echo '<p style="margin-top: 10px;">You have no friends :(</p>';
        }

        echo '                   </div>
                        </div>
                    </div>
                </div>
            </section>';
    }
}
