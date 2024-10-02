 let ingredientIndex = 1;
    document.getElementById('add-ingredient').addEventListener('click', function() {
    const container = document.getElementById('ingredients-container');
    const newIngredient = document.createElement('div');
    newIngredient.classList.add('ingredient-item');
    newIngredient.innerHTML = `
            <div class="row mb-3">
                <div class="col-md-6 ">
                    <input type="text" class="form-control" name="ingredients[${ingredientIndex}][name]" placeholder="Nom de l'ingrédient" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="ingredients[${ingredientIndex}][quantity]" placeholder="Quantité" required>
                </div>
                <div class="col-md-2">
                    <div type="button" class="btn btn-danger remove-ingredient"><i data-feather="x-circle">Annuler</i></div>
                </div>
            </div>
        `;
    container.appendChild(newIngredient);
    ingredientIndex++;
});
    document.getElementById('ingredients-container').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-ingredient')) {
    e.target.closest('.ingredient-item').remove();
}
});
