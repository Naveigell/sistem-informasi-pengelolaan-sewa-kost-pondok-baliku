<?php

if (!function_exists('render_json')) {
    function render_json($code = 200, ...$payload) {
        http_response_code($code);

        if (count(func_get_args()) > 1) {
            echo json_encode(...$payload);
        }
    }
}
