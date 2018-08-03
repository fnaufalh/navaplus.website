@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.css">
  <input type="text" name="" id="txt_category">
  <input type="text" name="" id="txt_category_id">
  <label for="" id="category_message"></label>
@endsection
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.js">

</script>
  <script type="text/javascript">
  $(document).ready(function(){

  });

  var autocompleteConfig = function () {

      var typingTimer;
      var doneTypingInterval = 1000;


      /*Category Autocomplete - Start*/
      // On keyup, start the countdown
      function keyup_category() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchCategoryName, doneTypingInterval);
      }

      // On keydown, clear the countdown
      function keydown_category() {
        clearTimeout(typingTimer);
      }

      $('#txt_category').on('keyup', searchCategoryName);
      $('#txt_category').on('keydown', keydown_category);

      function searchCategoryName() {

          var input = $("#txt_category");
          var inputHidden = $("#txt_category_id");
          var message = $("#category_message");
          var keyword = input.val();

          // If there's no keyword
          if (keyword === "") {
              input.val("");
              inputHidden.val("");
              message.html("");
              message.addClass("text-rose");

              return;
          }

          // Prevent run ajax when category choosed
          if (input.val().split(">").length > 1) {
              return;
          }

          $.ajax({
              type: "GET",
              url: URL_ROOT + "/api/agency/" + keyword,
              dataType: "JSON",
              beforeSend: function () {
                  message.addClass("text-rose");
                  message.html("Loading");
              },
              success: function (data) {

                  if (data['status'] == "Success") {
                      var categories = data['result'];
                      var category_list = [];

                      categories.forEach(category => {
                          var object = {};
                          object.label = category.name;
                          object.value = category.name;
                          object.id = category.id;

                          category_list.push(object);
                      });

                      // Show infromation message if catalog list not shown
                      message.addClass("text-rose");
                      message.html("Press down key if there's no category");

                      input.autocomplete({
                          source: category_list,
                          autoFocus: true,
                          focus:true,
                          select: function (event, ui) {
                              input.val(ui.item.label);
                              inputHidden.val(ui.item.catCode);

                              message.removeClass("text-rose");
                              message.html("Category choosed");
                              return false;
                          }
                      });
                      console.log(category_list);
                  }
                  else if (data['status'] == "Failed") {
                      inputHidden.val("");
                      message.addClass("text-rose");
                      message.html(data['message']);
                  }
              }
          });
      }

      /*Category Autocomplete - End*/

  }
  </script>
@endsection
