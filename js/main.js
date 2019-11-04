
// if(window.jQuery) {
  //   alert('jQuery is working');
  // } else {
    //   alert('Doesn\'t work')
    // }
    
$(document).ready(function() {

  var path = window.location.pathname;
  var pageId = path.substring(52);

  $('#' + pageId).addClass('active');

});
