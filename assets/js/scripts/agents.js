$(document).ready(function () {

  $("#form1").submit(function (e) {
    e.preventDefault();

    let reg_type = $("#reg_type");
    let name = $("[name=name]");
    let company_name = $("[name=company_name]");
    let gst = $("[name=gst]");
    let phone = $("[name=phone]");
    let email = $("[name=email]");
    let password = $("[name=password]");
    let address = $("[name=address]");


    let error = "";

    if ($.trim(name.val()) == "") {
      error = "Please enter Name";
      name.focus();
    } else if ($.trim(phone.val()) == "") {
      error = "Please enter phone";
      phone.focus();
    } else if ($.trim(email.val()) == "" || !EMAIL_PATTERN.test(email.val())) {
      error = "Please enter valid email";
      email.focus();
    } else if ($.trim(password.val()) == "") {
      error = "Please enter password";
      password.focus();
    }
    else if ($.trim(address.val()) == "") {
      error = "Please enter address";
      address.focus();
    }

    if (reg_type.val() == REG_TYPE_COMPANY) {
      if ($.trim(company_name.val()) == "") {
        error = "Please enter company name";
        company_name.focus();
      } else if ($.trim(gst.val()) == "") {
        error = "Please enter GST";
        gst.focus();
      }
    }

    if (error != "") {
      showAlert(error, 'danger');
      return;
    }
    // return;
    let formData = new FormData(this);
    let url = USER_BASE_URL + '/save-agent';
    showBtnProgress();
    AjaxPost(formData, url, AjaxSuccess, AjaxError);

  });

  function AjaxSuccess(content) {
    //hideBtnProgress();
    // showAlertOnPage($("#form1"),content);return;
    let result = JSON.parse(content);
    if (result.success) {
      // showAlert(result.message);
      showAlertOnPage($("#form1"), result.message);
      setTimeout(() => {
        hideBtnProgress();
        // window.location.replace(BASE_URL + "Users");
      }, 1000);

    } else {
      hideBtnProgress();
      showAlertOnPage($("#form1"), result.message, 'danger');
    }
  }

  $('#reg_type').change(
    function () {
      var sel = $(this);
      if (sel.val() == REG_TYPE_COMPANY) {
        $('[company-inputs]').show();
      } else if (sel.val() == REG_TYPE_INDIVIDUAL) {
        $('[company-inputs]').hide();
      }

    }
  );
  $('#reg_type').trigger('change');

});
