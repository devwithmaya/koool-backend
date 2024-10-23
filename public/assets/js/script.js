 let ingredientIndex = 1;
    document.getElementById('add-ingredient').addEventListener('click', function() {
    const container = document.getElementById('ingredients-container');
    const newIngredient = document.createElement('div');
    newIngredient.classList.add('ingredient-item');
    newIngredient.innerHTML = `
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="ingredients[${ingredientIndex}][name]" placeholder="Nom de l'ingrédient" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="ingredients[${ingredientIndex}][quantity]" placeholder="Quantité" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="ingredients[${ingredientIndex}][metric]" placeholder="Metric" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="ingredients[${ingredientIndex}][calories]" placeholder="Calories" required>
                </div>
                <div class="col-md-2">
                    <div type="button" class="btn btn-sm btn-danger text-light remove-ingredient">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-x-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                        Annuler
                    </div>
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
