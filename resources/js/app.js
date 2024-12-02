import './bootstrap';
document.getElementById('branch').addEventListener('change', function () {
    const branchId = this.value;

    fetch(`/api/departments?branch_id=${branchId}`)
        .then(response => response.json())
        .then(data => {
            const departmentSelect = document.getElementById('department');
            departmentSelect.innerHTML = '<option value="">All Departments</option>';
            data.forEach(department => {
                departmentSelect.innerHTML += `<option value="${department.id}">${department.name}</option>`;
            });
        });
});

document.getElementById('department').addEventListener('change', function () {
    const departmentId = this.value;

    fetch(`/api/ranks?department_id=${departmentId}`)
        .then(response => response.json())
        .then(data => {
            const rankSelect = document.getElementById('rank');
            rankSelect.innerHTML = '<option value="">All Ranks</option>';
            data.forEach(rank => {
                rankSelect.innerHTML += `<option value="${rank.id}">${rank.rank}</option>`;
            });
        });
});
