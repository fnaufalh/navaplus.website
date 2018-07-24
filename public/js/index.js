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

$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/agency?order_type=asc&order_by=id',
    dataType: 'json',
    success: function(data){
      var data = data;
      if (data.length != 0 ) {
        for (var i = 0; i < data.length; i++) {
          if(i == 0){
              var plus = '<div class="bar-white-vertical"></div><div class="bar-white-horizontal"></div>';
          }
          else if(i == 1){
              var plus = '<div class="bar-white-vertical left"></div><div class="bar-white-horizontal left"></div><div class="bar-white-vertical"></div><div class="bar-white-horizontal"></div>';
          }
          else if(i == 2){
              var plus = '<div class="bar-white-vertical left"></div><div class="bar-white-horizontal left"></div><div class="bar-white-vertical"></div><div class="bar-white-horizontal"></div>';
          }
          else if(i == 3){
              var plus = '<div class="bar-white-vertical left"></div><div class="bar-white-horizontal left"></div>';
          }
          else if(i == 4){
              var plus = '<div class="bar-white-vertical top"></div><div class="bar-white-horizontal top"></div>';
          }
          else if(i == 5){
              var plus = '<div class="bar-white-vertical left top"></div><div class="bar-white-horizontal left top"></div><div class="bar-white-vertical top"></div><div class="bar-white-horizontal top"></div>';
          }
          else if(i == 6){
            var plus = '<div class="bar-white-vertical left top"></div><div class="bar-white-horizontal left top"></div><div class="bar-white-vertical top"></div><div class="bar-white-horizontal top"></div>';
          }
          else if (i == 7) {
            var plus = '<div class="bar-white-vertical left top"></div><div class="bar-white-horizontal left top"></div>';
          }

          $('.site-holder').find('.display-flex').append('<a href="agency/'+ data[i].id +'" class="site-item" style="background-color: '+ data[i].background_color +'"><div class="hover-holder display-flex"><div>'+ data[i].motto +'</div><div><img src="images/right-arrow.png" alt="'+ data[i].name +'"></div></div><div class="site-name">'+ data[i].name +'</div><div class="site-logo" style="right: 0;"><img src="'+ data[i].icon_link +'" style="left: auto;" alt=""></div><div class="site-description">'+ data[i].motto +
          '</div>'
          + plus +'</a>');
        }
      }
      console.log(data);
    }
  });
});
