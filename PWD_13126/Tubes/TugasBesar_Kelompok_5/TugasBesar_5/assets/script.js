function validateRegister() {
    let nama = document.getElementById("nama");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let confirm = document.getElementById("confirm_password");

    if (nama.value.trim() === "") {
        alert("Nama harus diisi!");
        nama.focus();
        return false;
    }

    if (email.value.trim() === "") {
        alert("Email harus diisi!");
        email.focus();
        return false;
    }

    if (password.value.length < 6) {
        alert("Password minimal 6 karakter!");
        password.focus();
        return false;
    }

    if (password.value !== confirm.value) {
        alert("Password dan Konfirmasi Password tidak sama!");
        confirm.focus();
        return false;
    }

    return true;
}




function validateLogin() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    if (email.value.trim() === "") {
        alert("Email tidak boleh kosong!");
        email.focus();
        return false;
    }

    if (password.value.trim() === "") {
        alert("Password tidak boleh kosong!");
        password.focus();
        return false;
    }

    return true;
}




function confirmDelete(url) {
    let yakin = confirm("Yakin ingin menghapus data dokter ini?");
    if (yakin) {
        window.location = url;
    }
}




let inputs = document.querySelectorAll("input");

inputs.forEach(input => {
    input.addEventListener("focus", function() {
        this.style.borderColor = "#005bbf";
        this.style.boxShadow = "0 0 6px rgba(0, 91, 191, 0.5)";
    });

    input.addEventListener("blur", function() {
        this.style.borderColor = "#b9d3ff";
        this.style.boxShadow = "none";
    });
});