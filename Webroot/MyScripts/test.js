function msg() {

    alert('lol');
}



function openEdit(str) {
    //alert('txtHint'+str);
    if (str.length == 0) {
        document.getElementById("txtHint"+str).innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint"+str).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "http://testlinkshare.com/link/edit/" + str, true);
        xmlhttp.send();
    }
    
}


function editLink(str) {

    var title = document.getElementById('title').value;
    var text = document.getElementById('text').value;
    var link = document.getElementById('link').value;
    var check = document.getElementById('check').value;
    var dataString = 'edit=1&title='+title+'&description='+text+'&link='+link+'&private='+check;

    //alert(title+' '+text+' '+link+' '+check);


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://testlinkshare.com/link/edit/" + str, false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == XMLHttpRequest.DONE && xmlhttp.status == 200) {
            document.getElementById("txtHint"+str).innerHTML = this.responseText;
        }
    };


    xmlhttp.send(dataString);

    alert(dataString);



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