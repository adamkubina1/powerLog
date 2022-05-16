<?php

namespace PowerLog\Views;

abstract class View {

    /**
     * @param $data array containg data to present
     */
    abstract public function view($data);
}

