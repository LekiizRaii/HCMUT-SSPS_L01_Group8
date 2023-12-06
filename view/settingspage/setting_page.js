var input=document.querySelector('input[name="page-giving-date"]');
input.onfocus = function(e) {
    this.type = 'date';
}
input.onblur = function() {
    if (this.value == "") {
        this.type = 'text';
    }
    else {
        this.type = 'date';
    }
};

$('#test').click(function (e) {
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
        alert(response);
    });
});
