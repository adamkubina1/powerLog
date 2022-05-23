<?php


class FriendProgressView
{

    public function view($data = [])
    {
        echo '
                <section class="hero is-primary is-fullheight-with-navbar">
                    <div class="hero-body">
                        <div class="container has-text-centered">
                                <p class="title">
                                    Compare your progress with
                                </p>
                                <p class="subtitle">
                                    '. htmlspecialchars($data["friendName"]).' 
                                </p>
                                
                                <div class="box">
                                <form method="get">
                                    <div class="field">
                                        <div class="control">
                                            <div class="field">
                                              <label class="label">Exercise</label>
                                              <div class="control">
                                                <div class="select">
                                                  <select id="exerciseMe" name="exercise">';

        foreach ($data["exercises"] as $ex) {
            echo '<option value="' . htmlspecialchars($ex["exercise_id"]) . '">' . htmlspecialchars($ex["name"]) . '</option>';
        }

        echo '
                                                   </select>
                                                </div>
                                               </div>
                                            </div>
                                           </div>
                                          </div>
                                          <input type="hidden" name="name" value="'. htmlspecialchars($data["friendName"]).'">
                                        <input class="button is-block is-success is-large is-fullwidth" type="submit" value="Compare!">
                                </form>

                            </div>';


        if (!empty($data["graphData"]) && !empty($data["graphTitle"])&& !empty($data["graphDataFr"])) {
            echo '
                <script>
                    window.onload = function () {
                     
                    var chart = new CanvasJS.Chart("chartContainer", {
                        title: {
                            text: "' . $data["graphTitle"] . ' my results"
                        },
                        axisY: {
                            title: "Weight in kg"
                        },
                        data: [{
                            type: "line",
                            dataPoints: ' . json_encode($data["graphData"], JSON_NUMERIC_CHECK) . '
                        }]
                    });
                    var chart1 = new CanvasJS.Chart("chartContainerFr", {
                        title: {
                            text: "' . $data["graphTitle"] . ' '. $data["friendName"] .' results"
                        },
                        axisY: {
                            title: "Weight in kg"
                        },
                        data: [{
                            type: "line",
                            dataPoints: ' . json_encode($data["graphDataFr"], JSON_NUMERIC_CHECK) . '
                        }]
                    });
                    chart.render();
                    chart1.render();
                     
                    }
                </script>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
               <div class="columns">
              <div class="column" id="chartContainer" style="height: 400px; width: 100%; margin-right: 10px;">

              </div>
              <div class="column" id="chartContainerFr" style="height: 400px; width: 100%;">
              
            </div>
            </div>';
        }


        echo '          </div>
                      </div>
                    </div>
                </section>';


    }
}