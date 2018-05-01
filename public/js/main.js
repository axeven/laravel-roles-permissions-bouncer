$(document).ready(function(){
  $('.modal').modal();  
  $('#login').click(function(){
    $('#login-modal').modal('open');
    $('#email').focus();
  });
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