$(document).ready(function () {
    loadPrintModal();
});
function loadPrintModal() {
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