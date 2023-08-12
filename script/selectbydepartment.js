const deptSelect = document.getElementById('deptSelect');
const userTableRows = document.querySelectorAll('#userTable tbody tr');
const itemTableRows = document.querySelectorAll('#itemTable tbody tr');

// Function to filter users and items based on selected department
function filterDataByDepartment() {
    const selectedDepartment = deptSelect.value;

    userTableRows.forEach(userRow => {
        const userDepartment = userRow.getAttribute('data-department');

        if (!selectedDepartment || selectedDepartment === userDepartment) {
            userRow.style.display = 'table-row';
        } else {
            userRow.style.display = 'none';
        }
    });

    itemTableRows.forEach(itemRow => {
        const itemDepartment = itemRow.getAttribute('data-department');

        if (!selectedDepartment || selectedDepartment === itemDepartment) {
            itemRow.style.display = 'table-row';
        } else {
            itemRow.style.display = 'none';
        }
    });
}

// Add event listener to the department select element
deptSelect.addEventListener('change', filterDataByDepartment);

// Initial filtering when the page loads
filterDataByDepartment();

