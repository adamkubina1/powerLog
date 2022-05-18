<?php


class PrLogView
{

    public function view($data = []){
        echo '
            <section class="hero is-primary is-fullheight-with-navbar">
                <div class="hero-body">
                    <div class="container has-text-centered">
                            <p class="title">
                                Log your performance!
                            </p>
                            <div class="box">
                                <form method="post">
                                    <div class="field">
                                    <div class="control">
                                        <div class="field">
                                          <label class="label">Exercise</label>
                                          <div class="control">
                                            <div class="select">
                                              <select id="exercise" name="exercise">';

        foreach ($data["exercises"] as $ex){
            echo '<option value="'. htmlspecialchars($ex["exercise_id"]) .'">' . htmlspecialchars($ex["name"]) . '</option>';
        }

        echo '
                                               </select>
                                          </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="field" style="margin-top: 15px;">
                                            <div class="control">
                                                <input class="input is-medium" type="number" id="performance" name="performance" min="1" max="1000" placeholder="Your performance in kg" autofocus="true">
                                            </div>
                                    </div>';
        if(!empty($data["fail"])){
            echo '<p class="help is-danger is-size-6">' . htmlspecialchars($data["fail"]) .'</p>';
        } else if(!empty($data["success"])){
            echo '<p class="help is-success is-size-6">' . htmlspecialchars($data["success"]) .'</p>';
        }

        echo '
                                    <input class="button is-block is-link is-large is-fullwidth" type="submit" value="Log my performance!">
                                </form>
                            </div>
                    </div>
                </div>
            </section>
        ';
    }
}
