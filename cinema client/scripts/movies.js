console.log("movies.js is loaded");
const userId = localStorage.getItem("user_id");
if (!userId) {
  alert("Missing user ID. Cannot load profile.");
  window.location.href = "login.html"; 

} else {
  axios.get("http://localhost/Cinema-Project-1/cinema-server/movies")
  .then(response => {
    const movies = response.data.movies;
    const container = document.getElementById("movies-grid");

    for(let i=0;i<movies.length;i++){
        const movie=movies[i];

      container.innerHTML += `
      <div class ="movie-card">
        <div class="movie-image">
          <img src="assets/">
        </div>
        <h3 class="movie-title">${movie.name}</h3>
        <p class="movie-description">${movie.description}</p>
        <p class="movie-duration">Duration: ${movie.duration}</p>
        <p class="movie-cast">Cast: ${movie.cast}</p>
        </div>
      `;
    }
  })
}
function myFunction(){
  localStorage.clear();
  console.log("local storage cleared");
  window.location.href = `index.html`;
}