var items = ['https://www.arduino.cc/new_home/assets/illu-arduino-UNO.png'];

jQuery(document).ready(function($) {

    /* init */
    renderItems(items);

    /* attach listeners */
    $("#imgInp").change(function() {
        readURL(this);
    });

    $("#generate").click(function() {
        console.log('clicked generate');
    })

    $("body").click(function(e) {
        var trigger = e.target.dataset.trigger;

        if(trigger === 'delete') {
            var idx = e.target.dataset.idx;
            items.splice(idx, 1);
            renderItems(items);
        }
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            items.push(e.target.result);
            renderItems(items);
        }
        reader.readAsDataURL(input.files[0]);
    }

}

function renderItems(items) {
    var elements = items.map(function(item, i) {
        return '<div class="item"><img src="' + item + '" alt="item image" /><button data-trigger="delete" data-idx="' + i + '">×</button></div>';
    });

    // if there are no items render info message
    if(items.length === 0)
        elements = "<p>No images added yet</p>";

    $('#items').html(elements);
}
