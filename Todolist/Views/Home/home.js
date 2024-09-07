document.addEventListener('DOMContentLoaded', function () {
    var todolistItems = document.querySelectorAll('#todolist li');

    todolistItems.forEach(function (item, index) {
        setTimeout(function () {
            item.style.animation = 'expand 0.8s ease-out';
        }, index * 100);
    });
});


