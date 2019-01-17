
function openEdit(str) {

    var x = document.getElementById("myDIV"+str);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}


function getCheckboxValue(inputElements) {
    var check;
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
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", url, false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == XMLHttpRequest.DONE && xmlhttp.status == 200) {
            document.getElementById(id).innerHTML = this.responseText;
        }
    };


    xmlhttp.send(data);

}

function editLink(str) {

    var check;
    var title = document.getElementById('title'+str).value;
    var text = document.getElementById('text'+str).value;
    var link = document.getElementById('link'+str).value;

    var inputElements = document.getElementsByClassName('form-check-input'+str);
    check = getCheckboxValue(inputElements);

    var dataString = 'edit=1&title='+title+'&description='+text+'&link='+link+'&private='+check;



    sendAjax('http://testlinkshare.com/link/edit/' + str, dataString, 'txtHint'+str);

    sendAjax(document.URL, null, 'total');

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