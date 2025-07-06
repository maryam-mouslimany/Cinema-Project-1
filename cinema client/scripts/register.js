document.querySelector(".signup-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;
    const phone = document.querySelector('input[name="phone"]').value;
    const first_name = document.querySelector('input[name="first_name"]').value;
    const last_name = document.querySelector('input[name="last_name"]').value;
    const birth_date = document.querySelector('input[name="birth_date"]').value;

    axios.post("http://localhost/Cinema-Project-1/cinema-server/register", {

        email: email,
        password: password,
        first_name: first_name,
        last_name: last_name,
        birth_date: birth_date,
        phone: phone,
    }).then(function (response) {
        if (response.data.success) {
            window.location.href = "login.html";
        } else {
            alert(response.data.message);
        }
    });

});