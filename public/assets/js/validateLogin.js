document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('form');
    const usernameField = document.querySelector('input[type="text"]');
    const passwordField = document.querySelector('input[type="password"]');
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    form.appendChild(errorMessage);

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const username = usernameField.value.trim();
        const password = passwordField.value.trim();

        errorMessage.textContent = '';

        if (!username || !password) {
            displayError("Username dan Password wajib diisi!");
            return;
        }

        if (username.length < 3) {
            displayError("Username harus terdiri dari minimal 3 karakter.");
            return;
        }

        if (password.length < 6) {
            displayError("Password harus terdiri dari minimal 6 karakter.");
            return;
        }

        if (/\s/.test(username) || /\s/.test(password)) {
            displayError("Username dan Password tidak boleh mengandung spasi.");
            return;
        }

        try {
            const response = await fetch('/presma_pbl/public/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username: username, password: password }),
            });

            const data = await response.json();

            if (response.ok) {
                if (data.success) {
                    alert(data.message);
                    window.location.href = data.redirect_url;
                } else {
                    displayError(data.message || "Username atau Password salah.");
                }
            } else {
                displayError(data.message || "Login gagal, coba lagi.");
            }
        } catch (error) {
            console.error("Error:", error);
            displayError("Terjadi kesalahan pada server, coba lagi nanti.");
        }
    });

    function displayError(message) {
        errorMessage.textContent = message;
        errorMessage.style.color = 'red';
    }
});