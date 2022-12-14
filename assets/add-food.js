$('td').on('click', function (e) {
    var foodId = $(e.currentTarget).data('foodid');
    var mealId = $("#mealid").data("mealid");
    var tableId = $(this).parents('table').attr('id');
    if ("meal_pantry" === tableId) {
        var scrollTarget = $(e.currentTarget).parent('tr').next('tr').find("td:first").data('foodid');
    } else {
        var scrollTarget = foodId;
    }
    $packet = JSON.stringify([foodId, mealId, tableId]);
    $.post(document.location.origin + '/meal/' + mealId + '/editMealFood', $packet, function (response) {
        editFoods = $.parseJSON(response);
        var readyToEat = $.parseJSON(editFoods[0]);
        var pantry = $.parseJSON(editFoods[1]);
        var table = document.getElementById('ready_foods');
        $('#ready_foods tr:not(:first)').remove();
        $.each(readyToEat, function (key, food) {
            row = table.insertRow(-1);
            cell = row.insertCell(0);
            cell.innerHTML = food;
        });

        var table = document.getElementById('meal_pantry');
        $('#meal_pantry tr:not(:first)').remove();
        $.each(pantry, function (key, array) {
            food = array.split(",");
            foodId = food[0];
            foodName = food[1];
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            cell.innerHTML = foodName;
            cell.setAttribute('data-foodid', foodId);
        });
        location.reload();
        $('td[data-foodid="' + scrollTarget + '"]')[0].scrollIntoView();
    });
});