function showAlert(Message = '', Type = 'success', Delay = 2000) {
    if (Message != '') {
        $.notify({
            message: Message
        }, {
            type: Type,
            animate: {
                enter: 'animated bounceIn',
                exit: 'animated bounceOut'
            },
            newest_on_top: true,
            delay: Delay
        });

    }
};

function showAlertOnPage(ParentElement, Message = '', Type = 'success') {

    if (Message != '') {
        let alerthtml = `<div class="alert alert-${Type} alert-dismissible fade show alertonpage">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    ${Message}
  </div>`;
        let alertonpage = ParentElement.find('.alertonpage');
        if (alertonpage.length > 0) {
            alertonpage.remove();
        }
        ParentElement.prepend(alerthtml);
    }

};

function showBtnProgress(id = 'btn', msg = "Please wait...") {
    let btn = $('#' + id);
    btn.attr('oldhtml', btn.html());
    btn.html(`<span class="spinner-border spinner-border-sm"></span> ${msg}`);
    btn.attr('disabled', true);
}
function hideBtnProgress(id = 'btn') {
    let btn = $('#' + id);
    btn.html(btn.attr('oldhtml'));
    btn.attr('disabled', false);
}

function AjaxPost(formData, url, successCallBack, errorCallBack, args = null) {
    var request = new XMLHttpRequest;
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var content = request.responseText.trim();
            if (args == null)
                successCallBack(content)
            else {
                successCallBack(content, args)
            }

        } else if (this.status == 404 || this.status == 403) {
            throw "Error: readyState= " + this.readyState + " status= " + this.status;
        }
    }
    request.open("POST", url);
    request.send(formData);
}

function AjaxError(error) {
    showAlert("Please contact IT. ", 'error');
}
