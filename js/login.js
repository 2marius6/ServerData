function login(){
    var email=document.getElementById('email').value;
    var pass=document.getElementById('pass').value;
    var dataString;
    dataString='email='+email+'&pass='+pass;
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:"post",
            url:"http://localhost/IP/php/check-account.php",
            data:dataString,
            cache:false,
            success:function(html){
                $('#msj').html(html);
                setTimeout(function() {
                    window.top.location.reload(true);
                }, 3000);
            }
        });
    });
}