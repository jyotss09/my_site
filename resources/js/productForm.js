
$(document).ready(function() {

    $(document).on("click", "#save_product", function (e) {
        e.preventDefault();
        Swal.showLoading();
        
        var formElement = document.getElementById('product_form');
        var formData = new FormData(formElement);
        var token = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            type: "POST",
            url: "/admin/storeProduct",  // Ensure this matches the route in your web.php
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function (response) {
                Swal.hideLoading();
                $("#product_form")[0].reset();
                Swal.fire({
                    title: "Registered!",
                    text: "Product has been successfully added.",
                    icon: "success",
                    confirmButtonText: "OK",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // You can redirect or perform other actions here
                    }
                });
            },
            error: function (xhr) {
                Swal.hideLoading();
                var err = xhr.responseJSON.errors;
                var errorMessage = "Please fix the following errors:<br>";
                $.each(err, function (key, value) {
                    errorMessage += `<strong>${key.replace('_', ' ').toUpperCase()}</strong>: ${value.join('<br>')}<br>`;
                });
                Swal.fire({
                    title: "Failed!",
                    html: errorMessage,
                    icon: "error",
                    confirmButtonText: "OK",
                });
            },
        });
    });
    
});
