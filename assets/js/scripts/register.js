$("#form1").submit(function(e) {
    e.preventDefault();

    let role = $("[name=role]");
    let name = $("[name=name]");
    let email = $("[name=email]");
    let password = $("[name=password]");
    let cpassword = $("[name=cpassword]");

    let error = "";
    let selectedIndex = role.prop('selectedIndex');
    if (selectedIndex == 0) {
      error = "Please select role";
      role.focus();
    } else if ($.trim(name.val()) == "") {
      error = "Please enter Name";
      name.focus();
    } else if ($.trim(email.val()) == "" || !EMAIL_PATTERN.test(email.val())) {
      error = "Please enter valid email";
      email.focus();
    } else if ($.trim(password.val()) == "") {
      error = "Please enter password";
      password.focus();
    } else if ($.trim(cpassword.val()) == "") {
      error = "Please enter confirm password";
      cpassword.focus();
    } else if ($.trim(password.val()) != $.trim(cpassword.val())) {
      error = "Password not match";
      cpassword.focus();
    }

    if (error != "") {
      showAlert(error, 'danger');
      return;
    }

    let formData = new FormData(this);
    let url = BASE_URL + 'login/register_user';
    showBtnProgress();
    AjaxPost(formData, url, AjaxSuccess, AjaxError);

  });

  function AjaxSuccess(content) {

    let result = JSON.parse(content);
    if (result.success) {
      showAlert(result.message);
      setTimeout(() => {
        hideBtnProgress();
        window.location.replace(BASE_URL + "Users");
      }, 1000);

    } else {
      hideBtnProgress();
      showAlert(result.message, 'danger');
    }

  }