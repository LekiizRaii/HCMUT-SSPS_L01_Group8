async function fetchData(actor) {
    try {
        const response = await fetch(actor === "student" ? 'get_student_data.php' : 'get_spso_data.php');

        if (!response.ok) {
            throw new Error(`Failed to fetch data for ${actor}. Status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error(error);
        throw new Error(`An error occurred while fetching data for ${actor}`);
    }
}


function getPassword(data, username) {
    var password = null;
    for (var i = 0; i < data.length; i++) {
        if (data[i].TenDangNhap === username) {
            password = data[i].Password;
            break;
        }
    }
    return password;
}

document.getElementById("login-button").addEventListener("click", async function (event) {
    event.preventDefault();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // alert(username);
    // alert(password);

    if (username && password) {
        const urlParams = new URLSearchParams(window.location.search);
        const actor = urlParams.get("actor");

        // alert(actor);

        var loginPage = "";

        try {
            const data = await fetchData(actor);
            const pwdfromdb = getPassword(data, username);

            // alert(pwdfromdb);

            if (actor === "student") {
                if (pwdfromdb != null && password == pwdfromdb) {
                    localStorage.setItem('idRole', 1)
                    loginPage = "../homepage/homepage.php";
                } else {
                    alert("Không thể đăng nhập. Vui lòng kiểm tra lại thông tin.");
                    // loginPage = "Login.html?actor=student";
                }
            } else if (actor === "SPSO") {
                if (pwdfromdb != null && password == pwdfromdb) {
                    localStorage.setItem('idRole', 2)
                    loginPage = "../homepage/homepage.php";
                } else {
                    alert("Không thể đăng nhập. Vui lòng kiểm tra lại thông tin.");
                    // loginPage = "Login.html?actor=SPSO";
                }
            }
        } catch (error) {
            alert("Xảy ra lỗi khi lấy dữ liệu.");
        }

        // Chuyển hướng đến trang đăng nhập tương ứng
        window.location.href = loginPage;
    } else {
        // Hiển thị thông báo hoặc thực hiện xử lý khác nếu có lỗi
        alert("Vui lòng điền đầy đủ thông tin.");
    }
    event.preventDefault();
});

document.getElementById("nav__login__button").addEventListener("click", function () {
    window.location.href = "./ChooseActor.php";
});
