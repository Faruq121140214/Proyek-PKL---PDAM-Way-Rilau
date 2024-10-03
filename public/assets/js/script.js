function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
}
function checkSelection() {
    const jenisDokumen = document.getElementById('jenisDokumen').value;
    const inputHargaContainer = document.getElementById('inputHargaContainer');

    if (jenisDokumen === 'KUI') {
        inputHargaContainer.style.display = 'block';
    } else {
        inputHargaContainer.style.display = 'none';
    }
}

function checkSelection() {
const selectElement = document.getElementById('jenisDokumen');
const dropdownIcon = document.getElementById('dropdownIcon');
if (selectElement.value) {
    selectElement.classList.remove('text-gray-500');
    selectElement.classList.add('text-black');
    dropdownIcon.classList.add('hidden');
} else {
    selectElement.classList.add('text-gray-500');
    selectElement.classList.remove('text-black');
    dropdownIcon.classList.remove('hidden');
}
}

function checkSelection() {
    var selectElement = document.getElementById("jenisDokumen");
    var hargaContainer = document.getElementById("inputHargaContainer");
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;

    if (selectedValue === "KUI") {
        hargaContainer.classList.remove("hidden");
    } else {
        hargaContainer.classList.add("hidden");
    }
}
