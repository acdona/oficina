$(document).ready(function(){
    $('#new_user').on("submit", function(){
        var password = $('#password').val();
       if($('#name').val() === ""){
           $(".msg").html('<p>Erro: Necessário preencher o campo nome!</p>');
           return false;
       } else if($('#email').val() === ""){
           $(".msg").html('<p>Erro: Necessário preencher o campo e-mail!</p>');
           return false;
       } else if( password === ""){
           $(".msg").html('<p>Erro: Necessário preencher o campo senha!</p>');
           return false;
       } else if(password.length < 6 || password.match(/([1-9]+)\1{1,}/)){
           $(".msg").html('<p>Erro: Senha muito fraca, não deve ter número repetido!</p>');
           return false;
       } else if(password.length < 6 || !password.match(/[A-Za-z]/)){
           $(".msg").html('<p>Erro: Senha muito fraca, deve ter pelo menos uma letra!</p>');
           return false;
       }
    });
 });
 
 $(document).ready(function(){
    $('#send_login').on("submit", function(){      
       if($('#username').val() === ""){
           $(".msg").html('<p>Erro: Necessário preencher o campo usuário!</p>');
           return false;
       } else if($('#password').val() === ""){
           $(".msg").html('<p>Erro: Necessário preencher o campo senha!</p>');
           return false;
       }
    });
 });
 
 function passwordStrength(){
     var password = document.getElementById('password').value;
     var strength = 0;
     
     if((password.length >= 6) && (password.length <= 7)){
         strength += 10;
     }else if(password.length > 7){
         strength += 25;
     }
     
     if((password.length >= 6) && (password.match(/[a-z]+/))){
         strength += 10;
     }
     
     if((password.length >= 7) && (password.match(/[A-Z]+/))){
         strength += 20;
     }
     
     if((password.length >= 8) && (password.match(/[@#$%&;*]+/))){
         strength += 25;
     }
     
     if(password.match(/([1-9]+)\1{1,}/)){
         strength += -25;
     }
     
     console.log(strength);
     viewStrength(strength);
 }
 
 function viewStrength(strength){
     /*Imprimir a força da senha*/
     
     if(strength < 30){
         document.getElementById("msgViewStrength").innerHTML = ("<p style='color: #ff0000;'>Senha Fraca</p>");
     }else if((strength >= 30) && (strength < 50)){
         document.getElementById("msgViewStrength").innerHTML = ("<p style='color: #ff8c00;'>Senha Média</p>");
     }else if((strength >= 50) && (strength < 70)){
         document.getElementById("msgViewStrength").innerHTML = ("<p style='color: #7cfc00;'>Senha Boa</p>");
     }else if((strength >= 70) && (strength < 100)){
         document.getElementById("msgViewStrength").innerHTML = ("<p style='color: #008000;'>Senha Forte</p>");
     }
 }
function previewImagem(){
    var imagem = document.querySelector('input[name=imagem_nova]').files[0];
    var preview = document.querySelector('#preview-img');
    
     var reader = new FileReader();
     reader.onloadend = function(){
        preview.src = reader.result;
     };
     
     if(imagem){
         reader.readAsDataURL(imagem);
     } else {
         preview.src = "";
     }
    
}


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