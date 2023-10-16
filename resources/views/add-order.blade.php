<form id="order-form">
    <div>
        <label for="shop_product_id">Shop Product:</label>
        <select name="shop_product_id" id="shop_product_id">
            @foreach($shop_products as $shop_product)
                <option value="{{ $shop_product->id }}">{{ $shop_product->product->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="customer_name">customer name:</label>
        <input type="text" name="customer_name" id="customer_name">
    </div>

    <div>
        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" id="quantity">
    </div>
    <button type="submit">Add Order</button>
</form>

<div id="message"></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {

        $("#order-form").submit(function (e) {
            e.preventDefault();

            var formData = {
                shop_product_id: $("#shop_product_id").val(),
                quantity: $("#quantity").val(),
                customer_name: $("#customer_name").val(),
            };

            $.ajax({
                type: "POST",
                url: "/api/add-order",
                data: formData,
                dataType: "json",
                success: function (data) {
                    $("#message").html("<p style='color: green'>Order created successfully.</p>");
                },
                error: function (xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "<ul>";
                    for (var key in errors) {
                        errorMessage += "<li style='color: red'>" + errors[key] + "</li>";
                    }
                    errorMessage += "</ul>";
                    $("#message").html(errorMessage);
                },
            });
        });
    });
</script>
