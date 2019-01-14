function msg(){
    alert("Hello world from JS!!!");
}

function openEdit(str) {
    //alert("Lets change "+id +"'st link!");
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "http://testlinkshare.com/link/edit/" + str, true);
        xmlhttp.send();
    }
    
}


function editLink(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "http://testlinkshare.com/link/edit/" + str, true);
        xmlhttp.send();
    }




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