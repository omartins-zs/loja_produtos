

 function login(){

   var email = $("#email").val();
   var senha = $("#senha").val();

   $.post('control/login.php',{email:email,senha:senha},function(data){
     if(data == '1'){
       location.href="cliente";
     }else if(data == '3'){
       $.post('control/load.php',{load:true},function(data){
         if(data == 1){
           location.reload();
         }else{
           alert('Ocoreu um erro, faça login');
         }
       });
     }else{
       alert('Email ou senha incorreto');
     }
   });

 }



 function create(){
   var email = $("#email_criar").val();
   var whatsapp = $("#whatsapp_criar").val();
   var senha = $("#senha_criar").val();
   var nome = $("#nome_criar").val();

   $.post('control/create.php',{email:email,whatsapp:whatsapp,senha:senha,nome:nome},function(data){
     var obj = JSON.parse(data);

     if(obj.erro){

       alert(obj.msg);

       if(obj.create == 1){
         $("#email_criar").val('');
         $("#whatsapp_criar").val('');
         $("#senha_criar").val('');
       }
     }else{
        $.post('control/load.php',{load:true},function(data){
          if(data == 1){
            location.reload();
          }else{
            alert('Ocoreu um erro, faça login');
          }
        });
     }

   });

 }


 function create_pedido(){

   $("#btn_mp").prop('disabled', true);
   $("#btn_mp").html('Aguarde');

   $.post('control/create_pedido.php',{create:true},function(data){

     var obj = JSON.parse(data);

     if(obj.erro){
       alert(obj.msg);
       $("#btn_mp").prop('disabled', false);
       $("#btn_mp").html('Mercado Pago');
     }else{
       if(obj.msg == "Sucesso"){
         location.href=obj.link;
       }
     }

   });
 }
