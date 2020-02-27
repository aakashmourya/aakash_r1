$(document).ready(function () {

  $("#form1").submit(function (e) {
    e.preventDefault();
    let user_id = $("[name=user_id]");
    let from_date = $("[name=from_date]");
    let to_date = $("[name=to_date]");
    let file = $("[name=file]");

    let error = "";

    if ($.trim(from_date.val()) == "") {
      error = "Please enter from date";
      from_date.focus();
    } else if ($.trim(to_date.val()) == "") {
      error = "Please enter to date";
      to_date.focus();
    }
    else if ($.trim(file.val()) == "") {
      error = "Please select document";
      file.focus();
    } else if (selectedTestList.length <= 0) {
      error = "Please select tests.";
      $('#testsSelect').focus();
    }



    if (error != "") {
      showAlert(error, 'danger');
      return;
    }
    //return;
    let formData = new FormData(this);
    formData.append('tests', JSON.stringify(selectedTestList));
    showBtnProgress();
    console.log(formData);
    AjaxPost(formData, `${USER_BASE_URL}/${FORM_ACTION}`, AjaxSuccess, AjaxError);

  });
  function AjaxSuccess(content) {
    //hideBtnProgress();
    // showAlertOnPage($("#form1"),content);return;
    try {
      let result = JSON.parse(content);
      if (result.message.code) {
        if (result.message.code == 401) {
          window.location.replace(USER_BASE_URL + "/logout");
          return;
        }
      }
      if (result.success) {
        showAlertOnPage($("#form1"), result.message);
        setTimeout(() => {
          window.location.replace(USER_BASE_URL + "/show-agents");
        }, 1000);

      } else {
        hideBtnProgress();
        if (result.message.code) {
          showAlertOnPage($("#form1"), result.message.message, 'danger');
        }
        else {
          showAlertOnPage($("#form1"), result.message, 'danger');
        }
      }
    } catch (err) {
      window.location.replace(USER_BASE_URL + "/logout");
    }
  }


  ///////////////////////////////////////////////////////////////
  let setectedTestTable = $('#setectedTestTable');
  let selectedTestList = [];
  $('#addTestBtn').click(function () {
    let testsSelect = $('#testsSelect');
    let selectedOption = $("#testsSelect option:selected");
    let selectedIndex = testsSelect.prop('selectedIndex');
    if (selectedIndex == 0) {
      showAlert('Please select a test.', 'info');
      return;
    }
    let ob = {
      test_id: testsSelect.val(),
      test_name: selectedOption.text(),
      test_mrp: selectedOption.data('mrp')
    };
    selectedTestList.push(ob);
    loadTable(selectedTestList);
    selectedOption.remove();

  });
  function loadTable(list) {
    let packages = JS_ViewData.packages;
    console.log(list, packages);
    let len = list.length;
    setectedTestTable.empty();
    for (let i = 0; i < len; i++) {

      let packagesSelectOptions = packages.map((package) => {
        let optionTemplate = $(`<option value="${package.id}">${package.name} (${package.percentage}%)</option>`);
        optionTemplate.data('percentage', package.percentage);
        return optionTemplate;
      });

      let rowTemplate = $(`
            <tr>
            <th scope="row">${i + 1}</th>
            <td>${list[i].test_name}</td>
            <td>   <select  class="form-control  form-control-sm package-select"></select></td>
            <td><input type="text" class="form-control form-control-sm percentage-input" /></td>
            <td> <button title="Edit Agent" type="button" class="btn btn-danger btn-sm list-remove-btn">
            <i class="fa fa-remove"></i></button>
          </td>
          </tr>`);

      var percentageInput = rowTemplate.find('.percentage-input');
      percentageInput.data("test", list[i].test_id);
      percentageInput.keyup(percentageInput_keyup);

      var packageSelect = rowTemplate.find('.package-select');
      packageSelect.data("inputText", percentageInput);
      packageSelect.data("test", list[i].test_id);
      packageSelect.append(packagesSelectOptions)
      packageSelect.change(package_onchange);

      var removeBtn = rowTemplate.find('.list-remove-btn');
      removeBtn.data("test", list[i]);

      removeBtn.click(removeBtn_click);

      setectedTestTable.append(rowTemplate);
      if (list[i].selected_package) {
        packageSelect.val(list[i].selected_package);
      }
      else {
        list[i].selected_package = packages[0].id;
        list[i].percentage = packages[0].percentage;
      }
      packageSelect.val(list[i].selected_package);
      percentageInput.val(list[i].percentage);

    }
  }
  function removeBtn_click() {
    let btn = $(this);
    let test = btn.data('test');

    let itemIndex = selectedTestList.findIndex((item) => item.test_id == test.test_id);

    selectedTestList.splice(itemIndex, 1);
    loadTable(selectedTestList);

    let option = `<option data-mrp="${test.test_mrp}" value="${test.test_id}">${test.test_name}</option>`;
    let testsSelect = $('#testsSelect');
    testsSelect.append(option);
  }
  function percentageInput_keyup() {
    let percentageInput = $(this);
    let test_id = percentageInput.data('test');
    let item = selectedTestList.find((item) => item.test_id == test_id);
    item.percentage = percentageInput.val();

  }
  function package_onchange() {
    let packageSelect = $(this);
    let selectedOption = $(this.selectedOptions[0]);
    let inputText = packageSelect.data('inputText');
    let test_id = packageSelect.data('test');
    let percentage = selectedOption.data('percentage');
    let item = selectedTestList.find((item) => item.test_id == test_id);
    item.selected_package = packageSelect.val();

    inputText.val(percentage);
    item.percentage = percentage;

  }
  function initTestTable() {
    let interval = setInterval(packageListener, 1);
    function packageListener() {
      let package = JS_ViewData.packages;
      if (package !== undefined) {
        selectedTestList = JSON.parse(table_data);
        loadTable(selectedTestList);
        clearInterval(interval);
      }
    }
  }

  initTestTable();
  ////////////////////////////////////////////////////////////////
});
