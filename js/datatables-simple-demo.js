window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});



function loadSample() {
    $.ajax({
        method: "POST",
        // dataType: "JSON",
        url: "../api/tools.php",
        data: {
            "action": "loadSample"
        },
        success: (response) => {
            $(".categories").html("");
            $(".categories").html(response);
        },
        error: () => {
            alert(response['responseText']);

        },
    })
}
