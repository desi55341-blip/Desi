<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Pengguna</title>
    <link rel="stylesheet" href="assets/style.css?v=1.0">
</head>
<body>

    <h2>Form Registrasi</h2>

    <form id="registerForm" action="backend/register_process.php" method="POST">
        <label for="nama">Nama:</label>
        <input id="nama" type="text" name="nama" required>

        <label for="email">Email:</label>
        <input id="email" type="email" name="email" required>
        <div id="email-status" style="font-size:0.9em;margin-top:6px;height:18px;color:#b91c1c;"></div>

        <label for="password">Password:</label>
        <input id="password" type="password" name="password" required>

        <label for="alamat">Alamat:</label>
        <input id="alamat" type="text" name="alamat" required>

        <label for="telepon">No Telepon:</label>
        <input id="telepon" type="text" name="telepon" required>

        <button id="submitBtn" type="submit">Daftar</button>
    </form>

    <div style="text-align:center;margin-top:14px;">
        <a class="link-small" href="index.php">Kembali ke Halaman Utama</a>
    </div>

</body>
<script>
// Debounce helper
function debounce(fn, delay){
    let t;
    return function(...args){
        clearTimeout(t);
        t = setTimeout(()=>fn.apply(this,args), delay);
    }
}

const emailInput = document.getElementById('email');
const emailStatus = document.getElementById('email-status');
const submitBtn = document.getElementById('submitBtn');
// username removed per request

function setStatus(text, ok){
    // generic: accept either emailStatus or usernameStatus as target by passing element
}

function setFieldStatus(el, text, ok){
    el.textContent = text;
    if(ok){
        el.style.color = '#065f46'; // green
        submitBtn.disabled = false;
    } else {
        el.style.color = '#b91c1c'; // red
        submitBtn.disabled = true;
    }
}

async function checkEmailAvailability(){
    const email = emailInput.value.trim();
    if(!email){
        emailStatus.textContent = '';
        submitBtn.disabled = false;
        return;
    }
    try{
        const form = new FormData();
        form.append('email', email);
        const res = await fetch('backend/check_email.php', {
            method: 'POST',
            body: form
        });
        const data = await res.json();
        if(data && data.available){
            setFieldStatus(emailStatus, 'Email tersedia', true);
        } else {
            if(data && data.error){
                setFieldStatus(emailStatus, data.error, false);
            } else {
                setFieldStatus(emailStatus, 'Email sudah digunakan', false);
            }
        }
    } catch(err){
        // Jika jaringan/error, jangan langsung memblokir submit, tampilkan pesan
        console.error(err);
        setStatus('Gagal memeriksa email', false);
    }
}

const debouncedCheck = debounce(checkEmailAvailability, 450);
emailInput.addEventListener('input', debouncedCheck);

// username-related checks removed

// optional: prevent form submit if disabled
document.getElementById('registerForm').addEventListener('submit', function(e){
    if(submitBtn.disabled){
        e.preventDefault();
    }
});
</script>
</html>