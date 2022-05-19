<?php

class ProgressTrackerView{

    public function view($data = []){
        echo '
                <section class="hero is-primary is-fullheight-with-navbar">
                    <div class="hero-body">
                        <div class="container has-text-centered">
                                <p class="title">
                                    See your progress over time
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
                                           </div>
                                          </div>
                                        <input class="button is-block is-success is-large is-fullwidth" type="submit" value="See progress!">
                                </form>

                            </div>
                            <p class="has-text-white">
                                <a href="' . BASE_URL . '/prLog">Log your PR here!</a>
                            </p>';

    if(!empty($data["graphData"]) && !empty($data["graphTitle"])){
        echo '
                <script>
                    window.onload = function () {
                     
                    var chart = new CanvasJS.Chart("chartContainer", {
                        title: {
                            text: "'. $data["graphTitle"] . '"
                        },
                        axisY: {
                            title: "Weight in kg"
                        },
                        data: [{
                            type: "line",
                            dataPoints: ' .json_encode($data["graphData"], JSON_NUMERIC_CHECK) .'
                        }]
                    });
                    chart.render();
                     
                    }
                </script>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
              <div id="chartContainer" style="height: 400px; width: 100%;">

              </div>';
    }


echo '                      
                      </div>
                    </div>
                </section>';
        

    }
}