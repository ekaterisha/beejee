function openAuth() {
    document.getElementById("authForm").style.display = "block";
}

function closeAuth() {
    document.getElementById("authForm").style.display = "none";
}

function openForm(id) {
    document.getElementById("myForm"+id).style.display = "block";
}

function closeForm(id) {
    document.getElementById("myForm"+id).style.display = "none";
}

function taskStatus(id){
    var status = $('input[name="status'+id+'"]').is(":checked") ? 'done' : 'undone';

    $.ajax( {
        type: 'POST',
        url: 'index.php?r=Main&action=update&id='+id,
        data: 'status='+status
    } );
}

$('#auth').submit(function(){
  if($(this).attr('validated')=='false'){
      var login = $('input[name="login"]').val();
      var password = $('input[name="password"]').val();

      $.ajax({
          type: 'POST',
          url: 'index.php?r=Auth&action=check',
          data: 'login='+login+"&password="+password,
          success: function(answer){
              if(answer == 'yes'){
                  $('#auth').attr('validated',"true");
                  $('#auth').submit();
              }
              if(answer == 'no'){
                $('#notice a').text('Неверный пароль');
              }
          }
   });
   return false;
  }
 return true;
});



