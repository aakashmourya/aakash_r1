$(document).ready(function () {

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
        };
        selectedTestList.push(ob);
        loadTable(selectedTestList);
        selectedOption.remove();

    });
    function loadTable(list) {
        let packages = JS_ViewData.packages;

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
            removeBtn.data("test", list[i].test_id);
            removeBtn.data("testName", list[i].test_name);
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
        let test_id = btn.data('test');
        let test_name = btn.data('testName');

        let itemIndex = selectedTestList.findIndex((item) => item.test_id == test_id);

        selectedTestList.splice(itemIndex, 1);
        loadTable(selectedTestList);

        let option = `<option value="${test_id}">${test_name}</option>`;
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
    ////////////////////////////////////////////////////////////////
});
