<?php


class HomeView
{

    public function view($data = []){
        echo '
            <section class="hero is-primary is-fullheight-with-navbar">
                <div class="hero-body">
                    <div class="container has-text-centered">
                        <h1 class="title is-size-1">
                            PowerLog
                        </h1>
                        <hr class="login-hr">
                        <div class="columns is-centered">
                            <div class="column is-4 panel is-info">
                                <a href="' . BASE_URL . '/powerCalculator">
                                    <figure class="image ">
                                        <img src="' . BASE_URL . '/public/imgs/weightlift-home1.svg" />
                                    </figure>
                                    <h2 class="is-size-4 has-text-dark is-bold panel-heading" style="margin-top: 10px;">Calculate your power level</h2>
                                </a>
                            </div>
                            <div class="column is-4 panel is-info">
                                <a href="' . BASE_URL . '/exerciseStandards">
                                    <figure class="image ">
                                        <img src="' . BASE_URL . '/public/imgs/weightlift-home2.svg" />
                                    </figure>
                                    <h2 class="is-size-4 has-text-dark is-bold panel-heading" style="margin-top: 10px;">Compare your strength to others</h2>
                                </a>
                            </div>
                            <div class="column is-4 panel is-info">
                                <a href="' . BASE_URL . '/prLog">
                                    <figure class="image ">
                                        <img src="' . BASE_URL . '/public/imgs/weightlift-home3.svg" />
                                    </figure>
                                    <h2 class="is-size-4 has-text-dark is-bold panel-heading" style="margin-top: 10px;">Log your performances</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        ';
    }
}
