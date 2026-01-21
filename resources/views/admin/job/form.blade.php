@extends('layouts.admin')

@section('title', 'Admin Dashboard - Users')
@section('page_title', $action == 'create' ? __('job.txt_add_job') : __('job.txt_edit_job'))

@section('content')

<!-- [ Main Content ] start -->
@if ($action == 'create')
@include('admin.job.add')
@endif

@if ($action == 'edit')
@include('admin.job.edit')
@endif
<!-- [ Main Content ] end -->

<script>
    // Danh sách tỉnh đã chọn (lấy từ hidden select)
    function getSelectedProvinces() {
        const select = document.getElementById('area_application_hidden');
        return Array.from(select.selectedOptions).map(opt => opt.value);
    }

    let provinceSelected = getSelectedProvinces();

    // Thêm tỉnh mới
    function addProvince() {
        const code = $('#province_id').val();
        const name = $('#province_id').find('option:selected').text();
        console.log(code, name);

        if (!code) return;

        const selected = getSelectedProvinces();
        console.log(selected);
        
        // Nếu chưa có thì mới thêm
        if (!selected.includes(code) && !provinceSelected.includes(code)) {
            provinceSelected.push(code);
            // Thêm vào hidden select
            const hiddenSelect = document.getElementById('area_application_hidden');
            const option = new Option(name, code, true, true);
            hiddenSelect.add(option);

            // Thêm tag vào giao diện
            const tag = document.createElement('span');
            tag.className = 'badge rounded-pill bg-success d-flex flex-row align-items-center gap-1 p-2';
            tag.id = `province_tag_${code}`;
            tag.innerHTML = `
                <span class="text-white">${name}</span>
                <div onclick="removeProvince('${code}')" class="btn btn-sm p-0 text-white rounded-full hover:bg-blue-300 transition d-flex align-items-center justify-content-center">
                    <i class="ti ti-x"></i>
                </div>
            `;
            $('#province_tags').append(tag);
        }

        // Reset select
        this.value = '';
    };

    // Xóa tỉnh
    function removeProvince(code) {
        // Xóa khỏi hidden select
       const hiddenSelect = document.getElementById('area_application_hidden');
       const option = hiddenSelect.querySelector(`option[value="${code}"]`);
       if (option) {
           hiddenSelect.removeChild(option);
       }
       
        for (let i = 0; i < provinceSelected.length; i++) {
            if (provinceSelected[i] === code) {
                provinceSelected.splice(i, 1);
                break;
            }
        }

        // Xóa tag khỏi giao diện
        const tag = $(`#province_tag_${code}`);
        if (tag) {
            tag.remove();
        }
    };
</script>

<script>
    // Danh sách loại công việc đã chọn (lấy từ hidden select)
    function getSelectedProfession() {
        const select = document.getElementById('profession_hidden');
        return Array.from(select.selectedOptions).map(opt => opt.value);
    }

    let professionSelected = getSelectedProfession();

    // Thêm tỉnh mới
    function addProfession() {
        const code = $('#profession_id').val();
        const name = $('#profession_id').find('option:selected').text();

        if (!code) return;

        const selected = getSelectedProfession();
        
        // Nếu chưa có thì mới thêm
        if (!selected.includes(code) && !professionSelected.includes(code)) {
            professionSelected.push(code);
            // Thêm vào hidden select
            const hiddenSelect = document.getElementById('profession_hidden');
            const option = new Option(name, code, true, true);
            hiddenSelect.add(option);

            // Thêm tag vào giao diện
            const tag = document.createElement('span');
            tag.className = 'badge rounded-pill bg-success d-flex flex-row align-items-center gap-1 p-2';
            tag.id = `province_tag_${code}`;
            tag.innerHTML = `
                <span class="text-white">${name}</span>
                <div onclick="removeProvince('${code}')" class="btn btn-sm p-0 text-white rounded-full hover:bg-blue-300 transition d-flex align-items-center justify-content-center">
                    <i class="ti ti-x"></i>
                </div>
            `;
            $('#profession_tags').append(tag);
        }

        // Reset select
        this.value = '';
    };

    // Xóa tỉnh
    function removeProfession(code) {
        // Xóa khỏi hidden select
       const hiddenSelect = document.getElementById('profession_hidden');
       const option = hiddenSelect.querySelector(`option[value="${code}"]`);
       if (option) {
           hiddenSelect.removeChild(option);
       }
       
        for (let i = 0; i < professionSelected.length; i++) {
            if (professionSelected[i] === code) {
                professionSelected.splice(i, 1);
                break;
            }
        }

        // Xóa tag khỏi giao diện
        const tag = $(`#profession_tag_${code}`);
        if (tag) {
            tag.remove();
        }
    };

    // Format salary
    const inputMinSalary = document.getElementById('min_salary');
    const inputMaxSalary = document.getElementById('max_salary');

    function formatNumberDot(num) {
            num = num.replace(/\D/g, ""); // chỉ giữ số 
            if (num) { 
                num = Number(num).toLocaleString("vi-VN"); 
            }
            return num;
    }

    inputMinSalary.addEventListener('input', function() {
        this.value = formatNumberDot(this.value);
    });

    inputMaxSalary.addEventListener('input', function() {
        this.value = formatNumberDot(this.value);
    });

    
</script>

<script>
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        ['link', 'image', 'video', 'formula'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];

    const quill = new Quill('#description-editor', {
        modules: {
            toolbar: {
                container: toolbarOptions,
                handlers: {
                    image: function() {
                        imageHander(this.quill);
                    },
                },
            },
            resize: {
            embedTags: ["VIDEO", "IFRAME"],
            tools: [
                {
                text: "Alt",
                attrs: {
                    title: "Set image alt",
                    class: "btn-alt",
                },
                verify(activeEle) {
                    return activeEle && activeEle.tagName === "IMG";
                },
                handler(evt, button, activeEle) {
                    let alt = activeEle.alt || "";
                    alt = window.prompt("Alt for image", alt);
                    if (alt == null) return;
                    activeEle.setAttribute("alt", alt);
                },
                },
            ],
            },
        },
        theme: 'snow'
    });

    const quill2 = new Quill('#requirements-editor', {
        modules: {
            toolbar: {
                container: toolbarOptions,
                handlers: {
                    image: function() {
                        imageHander(this.quill);
                    },
                },
            },
            resize: {
            embedTags: ["VIDEO", "IFRAME"],
            tools: [
                {
                    text: "Alt",
                    attrs: {
                        title: "Set image alt",
                        class: "btn-alt",
                    },
                    verify(activeEle) {
                        return activeEle && activeEle.tagName === "IMG";
                    },
                    handler(evt, button, activeEle) {
                        let alt = activeEle.alt || "";
                        alt = window.prompt("Alt for image", alt);
                        if (alt == null) return;
                        activeEle.setAttribute("alt", alt);

                        
                    },
                },
            ],
            },
        },
        theme: 'snow'
    });

    function imageHander(quillInstance) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';

        input.addEventListener('change', async function(e) {
            const file = input.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('upload', file);

                try {
                    const response = await fetch('{{ route("admin.jobs.upload-editor-image") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                   
                    const imageUrl = data.url;

                   // Lấy vị trí con trỏ hiện tại trong editor
                    const range = quillInstance.getSelection();
                    // Chèn hình ảnh vào đúng vị trí đó
                    quillInstance.insertEmbed(range ? range.index : 0, 'image', imageUrl);
                    
                    // Di chuyển con trỏ xuống sau hình ảnh
                    quillInstance.setSelection((range ? range.index : 0) + 1);

                }  catch (error) {
                    console.error('Error:', error);
                    alert('Lỗi upload: ' + error.message);
                }
            };
        });

        input.click();
    }

</script>
@endsection