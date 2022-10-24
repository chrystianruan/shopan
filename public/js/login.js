
function showPassword() {
    var lock = document.getElementById('lock');
    var password = document.getElementById('password');
    
        if(password.getAttribute('type') == 'password') {
            password.setAttribute('type', 'text');
            lock.setAttribute('class', 'fas fa-lock-open');
        } else {
            password.setAttribute('type', 'password');
            lock.setAttribute('class', 'fas fa-lock');
        }

}
