$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/news?order_by=id&order_type=desc',
    dataType: 'json',
    success: function(data){
      var data = data;
      if (data.length != 0 ) {
        for (var i = 0; i < data.length; i++) {
          $('#whats-going-on').find('.section-content').append('<div class="section-content-item"><div class="image-project" style="background-image:url('+ data[i].image_link +')"><div class="info" style="text-align:left;"><div class="sub-title" style="text-transform:uppercase;">'+ data[i].date_formated +'</div><div class="title"><h5>'+ data[i].name +'</h5></div></div></div></div>');
        }
      }
      console.log(data);
    }
  });
});
