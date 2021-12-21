<?php
    use Jenssegers\Blade\Blade;

    function view($page, $variables = null) {
        $blade = new Blade('views', 'cache');
        if (isset($variables)) {
            echo $blade->make($page, $variables)->render();
        } else {
            echo $blade->make($page)->render();
        }
    }