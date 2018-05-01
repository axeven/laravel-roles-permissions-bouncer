$(document).ready(function(){
  $('.modal').modal();  
  $('#login').click(function(){
    $('#login-modal').modal('open');
    $('#email').focus();
  });
});