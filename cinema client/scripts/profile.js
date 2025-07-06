const userId = localStorage.getItem("user_id");

if (!userId) {
  alert("Missing user ID in URL. Cannot load profile.");

} else {

  axios.get(`http://localhost/Cinema-Project-1/cinema-server/profile?`, {
    params: { id: userId }
  }).then(response => {
    if (response.data.success) {
      const user = response.data.user;
      const genres = response.data.genres.map(genre => genre.name).join(", ");

      document.getElementById("first_name").innerText = user.first_name;
      document.getElementById("last_name").innerText = user.last_name;
      document.getElementById("birth_date").innerText = user.birth_date;
      document.getElementById("email").innerText = user.email;
      document.getElementById("password").innerText = "••••••••••";
      document.getElementById("phone").innerText = user.phone;
      document.getElementById("communication_preference").innerText = user.communication_preference;
      document.getElementById("genres").innerText = genres;
      document.getElementById("payment_method").innerText = user.payment_method;

      document.querySelector(".user-name").innerText = `${user.first_name} ${user.last_name}`;
    } else {
      alert("Error: " + response.data.error);
    }
  })
    .catch(error => {
      console.error(error);
      alert("Error loading profile.");
    });
}


