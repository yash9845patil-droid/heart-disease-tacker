document.getElementById("predictionForm").addEventListener("submit", function(event) {
  let age = document.querySelector("input[name='age']").value;
  let bp = document.querySelector("input[name='bp']").value;
  let cholesterol = document.querySelector("input[name='cholesterol']").value;
  let maxhr = document.querySelector("input[name='maxhr']").value;

  if (age <= 0 || bp <= 0 || cholesterol <= 0 || maxhr <= 0) {
    alert("Please enter valid positive values.");
    event.preventDefault();
  }
});
