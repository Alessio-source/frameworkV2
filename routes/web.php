<?php

    $router::addRoute('/test', 'prova', ['test' => 'test2']);

    $router::addController('/prova', 'testController', 'index');