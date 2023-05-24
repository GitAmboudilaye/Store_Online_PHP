// Récupérer le bouton pour ouvrir la boîte de dialogue
var btnOpenDialog = document.getElementById("btnOpenDialog");

// Récupérer la boîte de dialogue
var dialog = document.getElementById("panier-dialog");

// Récupérer le bouton pour fermer la boîte de dialogue
var btnCloseDialog = document.getElementById("btnCloseDialog");
// Lorsque le bouton pour fermer la boîte de dialogue est cliqué
btnCloseDialog.addEventListener("click", function() {
  
  const url = `http://localhost/Cours_CM/projetsession/view/test.php`;
  // Rediriger vers la page Web
  window.location.href = url;
});

