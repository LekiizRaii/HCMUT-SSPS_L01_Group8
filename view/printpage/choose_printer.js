$(document).ready(function () {
    Promise.all([load_list_of_printer()]).then(function() {
        $(document).ready(function () {
            load_notification();
        });
    });

});

function load_list_of_printer() {
    return fetch('../../controllers/print_page_controller.php?action=show-printer-list', {credentials: 'include'})
    .then(response => response.json())
    .then(response => {
        $("#current-user-pages").html(`Số lượng giấy hiện có (tờ): ${response['user_numberofpage']}`);

        var str = "";
        str = `<tr>
                    <th scope="col" class="px-6 py-3">
                        &nbsp &nbsp &nbsp ID Máy In
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Mẫu Máy In
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Trạng thái
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Số lượng giấy ${response['pagesize']} (Tờ)
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        <span class="sr-only">Chọn</span>
                    </th>
                </tr>`;
        $("#header-list-of-printer").html(str);

        str = "";
        response['list-of-printer'].forEach(item => {
            var numberofpages = 0;
            if (response['pagesize'] == 'A4') {
                numberofpages = item['SoGiayA4'];
            }
            else if (response['pagesize'] == 'A3') {
                numberofpages = item['SoGiayA3'];
            }
            str += `<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="../img/printer_icon.png" alt="" class="w-10 h-10 mr-4">
                            <p class="my-auto">&nbsp ${item['ID']}</p>
                        </th>
                        <td class="px-6 py-4 text-center">
                            ${item['LoaiMuc']}
                        </td>
                        <td class="px-6 py-4 text-center text-green-500">
                            Sẵn sàng
                        </td>
                        <td class="px-6 py-4 text-center">
                            ${numberofpages}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a id="choose-printer" data-modal-target="print-modal" data-modal-toggle="print-modal" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chọn</a>
                        </td>
                    </tr>`;
        });
        $('#list-of-printer').html(str);
    });
}

function load_notification() {
    $('#choose-printer').click(function (e) {
        e.preventDefault();

        var isInProgress = true;

        if (isInProgress) {
            // Đang in
            var str = `
                <div class="flex flex-col m-auto max-w-screen p-4">
                    <h1 class="text-3xl text-center font-normal m-auto dark:text-white mb-4">File của bạn đang được in...</h1>
                    <img src="../img/printing.png" alt="Hình ảnh" class="w-6/12 m-auto my-3">
                    <h1 class="text-3xl text-center font-normal m-auto dark:text-white mt-4">Vui lòng chờ...</h1>
                </div>`;
            $('#bodyModal').html(str);
            $('#return-home').hide();

            // Simulate a delay of 1.5 seconds (1500 milliseconds) for printing
            setTimeout(function () {
                // After the delay, transition to the "In thành công" state
                var successStr = `
                    <div class="flex flex-col m-auto max-w-screen p-4">
                        <h1 class="text-3xl text-center font-normal m-auto dark:text-white mb-4">File của bạn đã được in thành công.</h1>
                        <img src="../img/happy-face.png" alt="Hình ảnh" class="w-6/12 m-auto my-3">
                    </div>`;
                $('#bodyModal').html(successStr);
                $('#return-home').show();
            }, 1500); // 1500 milliseconds (1.5 seconds)
        }
    });
}