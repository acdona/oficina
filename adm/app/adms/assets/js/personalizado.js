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
