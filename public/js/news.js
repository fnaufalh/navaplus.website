$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/news?order_by=id&order_type=desc',
    dataType: 'json',
    success: function(data){
        var data = data;
        if (data.length != 0 ) {
            for (var i = 0; i < data.length; i++) {
                $('#whats-going-on').find('.section-content').append('');
            }
        }
    }
  });
});
