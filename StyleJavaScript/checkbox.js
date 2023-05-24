// Récupérer la case à cocher "Sélectionner tout"
const selectAllCheckbox = document.querySelector('.checkbox_select_all');
// Récupérer la case à cocher "Sélectionner each"
const checkboxes = document.querySelectorAll('.checkbox_item');
// Ajouter un écouteur d'événement "click"
selectAllCheckbox.addEventListener('click', ()=> {
  // Vérifier si la case à cocher est cochée
  if (selectAllCheckbox.checked) {
    // Parcourir toutes les cases à cocher et les cocher
    
    checkboxes.forEach((checkbox)=> {
      checkbox.checked = true;
    });
  } else {
    // Parcourir toutes les cases à cocher et les décocher
    checkboxes.forEach((checkbox)=> {
      checkbox.checked = false;
    });
  }
});
