<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head();?>
</head>

<body <?php body_class('blog');?>>
    <div id="page" class="hfeed site">
        <header id="masthead" class="site-header header header-one" role="banner">
            <div class="header-top non-sticky">
                <div class="container">
                    <div class="row">
                        <div class="wrapper">
                            <div class="col-lg-6 col-sm-6">
                                <?php 
                                $icons = get_theme_mod( 'corporate_landing_page_header_contact_icon' );
                                if($icons):
                                foreach($icons as $icon):?>
                                <div class="phone">
                                    <i class="fa <?php echo esc_attr( $icon['icon'] );?>"></i>
                                    <span><?php echo esc_attr($icon['text']); ?></span>
                                </div>
                                <?php
                                endforeach; 
                                endif; ?>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="topbar-text">
                                    <p><?php bloginfo('description');?></p>
                                    <?php
                                    $cart = get_theme_mod('corporate_landing_page_ed_cart', 0); 
                                    if($cart && corporate_landing_page_woocommerce_activated()){?>
                                    <a href="<?php echo esc_url(wc_get_cart_url());?>"><span class="header-cart"><i class="fa fa-shopping-cart cart"></i></span></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <div class="site-branding">
                            <?php
                                the_custom_logo();
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>                               
                        </div>
                    </div>
                        <div class="col-lg-9 col-sm-9">
                            <nav id="site-navigation" class="navbar navbar-default main-navigation">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only"><?php echo esc_html('Toggle navigation', 'corporate-landing-page') ?></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                   <?php
					                $defaults = array(
					                'theme_location' 	=> 'menu-1',
					                'menu_id'        	=> 'primary-menu',
			                        'container'       	=> 'ul',
			                        'echo'            	=> true,
			       	                'fallback_cb'     	=> 'WP_Bootstrap_Navwalker::fallback',
			                        'menu_class'		=> 'nav navbar-nav navbar-right primary-menu',
                                    'item_wrap'			=> '<ul class="%2$s">%3$s</ul>',
                                    'walker'         => new wp_bootstrap_navwalker(),
					                );
                                    wp_nav_menu($defaults);
                                    ?>
                                </div>
                                <!-- /.navbar-collapse -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>  
        
        <?php if(!is_page_template('page-templates/template-home.php')):
        if( !is_404() ): ?>
        <div class="blog-landing" style="background-image: url('<?php echo esc_url(get_theme_mod('header_image'));?>')">
            <div class="overlay"></div>
            <div class="container">
                <article class="post">
                    <div class="text-holder">
                        <div class="entry-header">
                            <h2 class="entry-title">
                                <?php
                                if(is_home()){
                                }
                                elseif(is_archive()){
                                    the_archive_title();
                                }
                                elseif(is_search()){
                                    echo get_search_query();
                                }
                                elseif(is_single() || is_page()){
                                    the_title();
                                }
                                ?>
                            </h2>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="container">
                <div id="crumbs" class="content">
                <?php
                    $breadcrumb_ed  = get_theme_mod('corporate_landing_page_ed_breadcrumb', 1);
                    if(function_exists('corporate_landing_page_breadcrumbs')){
                        if($breadcrumb_ed){
                        corporate_landing_page_breadcrumbs();
                        }
                    } ?>
                </div>
            </div>
        </div>  
        <?php endif;
                endif;