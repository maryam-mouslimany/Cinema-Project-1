const userId = localStorage.getItem("user_id");
if (!userId) {
  alert("Missing user ID. Cannot load profile.");
  window.location.href = "login.html"; 

} else {
  axios.get("http://localhost/Cinema---Project/cinema%20server/Controllers/MovieController.php")
  .then(response => {
    const movies = response.data.movies;

    const container = document.getElementById("movies-grid");

    for(let i=0;i<movies.length;i++){
        const movie=movies[i];
        if (movie.image){
        }
      container.innerHTML += `
      <div class ="movie-card">
        <div class="movie-image">Movie Poster</div>
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