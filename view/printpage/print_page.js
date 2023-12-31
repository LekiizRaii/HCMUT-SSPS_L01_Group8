$(document).ready(function () {
    Promise.all([load_file_format()])
    .then(function() {
            load_notification();

            // Load default preview image on document ready
            // showDefaultPreview();
            
            // Attach event listener to file input change
            $('#file_input').change(function (e) {
                e.preventDefault();
                preview_file();
            });
        }
    );
});

function load_file_format() {
    return fetch('../../controllers/print_page_controller.php?action=load-format', {credentials: 'include'})
    .then(response => response.json())
    .then(response => {
        var format_str = "";
        var accept_str = "";
        for (var i = 0; i < response.length; i++) {
            if (i > 0) {
                format_str += `, ${response[i]}`;
                accept_str += `, .${response[i]}`;
            }
            else {
                format_str += `${response[i]}`
                accept_str += `.${response[i]}`;
            }
        }
        $("#file_input_help").html(`Hỗ trợ các định dạng file ${format_str} (tối đa 30MB)`);
        document.getElementById("file_input").setAttribute("accept", accept_str);
    });
}

function load_notification() {
    $('#save-button').click(function (e) {
        e.preventDefault();

        print_page_params = {};
        print_page_params["path"] = document.getElementById("file_input").value;
        print_page_params["numberofcopy"] = document.getElementById("numberofcopy").value;
        print_page_params["numberofpages"] = document.getElementById("pages").value;
        print_page_params["pagesize"] = document.getElementById("size").value;
        print_page_params["orientation"] = $('input:radio[name=pagelandscape]:checked').val();
        print_page_params["twofaced"] = $('input:checkbox[name=twofaced]:checked').val();
        if (print_page_params["twofaced"]) {
            print_page_params["twofaced"] = true;
        }
        else {
            print_page_params["twofaced"] = false;
        }

        var params = new FormData();
        for (var key in print_page_params) {
            params.append(key, print_page_params[key]);
        }

        fetch('../../controllers/print_page_controller.php?action=validate', {
            method: 'POST',
            body: params,
            credentials: 'include'
        })
        .then(response => response.json())
        .then(response => {
            if (response['status'] == 'OK') {
                $('#bug-modal').remove();
                Swal.fire({
                    title: "Thành công",
                    text: "Cung cấp thông tin in thành công",
                    icon: "success",
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                    window.location.replace("./choose_printer.php");
                });
            } 
            else if (response['status'] == 'ERROR') {
                if (response['error-type'] == 'USER') {
                    $('#bug1').show();
                    $('#bug2').show();
                    var str = '';
                    str += `
                            <div class="flex flex-col m-auto max-w-screen p-4">
                                <h1 class="text-2xl text-center font-bold m-auto dark:text-white mb-3">KHÔNG ĐỦ GIẤY IN</h1>
                        
                                <img src="../img/notenoughpage.png"
                                alt="Hình ảnh" class="w-4/12 m-auto my-3">
                        
                                <p class="text-xl text-center text-black m-auto dark:text-white mt-3 font-bold">Bạn không có đủ giấy để in file này.</p>
                                <br>
                                <p class="text-xl text-center text-black m-auto dark:text-white">Vui lòng mua thêm giấy in hoặc điều chỉnh lại thông tin in.</p>
                            </div>   
                            `;
                    $('#bodyModal').html(str);
                    $('#bug1').hide();
                }
                else {
                    $('#bug1').show();
                    $('#bug2').show();
                    var message = '';
                    var request = '';
                    if (response['error-type'] == 'FILE') {
                        message = 'Bạn chưa tải lên tệp cần in.';
                        request = 'Vui lòng tải lên tập cần in.';
                    }
                    else if (response['error-type'] == 'COPY-NUMBER') {
                        message = 'Bạn chưa nhập số lượng bản in.';
                        request = 'Vui lòng nhập một số nguyên dương và không có kí tự phía trước hay phía sau số đó.';
                    }
                    else if (response['error-type'] == 'COPY-FORMAT') {
                        message = "Định dạng số lượng bản in không phù hợp.";
                        request = "Vui lòng nhập một số nguyên dương và không có kí tự phía trước hay phía sau số đó.";
                    }
                    else if (response['error-type'] == 'PAGE-NUMBER') {
                        message = "Bạn chưa nhập số trang cần in.";
                        request = "Vui lòng nhập số trang cần in theo định dạng được quy định.";
                    }
                    else if (response['error-type'] == 'PAGE-FORMAT') {
                        message = "Định dạng số trang cần in không phù hợp.";
                        request = "Vui lòng nhập số trang cần in theo định dạng được quy định.";
                    }
                    else if (response['error-type'] == 'PAGE-LOGIC') {
                        message = "Bạn nhập vào số trang cần in không hợp lý.";
                        request = "Vui lòng kiểm tra lại tính hợp lý của số trang cần in.";
                    }
                    var str = '';
                    str += `
                            <div class="flex flex-col m-auto max-w-screen p-4">
                                <h1 class="text-2xl text-center font-bold m-auto dark:text-white mb-3">LỖI THÔNG TIN IN</h1>
                        
                                <img src="../img/error.png"
                                alt="Hình ảnh" class="w-7/12 m-auto my-3">
                        
                                <p class="text-xl text-center text-black m-auto dark:text-white mt-3 font-bold">${message}</p>
                                <br>
                                <p class="text-xl text-center text-black m-auto dark:text-white">${request}</p>
                            </div>   
                            `;
                    $('#bodyModal').html(str);
                    $('#bug2').hide();
                }
            }
        });
    });
}

function preview_file() {
    var fileInput = $('#file_input')[0];
    var previewContainer = $('#preview');

    if (fileInput.files && fileInput.files[0]) {
        if (fileInput.files[0].size > 30000000) {
            $('#bug1').show();
            $('#bug2').show();
            var str = '';
            str += `
                    <div class="flex flex-col m-auto max-w-screen p-4">
                        <h1 class="text-2xl text-center font-bold m-auto dark:text-white mb-3">KÍCH THƯỚC KHÔNG PHÙ HỢP</h1>
                
                        <img src="../img/error.png"
                        alt="Hình ảnh" class="w-4/12 m-auto my-3">
                
                        <p class="text-xl text-center text-black m-auto dark:text-white mt-3 font-bold">File bạn chọn có kích thước quá lớn.</p>
                        <br>
                        <p class="text-xl text-center text-black m-auto dark:text-white">Vui lòng chọn file có kích thước tối đa là 30MB</p>
                    </div>   
                    `;
            $('#bodyModal').html(str);
            $('#bug2').hide();
            $('#upload').trigger('click');
            return ;
        }
        $('#bug1').show();
        $('#bug2').show();
        var str = '';
        str += `
                <div class="flex flex-col m-auto max-w-screen p-4">
                    <h1 class="text-2xl text-center font-bold m-auto dark:text-white mb-3">TẢI FILE LÊN</h1>
            
                    <img src="../img/upload.png"
                    alt="Hình ảnh" class="w-4/12 m-auto my-3">
            
                    <p class="text-xl text-center text-black m-auto dark:text-white mt-3 font-bold">File của bạn đang được tải lên.</p>
                </div>   
                `;
        $('#bodyModal').html(str);
        $('#bug1').hide();
        $('#bug2').hide();
        $('#upload').trigger('click'); 
    }

    // Clear previous content in the preview container
    previewContainer.empty();

    // Hide the default image
    $('#default-preview-image').hide();

    // Check if a file is selected
    if (fileInput.files && fileInput.files[0]) {
        // $('#upload').trigger('click'); 

        var reader = new FileReader();

        // Display the selected file in the preview container
        reader.onload = function (e) {
            e.preventDefault();

            var file = fileInput.files[0];

            // Check if the file is a PDF
            if (file.type === 'application/pdf') {
                var pdfViewer = $('<object>');
                pdfViewer.attr({
                    'data': e.target.result,
                    'type': 'application/pdf',
                    'width': '100%',
                    'height': '400px'
                });
                previewContainer.append(pdfViewer);
            } else if (file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                // Check if the file is a DOCX
                var docxViewer = $('<object>');
                docxViewer.attr({
                    'data': e.target.result,
                    'type': 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'width': '100%',
                    'height': '400px'
                });
                previewContainer.append(docxViewer);
            } else {
                // If not a PDF, display an image preview
                var previewImage = $('<img>');
                previewImage.attr({
                    'src': e.target.result,
                    'alt': 'Print Preview'
                });
                previewContainer.append(previewImage);
            }

            var params = new FormData();
            params.append('file-type', file.type);
            params.append('file-properties', file);

            Promise.all([
                fetch('../../controllers/print_page_controller.php?action=upload', {
                    method: 'POST',
                    body: params,
                    credentials: 'include'
                })
                .then(response => response.json())
                .then(response => {
                    console.log(response);
                })])
            .then(function() {
                $('#upload').trigger('click'); 
            });
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(fileInput.files[0]);
    }
}

