// document.getElementById('printButton').addEventListener('click', function () {
// Call the browser's print function
// window.print();
// });
// Add event listener to the department select dropdown
function filterTableByDepartment(selectedDepartment) {
  var rows = document.querySelectorAll("#myTable-report tbody tr");

  for (var i = 0; i < rows.length; i++) {
    var row = rows[i];
    var department = row.getAttribute("data-dep-id");

    // If no department is selected or the row's department matches the selected department, show the row
    if (!selectedDepartment || department === selectedDepartment) {
      row.style.display = "table-row";
    } else {
      row.style.display = "none";
    }
  }
}

document
  .getElementById("departmentSelect")
  .addEventListener("change", function () {
    var selectedDepartment = this.value;
    filterTableByDepartment(selectedDepartment); // Call the function with the selected department
  });
