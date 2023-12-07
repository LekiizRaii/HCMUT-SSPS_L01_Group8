document.getElementById("login-button").addEventListener("click", function (event) {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username && password) {
            const urlParams = new URLSearchParams(window.location.search);
            const actor = urlParams.get("actor");

            var loginPage = "";

            // Định nghĩa đường dẫn tới trang đăng nhập dựa trên vai trò (actor) đã trích xuất
            if (actor === "student") {
                localStorage.setItem('idRole', 1)
                loginPage = "../homepage/homepage.php";
            } else if (actor === "SPSO") {
                localStorage.setItem('idRole', 2)
                loginPage = "../homepage/homepage.php";
            }

            // Chuyển hướng đến trang đăng nhập tương ứng
            window.location.href = loginPage;
    } else {
            // Hiển thị thông báo hoặc thực hiện xử lý khác nếu có lỗi
            alert("Vui lòng điền đầy đủ thông tin.");
    }
    // Ngăn chặn hành động mặc định của nút submit trong form
    event.preventDefault();
});

document.getElementById("nav__login__button").addEventListener("click", function () {
    window.location.href = "./ChooseActor.php";
});

