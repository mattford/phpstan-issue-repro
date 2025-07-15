<?php
function customAutoload($class) {
    if (class_exists($class, false)) {
        return;
    }
    if (str_starts_with($class, 'Model')) {
        eval('class Model' . substr($class, strlen('Model')) . ' extends Model {}');
    }
}

spl_autoload_register('customAutoload');

