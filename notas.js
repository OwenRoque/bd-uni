const isEmpty = (str) => str.trim() === '';

function acceder(){
    /*
    var contenido = document.getElementById("mensaje");
    if (window.XMLHttpRequest){
        ajax = new XMLHttpRequest;
    } else {
        ajax = new ActiveXObject("Microsoft.XMLHTTP");
    }

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200){
            if (ajax.responseText.trim() == "OK"){
                window.location.href = "dashboard.php";
            }
        }
    }
    let x = document.getElementById("notas_php").serialize();
    ajax.open("POST", "guardar_notas.php");
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("usuario="+usuaVal+"&clave="+claveVal);
    
    

    let xhr = new XMLHttpRequest();
    let data = document.getElementById("notas_php");  //registro= id del formulario
    let form = new FormData(data);

    xhr.open('POST',"guardar_notas.php");
    xhr.onload;
    xhr.send(form);
    alert("NOTAS REGISTRADAS CORRECTAMENTE");
    */
    


    $.ajax({
        type: 'POST',
        url: 'guardar_notas.php',
        data: $('#notas_php').serialize(),
        success: function(data) {
            const d = JSON.parse(data);
            swal({
                title: d.title,
                text: d.msg,
                type: d.icon
            }).then(function(){ 
                location.reload();
            });
        }  
    });

};
function asignar(){
    btnAcceder = document.getElementById('guardar_notas');
    btnAcceder.addEventListener("click",acceder);
};

window.addEventListener("load",asignar);
