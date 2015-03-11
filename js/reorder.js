jQuery(document).ready(function($) {
	$( 'div#jobs-admin-sort' ).each(function() {

		var sortList = $( 'ul#custom-type-list'),
            animation = $( '#loading-animation'),
            page_title = $( 'div#jobs-admin-sort h2:first' );

		sortList.sortable({
			update: function(event, ui) {
				animation.show(); // Show the animate loading gif while waiting

				opts = {
					url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
					type: 'POST',
					async: true,
					cache: false,
					dataType: 'json',
					data:{
						action: 'save_sort', // Tell WordPress how to handle this ajax request
						order: sortList.sortable( 'toArray' ).toString(), // Passes ID's of list items in	1,3,2 format
                        security: hrm_options.security
					},
					success: function(response) { // success refers to the success of the ajax function itself, not the callback result
                        $( 'div#message' ).remove();
                        animation.hide(); // Hide the loading animation


                        if ( true === response.success ) {
                            page_title.after( '<div id="message" class="updated below-h2"><p>Jobs sort order has been saved</p></div>' );
                            return;
                        } else {
                            page_title.after( '<div id="message" class="error below-h2"><p>There was an error saving the sort order, or you do not have proper permissions.</p></div>' );
                            return;
                        }

					},
					error: function(xhr,textStatus,e) {

					}
				};
				$.ajax(opts);
			}
		});

	});
});