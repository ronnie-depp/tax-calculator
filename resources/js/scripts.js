// Custom JavaScript code can be added here

$(document).ready(function () {
    console.log("script loaded");

    document.getElementById('login-btn').addEventListener('click', function() {
        document.getElementById('login-form').classList.remove('d-none');
        document.getElementById('register-form').classList.add('d-none');
        this.classList.add('active');
        document.getElementById('register-btn').classList.remove('active');
    });
    
    document.getElementById('register-btn').addEventListener('click', function() {
        document.getElementById('register-form').classList.remove('d-none');
        document.getElementById('login-form').classList.add('d-none');
        this.classList.add('active');
        document.getElementById('login-btn').classList.remove('active');
    });

});
