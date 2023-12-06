$(document).ready(function () {
    customize_date_input();
    load_notification();
});

function customize_date_input() {
    var input=document.querySelector('input[name="page-giving-date"]');
    input.onfocus = function(e) {
        e.preventDefault();
        this.type = 'date';
    }
    input.onblur = function(e) {
        e.preventDefault();
        if (this.value == "") {
            this.type = 'text';
        }
        else {
            this.type = 'date';
        }
    };
}

function load_notification() {
    $('#save-button').click(function (e) {
        e.preventDefault();

        var setting_page_params = new Array();
        setting_page_params['semester-pages'] = document.getElementById("semester-pages").value;
        setting_page_params['page-giving-date'] = document.getElementById("page-giving-date").value;
        var format_array = new Array();
        $('input:checkbox[name=file-format]:checked').each(function() {
            format_array.push($(this).val());
        })
        setting_page_params['supported-formats'] = String(format_array);

        var params = new FormData();
        for (var key in setting_page_params) {
            params.append(key, setting_page_params[key]);
        }

        fetch('../../controllers/setting_page_controller.php?action=save-setting-info', {
            method: 'POST',
            body: params,
            credentials: 'include'
        })
        .then(response => response.json())
        .then(response => {
            if (response['status'] === 'OK') {
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
                    alert(12);
                    window.location.replace("../homepage/homepage.php");
                });
            } else if (response['status'] === 'ERROR') { 
                var message = '';
                var request = '';
                if (response['error-type'] == 'PAGE') {
                    message = "Bạn chưa nhập số lượng giấy được cung cấp mỗi kỳ.";
                    request = "Yêu cầu nhập một số nguyên dương và không có kí tự phía trước hay phía sau số đó.";
                } else if (response['error-type'] == 'DATE') {
                    message = "Bạn chưa nhập thời gian cung cấp giấy.";
                    request = "Yêu cầu chọn thời gian.";
                }
                else if (response['error-type'] == 'FORMAT') {
                    message = "Định dạng số lượng giấy được cung cấp mỗi học kỳ không phù hợp.";
                    request = "Yêu cầu nhập một số nguyên dương và không có kí tự phía trước hay phía sau số đó.";
                }
                else if (response['error-type'] == 'PAST') {
                    message = "Thời gian cung cấp giấy là quá khứ so với hiện tại, chúng tôi không thể hiện thực tác vụ ở quá khứ.";
                    request = "Yêu cầu chọn thời gian phù hợp.";
                }
                var str = '';
                    str += `
                            <div class="flex flex-col m-auto max-w-screen p-4">
                                <h1 class="text-2xl text-center font-bold m-auto dark:text-white mb-3">LỖI LƯU THÔNG TIN CÀI ĐẶT IN</h1>
                        
                                <img src="../img/error.png"
                                alt="Hình ảnh" class="w-7/12 m-auto my-3">
                        
                                <p class="font-bold text-xl text-center text-black m-auto dark:text-white mt-3" style="color:red">${message}</p>
                                <br>
                                <p class="text-xl text-center text-black m-auto dark:text-white">${request}</p>
                            </div>   
                            `
                    $('#bodyModal').html(str);
            }
        });
    });
};
