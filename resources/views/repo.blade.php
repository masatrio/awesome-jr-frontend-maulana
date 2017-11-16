<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/master.css">
  </head>
  <body>
  <!-- navbar -->
  <nav>
    <div class="logo">
      <img src="img/github.png" alt="logo">
    </div>
    <ul>
      <a href="https://github.com/features"><li class="list-item">Features</li></a>
      <a href="https://github.com/marketplace"><li class="list-item">Marketplace</li></a>
      <a href="https://github.com/pricing"><li class="list-item">Pricing</li></a>
      <a href="https://github.com/explore"><li class="list-item">Explore</li></a>
      <a href="https://github.com/business"><li class="list-item">Business</li></a>
    </ul>
    <div class="right-nav">
        <input id="search" type="text" name="" value="" placeholder="Search Github">
        <ul >
          <a href="#"><li class="right-list-item">Sign In</li></a>
          <span class="right-list-item">/</span>
          <a href="#"><li class="right-list-item">Sign Up</li></a>
        </ul>
    </div>
  </nav>
  <div class="clear"></div>
  <!-- end of navbar -->
  <div class="mycontainer">
    <div class="col-md-3" id="left-container">
      <div class="photo" id="avatar">
      </div>
      <div class="namecard" id="namecard">
        <h1></h1>
        <span class="nickname" id="nickname"></span>
      </div>
      <div class="listku" id="bio">
        <p align="justify"></p>
      </div>
      <div class="listku" id="bio">
        <button type="button" id="followbtn"class="btn btn-primary">Follow</button>
      </div>
      <div class="listku" id="company">
      </div>
      <div class="listku" id="location">
      </div>
      <div class="listku" id="email">
        <svg aria-hidden="true" class="octicon octicon-mail" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M0 4v8c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H1c-.55 0-1 .45-1 1zm13 0L7 9 1 4h12zM1 5.5l4 3-4 3v-6zM2 12l3.5-3L7 10.5 8.5 9l3.5 3H2zm11-.5l-4-3 4-3v6z"/></svg>
      </div>
      <div class="listku" id="blog">
      </div>
    </div>


    <div class="col-md-9">
        <ul id="viewmenu">
          <a class="viewmenulist" id="overviewlink"><li class="viewmenulist">Overview</li></a>
          <a class="viewmenulist" id="repolink"><li class="viewmenulist">Repositories <span class="badge" id="numrepos"></span></li></a>
          <a class="viewmenulist" id="starlink"><li class="viewmenulist">Stars <span class="badge" id="numstars">10</span></li></a>
          <a class="viewmenulist" id="followerlink"><li class="viewmenulist">Followers <span class="badge" id="numfollowers"></span></li></a>
          <a class="viewmenulist" id="followinglink"><li class="viewmenulist">Following <span class="badge" id="numfollowings"></span></li></a>
        </ul>
        <div id="repo">
        </div>
    </div>


  </div>
  </body>
  <script>
  $(document).ready(function() {
    var nicedata;
      $.ajax({
        method: "GET",
        url: "https://api.github.com/users/{{$name}}",
        success: function(data){
          $('#avatar').append('<img class="img-round" src="'+data.avatar_url+'">');
          $('#namecard h1').append(data.name);
          $('#nickname').append(data.login);
          $('#bio p').append(data.bio);
          if(data.commpany!='null'){
            $('#company').append('<svg aria-hidden="true" class="octicon octicon-organization" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M16 12.999c0 .439-.45 1-1 1H7.995c-.539 0-.994-.447-.995-.999H1c-.54 0-1-.561-1-1 0-2.634 3-4 3-4s.229-.409 0-1c-.841-.621-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.442.58 2.5 3c.058 2.41-.159 2.379-1 3-.229.59 0 1 0 1s1.549.711 2.42 2.088C9.196 9.369 10 8.999 10 8.999s.229-.409 0-1c-.841-.62-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.437.581 2.495 3c.059 2.41-.158 2.38-1 3-.229.59 0 1 0 1s3.005 1.366 3.005 4"/></svg><a href="https://github.com/'+data.company.replace(/[!@#$%^&*]/g, "").toLowerCase()+'"><span  class="spanlist">'+data.company+'</span></a>');
          }
          if(data.location!=null){
            $('#location').append('<svg aria-hidden="true" class="octicon octicon-location" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M6 0C2.69 0 0 2.5 0 5.5 0 10.02 6 16 6 16s6-5.98 6-10.5C12 2.5 9.31 0 6 0zm0 14.55C4.14 12.52 1 8.44 1 5.5 1 3.02 3.25 1 6 1c1.34 0 2.61.48 3.56 1.36.92.86 1.44 1.97 1.44 3.14 0 2.94-3.14 7.02-5 9.05zM8 5.5c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg><span class="spanlist">'+data.location+'</span>');
          }
          if(data.email==null){
            $('#email').append('<a href="https://github.com/login"><span class="spanlist">Sign in to view email</span></a>');
          }else{
            $('#email').append('<span class="spanlist">'+data.email+'</span>');
          }
          if(data.blog!=null){
            $('#blog').append('<svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"/></svg><a href="'+data.blog+'"><span class="spanlist">'+data.blog+'</span></a>');
          }
          $('#numrepos').html(data.public_repos);
          $('#numfollowers').html(data.followers);
          $('#numfollowings').html(data.following);
          $('#overviewlink').attr('href', data.html_url);
          $('#repolink').attr('href', data.html_url+'?tab=repositories');
          $('#starlink').attr('href', data.html_url+'?tab=stars');
          $('#followerlink').attr('href', data.html_url+'?tab=followers');
          $('#followinglink').attr('href', data.html_url+'?tab=following');
      }
    });
    $.ajax({
      method: "GET",
      url: "https://api.github.com/users/{{$name}}/repos",
      data: {sort : 'updated'},
      success: function(data){
        var loop = 1;
        $.each(data, function(i, item) {
          console.log(item);
          if(item.description==null){ // next jika repo tidak memiliki deskripsi
            return;
          }
          $('#repo').append('<div class="col-md-6"><div class="card-body"><a href="'+item.html_url+'"><h4 class="card-title">'+item.name+'</h4></a><p class="card-text">'+item.description+'</p><div id="atribut_'+loop+'"><div class="kategori"></div><span class="bahasa">'+item.language+'</span></div></div></div>');
          if(item.stargazers_count>0){
            $('#atribut_'+loop).append('<a href="'+item.html_url+'/stargazers"><svg aria-label="stars" style="fill:#586069" class="octicon octicon-star" height="16" role="img" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"/></svg><span id="starcount">'+item.stargazers_count+'</span></a>');
          }
          if(loop==2||loop==4){
            $('#repo').append('<div class="clear"></div>');
          }
          loop = loop + 1;
          if(loop==5){
            return false;
          }
        });
      }
    });
  });
  </script>
</html>
