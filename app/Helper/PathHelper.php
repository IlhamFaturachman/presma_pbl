<?php

function views($path = '')
{
    $viewsDir = __DIR__ . '/../../resources/views/pages';
    return $path ? $viewsDir . '/' . ltrim($path, '/') : $viewsDir;
}