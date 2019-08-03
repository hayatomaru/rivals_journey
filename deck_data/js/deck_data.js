'use strict'

{

var win;
var name;
var leader;



function victory(a){
  var winner = Number($('.winner').eq(a).text());
  var loser = Number($('.loser').eq(a).text());
  return Math.round(winner / (winner + loser) * 100);
}

function whole(a){
  console.log("hello");
  var data_winner = Number($('.winner').eq(a).text());
  var data_loser = Number($('.loser').eq(a).text());
  $('.percent').eq(a).text(Math.round(data_winner / (data_winner + data_loser) * 100));
  var winner = 0;
  var loser = 0;
  var leader1 = ["",0];
  var leader2 = ["",100];
  console.log("hello");
  for(let i = 0 ; i < 7 ; i++){
    var w = Number($('.winner').eq(i).text());
    var l = Number($('.loser').eq(i).text());
    winner += w;
    loser += l;
    if(Number($('.percent').eq(i).text())>=leader1[1]){
      leader1[0] = $('.leader_name').eq(i).text();
      leader1[1] = Number($('.percent').eq(i).text());
    }
    if(Number($('.percent').eq(i).text())<=leader2[1]){
      leader2[0] = $('.leader_name').eq(i).text();
      leader2[1] = Number($('.percent').eq(i).text());
    }
  }
  console.log("hello");
  $('#whole_percent').text(Math.round(winner/(winner+loser)*100) + '%');
  $('#whole_victory').text(winner + '勝'　+ loser + '敗')
  $('#strong_leader').text("強い：" + leader1[0]);
  $('#weak_leader').text("弱い：" + leader2[0]);
}

// 勝利のプログラム
$('.win_plus').on('click',function(){
  var clickedIndex = $('.win_plus').index($(this));
  name = $('#deck_naming').text();
  leader = $('.leader_name').eq(clickedIndex).text();
  win = $('.winner').eq(clickedIndex).text();
  $.post({
    url:"js/deck_data_ajax.php",
    data:{
      'name':name,
      'leader':leader,
      'win':win,
      'mode':'w_plus'
    }
  }).done(function(data){
    data.win++;
    $('.winner').eq(clickedIndex).text(data.win);
    whole(clickedIndex);
  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
    console.log('失敗');
    // console.log(data);
    console.log("XMLHttpRequest : " + XMLHttpRequest.status);
    console.log("textStatus     : " + textStatus);
    console.log("errorThrown    : " + errorThrown.message);
  });
});

$('.win_minus').on('click',function(){
  var clickedIndex = $('.win_minus').index($(this));
  name = $('#deck_naming').text();
  leader = $('.leader_name').eq(clickedIndex).text();
  win = $('.winner').eq(clickedIndex).text();
  $.post({
    url:"js/deck_data_ajax.php",
    data:{
      'name':name,
      'leader':leader,
      'win':win,
      'mode':"w_minus"
    }
  }).done(function(data){
    data.win--;
    $('.winner').eq(clickedIndex).text(data.win);
    whole(clickedIndex)
  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
    console.log('失敗');
    // console.log(data);
    console.log("XMLHttpRequest : " + XMLHttpRequest.status);
    console.log("textStatus     : " + textStatus);
    console.log("errorThrown    : " + errorThrown.message);
  });
});

// 敗者のプログラム
$('.lose_plus').on('click',function(){
  var clickedIndex = $('.lose_plus').index($(this));
  name = $('#deck_naming').text();
  leader = $('.leader_name').eq(clickedIndex).text();
  win = $('.loser').eq(clickedIndex).text();
  $.post({
    url:"js/deck_data_ajax.php",
    data:{
      'name':name,
      'leader':leader,
      'win':win,
      'mode':'l_plus'
    }
  }).done(function(data){
    data.win++;
    $('.loser').eq(clickedIndex).text(data.win);
    whole(clickedIndex);
  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
    console.log('失敗');
    // console.log(data);
    console.log("XMLHttpRequest : " + XMLHttpRequest.status);
    console.log("textStatus     : " + textStatus);
    console.log("errorThrown    : " + errorThrown.message);
  });
});

$('.lose_minus').on('click',function(){
  var clickedIndex = $('.lose_minus').index($(this));
  name = $('#deck_naming').text();
  leader = $('.leader_name').eq(clickedIndex).text();
  win = $('.loser').eq(clickedIndex).text();
  $.post({
    url:"js/deck_data_ajax.php",
    data:{
      'name':name,
      'leader':leader,
      'win':win,
      'mode':"l_minus"
    }
  }).done(function(data){
    data.win--;
    $('.loser').eq(clickedIndex).text(data.win);
    whole(clickedIndex);
  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
    console.log('失敗');
    // console.log(data);
    console.log("XMLHttpRequest : " + XMLHttpRequest.status);
    console.log("textStatus     : " + textStatus);
    console.log("errorThrown    : " + errorThrown.message);
  });
});

// リセットのプログラム
$('.reset').on('click',function(){
  var clickedIndex = $('.reset').index($(this));
  name = $('#deck_naming').text();
  leader = $('.leader_name').eq(clickedIndex).text();
  win = $('.loser').eq(clickedIndex).text();
  $.post({
    url:"js/deck_data_ajax.php",
    data:{
      'name':name,
      'leader':leader,
      "win" : win,
      'mode':"reset"
    }
  }).done(function(data){
    console.log("hello");
    $('.winner').eq(clickedIndex).text("0");
    $('.loser').eq(clickedIndex).text("0");
    whole(clickedIndex);
    $(".percent").eq(clickedIndex).text('0')
  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
    console.log('失敗');
    // console.log(data);
    console.log("XMLHttpRequest : " + XMLHttpRequest.status);
    console.log("textStatus     : " + textStatus);
    console.log("errorThrown    : " + errorThrown.message);
  });
});

}
