function user_options(id){
    $("#userOptions").load("php/user-options.php", {
        id: id,
    });
}