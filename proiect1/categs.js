function selectCategory(){ //dupa ce e selectat un elem e apelata functia
    var x= document.getElementById("produs").value; //stocam valoarea obiectului selectat in variabila x

    $.ajax({
        url:"showCategory.php",
        method:"POST",
        data:{
            id:x
        },
        success:function (data){
            $("#ans").html(data);
        }
    })
}