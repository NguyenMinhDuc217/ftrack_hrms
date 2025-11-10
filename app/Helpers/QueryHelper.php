<?php

if (!function_exists('getFullSql')) {
    function getFullSql($query)
    {
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        return vsprintf(str_replace('?', '%s', $sql), collect($bindings)->map(function ($binding) {
            return is_string($binding) ? "'{$binding}'" : $binding;
        })->toArray());
    }
}