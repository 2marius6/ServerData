function change_pass_user(){
    var currPass=document.getElementById('oldPass').value;
    var newPass=document.getElementById('newPass').value;
    var newPassConf=document.getElementById('newPassConf').value;
    var dataString;
    dataString='currPass='+currPass+'&newPass='+newPass+'&newPassConf='+newPassConf;
    $('#passChange').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"post",
            url:"http://localhost/IP/php/change-pass.php",
            data:dataString,
            cache:false,
            success:function(html){
                $('#passMsj').html(html);
            }
        });
    });
}