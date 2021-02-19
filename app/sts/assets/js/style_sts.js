
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

$(document).ready(function () {
    $('#edit_user').on("submit", function () {
        if ($('#name').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>");
            return false;
        } else if ($('#email').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>");
            return false;
        } else if ($('#username').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>");
            return false;
        } 
    });
});


$(document).ready(function () {
    $('#edit_img').on("submit", function () {
        if ($('#new_image').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma imagem JPG ou PNG!</div>");
            return false;
        } 
    });
    
    $('#new_image').change( function(){
        let validos = /(\.jpg|\.png)$/i;
        let fileInput = $(this);
        let name = fileInput.get(0).files["0"].name;
        if(validos.test(name)){
            $(".msg").html('<p></p>');
            previewImage();
        }else{
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma imagem JPG ou PNG!</div>");
            return false;
        }        
    });
    
    function previewImage(){
        var image = document.querySelector('input[name=new_image]').files[0];
        var preview = document.querySelector('#preview-img');
        
        var reader = new FileReader();
        reader.onloadend = function(){
            preview.src = reader.result;
        };
        
        if(image){
            reader.readAsDataURL(image);
        }else{
            preview.src = "";
        }
    }
});


