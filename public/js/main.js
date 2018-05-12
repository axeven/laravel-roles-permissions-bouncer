$(document).ready(function(){
  $('.modal').modal();  
  $('#login').click(function(){
    $('#login-modal').modal('open');
    $('#loginemail').focus();
  });
  $('select').formSelect();
  $('.tabs').tabs();
      
});

function createOverlay(){
  var el = `
    <div id="custom-overlay" class="valign-wrapper">
      <div class="center-align" style="width:100%">
        <div class="preloader-wrapper big active">
          <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;
  $('body').append(el);
  $('#custom-overlay').hide();
  return $('#custom-overlay');
}

function unvalidate(inputName, message){
  var temp = inputName.replace(/\./g, '_');
  name = temp.replace(/_[0-9]+/, "");
  var el;
  if( name === temp){
    el = $('#'+name);
  }else{
    var idx =0 ;
    var nameSplit = inputName.split('.');
    for(var i = 0;i < nameSplit.length;++i){
      if ( $.isNumeric( nameSplit[i])){
        idx = parseInt(nameSplit[i]);
        break;
      }
    }
    el = $('.'+name)[idx]
  }

  $(el).addClass('invalid');
  $(el).parent().children('span').remove();
  $(el).parent().append('<span class="helper-text" data-error="'+message+'"></span>');
}