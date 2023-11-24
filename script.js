function addStudent() {
    const formData = new FormData(document.getElementById("studentForm"));

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // window.alert("Өгөгдөл амжилттай илгээгдлээ: " + this.responseText);
                document.querySelector('#result').innerHTML = this.responseText;
            } else {
                window.alert("Алдаа: " + this.statusText);
            }
        }
    };

    xhttp.open("POST", "student.php", true);
    xhttp.send(formData);
}

function addLibraryVisit() {
    const formData = new FormData(document.getElementById("visitForm"));

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // window.alert("Өгөгдөл амжилттай илгээгдлээ: " + this.responseText);
                document.querySelector('#result').innerHTML = this.responseText;
            } else {
                window.alert("Алдаа: " + this.statusText);
            }
        }
    };

    xhttp.open("POST", "visit.php", true);
    xhttp.send(formData);
}

function showStudentHours() {
    
    const formData = new FormData(document.getElementById("hoursForm"));

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                //window.alert("Өгөгдөл амжилттай илгээгдлээ: " + this.responseText);
                document.querySelector("#result").innerHTML = this.responseText;
            } else {
                window.alert("Error: " + this.statusText);
            }
        }
    };

    xhttp.open("POST", "join_student_visit.php", true);
    xhttp.send(formData);
}
