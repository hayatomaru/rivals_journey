'use strict'

{

  $(document).ready( function(){
    if (window.name != "test") {
      // alert("reload");
      location.reload();
      window.name = "test";
    } else {
      window.name = "";
    }
  });

  var name;
  var leader;
  var type;
  var url;

  $("#registration").on('click',function(){
    name = $('#deck_name').val();
    leader = $('#deck_leader').val();
    type = $('#deck_type').val();
    url = $('#deck_url').val();
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
      console.log("success");
      re = true;
    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
      console.log('失敗');
      // console.log(data);
      console.log("XMLHttpRequest : " + XMLHttpRequest.status);
      console.log("textStatus     : " + textStatus);
      console.log("errorThrown    : " + errorThrown.message);
    });
  });

  $('.delete').on('click',function(){
    if(!confirm('本当に削除しますか？')){
      /* キャンセルの時の処理 */
      return;
    }else{
      /*　OKの時の処理 */
      console.log("hello")
      $.post({
        url:"../_Ajax.php",
        data:{
          'id':$(this).parent("div").data('id'),
          'name':$(this).data('name'),
          'mode':'del'
        },
        dataType:'json',
      }).done(function(data){
        $("#deck_" + data.id).fadeOut(500);
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
