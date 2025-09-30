<?php 
if (!function_exists('fasset')) {
    function fasset($path)
    {
        $version = filemtime(public_path('js/app.js'));

        // Fallback to original asset path if not found in manifest
        return asset($path . '?v='. $version);
    }
}