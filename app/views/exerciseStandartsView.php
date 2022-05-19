<?php


class ExerciseStandartsView
{

    public function view($data = []){
        echo '
            <section class="hero is-info is-fullheight-with-navbar">
                <div class="hero-body">
                    <div class="container has-text-centered">
                            <p class="title">
                                Compare your strength to other lifters
                            </p>
                            <p class="subtitle">
                                Pick an exercise to find out!
                            </p>
                            <div class="box">
                                <form method="get">
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
                                        <input class="button is-block is-link is-large is-fullwidth" type="submit" value="Compare!">
                                </form>
                            </div>';
        if(!empty($data["exerciseStandard"])){
            echo '        <div class="columns has-text-centered">
                                <div class="column">
                                    <p>Your worst PR at <span class="is-size-4"> '. htmlspecialchars($data["exerciseStandard"]["worstPerformance"]).' kg</span> is better than</p>';
            echo '<span class="is-size-3">' . htmlspecialchars($data["exerciseStandard"]["worst"]) . ' %</span>';
            echo '
                                </div>';
            echo '
                                 <div class="column">
                                    <p>Your best PR at <span class="is-size-4">'. htmlspecialchars($data["exerciseStandard"]["bestPerformance"]).' kg</span> is better than</p>';
            echo '<span class="is-size-3">' . htmlspecialchars($data["exerciseStandard"]["best"]) . ' %</span>';
            echo '                        
                                 </div>
                            </div>
                            <span>of all lifters in your weight class</span>        ';
        }
        echo '          
                            </div>
                        </div>';
        if(empty($data["exerciseStandard"])){
            echo '      <p class="has-text-white">
                            <a href="' . BASE_URL . '/prLog">Log your PR here!</a>
                        </p>';
        }

        echo '       </div>
            </section>
        ';
    }
}
