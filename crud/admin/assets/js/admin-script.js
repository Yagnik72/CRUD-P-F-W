jQuery(document).ready(function ($) {
    jQuery('#users-listing').DataTable(); // Listing table
    

    jQuery('#add_edit_user_form').on('submit', function(e){

        e.preventDefault();
            
        var formData=jQuery(this).serialize();
            formData+='&'+jQuery.param({'action':'user_add_edit'});

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: admin_ajax_object.ajaxurl,
            data: formData,
            success: function(msg){
                console.log(msg);
            }
        });
        
    });

});