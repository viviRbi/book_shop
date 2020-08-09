
function changeStatus(link){
    // get Link at index.php URL::createLink(module, controller, action, id, status)
    // it will get all info in groupController-> ajaxStatusAction as data
    $.get(link, function(data){
        var element = 'a#status-' + data[0];
        var classRemove, classAdd;
        if(data[1]==1){
            classRemove = 'btn-warning';
            classAdd = 'btn-success';
        }else{
            classRemove = 'btn-success';
            classAdd = 'btn-warning';
        }
        $(element).attr('href', "javascript:changeStatus('"+data[2]+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd)
    },'json')
}

function changeGroupACP(link){
    $.get(link, function(data){
        var element = 'a#group-acp-' + data[0];
        var classRemove, classAdd;
        if(data[1]==1){
            classRemove = 'btn-warning';
            classAdd = 'btn-success';
        }else{
            classRemove = 'btn-success';
            classAdd = 'btn-warning';
        }
        $(element).attr('href', "javascript:changeGroupACP('"+data[2]+"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd)
    },'json')
}

$(document).ready(function(){
    $('input[name=checkall-toggle]').change(function(){
        var checkStatus = this.checked;
        $('#adminForm').find(':checkbox').each(function(){
            this.checked = checkStatus;
        })
    })
})