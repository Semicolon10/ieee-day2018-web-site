<?php 
/* Footer for corporate-landing-page
 Footer Widgets and scripts are loaded here 
 */
?>
    <footer id="colophon" class="site-footer" role="conteninfo">
        <div class="holder">
            <div class="container">
                <div class="widget-area">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <?php dynamic_sidebar('footer-1');?>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <?php dynamic_sidebar('footer-2');?>    
                        </div>

                            <div class="col-lg-3 col-sm-6">
                                <?php dynamic_sidebar('footer-3');?>
                            </div>

                            <div class="col-lg-3 col-sm-6">
                                <?php dynamic_sidebar('footer-4');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php do_action( 'corporate_landing_page_footer'); ?>
        </footer>
        </div>
        <?php wp_footer();?>
    </body>
</html>