function darkToggle() {
  let on = document.body.classList.toggle("dark-mode");
  on ? document.getElementById("dark-button").innerHTML = "light mode" :
    document.getElementById("dark-button").innerHTML = "dark mode";
}