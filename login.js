function toggleForm(a) {
    if (a == 'login') {
        document.getElementById('login').classList.add('active')
        document.getElementById('register').classList.remove('active')
    }
    else {
        document.getElementById('register').classList.add('active')
        document.getElementById('login').classList.remove('active')
    }
}

function checki(){
    if(document.getElementById('pass1').value != document.getElementById('pass2').value){
        alert("check password")
        return false;
    }
    return true;
     
}