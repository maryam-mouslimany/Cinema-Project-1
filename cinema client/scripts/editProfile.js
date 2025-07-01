document.addEventListener("DOMContentLoaded", function () {
  const id = localStorage.getItem("user_id");

  axios.get(`http://localhost/Cinema---Project/cinema%20server/Controllers/UserController.php?id=${id}`)
    .then(response => {
        
      const user = response.data.user;
      if (user) {
        document.querySelector('input[name="email"]').value = user.email;
        document.querySelector('input[name="first_name"]').value = user.first_name;
        document.querySelector('input[name="last_name"]').value = user.last_name;
        document.querySelector('input[name="birth_date"]').value = user.birth_date;
        document.querySelector('input[name="phone"]').value = user.phone || '';
        document.querySelector('select[name="communication_preference"]').value = user.communication_preference || "";
        document.querySelector('select[name="payment_method"]').value = user.payment_method || "";
        document.querySelector('input[name="password"]').value = '';

      } else {
        alert("User not found.");
      }
    })
    .catch(error => {
      console.error("Error fetching user data:", error);
      alert("Failed to load profile data.");
    });
});

document.querySelector(".update-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const id = localStorage.getItem("user_id");

  axios.post("http://localhost/Cinema---Project/cinema%20server/Controllers/UpdateController.php", {
    id: id,
    email: document.querySelector('input[name="email"]').value,
    password: document.querySelector('input[name="password"]').value,
    first_name: document.querySelector('input[name="first_name"]').value,
    last_name: document.querySelector('input[name="last_name"]').value,
    birth_date: document.querySelector('input[name="birth_date"]').value,
    phone: document.querySelector('input[name="phone"]').value,
    communication_preference: document.querySelector('select[name="communication_preference"]').value,
    payment_method: document.querySelector('select[name="payment_method"]').value
  })
  .then(function (response) {
     console.log(response.data); 
    alert(response.data.message);
  })
  .catch(function (error) {
    console.error(error);
    alert("Something went wrong.");
  });
});