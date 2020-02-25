$(document).ready(function () {

  $("#form1").submit(function (e) {
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
      showAlertOnPage($("#form1"),error,'danger');
      return;
    }

    let formData = new FormData(this);
    query_string="";
    if(window.location.href.indexOf('?')!=-1){
      query_string= window.location.href.slice(window.location.href.indexOf('?'))
    }
    
    let url = BASE_URL + 'Login/validate'+query_string;
    showBtnProgress();
    AjaxPost(formData, url, AjaxSuccess, AjaxError);

  });

  function AjaxSuccess(content) {
   
    let result = JSON.parse(content);
    if (result.success) {
      showAlertOnPage($("#form1"),result.message);
    
      setTimeout(() => {
        window.location.replace(result.home_url);
      }, 1000);

    } else {
      hideBtnProgress();
      showAlertOnPage($("#form1"),result.message,'danger');
    
    }

  }

});