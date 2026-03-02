@extends('layouts.client')
@section('title', 'Create CV')
@section('content')
<section class="py-6 bg-gray-50">
    <style>
        #preview-body,
        #previewModal,
        #pdf-preview {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #preview-body::-webkit-scrollbar,
        #previewModal::-webkit-scrollbar,
        #pdf-preview::-webkit-scrollbar {
            display: none;
        }

        /* Ẩn scrollbar */
        .cv-preview-iframe::-webkit-scrollbar {
            display: none;
        }



        .cv-preview-box {
            width: 100%;
            height: 100%;
            aspect-ratio: 1 / 1.414;
            /* A4 Ratio */
            position: relative;
            overflow: hidden;
            background: #f1f1f1;
            /* Khử răng cưa khi scale */
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .cv-iframe {
            width: 800px;
            /* Fixed rendering width */
            height: 1131.2px;
            border: none;
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: top left;
            pointer-events: none;
            opacity: 0;
        }
    </style>

    <div class="container mx-auto px-0">
        <div class="mb-8 text-center">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-2">Chọn mẫu CV chuyên nghiệp</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">Xem trước trực tiếp và chọn mẫu phù hợp nhất</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 card-all">
            @foreach($cv_templates as $key => $option)

            <div class="group cursor-pointer p-2 rounded-lg border-2 border-gray-200 !h-[80%] hover:transition-all hover:scale-105 bg-[#eeeeee]" onclick="updatePreview('{{ $key }}')">

                <div class="cv-preview-box rounded-lg">
                    <iframe
                        src="{{ route('cv.preview-pdf', ['id' => $key, 'type' => 'preview']) }}?theme=light"
                        class="cv-iframe">
                    </iframe>
                </div>

                <div class="mt-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-primary transition-colors">
                        {{ $option['name'] }}
                    </h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-between">
                    <h5 class="modal-title" id="previewModalLabel">CV Preview</h5>
                    <div class="flex flex-wrap justify-center items-center gap-3">
                        <div class="flex gap-2 items-center no-print">
                            <button class="w-10 h-10 p-2 rounded-full !bg-[var(--blue-color)] dark:bg-gray-800 shadow-lg !text-white dark:text-gray-300 hover:text-primary transition-colors flex justify-center items-center shrink-0" onclick="printCV()" title="Download">
                                <i class="ti ti-download"></i>
                            </button>
                            <button class="w-10 h-10 p-2 rounded-full !bg-[var(--accent-color)] dark:bg-gray-800 shadow-lg !text-white dark:text-white hover:text-primary transition-colors flex justify-center items-center shrink-0" onclick="toggleDarkMode()" title="Theme Mode">
                                <span class="material-icons" id="text-theme-mode"><i class="bi bi-moon-stars-fill"></i></span>
                            </button>
                            <button id="download-cv-btn" class="w-10 h-10 p-2 rounded-full !bg-[var(--red-color)] dark:bg-gray-800 shadow-lg text-white dark:text-gray-300 hover:text-primary transition-colors flex justify-center items-center shrink-0" onclick="downloadPdf()" title="Save">
                                <i class="bi bi-floppy"></i>
                            </button>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body p-0" id="preview-body"> <!-- p-0 để iframe sát viền -->
                    <div id="loading" class="hidden text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Đang tải preview...</p>
                    </div>
                    <iframe id="pdf-preview" src="" width="100%" height="800px" style="border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new ResizeObserver(entries => {
            for (let entry of entries) {
                const container = entry.target;
                const iframe = container.querySelector('.cv-iframe');

                if (iframe) {
                    // Use the precise width provided by the observer
                    const containerWidth = entry.contentRect.width;
                    const iframeOriginalWidth = 800;
                    const scale = containerWidth / iframeOriginalWidth;

                    // Apply transformation
                    iframe.style.transform = `scale(${scale})`;

                    // Once scaled, fade it in to hide the 'snap'
                    iframe.style.opacity = "1";
                    iframe.style.transition = "opacity 0.5s ease, transform 0.1s ease-out";
                }
            }
        });

        // Start watching every preview box
        document.querySelectorAll('.cv-preview-box').forEach(box => {
            // Initially hide the iframe so we don't see the unscaled version
            const iframe = box.querySelector('.cv-iframe');
            if (iframe) {
                iframe.style.opacity = "0";
            }

            observer.observe(box);
        });
    });
</script>

<script>
    // Biến lưu trữ template hiện tại, mặc định là 1
    let currentTemplate = 1;

    function toggleDarkMode() {
        const isDark = document.documentElement.classList.toggle('dark');
        const iframe = document.getElementById('pdf-preview');
        if (iframe && iframe.contentWindow) {
            const childHtml = iframe.contentWindow.document.documentElement;
            if (isDark) {
                childHtml.classList.add('dark');
                $("#text-theme-mode").html('<i class="bi bi-sun-fill"></i>');
            } else {
                childHtml.classList.remove('dark');
                $("#text-theme-mode").html('<i class="bi bi-moon-stars-fill"></i>');
            }
        }
    }

    function updatePreview(templateKey) {
        currentTemplate = templateKey; // Cập nhật biến toàn cục

        // (Tùy chọn) Xóa class active cũ và thêm vào card mới
        document.querySelectorAll('.group').forEach(el => el.classList.remove('template-card-active'));
        // Lưu ý: Nếu bạn muốn thêm class active, bạn cần truyền event hoặc dùng selector tìm card theo key

        const modalElement = document.getElementById('previewModal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
        const iframe = document.getElementById('pdf-preview');
        const loading = document.getElementById('loading');

        const isDark = document.documentElement.classList.contains('dark') ? 'dark' : 'light';

        modal.show();
        loading.classList.remove('hidden');
        iframe.style.display = 'none';

        let url = "{{ route('cv.preview-pdf', ['id' => '999999', 'type' => 'preview']) }}";
        url = url.replace('999999', templateKey) + '?theme=' + isDark;

        iframe.src = url;

        iframe.onload = () => {
            loading.classList.add('hidden');
            iframe.style.display = 'block';

            if (document.documentElement.classList.contains('dark')) {
                iframe.contentWindow.document.documentElement.classList.add('dark');
            }
        };
    }

    function downloadPdf() {
        const isDark = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        let url = "{{ route('cv.preview-pdf', ['id' => '999999', 'type' => 'download']) }}";
        url = url.replace('999999', currentTemplate) + '?theme=' + isDark;

        window.location.href = url;
    }

    function printCV() {
        const iframe = document.getElementById('pdf-preview');

        if (iframe && iframe.contentWindow) {
            // 1. Lấy trạng thái Dark mode của trang cha (nếu muốn)
            // Thông thường CV nên in ở chế độ Light Mode để tiết kiệm mực và chuyên nghiệp
            // iframe.contentWindow.document.documentElement.classList.remove('dark');

            // 2. Focus và thực hiện lệnh in
            iframe.contentWindow.focus();

            // Thêm một khoảng trễ nhỏ để trình duyệt cập nhật lại layout nếu vừa bỏ dark mode
            setTimeout(() => {
                iframe.contentWindow.print();
            }, 200);
        } else {
            alert("Đang tải bản xem trước, vui lòng đợi trong giây lát!");
        }
    }
</script>
@endsection