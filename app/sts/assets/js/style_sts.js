
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
    $('#add_user').on("submit", function () {
        var password = $('#password').val();
        if ($('#name').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>");
            return false;
        } else if ($('#email').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>");
            return false;
        } else if ($('#username').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>");
            return false;
        }else if (password === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>");
            return false;
        } else if (password.length < 6 || password.match(/([1-9]+)\1{1,}/)) {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Senha muito fraca, não deve ter número repetido!</div>");
            return false;
        } else if (password.length < 6 || !password.match(/[A-Za-z]/)) {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Senha muito fraca, deve ter pelo menos uma letra!</div>");
            return false;
        }
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
    $('#edit_perfil').on("submit", function () {
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

$(document).ready(function () {
    $('#sits_user').on("submit", function () {
        if ($('#name').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>");
            return false;
        } else if ($('#adms_color_id').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo cor!</div>");
            return false;
        } 
    });
});

$(document).ready(function () {
    $('#form_color').on("submit", function () {
        if ($('#name').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>");
            return false;
        } else if ($('#color').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo cor!</div>");
            return false;
        } 
    });
});

$(document).ready(function () {
    $('#add_conf_email').on("submit", function () {
        if ($('#title').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo título!</div>");
            return false;
        } else if ($('#name').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>");
            return false;
        } else if ($('#email').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>");
            return false;
        } else if ($('#host').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo host!</div>");
            return false;
        } else if ($('#username').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>");
            return false;
        } else if ($('#password').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>");
            return false;
        } else if ($('#smtpsecure').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo SMTP!</div>");
            return false;
        } else if ($('#port').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo porta!</div>");
            return false;
        } 
    });
});

$(document).ready(function () {
    $('#edit_conf_email').on("submit", function () {
        if ($('#title').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo título!</div>");
            return false;
        } else if ($('#name').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>");
            return false;
        } else if ($('#email').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>");
            return false;
        } else if ($('#host').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo host!</div>");
            return false;
        } else if ($('#username').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>");
            return false;
        } else if ($('#smtpsecure').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo SMTP!</div>");
            return false;
        } else if ($('#port').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo porta!</div>");
            return false;
        } 
    });
});

$(document).ready(function () {
    $('#edit_conf_email_pass').on("submit", function () {
        if ($('#password').val() === "") {
            $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>");
            return false;
        } 
    });
});
