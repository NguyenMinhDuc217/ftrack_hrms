<style>
    .scrollable-no-select {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .scrollable-no-select:active {
        cursor: grabbing;
    }
    .scrollbar-hidden {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hidden::-webkit-scrollbar {
        display: none;
    }
    .scroll-smooth {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch; /* iOS smooth scrolling */
    }
    .scrollable {
        display: flex;
        overflow-x: scroll;
        cursor: pointer;
        overflow-y: hidden;
        position: relative;
        scrollbar-width: none;
        transition: all .2s;
        white-space: nowrap;
        width: 100%;
    }
    .scrollable-item {
        cursor: pointer;
        display: inline-block;
    }

    .filter-btn.active {
        background-color: var(--blue-color) !important;
        color: white !important;
        border-color: var(--blue-color) !important;
    }
</style>
@if(!$filters->isEmpty())

<div class="flex items-center gap-2 w-full md:w-auto" id="location-tabs">
    <button class="h-[34px] w-[34px] px-2 border border-gray-200 rounded-full hover:bg-gray-100 text-gray-500" id="prev">
        <i class="bi bi-chevron-left"></i>
    </button>

    <div class="flex items-center gap-2 overflow-x-auto scrollbar-hidden scrollable-no-select scroll-smooth w-full md:w-auto scrollable">
    <!-- <div class="flex items-center scrollable"> -->
            <button class="filter-btn flex-shrink-0 px-4 py-1.5 rounded-0 text-sm whitespace-nowrap transition-colors border bg-white text-gray-600 border-gray-200 hover:border-gray-300 hover:bg-gray-50 scrollable-item" data-loc="Tất cả">Tất cả</button>
            @foreach($filters as $filter)
            <button onclick="chooseProfession('{{ $type }}', '{{ $filter->slug }}', '{{ $filter->name }}')" class="filter-btn flex-shrink-0 px-4 py-1.5 rounded-0 text-sm whitespace-nowrap transition-colors border bg-white text-gray-600 border-gray-200 hover:border-gray-300 hover:bg-gray-50 scrollable-item {{ (isset($val) && $val == $filter->slug) ? 'active' : '' }}">{{ $filter->name }}</button>
            @endforeach
    </div>
    

    <button class="h-[34px] w-[34px] px-2 border border-gray-200 rounded-full hover:bg-gray-100 text-gray-500" id="next">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.scrollable');
        if (!container) return;

        // Tìm button đang active (có class 'active' hoặc bạn dùng data-active)
        let activeButton = container.querySelector('.filter-btn.active');

        // Nếu không có class active, tìm theo giá trị hiện tại trên URL
        if (!activeButton) {
            const urlParams = new URLSearchParams(window.location.search);
            const currentValue = urlParams.get('{{ $type }}'); // ví dụ: department_id, province_id

            if (currentValue) {
                activeButton = container.querySelector(`.filter-btn[onclick*="('${currentValue}')"]`) ||
                                container.querySelector(`.filter-btn[data-loc="${currentValue}"]`);
            }
        }

        // Nếu tìm thấy button active → scroll đến nó
        if (activeButton) {
            // Cách 1: Đẩy button active ra GIỮA màn hình (đẹp nhất)
            container.scrollTo({
                left: activeButton.offsetLeft - (container.offsetWidth / 2) + (activeButton.offsetWidth / 2),
                behavior: 'smooth'
            });

            // Cách 2: Nếu bạn muốn đẩy button active lên ĐẦU danh sách (cũng hay)
            // container.scrollTo({
            //     left: activeButton.offsetLeft - 20, // cách lề trái 20px
            //     behavior: 'smooth'
            // });
        }
        // Nếu là "Tất cả" hoặc không có filter → scroll về đầu
        else {
            container.scrollTo({ left: 0, behavior: 'smooth' });
        }
    });
    $('#prev').click(function() {
        const container = document.querySelector('.scrollable');
        container.scrollBy({ left: -container.offsetWidth, behavior: 'smooth' });
    });
    $('#next').click(function() {
        const container = document.querySelector('.scrollable');
        container.scrollBy({ left: +container.offsetWidth, behavior: 'smooth' });
    });
</script>