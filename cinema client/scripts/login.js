document.querySelector(".login-form").addEventListener("submit", function (e) {
  e.preventDefault();

  /*const base_url = "http://localhost/Cinema-Project-1/cinema%20server/Controllers/";
 
  const api= base_url + "AuthenticationController.php";*/
  const email = document.querySelector('input[name="email"]').value;
  const password = document.querySelector('input[name="password"]').value;
  const api = "http://localhost/Cinema-Project-1/cinema-server/login";
  const params = {
    email: email,
    password: password
  };

  axiosGetCall(api, params).then(function (resp) {
    console.log("API response:", resp);

    if (resp.user) {

      const userId = resp.user.id;
      localStorage.setItem("user_id", userId);
      window.location.href = `profile.html`;
    } else {
      alert(resp.message || "Login failed");
    }
  })
});

function axiosGetCall(api, params) {
  return axios.get(api, {
    params: params
  }).then(function (response) {
    return response.data;
  }).catch(function (error) {
    return null;
  });
}


