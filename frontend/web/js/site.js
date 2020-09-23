$(document).ready(function() {
    $(document).on('click','.add-to-cart',function(e) {
        e.preventDefault();
        let productId = $(this).data('pid');
        $.ajax({
            url: '/ajax/add-cart',
            data: { product_id: productId },
            type: "post",
            context: this,
            success: function (response) {
                if(response.status) {
                    _showAlert(response.message,"info");
                    updateCartCount("add",1);
                    $(this).removeClass("add-to-cart").addClass("remove-from-cart").html('Remove');
                } else {
                    _showAlert(response,'error');
                }
            }
        });
    });

    $(document).on('click', '.remove-from-cart', function (e) {
        e.preventDefault();
        let productId = $(this).data('pid');
        $.ajax({
            url: '/ajax/remove-cart',
            data: { product_id: productId },
            type: "post",
            context: this,
            success: function (response) {
                if (response.status) {
                    _showAlert(response.message, "info");
                    updateCartCount("remove", 1);
                    $(this).removeClass("remove-from-cart").addClass("add-to-cart").html('Add To Cart');
                } else {
                    _showAlert(response, 'error');
                }
            }
        });
    });

    $(document).on("change",".counter",function (e) {
        var button_classes, value = +$(this).val();
        button_classes = $(e.currentTarget).prop('class');
        if (button_classes.indexOf('up_count') !== -1) {
            value = (value) + 1;
        } else {
            value = (value) - 1;
        }
        value = value < 0 ? 0 : value;

        $('.counter').val(value);
    });
    $('.counter').click(function () {
        $(this).focus().select();
    });
});

function updateCartCount(action,quantity) {
    let selector = $("#cart-count");
    let cartCount = parseInt(selector.html());
    if(action == "add") {
       selector.html(cartCount + quantity);
    } else if(action == "remove") {
        selector.html(cartCount - quantity);
    }
}

function _showAlert(msg,type) {
    var toastDiv = $("#snackbar");
    toastDiv.className = "show";
    toastDiv.html(msg);
    toastDiv.addClass(type);
    setTimeout(function () { toastDiv.className = toastDiv.className.replace("show", ""); }, 3000);
}