<?php

if (!function_exists('last_segment')) {
    function last_segment() {
        $request = \Config\Services::request();
        $segments = $request->uri->getSegments();

        return end($segments);
    }
}

if (!function_exists('all_in_segment')) {
    function all_in_segment(array $search) {
        $request = \Config\Services::request();
        $segments = $request->uri->getSegments();

        return count(array_intersect($segments, $search)) == count($search);
    }
}

if (!function_exists('exists_in_segment')) {
    function exists_in_segment(array $search) {
        $request = \Config\Services::request();
        $segments = $request->uri->getSegments();

        return count(array_intersect($segments, $search)) > 0;
    }
}
