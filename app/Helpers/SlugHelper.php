<?php

if (!function_exists('vietnamese_slug')) {
    /**
     * Tạo slug từ tiếng Việt
     */
    function vietnamese_slug($str, $separator = '-')
    {
        // Chuyển về chữ thường
        $str = mb_strtolower($str, 'UTF-8');
        
        // Bảng chuyển đổi ký tự có dấu
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        ];
        
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        
        // Xóa ký tự đặc biệt
        $str = preg_replace('/[^a-z0-9\s-]/', '', $str);
        
        // Xóa khoảng trắng thừa
        $str = preg_replace('/[\s-]+/', ' ', $str);
        
        // Chuyển khoảng trắng thành separator
        $str = trim($str);
        $str = str_replace(' ', $separator, $str);
        
        return $str;
    }
}