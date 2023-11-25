
function SearchTarget() {
    const formData = new FormData(document.getElementById("SearchForm"));

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                //window.alert("Өгөгдөл амжилттай илгээгдлээ: " + this.responseText);
                document.querySelector('#result').innerHTML = this.responseText;
            } else {
                window.alert("Алдаа: " + this.statusText);
            }
        }
    };

    xhttp.open("POST", "searchdata.php", true);
    xhttp.send(formData);
}
