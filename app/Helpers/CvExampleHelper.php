<?php

if (!function_exists('cv_template_options')) {
    function cv_template_options()
    {
        return [
            '1' => [
                'name' => 'C',
                'blade' => 'client.cv.cv1',
            ],
            '2' => [
                'name' => 'P',
                'blade' => 'client.cv.cv2',
            ],
            '3' => [
                'name' => 'M',
                'blade' => 'client.cv.cv3',
            ],
        ];
    }
}
