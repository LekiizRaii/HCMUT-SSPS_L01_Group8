$(document).ready(function () {
    loadBugModal();
});
function loadBugModal() {
    $('#save-button').click(function (e) {
        e.preventDefault();
        fetch('controllers/print_page_controller.php?test=2')
        .then(response => response.json())
        .then(error_type => {
            alert(typeof(error_type));
            if (error_type === 1) {
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
                    window.location.replace("view/printpage/choose_printer.php");
                });
            } else if (error_type === 0) { //Lỗi cài đặt in
                var str = '';
                str += `
                        <div class="flex flex-col m-auto max-w-screen p-4">
                            <h1 class="text-2xl text-center font-bold m-auto dark:text-white mb-3">LỖI CÀI ĐẶT IN</h1>
                    
                            <img src="../img/error.png"
                            alt="Hình ảnh" class="w-7/12 m-auto my-3">
                    
                            <p class="text-xl text-center text-black m-auto dark:text-white mt-3">Các thông số cài đặt in không hợp lệ.</p>

                            <p class="text-xl text-center text-black m-auto dark:text-white">Vui lòng kiểm tra lại.</p>
                        </div>   
                        `
                $('#bodyModal').html(str);
                $('#bug2').remove();
            } else { //Lỗi không đủ giấy in
                var str = '';
                str += `
                        <div class="flex flex-col m-auto max-w-screen p-4">
                            <h1 class="text-2xl text-center font-bold m-auto dark:text-white mb-3">KHÔNG ĐỦ GIẤY IN</h1>
                    
                            <img src="../img/notenoughpage.png"
                            alt="Hình ảnh" class="w-4/12 m-auto my-3">
                    
                            <p class="text-xl text-center text-black m-auto dark:text-white mt-3">Bạn không có đủ giấy để in file này.</p>

                            <p class="text-xl text-center text-black m-auto dark:text-white">Vui lòng mua thêm giấy in hoặc điều chỉnh lại cài đặt.</p>
                        </div>   
                        `
                $('#bodyModal').html(str);
                $('#bug1').remove();
            }
        });
    });
}

$(document).ready(function () {
    // Load default preview image on document ready
    showDefaultPreview();
    
    // Attach event listener to file input change
    $('#file_input').change(function () {
        previewFile(this);
    });
});

function previewFile(input) {
    var fileInput = $('#file_input')[0];
    var previewContainer = $('#preview');

    // Clear previous content in the preview container
    previewContainer.empty();

    // Hide the default image
    $('#default-preview-image').hide();

    // Check if a file is selected
    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        // Display the selected file in the preview container
        reader.onload = function (e) {
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
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(fileInput.files[0]);

        // Hide the default image
        $('#default_preview').hide();
    }
}

