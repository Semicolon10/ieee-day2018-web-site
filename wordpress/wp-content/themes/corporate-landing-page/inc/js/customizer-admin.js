jQuery(document).ready(function($) {
	/* Move widgets to their respective sections */
    
    // Scroll to section
    $('body').on('click', '#sub-accordion-panel-corporate_landing_page_homepage_panel .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        hcScrollToSection( section_id );
    });
    
});

function hcScrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        case 'accordion-section-corporate_landing_page_kirki_slider_options':
        preview_section_id = "slider";
        break;
        
        case 'accordion-section-corporate_landing_page_homepage_banner':
        preview_section_id = "cta";
        break;

        case 'accordion-section-corporate_landing_page_about_section':
        preview_section_id = "about";
        break;

        case 'accordion-section-corporate_landing_page_blog_section':
        preview_section_id = "blog";
        break;

        case 'accordion-section-corporate_landing_page_contact_section':
        preview_section_id = "contact";
        break;

        case 'accordion-section-corporate_landing_page_subscription':
        preview_section_id = "subscribe";
        break;
        
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );