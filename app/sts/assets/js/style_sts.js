
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

//Carregar modal apagar
//Carregar modal apagar
$(document).ready(function () {
    $('a[data-confirm]').click(function () {
        var href = $(this).attr('href');

        if (!$('#confirm-delete').length) {
            $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="confirm-deleteLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger"><h5 class="modal-title text-white" id="deleteDataLabel"><i class="far fa-trash-alt fa-lg"></i> EXCLUIR REGISTRO</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza que deseja excluir o registro selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancelar</button><a class="btn btn-outline-danger" id="dataConfirmOk">Apagar</a></div></div></div></div>');
        }

        $('#dataConfirmOk').attr('href', href);
        $('#confirm-delete').modal({show: true});
        return false;
    });
});




