
if(window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
}

$(document).ready(function () {
    $('#add_account_category').on("submit", function () {
        if ($('#name').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>");
            return false;
        } 
    });
});





