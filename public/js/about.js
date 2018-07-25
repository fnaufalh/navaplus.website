$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/about',
    dataType: 'json',
    success: function(data){
      var data = data['data'];
      $('.quotes > p').html(data.description);
      $('.vision-mission > div > p').html(data.vision);
      $('.vision-mission > div > p:last-child').html(data.mission);
      $('.section-image').css('background-image', 'url('+ data.image_link +')');
    }
  });
});

$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: 'https://www.aashari.id/form-asia/navaplus/cms/public/api/people?agency_id=9&order_type=asc',
    dataType: 'json',
    success: function(data){
      var data = data;
      if (data.length != 0 ) {
        for (var i = 0; i < data.length; i++) {
          $('.bod').find('.row').append('<div class="col-sm-12 col-md-9 about-item d-flex"><img class="img-responsive" src="'+ data[i].image_link +'" alt="Profile"><div class="description"><h5>'+ data[i].name +'</h5><h6>'+ data[i].department +'</h6><div class="email-holder"><div class="email"><span class="email-icon align-middle"><i class="fa fa-envelope-square fa-1x"></i></span><a href="mail:'+ data[i].email +'"><span class="align-middle" style="padding-left:5px;">'+ data[i].email +'</span></a></div></div><p>'+ data[i].description +'</p></div></div>');
        }
      }
      console.log(data);
    }
  });
});
