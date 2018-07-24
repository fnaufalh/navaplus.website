$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: 'https://www.aashari.id/form-asia/navaplus-new/navaplus/public/api/about',
    dataType: 'json',
    success: function(data){
      alert(data.vision)
    }
  })
});
