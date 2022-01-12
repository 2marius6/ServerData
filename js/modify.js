function user_modify(){
    var currEmail=document.getElementById('oldEmail').value;
    var newEmail=document.getElementById('newEmail').value;
    var newName=document.getElementById('newName').value;
    var dataString;
    dataString='currEmail='+currEmail+'&email='+newEmail+'&name='+newName;
    $('#infoChange').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"post",
            url:"http://localhost/IP/php/modify.php",
            data:dataString,
            cache:false,
            success:function(html){
                $('#modMsj').html(html);
            }
        });
    });
}