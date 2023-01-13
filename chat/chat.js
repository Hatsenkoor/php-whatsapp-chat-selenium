$(function() {
    $('#makeEditable').SetEditable({ $addButton: $('#but_add')});

    $('#submit_data').on('click',function() {
        var td = TableToCSV('makeEditable', ',');
        var ar_lines = td.split("\n");
        var each_data_value = [];
        for(i=0;i<ar_lines.length;i++)
        {
            each_data_value[i] = ar_lines[i].split(",");
        }

        if(each_data_value.length > 0)
        {
            sendMessage(each_data_value);
        }
    });
});

function sendMessage(data)
{
    $.post('./chat.php', {data: JSON.stringify(data)}, function(data){

    });
}