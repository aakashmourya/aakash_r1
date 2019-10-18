$("#form1").submit(function(e) {
    e.preventDefault();

   
    let email = $("[name=email]");
    let password = $("[name=password]");
  
   
    let error = "";
   
   if ($.trim(email.val()) == "" || !EMAIL_PATTERN.test(email.val())) {
      error = "Please enter valid email";
      email.focus();
    } else if ($.trim(password.val()) == "") {
      error = "Please enter password";
      password.focus();
    }

    if (error != "") {
      showAlert(error, 'danger');
      return;
    }
    
    let formData = new FormData(this);
    let url = BASE_URL + 'login/validate';
    showBtnProgress();
    AjaxPost(formData, url, AjaxSuccess, AjaxError);

  });

  function AjaxSuccess(content) {
   // hideBtnProgress();
//console.log(content);
//return;
    let result = JSON.parse(content);
    if (result.success) {
      showAlert(result.message);
      setTimeout(() => {
        hideBtnProgress();
        window.location.replace(BASE_URL + "Users");
      }, 500);

    } else {
      hideBtnProgress();
      showAlert(result.message, 'danger');
    }

  }