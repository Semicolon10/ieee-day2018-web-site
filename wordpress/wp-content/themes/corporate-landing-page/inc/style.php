<?php

/*Styling the fonts,color and image using customizer(giving choice of selection for user)*/
function corporate_landing_page_customize_css(){

    $corporate_landing_page_headerfont = get_theme_mod('corporate_landing_page_heading_font', array('font-family'=>'Raleway', 'variant'=>'regular') );
    $corporate_landing_page_bodyfont = get_theme_mod('corporate_landing_page_body_font', array('font-family'=>'Open Sans', 'variant'=>'regular'));
    $primarycolor = get_theme_mod('corporate_landing_page_primary_color', '#353c4e');
    $secondarycolor = get_theme_mod('corporate_landing_page_secondary_color', '#cf9556');
    $bgcolor = get_theme_mod( 'corporate_landing_page_bg_color', '#FFFFFF' );
    $bg_image = get_theme_mod( 'corporate_landing_page_bg_image' );
    ?>
    <style>
        <?php
        if( !get_theme_mod('corporate_landing_page_ed_cart', 1) ) { ?>
        .header .topbar-text .form-holder {
            border-right: unset;
        }
        <?php 
        }
        ?>
        body {
            background-image: url('<?php echo esc_attr($bg_image);?>');
        }
       
        body {
            background-color: <?php echo esc_attr($bgcolor);?>
        }
    /*Primary Color*/
	.header-one.header .header-top,
	.header-two.header .header-top,
	.header-three .header .header-bottom,
	.header-four .header .header-top,
	.header-four .header .header-bottom,
	.header-five.header .header-bottom,
	{
		background-color: <?php echo esc_attr($primarycolor);?>;
	}
    /*Default Blog Page*/

    .header .site-branding .site-title a{
        color: <?php echo esc_attr($primarycolor); ?>;
    }
    .site-content .widget-default .widget.widget_calendar table caption {
     background : <?php echo esc_attr($primarycolor); ?>;
}

     .blog-main .caption, .site-footer .widget.widget_calendar table caption,.header .header-top{
               background-color: <?php echo esc_attr($primarycolor); ?>;
           }
    .overlay, .blog-landing .overlay{
        background: rgba(<?php echo esc_attr(corporate_landing_page_hex_to_rgb($primarycolor, 0.8));?>) ;
    }
    /*Front Page*/
    .site-header .sticky{
        background-color: <?php echo esc_attr($primarycolor); ?>;
    }
    .blog-content-wrapper .card-one .entry-meta{
         background-color: <?php echo esc_attr($primarycolor); ?>;
    }
    .blog-content-wrapper .card-one .img-holder .overlay
    /*.slider .slides .overlay*/{
         background: rgba(<?php echo esc_attr(corporate_landing_page_hex_to_rgb($primarycolor, 0.5));?>) ;
    }

    /*Grid Blog Page*/
    .blog-main .card-one .entry-meta,.header.header-three .header-bottom, .header.header-four .header-bottom, .header.header-four.header-five .social-media li{
        background-color: <?php echo esc_attr($primarycolor); ?>;
    }
    .header.header-three .header-top .site-branding .site-title a, .header.header-four.header-five .header-top span, .header.header-four.header-five .header-top .phone .fa{
        color: <?php echo esc_attr($primarycolor); ?>;
    }
    .blog-main .card-one .img-holder .overlay{
         background: rgba(<?php echo esc_attr(corporate_landing_page_hex_to_rgb($primarycolor, 0.5));?>) ;
    }
    .header.header-six .header-top .phone, .header.header-six .header-top .mail, .header.header-six .header-top .fa, .header.header-six .header-top span{
        color: <?php echo esc_attr($primarycolor); ?>;
    }
    .header.header-three .header-top .fa, .header.header-three .header-top span{
        color: <?php echo esc_attr($primarycolor); ?>; 
    }
    .header.header-two .topbar-text .form-holder, .header.header-two .topbar-text p{
       border-right:  2px solid <?php echo esc_attr($primarycolor); ?>;
   }
   .header.header-two .topbar-text span a, .header.header-two .topbar-text p{
       color: <?php echo esc_attr($primarycolor); ?>;
   }

    /*Secondary Color*/
    /*Default Blog Page*/
    .header .header-bottom .navbar-default .navbar-nav  li a:hover, .site-content .widget-area .widget ul li a:hover,.site-footer .widget-area .widget ul li a:hover, .breadcrumbs .content{
         color: <?php echo esc_attr($secondarycolor); ?>;
    }

    .header .header-bottom .navbar-default .navbar-nav  li.open  a{
        color: <?php echo esc_attr($secondarycolor); ?>;
    }
      .header ul.dropdown-menu{
        border-top:1px solid <?php echo esc_attr($secondarycolor); ?>;
    }
    .blog-main .comment-body .comment-metadata a{
       color: <?php echo esc_attr($secondarycolor); ?>; 
    }

    .custom-border, .site-content .blog-main .custom-border, .site-content .widget .entry-footer .read, .form-submit .submit{
         background-color: <?php echo esc_attr($secondarycolor); ?>;
    }
    .blog-two .blog-main .entry-footer, .form-submit .submit{
        border-color: <?php echo esc_attr($secondarycolor); ?>; 
    }

    /*Grid Blog Page*/
    .blog-main .card-one:hover .entry-meta{
         background-color: <?php echo esc_attr($secondarycolor); ?>;
    }
    .header.header-three .header-bottom .navbar-default .navbar-nav li a:hover,.header.header-four .navbar-default .navbar-nav .active a{
        color: <?php echo esc_attr($secondarycolor); ?>;
    }
  
    /*Front Page*/
    .section .line{
        background-color: <?php echo esc_attr($secondarycolor); ?>;
    }
    .blog-content-wrapper .card-one:hover .entry-meta{
        background-color: <?php echo esc_attr($secondarycolor); ?>;
    }
    .site .slider .slides .carousel-caption .buy_now,
    .about-content-wrapper .btn.learn,.slider .owl-theme .owl-dots .owl-dot.active span,.slider .owl-theme .owl-dots .owl-dot:hover span{
       background-color: <?php echo esc_attr($secondarycolor); ?>; 
    }
    .cta-content-wrapper .overlay{
        background: rgba(<?php echo esc_attr(corporate_landing_page_hex_to_rgb($secondarycolor, 0.8));?>) ;
    }
    .subscribe-content-wrapper .overlay{
        background: rgba(<?php echo esc_attr(corporate_landing_page_hex_to_rgb($secondarycolor, 0.8));?>) ;
    }


	<style type='text/css' media='all'>       
    
    /*Header Font*/
    /*Default Blog Page Font */
 

    .site-content .widget-title{
    	 font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
		}
    .blog-landing h2.entry-title{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
    }
    .site-footer .widget-title{
    	 font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
		}
    
    .site-content .widget.widget_calendar table caption{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
    }
    .blog-main .comments-title,
    .blog-main .comment-reply-title{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif; 
    }

   .site-main .post .entry-footer .read-more{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
   }
    .form-submit .submit{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif; 
    }
    .blog-main .comment-respond p textarea::placeholder, .blog-main .comment-respond p input::placeholder{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif; 
    }
    .site-content .widget-area .widget .widget-title,
    .site-footer .widget-area .widget .widget-title
    {
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
    }  
  


    /*Front Page*/
    .slider .carousel-caption h2, .slider .carousel-caption p{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
    }
    .section .section-title, .section .section-para{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
    }
    .cta-content-wrapper .cta-text h2, .cta-content-wrapper .cta-btn{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
    }
    .section .section-title, .blog-content-wrapper .card-one .entry-meta .post-date{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
   }
   .subscribe-content-wrapper .subscribe-text h2{
        font-family: '<?php echo esc_attr($corporate_landing_page_headerfont['font-family']);?>',sans-serif;
   }
           
       ?>     
    </style>


    <style type='text/css' media='all'> 

    /*Body Font*/ 
    /*Default Blog Page Font*/   
    .header .header-bottom .site-branding .site-title a{
       font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    } 
    .header .header-bottom .navbar-default .navbar-nav li {
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    }
    .breadcrumbs .content{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    }
    .body{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',
        sans-serif;
    }
    .blog-main h2.entry-title{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',
        sans-serif;
    }
    
	.site-footer .widget-area .widget p,
	.site-content .widget-area .widget p{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
	} 

    .site-footer .widget-area .widget ul li,
    .site-content .widget-area .widget ul li{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    } 
    .site-content .widget-area .widget .calendar_wrap thead, 
    .site-content .widget.widget_calendar table tbody,
    .site-content .widget.widget_calendar table tfoot{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    }
    .site-content .widget.widget_search .search-field::placeholder,.site-footer .widget.widget_search .search-field::placeholder{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    }
    .blog-main .caption a{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;  
    }

   .site-main .post .entry-content p{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }

    .site-main .post .author .post-author{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }
    .header .header-top span, .header .topbar-text p{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    }
    .navigation.pagination .nav-links .page-numbers{
       font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;  
    }
    .site-footer .site-info{
       font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;  
    }
    .blog-main .comment-body .comment-metadata, .blog-main .comment-body .comment-author.vcard .fn,
    .blog-main .comment-body .comment-content{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;  
    }
    /*Grid Blog Page*/
    .blog-main .card-one .entry-meta .post-date a,.blog-main .card-one .entry-meta .post-date{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;  
    }
    .header .site-branding .site-title{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
    }
    .search-area .search-form input[type="search"]{
         font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;   
    }
    .header-six .site-branding.main .site-description{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;   
    }
    }
  
   /*Front Page*/
    .slider .carousel-caption .buy_now{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }
   .about-content-wrapper .entry-content p, .about-content-wrapper .btn.learn{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }
   .cta-content-wrapper .cta-text p{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }
   .blog-content-wrapper .card-one .entry-title a{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }
   .contact-content-wrapper.section .section-para, .contact-content-wrapper.section .contacts{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }
   .contact-left .post-para, .contact-left .contacts h3, .contact-left .contacts p{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;
   }
   .subscribe-content-wrapper .subscribe-text p{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;   
   }
   /*Gird Blog Page*/
   .blog-main .card-one .entry-title{
        font-family: '<?php echo esc_attr($corporate_landing_page_bodyfont['font-family']);?>',sans-serif;  
   }
 

    </style>
    <?php
}
add_action( 'wp_head', 'corporate_landing_page_customize_css');


//Custom Background Activation
function corporate_landing_page_custom() {
	if ( get_background_image() != '' ) {
		?>

		<style type="text/css">
			.site-content {
				background-color: transparent !important;
			}
			
		</style>
	<?php
	}
}
add_action( 'wp_head', 'corporate_landing_page_custom' );
