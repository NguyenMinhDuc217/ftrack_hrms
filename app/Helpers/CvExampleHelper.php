<?php

if (!function_exists('cv_template_options')) {
    function cv_template_options()
    {
        return [
            '1' => [
                'name' => 'CV1',
                'blade' => 'client.cv.cv1',
            ],
            '2' => [
                'name' => 'CV2',
                'blade' => 'client.cv.cv2',
            ],
            '3' => [
                'name' => 'CV3',
                'blade' => 'client.cv.cv3',
            ],
        ];
    }
}
