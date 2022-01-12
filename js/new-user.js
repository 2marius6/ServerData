function new_user(){
    var email=document.getElementById('email').value;
    var name=document.getElementById('name').value;
    var pass=document.getElementById('pass').value;
    var dataString;
    dataString='email='+email+'&name='+name+'&pass='+pass;
    $('#registerUser').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"post",
            url:"http://localhost/IP/php/new-user.php",
            data:dataString,
            cache:false,
            success:function(html){
                $('#messageBox').html(html);
            }
        });
    });
}