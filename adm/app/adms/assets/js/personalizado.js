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

