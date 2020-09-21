function openForm(id) {
    document.getElementById("myForm"+id).style.display = "block";
}

function closeForm(id) {
    document.getElementById("myForm"+id).style.display = "none";
}
function taskStatus(id){
    var status = $('input[name="status"'+id+']').is(":checked") ? 'done' : 'undone';
    $.ajax( {
        type: 'POST',
        url: 'index.php?r=Main&action=update',
        data: 'status='+status,

        success: function(data) {
            $('#task_form').attr('status',);
        }
        
    } );
}



