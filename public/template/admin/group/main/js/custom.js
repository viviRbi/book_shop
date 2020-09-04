
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

$.get('/book_shop/index.php?module=admin&controller=group&action=save', function(data){
    console.log(data);
},'json')

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
    $('#selectGroupACP').change(function(){
        $('#adminForm').submit();
    })
    $('#selectStatus').change(function(){
        $('#adminForm').submit();
    })
})

function submitForm(link){
    $('#adminForm').attr('action',link);
    $('#adminForm').submit();
}

function alphabetOrder(objectHTML,column,order){
    $('input[name=filter_column]').val(column);
    $('input[name=filter_column_dir]').val(order);
    $('#adminForm').submit();
}



