$(document).ready(function() {
  var nicedata;
    $.ajax({
      method: "GET",
      url: "https://api.github.com/users/{{$name}}",
      success: function(data){
        $('body').append('foto : <img src="'+data.avatar_url+'"><br><br>');
        $('body').append('nama : '+data.name+'<br><br>');
        $('body').append('nick : '+data.login+'<br><br>');
        $('body').append('bio : '+data.bio+'<br><br>');
    }
  });
});
