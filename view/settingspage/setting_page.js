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
    setting_page_params['supported-formats'] = new Array();
    $('input:checkbox[name=file-format]:checked').each(function() {
        setting_page_params['supported-formats'].push($(this).val());
    })
    alert(setting_page_params['supported-formats']);
});
