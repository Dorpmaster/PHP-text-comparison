<?php

if (class_exists('Psr4AutoloaderClass')) {
    $loader = new Psr4AutoloaderClass();
    $loader->register();
    $loader->addNamespace('Diff', __DIR__);
}
