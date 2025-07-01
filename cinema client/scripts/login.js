document.querySelector(".login-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const email = document.querySelector('input[name="email"]').value;
  const password = document.querySelector('input[name="password"]').value;

  axios.get("http://localhost/Cinema---Project/cinema%20server/Controllers/AuthenticationController.php", {
    params: {
      email: email,
      password: password
    }
  })
  .then(function (response) { 
    const data = response.data;
    if (data.user) {
      const userId = data.user.id;
      localStorage.setItem("user_id", userId); 
      window.location.href = `profile.html`;
    } else {
      alert(data.message || "Login failed");
    }
  })
  .catch(function (error) {
    console.error(error);
    alert("An error occurred during login.");
  });
});



  