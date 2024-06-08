<?php

use Jenssegers\Blade\Blade;

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../../cache';

$blade = new Blade($views, $cache);

return $blade;