$(document).ready(function () {
    loadBugModal();
});
function loadBugModal() {
    $('#save-button').click(function (e) {
        e.preventDefault();
        if (1) {
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
                window.location.replace("./chooseprinter.html");
            });
        } else if (0) { //Lỗi cài đặt in
            var str = '';
            str += `
                    <div class="flex flex-col m-auto max-w-screen p-4">
                        <h1 class="text-2xl font-bold m-auto dark:text-white mb-3">LỖI CÀI ĐẶT IN</h1>
                
                        <img src="../img/error.png"
                        alt="Hình ảnh" class="w-7/12 m-auto my-3">
                
                        <p class="text-xl text-black m-auto dark:text-white mt-3">Các thông số cài đặt in không hợp lệ.</p>

                        <p class="text-xl text-black m-auto dark:text-white">Vui lòng kiểm tra lại.</p>
                    </div>   
                    `
            $('#bodyModal').html(str);
            $('#bug2').remove();
        } else { //Lỗi không đủ giấy in
            var str = '';
            str += `
                    <div class="flex flex-col m-auto max-w-screen p-4">
                        <h1 class="text-2xl font-bold m-auto dark:text-white mb-3">KHÔNG ĐỦ GIẤY IN</h1>
                
                        <img src="../img/notenoughpage.png"
                        alt="Hình ảnh" class="w-4/12 m-auto my-3">
                
                        <p class="text-xl text-black m-auto dark:text-white mt-3">Bạn không có đủ giấy để in file này.</p>

                        <p class="text-xl text-black m-auto dark:text-white">Vui lòng mua thêm giấy in hoặc điều chỉnh lại cài đặt.</p>
                    </div>   
                    `
            $('#bodyModal').html(str);
            $('#bug1').remove();
        }
    });
}