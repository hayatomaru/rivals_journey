'use strict'

{
  var name;
  var leader;
  var type;
  var url;

$("#registration").on('click',function(){
  name = $('#deck_name').val();
  leader = $('#deck_leader').val();
  type = $('#deck_type').val();
  url = $('#deck_url').val();

  if(name === "" || leader === "" || type === "" || url === ""){
    $("error").text("エラー：データを入力してください！");
    return

  }else{
  $.post({
    url:"../_Ajax.php",
    data:{
      'name':name,
      'leader':leader,
      'type':type,
      'url':url,
      'mode':'reg'
    },
    dataType:'json',
    // mode:'reg',
  }).done(function(data){
    $("#deck_name").val("");
    $('#deck_url').val("");
    alert("登録完了しました。")
  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
    console.log('失敗');
    // console.log(data);
    console.log("XMLHttpRequest : " + XMLHttpRequest.status);
    console.log("textStatus     : " + textStatus);
    console.log("errorThrown    : " + errorThrown.message);
  });
}
});

}

// var $div = $('#decklist_template').clone();
// $div
//   .attr('id',"hello")
//   .find('h4').text(data.name);
// $div.find('.TitleLeader').text("リーダー:"+data.leader);
// $div.find('.TitleType').text("タイプ:"+data.type);
// $div.find('.jump_dack_page').attr('href',data.url);
// $div.find('.delate_deck_data').attr('href','deck_data/index.php?deckName=' + data.name);
//   // .find('#TitleType').text('タイプ；' + data.type);
// $("#deck_list").append($div);
// $('#deck_name').val('');
// $('#deck_url').val('');
