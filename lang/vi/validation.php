<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Trường này phải được chấp nhận.',
    'accepted_if' => 'Trường này phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường này không phải là một URL hợp lệ.',
    'after' => 'Trường này phải là một ngày sau ngày :date.',
    'after_or_equal' => 'Trường này phải là lớn hơn hoặc bằng :date.',
    'alpha' => 'Trường này chỉ có thể chứa các chữ cái.',
    'alpha_dash' => 'Trường này chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num' => 'Trường này chỉ có thể chứa chữ cái và số.',
    'any_of' => 'Trường này không hợp lệ.',
    'array' => 'Trường này phải là dạng mảng.',
    'ascii' => 'Trường này chỉ được chứa các ký tự chữ và số đơn byte và các ký hiệu.',
    'before' => 'Trường này phải là một ngày trước ngày :date.',
    'before_or_equal' => 'Trường này phải là nhỏ hơn hoặc bằng :date.',
    'between' => [
        'array' => 'Trường này phải có từ :min đến :max phần tử.',
        'file' => 'Dung lượng tập tin trong trường này phải từ :min đến :max kB.',
        'numeric' => 'Trường này phải nằm trong khoảng :min đến :max.',
        'string' => 'Trường này phải có từ :min đến :max ký tự.',
    ],
    'boolean' => 'Trường này phải là true hoặc false.',
    'can' => 'Trường này chứa giá trị không được phép.',
    'confirmed' => 'Giá trị xác nhận trong trường này không khớp.',
    'contains' => 'Trường này thiếu một giá trị bắt buộc.',
    'current_password' => 'Mật khẩu không đúng.',
    'date' => 'Trường này không phải là định dạng của ngày-tháng.',
    'date_equals' => 'Trường này phải là một ngày bằng với :date.',
    'date_format' => 'Trường này không giống với định dạng :format.',
    'decimal' => 'Trường này phải có :decimal chữ số thập phân.',
    'declined' => 'Trường này phải bị từ chối.',
    'declined_if' => 'Trường này phải bị từ chối khi :other là :value.',
    'different' => 'Trường này và :other phải khác nhau.',
    'digits' => 'Độ dài của trường này phải gồm :digits chữ số.',
    'digits_between' => 'Độ dài của trường này phải nằm trong khoảng :min and :max chữ số.',
    'dimensions' => 'Trường này có kích thước không hợp lệ.',
    'distinct' => 'Trường này có giá trị trùng lặp.',
    'doesnt_contain' => 'Trường này không được chứa một trong các giá trị sau: :values.',
    'doesnt_end_with' => 'Trường này không được kết thúc bằng một trong các giá trị sau: :values.',
    'doesnt_start_with' => 'Trường này không được bắt đầu bằng một trong các giá trị sau: :values.',
    'email' => 'Trường này phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường này phải kết thúc bằng một trong những giá trị sau: :values.',
    'enum' => 'Giá trị đã chọn trong trường này không hợp lệ.',
    'exists' => 'Giá trị đã chọn trong trường này không hợp lệ.',
    'extensions' => 'Trường này phải có một trong các phần mở rộng sau: :values.',
    'file' => 'Trường này phải là một tập tin.',
    'filled' => 'Trường này không được bỏ trống.',
    'gt' => [
        'array' => 'Mảng này phải có nhiều hơn :value phần tử.',
        'file' => 'Dung lượng trường này phải lớn hơn :value kilobytes.',
        'numeric' => 'Giá trị trường này phải lớn hơn :value.',
        'string' => 'Độ dài trường này phải nhiều hơn :value ký tự.',
    ],
    'gte' => [
        'array' => 'Mảng này phải có ít nhất :value phần tử.',
        'file' => 'Dung lượng trường này phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Giá trị trường này phải lớn hơn hoặc bằng :value.',
        'string' => 'Độ dài trường này phải lớn hơn hoặc bằng :value ký tự.',
    ],
    'hex_color' => 'Trường này phải là một mã màu hex hợp lệ.',
    'image' => 'Trường này phải là định dạng hình ảnh.',
    'in' => 'Giá trị đã chọn trong trường này không hợp lệ.',
    'in_array' => 'Trường này phải thuộc tập cho phép: :other.',
    'in_array_keys' => 'Trường này phải chứa ít nhất một trong các khóa sau: :values.',
    'integer' => 'Trường này phải là một số nguyên.',
    'ip' => 'Trường này phải là một địa chỉ IP.',
    'ipv4' => 'Trường này phải là một địa chỉ IPv4.',
    'ipv6' => 'Trường này phải là một địa chỉ IPv6.',
    'json' => 'Trường này phải là một chuỗi JSON.',
    'list' => 'Trường này phải là một danh sách.',
    'lowercase' => 'Trường này phải là chữ thường.',
    'lt' => [
        'array' => 'Mảng này phải có ít hơn :value phần tử.',
        'file' => 'Dung lượng trường này phải nhỏ hơn :value kilobytes.',
        'numeric' => 'Giá trị trường này phải nhỏ hơn :value.',
        'string' => 'Độ dài trường này phải nhỏ hơn :value ký tự.',
    ],
    'lte' => [
        'array' => 'Mảng này không được có nhiều hơn :value phần tử.',
        'file' => 'Dung lượng trường này phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Giá trị trường này phải nhỏ hơn hoặc bằng :value.',
        'string' => 'Độ dài trường này phải nhỏ hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => 'Trường này phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => 'Trường này không được lớn hơn :max phần tử.',
        'file' => 'Dung lượng tập tin trong trường này không được lớn hơn :max kB.',
        'numeric' => 'Trường này không được lớn hơn :max.',
        'string' => 'Trường này không được lớn hơn :max ký tự.',
    ],
    'max_digits' => 'Trường này không được nhiều hơn :max chữ số.',
    'mimes' => 'Trường này phải là một tập tin có định dạng: :values.',
    'mimetypes' => 'Trường này phải là một tập tin có định dạng: :values.',
    'min' => [
        'array' => 'Trường này phải có tối thiểu :min phần tử.',
        'file' => 'Dung lượng tập tin trong trường này phải tối thiểu :min kB.',
        'numeric' => 'Trường này phải tối thiểu là :min.',
        'string' => 'Trường này phải có tối thiểu :min ký tự.',
    ],
    'min_digits' => 'Trường này phải có ít nhất :min chữ số.',
    'missing' => 'Trường này phải không tồn tại.',
    'missing_if' => 'Trường này phải không tồn tại khi :other là :value.',
    'missing_unless' => 'Trường này phải không tồn tại trừ khi :other là :value.',
    'missing_with' => 'Trường này phải không tồn tại khi :values có mặt.',
    'missing_with_all' => 'Trường này phải không tồn tại khi :values có mặt.',
    'multiple_of' => 'Trường này phải là bội số của :value.',
    'not_in' => 'Giá trị đã chọn trong trường này không hợp lệ.',
    'not_regex' => 'Trường này có định dạng không hợp lệ.',
    'numeric' => 'Trường này phải là một số.',
    'password' => [
        'letters' => 'Trường này phải chứa ít nhất một chữ cái.',
        'mixed' => 'Trường này phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => 'Trường này phải chứa ít nhất một số.',
        'symbols' => 'Trường này phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => 'Mật khẩu này đã bị rò rỉ dữ liệu. Vui lòng chọn một mật khẩu khác.',
    ],
    'present' => 'Trường này phải được cung cấp.',
    'present_if' => 'Trường này phải được cung cấp khi :other là :value.',
    'present_unless' => 'Trường này phải được cung cấp trừ khi :other là :value.',
    'present_with' => 'Trường này phải được cung cấp khi :values có mặt.',
    'present_with_all' => 'Trường này phải được cung cấp khi :values có mặt.',
    'prohibited' => 'Trường này bị cấm.',
    'prohibited_if' => 'Trường này bị cấm khi :other là :value.',
    'prohibited_if_accepted' => 'Trường này bị cấm khi :other được chấp nhận.',
    'prohibited_if_declined' => 'Trường này bị cấm khi :other bị từ chối.',
    'prohibited_unless' => 'Trường này bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Trường này cấm :other hiện diện.',
    'regex' => 'Trường này có định dạng không hợp lệ.',
    'required' => 'Trường này không được bỏ trống.',
    'required_array_keys' => 'Trường này phải bao gồm các mục nhập cho: :values.',
    'required_if' => 'Trường này không được bỏ trống khi trường :other là :value.',
    'required_if_accepted' => 'Trường này không được bỏ trống khi :other được chấp nhận.',
    'required_if_declined' => 'Trường này không được bỏ trống khi :other bị từ chối.',
    'required_unless' => 'Trường này không được bỏ trống trừ khi :other là :values.',
    'required_with' => 'Trường này không được bỏ trống khi một trong :values có giá trị.',
    'required_with_all' => 'Trường này không được bỏ trống khi tất cả :values có giá trị.',
    'required_without' => 'Trường này không được bỏ trống khi một trong :values không có giá trị.',
    'required_without_all' => 'Trường này không được bỏ trống khi tất cả :values không có giá trị.',
    'same' => 'Trường này và :other phải giống nhau.',
    'size' => [
        'array' => 'Trường này phải chứa :size phần tử.',
        'file' => 'Dung lượng tập tin trong trường này phải bằng :size kB.',
        'numeric' => 'Trường này phải bằng :size.',
        'string' => 'Trường này phải chứa :size ký tự.',
    ],
    'starts_with' => 'Trường này phải được bắt đầu bằng một trong những giá trị sau: :values.',
    'string' => 'Trường này phải là một chuỗi ký tự.',
    'timezone' => 'Trường này phải là một múi giờ hợp lệ.',
    'unique' => 'Trường này đã có trong hệ thống.',
    'uploaded' => 'Trường này tải lên thất bại.',
    'uppercase' => 'Trường này phải là chữ in hoa.',
    'url' => 'Trường này không phải là một URL hợp lệ.',
    'ulid' => 'Trường này phải là một ULID hợp lệ.',
    'uuid' => 'Trường này phải là một UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'role' => 'vai trò',
        'second' => 'giây',
        'sex' => 'giới tính',
        'shipment' => 'lô hàng',
        'short_text' => 'văn bản ngắn',
        'size' => 'kích thước',
        'state' => 'tình trạng',
        'street' => 'đường',
        'title' => 'tiêu đề',
        'type' => 'loại',
        'updated_at' => 'ngày cập nhật',
        'user' => 'người dùng',
        'username' => 'tên đăng nhập',
        'value' => 'giá trị',
        'year' => 'năm',
        'full_name' => 'tên đầy đủ',
        'start_date' => 'ngày bắt đầu',
        'end_date' => 'ngày kết thúc',
    ],

];