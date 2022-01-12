function delete_user(id){
    if(confirm("Are you sure you want to delete this account?")===true) {
        $("#messageBox").load("php/delete-user.php", {
            id: id,
        });
    }
    $("#admin-box").load("php/admin-area.php", {});
}