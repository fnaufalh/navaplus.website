$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/client?order_by=id&order_type=asc&all=n',
    dataType: 'json',
    success: function(data){
      var data = data;
      if (data.length != 0 ) {
        for (var i = 0; i < data.length; i++) {
          $('#our-works').find('.section-content').append('<div class="client-holder"><div class="item"><img src="'+ data[i].image_link +'"></div></div>');
        }
      }
      console.log(data);
    }
  });
});
