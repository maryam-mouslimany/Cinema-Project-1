
function toggleMenu() {
            const navMenu = document.querySelector('.nav-menu');
            navMenu.classList.toggle('active');
        }

const userId = localStorage.getItem("user_id");

if (userId) {
  axios.get(`http://localhost/Cinema---Project/cinema%20server/Controllers/UserController.php?`, {
    params: { id: userId }
  })
  .then(function(response) {
    const data = response.data;

    if (data.user) {
      document.querySelector(".user-name").textContent =
        `${data.user.first_name} ${data.user.last_name}`;
    } else {
      alert(data.error || "User not found");
    }
  })
  .catch(function(error) {
    console.error("Error fetching user data:", error);
    alert("Failed to load user info");
  });
} else {
  alert("Missing user ID in URL");
  window.location.href = "login.html";
}
