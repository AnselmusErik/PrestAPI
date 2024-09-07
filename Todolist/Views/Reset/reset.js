document.querySelector('form').addEventListener('submit', function (event) {
    var new_password = document.getElementById('new_password').value;

    if (new_password === '') {
        alert('New Password tidak boleh kosong!');
        event.preventDefault();
    }
});
