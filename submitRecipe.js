function submitRecipe() {
    var recipeName = document.getElementById('recipeName').value.trim();
    var ingredients = document.querySelectorAll('#ingredientsContainer .ingredient-input');
    var instructions = document.querySelectorAll('#instructionsContainer .instruction-input');
    var recipeImages = document.getElementById('recipeImages').files;
    var selectedCategories = document.querySelectorAll('.form-check-input:checked');
    var f = new FormData();

    f.append("recipeName", recipeName);

    ingredients.forEach((input, index) => {
        f.append(`ingredients[${index}]`, input.value.trim());
    });

    instructions.forEach((input, index) => {
        f.append(`instructions[${index}]`, input.value.trim());
    });

    for (var x = 0; x < recipeImages.length; x++) {
        f.append(`image${x}`, recipeImages[x]);
    }

    selectedCategories.forEach((checkbox, index) => {
        f.append(`categories[${index}]`, checkbox.value);
    });

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState === 4) {
            if (r.status === 200) {
                alert(r.responseText);
                window.location = "profile.php"; 
            } else {
                alert("Error submitting the recipe: " + r.status);
            }
        }
    };

    r.open("POST", "addRecipeProcess.php", true);
    r.send(f); 
}

document.getElementById('addIngredient').addEventListener('click', function () {
    const ingredientsContainer = document.getElementById('ingredientsContainer');
    const ingredientCount = ingredientsContainer.children.length + 1;

    const ingredientGroup = document.createElement('div');
    ingredientGroup.classList.add('input-group', 'mb-2');
    ingredientGroup.innerHTML = `
        <span class="input-group-text ingredient-number">${ingredientCount}</span>
        <input type="text" class="form-control ingredient-input" name="ingredients[]" placeholder="Enter ingredient" required>
        <button type="button" class="btn btn-outline-danger remove-ingredient">Remove</button>
    `;
    ingredientsContainer.appendChild(ingredientGroup);
    updateNumbers('ingredient-number', ingredientsContainer);
});

document.getElementById('addInstruction').addEventListener('click', function () {
    const instructionsContainer = document.getElementById('instructionsContainer');
    const instructionCount = instructionsContainer.children.length + 1;

    const instructionGroup = document.createElement('div');
    instructionGroup.classList.add('input-group', 'mb-2');
    instructionGroup.innerHTML = `
        <span class="input-group-text instruction-number">${instructionCount}</span>
        <input type="text" class="form-control instruction-input" name="instructions[]" placeholder="Enter instruction" required>
        <button type="button" class="btn btn-outline-danger remove-instruction">Remove</button>
    `;
    instructionsContainer.appendChild(instructionGroup);
    updateNumbers('instruction-number', instructionsContainer);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-ingredient')) {
        e.target.parentElement.remove();
        updateNumbers('ingredient-number', document.getElementById('ingredientsContainer'));
    } else if (e.target.classList.contains('remove-instruction')) {
        e.target.parentElement.remove();
        updateNumbers('instruction-number', document.getElementById('instructionsContainer'));
    }
});

function updateNumbers(className, container) {
    const elements = container.querySelectorAll(`.${className}`);
    elements.forEach((element, index) => {
        element.textContent = index + 1;
    });
}

document.getElementById('recipeImages').addEventListener('change', function () {
    const selectedImagesList = document.getElementById('selectedImages');
    selectedImagesList.innerHTML = '';

    Array.from(this.files).forEach((file, index) => {
        const listItem = document.createElement('li');
        listItem.textContent = `${index + 1}. ${file.name}`;
        selectedImagesList.appendChild(listItem);
    });
});




