
$(document).ready(function (){

   var user = true,
       pass = true,
       mess = true;


 $('.user').blur(function(){

   if($(this).val().length < 3 ){
      $(this).css('border', '1px solid #f00');
      $(this).next().fadeIn(200);
      user = true;
     }else{
      $(this).css('border', '1px solid #080');
      $(this).next().fadeOut(200);
      user = false;
     }

 });

 
 $('.pass').blur(function(){

   if($(this).val().length < 4 ){
      $(this).css('border', '1px solid #f00');
      $(this).next().fadeIn(200);
      pass = true;
     }else{
      $(this).css('border', '1px solid #080');
      $(this).next().fadeOut(200);
      pass = false;
     }

 });
 
 
 $('.mess').blur(function(){

   if($(this).val().length < 10 ){
      $(this).css('border', '1px solid #f00');
      $(this).next().fadeIn(200);
      mess = true;
     }else{
      $(this).css('border', '1px solid #080');
      $(this).next().fadeOut(200);
      mess = false;
     }

 });

 
 $('.control-form').submit(function(e){

   if(pass == true || mess == true || user == true){
      e.preventDefault();
      $('.user, .pass, .mess').blur();

   }

 });
});