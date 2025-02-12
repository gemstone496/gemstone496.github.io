function darkToggle() {
  let on = document.body.classList.toggle("dark-mode");
  on ? document.getElementById("dark-button").innerHTML = "Light Mode" :
    document.getElementById("dark-button").innerHTML = "Dark Mode";
}