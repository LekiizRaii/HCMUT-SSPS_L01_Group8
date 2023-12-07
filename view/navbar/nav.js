var user = {
    name: 'Mai Hoàng Danh',
    dob: new Date(2003, 3, 1),
    gender: 1,
    address: 'KTX khu A thành phố Hồ Chí Minh',
    phone: '0912345678',
    email: 'neil.sims@flowbite.com',
}
$(document).ready(function () {
    loadNav();
    loadModal();
    signout();
});
function loadNav() {
    var idRole = localStorage.getItem('idRole');
    if (!localStorage.getItem("idRole")) {
        $('#nav__user').remove();
        $('#homepage1').remove();
        $('#homepage2').remove();
        $('#nav__login__button').click(function () {
            window.location.replace("../loginpage/ChooseActor.html");
        });
    }
    else if (idRole === "1") {
        $('#nav__login').remove();
        $('#user__SPSO').remove();
        $('#homepage0').remove();
        $('#homepage2').remove();
        $('#history2').remove();
        $('#history3').remove();
        
    }
    else if (idRole === "2") {
        $('#nav__login').remove();
        $('#user__student').remove();
        $('#homepage0').remove();
        $('#homepage1').remove();
        $('#history1').remove();
        $('#history3').remove();
    }
    
    // $('#my-class-link').attr('href', '../MyCourses/myCourses.html');
    // $('#my-page-link').attr('href', '../MyPage/myPage.html');
}
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});
function loadModal() {
    $('#userinfo').click(function (e) {
        e.preventDefault();
        var str = '';
        str += `
                    <div class="col-span-2">
                        <form>
                            <div>
                                <div class="gap-6 mb-6">
                                    <label for="full_name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Họ
                                        và tên</label>
                                    <input type="text" id="full_name" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Nguyễn Văn A" value="`+ user.name + `" required>
                                </div>
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="dob"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Năm
                                        sinh</label>
                                    <input type="date" id="dob" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value=`+ (new Date(user.dob.getTime() - (user.dob.getTimezoneOffset() * 60000))).toISOString().split('T')[0] + `   required>
                                </div>
                                <div>
                                    <label for="gender"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giới
                                        tính</label>
                                    <div class="flex">
                                        <div class="flex items-center mt-3 mr-4">
                                        `
        if (user.gender === 1) {
            str += `<input disabled checked id="inline-radio" type="radio"
                                            value="Nam" name="inline-radio-group"
                                            class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">`
        }
        else {
            str += `<input disabled id="inline-radio" type="radio"
            value="Nam" name="inline-radio-group"
            class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">`
        }
        str += `
                                            
                                            <label for="inline-radio"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nam</label>
                                        </div>
                                        <div class="flex items-center mt-3 mr-4">
                                        `
        if (user.gender === 0) {
            str += `<input disabled checked id="inline-2-radio" type="radio"
            value="Nữ" name="inline-radio-group"
            class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">`
        }
        else {
            str += `<input disabled id="inline-2-radio" type="radio"
            value="Nữ" name="inline-radio-group"
            class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">`
        }
        str += `<label for="inline-2-radio"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gap-6 mb-6">
                                <div>
                                    <label for="address"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa
                                        chỉ</label>
                                    <input disabled type="text" id="address"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="" value="`+ user.address + `" required>
                                </div>
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="phone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số
                                        điện thoại</label>
                                    <input disabled type="tel" id="phone"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="0912345678" pattern="[0-9]{10}" value="`+ user.phone + `" required>
                                </div>
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa
                                        chỉ email</label>
                                    <input type="email" id="email" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="nguyenvana@company.com" value="`+ user.email + `" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="" style="margin-top: 4vh;">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 mb-10">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="https://th.bing.com/th/id/OIP.CVdkzge14K0HJZWZg5DiMQHaHn?pid=ImgDet&rs=1"
                                    alt="">
                                <input disabled id="dropzone-file" type="file" class="hidden" />
                            </div>
                        </label>

                        <div class="w-full gap-4">
                        </div>
                    </div>
                `
        $('#userModal').html(str);
        // $('#closeBtn').click(function (e) {
        //     e.preventDefault();
        //     $('#default-modal').html('');
        // });
    });
}
function signout() {
    $('#signout').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Bạn chắc chứ?",
            text: "Bạn đang đăng xuất",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xác nhận"
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({
                    icon: "success",
                    title: "Đăng xuất thành công"
                }).then(() => {
                    localStorage.removeItem('idRole');
                    localStorage.removeItem('userInfo');
                    window.location.replace("../homepage/homepage.php");
                });
            }
        });
    });
}