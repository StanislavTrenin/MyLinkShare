
function collapseElement(name, id) {

   const x = document.getElementById(name+id);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

$('button').click(function(){
    let isHidden = false
    if ( $(this).next().css('display') == 'none' || $($(this).next()).css("visibility") == "hidden"){
        isHidden = true;
    }
    $('.hidden').hide('slow');
    if(isHidden){

        $(this).next().toggle('slow');
    }

});

$("input").click(function(e){

    if(e.target.name == 'edit_confirm') {
        const id = e.target.id;
        const number = id.replace('submit', '');
        let arguments = $('#form' + number).serialize() + '&edit=1';

        if(!($("#check"+number+":checked").length > 0)){
            arguments += '&private=off';
        }

        let x = $('#form' + number).serializeArray();
        /*$.each(x, function(i, field) {

            alert(field.name+":"+field.value);
        });
        alert(x[0]);*/
        $.ajax({
            type: 'POST',
            //dataType: "json",
            url: 'http://testlinkshare.com/link/edit/'+number+'/',
            data: arguments,
            success: function() {

            }
        });



        $('#title'+number).text(x[0].value);
        $('#description'+number).text(x[1].value);
        $('#link'+number).text(x[2].value);

        $('#hidden'+number).toggle('slow');
    }
});



function getCheckboxValue(inputElements) {
    let check;
    for(var i=0; inputElements[i]; ++i){
        if(inputElements[i].checked){
            check = inputElements[i].value;
            break;
        }
    }

    if(check == null)
    {
        return 0;
    } else {
        return 1;
    }


}

function sendAjax(url, data, id) {
    if (id.length = 0){
        document.getElementById(id).innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", url, false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == XMLHttpRequest.DONE && xmlhttp.status == 200) {

                    document.getElementById(id).innerHTML = this.responseText;

            }
        };


        xmlhttp.send(data);
    }
}

function editLink(str) {

    const title = document.getElementById('title'+str).value;
    const text = document.getElementById('text'+str).value;
    const link = document.getElementById('link'+str).value;

    const inputElements = document.getElementsByClassName('form-check-input'+str);
    const check = getCheckboxValue(inputElements);

    const dataString = 'edit=1&title='+title+'&description='+text+'&link='+link+'&private='+check;



    sendAjax('http://testlinkshare.com/link/edit/' + str, dataString, 'txtHint'+str);

    //sendAjax(document.URL, '', 'total');

    //alert('lol');

}




/*$('#submit').click(function(){

    alert('submitting');
    $('#formfield').submit();
});

function ShowModal(id)
{
    //var modal = document.getElementById(id);
    modal.style.display = "block";
}

var error = document.getElementById('error');

if (error) {
    // Please don't use native dialogs though!
    alert(error.textConent)
}

<IfModule mod_rewrite.c>
    Options +FollowSymLinks
    RewriteEngine On

    RewriteCond %{REQUEST_URI} !-f
    RewriteCond %{REQUEST_URI} !-d
    RewriteCond %{REQUEST_URI} !-l
    RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}*/