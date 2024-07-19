$(document).ready(function() {
    // Attach a submit event listener to forms with the class "ajax-form"
    $('form.ajax-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        let $form = $(this); // Store the form object in a variable
        
        // Send an AJAX request to the form's action URL
        $.ajax({
            url: $form.attr('action'), // Get the URL to send the request to
            method: $form.attr('method'), // Get the HTTP method (e.g., POST)
            data: $form.serialize(), // Serialize the form data for the request
            success: function(response) {
                // If the response contains a message, display it in an alert
                if (response.message) {
                    alert(response.message);
                    
                    // If the form has a "data-redirect-to" attribute, redirect to the specified URL
                    if ($form.data('redirect-to') != "") {
                        window.location.href = $form.data('redirect-to');
                    }
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors; // Get the errors from the response JSON
                
                // If the response contains a message, display it in an alert
                if (xhr.responseJSON.message) {
                    alert(xhr.responseJSON.message);
                }
                
                // Remove any existing error messages
                $('.text-red-500.text-sm.mt-1').remove();
                
                // Loop through each error and display it next to the corresponding form field
                $.each(errors, function(field, error) {
                    console.log($form.find('[name="' + field + '"]'));
                    $form.find('[name="' + field + '"]').parent('div').append(`<div class="text-red-500 text-sm mt-1">${error}</div>`);
                });
            }
        });
    });
});

/**
 * This script enhances form submission by using AJAX.
 * 
 * - It prevents the default form submission behavior and sends the form data using an AJAX request.
 * - On successful form submission, it displays a message and redirects if a URL is specified.
 * - On error, it displays error messages next to the respective form fields.
 * 
 * Usage:
 * Add the class "ajax-form" to any form element to enable AJAX submission.
 */
