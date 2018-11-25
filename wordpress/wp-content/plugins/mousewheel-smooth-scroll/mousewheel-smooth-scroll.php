<?php
/*
	Plugin Name: MouseWheel Smooth Scroll
	Plugin URI: https://kubiq.sk
	Description: MouseWheel smooth scrolling for your WordPress website
	Version: 4.0
	Author: KubiQ
	Author URI: https://kubiq.sk
	Text Domain: wpmss
	Domain Path: /languages
*/

if( ! class_exists('wpmss') ){
	class wpmss {
		var $plugin_admin_page;
		var $settings;
		var $tab;
		
		function __construct(){
			add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
			add_action( 'admin_menu', array( &$this, 'plugin_menu_link' ) );
			add_action( 'init', array( &$this, 'plugin_init' ) );
		}

		function plugins_loaded(){
			load_plugin_textdomain( 'wpmss', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
		}
		
		function filter_plugin_actions( $links, $file ){
		   $settings_link = '<a href="options-general.php?page=' . basename( __FILE__ ) . '">' . __('Settings') . '</a>';
		   array_unshift( $links, $settings_link );
		   return $links;
		}
		
		function plugin_menu_link(){
			$this->plugin_admin_page = add_submenu_page(
				'options-general.php',
				__( 'Smooth Scroll', 'wpmss' ),
				__( 'Smooth Scroll', 'wpmss' ),
				'manage_options',
				basename( __FILE__ ),
				array( $this, 'admin_options_page' )
			);
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'filter_plugin_actions' ), 10, 2 );
		}
		
		function plugin_init(){
			$this->settings = get_option('wpmss_settings');
			if( ! isset( $this->settings['general']['timestamp'] ) ){
				$this->settings['general']['timestamp'] = time();
				update_option( 'wpmss_settings', $this->settings );
			}
			$this->settings['general']['frameRate'] = isset( $this->settings['general']['frameRate'] ) && trim( $this->settings['general']['frameRate'] ) ? intval( $this->settings['general']['frameRate'] ) : 150;
			$this->settings['general']['animationTime'] = isset( $this->settings['general']['animationTime'] ) && trim( $this->settings['general']['animationTime'] ) ? intval( $this->settings['general']['animationTime'] ) : 1000;
			$this->settings['general']['stepSize'] = isset( $this->settings['general']['stepSize'] ) && trim( $this->settings['general']['stepSize'] ) ? intval( $this->settings['general']['stepSize'] ) : 100;
			$this->settings['general']['pulseScale'] = isset( $this->settings['general']['pulseScale'] ) && trim( $this->settings['general']['pulseScale'] ) ? intval( $this->settings['general']['pulseScale'] ) : 4;
			$this->settings['general']['pulseNormalize'] = isset( $this->settings['general']['pulseNormalize'] ) && trim( $this->settings['general']['pulseNormalize'] ) ? intval( $this->settings['general']['pulseNormalize'] ) : 1;
			$this->settings['general']['accelerationDelta'] = isset( $this->settings['general']['accelerationDelta'] ) && trim( $this->settings['general']['accelerationDelta'] ) ? intval( $this->settings['general']['accelerationDelta'] ) : 50;
			$this->settings['general']['accelerationMax'] = isset( $this->settings['general']['accelerationMax'] ) && trim( $this->settings['general']['accelerationMax'] ) ? intval( $this->settings['general']['accelerationMax'] ) : 3;
			$this->settings['general']['arrowScroll'] = isset( $this->settings['general']['arrowScroll'] ) && trim( $this->settings['general']['arrowScroll'] ) ? intval( $this->settings['general']['arrowScroll'] ) : 50;
			add_action( 'wp_enqueue_scripts', array( $this, 'plugin_scripts_load' ) );
		}

		function plugin_scripts_load() {
			wp_enqueue_script( 'wpmss_script', plugins_url( 'js/wpmss.min.js', __FILE__ ), array('jquery'), $this->settings['general']['timestamp'], 1 );
		}
		
		function plugin_admin_tabs( $current = 'general' ) {
			$tabs = array( 'general' => __('General'), 'info' => __('Help') ); ?>
			<h2 class="nav-tab-wrapper">
			<?php foreach( $tabs as $tab => $name ){ ?>
				<a class="nav-tab <?php echo ( $tab == $current ) ? "nav-tab-active" : "" ?>" href="?page=<?php echo basename( __FILE__ ) ?>&amp;tab=<?php echo $tab ?>"><?php echo $name ?></a>
			<?php } ?>
			</h2><br><?php
		}

		function save_as_js(){
			global $wp_filesystem;

			$content = sprintf(
				'!function(){function e(){z.keyboardSupport&&m("keydown",a)}function t(){if(!Y&&document.body){Y=!0;var t=document.body,o=document.documentElement,n=window.innerHeight,r=t.scrollHeight;if(A=document.compatMode.indexOf("CSS")>=0?o:t,D=t,e(),top!=self)O=!0;else if(te&&r>n&&(t.offsetHeight<=n||o.offsetHeight<=n)){var a=document.createElement("div");a.style.cssText="position:absolute; z-index:-10000; top:0; left:0; right:0; height:"+A.scrollHeight+"px",document.body.appendChild(a);var i;T=function(){i||(i=setTimeout(function(){L||(a.style.height="0",a.style.height=A.scrollHeight+"px",i=null)},500))},setTimeout(T,10),m("resize",T);var l={attributes:!0,childList:!0,characterData:!1};if(M=new W(T),M.observe(t,l),A.offsetHeight<=n){var c=document.createElement("div");c.style.clear="both",t.appendChild(c)}}z.fixedBackground||L||(t.style.backgroundAttachment="scroll",o.style.backgroundAttachment="scroll")}}function o(){M&&M.disconnect(),w(I,r),w("mousedown",i),w("keydown",a),w("resize",T),w("load",t)}function n(e,t,o){if(p(t,o),1!=z.accelerationMax){var n=Date.now(),r=n-q;if(r<z.accelerationDelta){var a=(1+50/r)/2;a>1&&(a=Math.min(a,z.accelerationMax),t*=a,o*=a)}q=Date.now()}if(R.push({x:t,y:o,lastX:t<0?.99:-.99,lastY:o<0?.99:-.99,start:Date.now()}),!j){var i=e===document.body,l=function(n){for(var r=Date.now(),a=0,c=0,u=0;u<R.length;u++){var d=R[u],s=r-d.start,f=s>=z.animationTime,m=f?1:s/z.animationTime;z.pulseAlgorithm&&(m=x(m));var w=d.x*m-d.lastX>>0,h=d.y*m-d.lastY>>0;a+=w,c+=h,d.lastX+=w,d.lastY+=h,f&&(R.splice(u,1),u--)}i?window.scrollBy(a,c):(a&&(e.scrollLeft+=a),c&&(e.scrollTop+=c)),t||o||(R=[]),R.length?_(l,e,1e3/z.frameRate+1):j=!1};_(l,e,0),j=!0}}function r(e){Y||t();var o=e.target;if(e.defaultPrevented||e.ctrlKey)return!0;if(h(D,"embed")||h(o,"embed")&&/\.pdf/i.test(o.src)||h(D,"object")||o.shadowRoot)return!0;var r=-e.wheelDeltaX||e.deltaX||0,a=-e.wheelDeltaY||e.deltaY||0;N&&(e.wheelDeltaX&&y(e.wheelDeltaX,120)&&(r=-120*(e.wheelDeltaX/Math.abs(e.wheelDeltaX))),e.wheelDeltaY&&y(e.wheelDeltaY,120)&&(a=-120*(e.wheelDeltaY/Math.abs(e.wheelDeltaY)))),r||a||(a=-e.wheelDelta||0),1===e.deltaMode&&(r*=40,a*=40);var i=u(o);return i?!!v(a)||(Math.abs(r)>1.2&&(r*=z.stepSize/120),Math.abs(a)>1.2&&(a*=z.stepSize/120),n(i,r,a),e.preventDefault(),void l()):!O||!J||(Object.defineProperty(e,"target",{value:window.frameElement}),parent.wheel(e))}function a(e){var t=e.target,o=e.ctrlKey||e.altKey||e.metaKey||e.shiftKey&&e.keyCode!==K.spacebar;document.body.contains(D)||(D=document.activeElement);var r=/^(textarea|select|embed|object)$/i,a=/^(button|submit|radio|checkbox|file|color|image)$/i;if(e.defaultPrevented||r.test(t.nodeName)||h(t,"input")&&!a.test(t.type)||h(D,"video")||g(e)||t.isContentEditable||o)return!0;if((h(t,"button")||h(t,"input")&&a.test(t.type))&&e.keyCode===K.spacebar)return!0;if(h(t,"input")&&"radio"==t.type&&P[e.keyCode])return!0;var i,c=0,d=0,s=u(D);if(!s)return!O||!J||parent.keydown(e);var f=s.clientHeight;switch(s==document.body&&(f=window.innerHeight),e.keyCode){case K.up:d=-z.arrowScroll;break;case K.down:d=z.arrowScroll;break;case K.spacebar:i=e.shiftKey?1:-1,d=-i*f*.9;break;case K.pageup:d=.9*-f;break;case K.pagedown:d=.9*f;break;case K.home:d=-s.scrollTop;break;case K.end:var m=s.scrollHeight-s.scrollTop,w=m-f;d=w>0?w+10:0;break;case K.left:c=-z.arrowScroll;break;case K.right:c=z.arrowScroll;break;default:return!0}n(s,c,d),e.preventDefault(),l()}function i(e){D=e.target}function l(){clearTimeout(E),E=setInterval(function(){F={}},1e3)}function c(e,t){for(var o=e.length;o--;)F[V(e[o])]=t;return t}function u(e){var t=[],o=document.body,n=A.scrollHeight;do{var r=F[V(e)];if(r)return c(t,r);if(t.push(e),n===e.scrollHeight){var a=s(A)&&s(o),i=a||f(A);if(O&&d(A)||!O&&i)return c(t,$())}else if(d(e)&&f(e))return c(t,e)}while(e=e.parentElement)}function d(e){return e.clientHeight+10<e.scrollHeight}function s(e){var t=getComputedStyle(e,"").getPropertyValue("overflow-y");return"hidden"!==t}function f(e){var t=getComputedStyle(e,"").getPropertyValue("overflow-y");return"scroll"===t||"auto"===t}function m(e,t){window.addEventListener(e,t,!1)}function w(e,t){window.removeEventListener(e,t,!1)}function h(e,t){return(e.nodeName||"").toLowerCase()===t.toLowerCase()}function p(e,t){e=e>0?1:-1,t=t>0?1:-1,X.x===e&&X.y===t||(X.x=e,X.y=t,R=[],q=0)}function v(e){if(e)return B.length||(B=[e,e,e]),e=Math.abs(e),B.push(e),B.shift(),clearTimeout(C),C=setTimeout(function(){try{localStorage.SS_deltaBuffer=B.join(",")}catch(e){}},1e3),!b(120)&&!b(100)}function y(e,t){return Math.floor(e/t)==e/t}function b(e){return y(B[0],e)&&y(B[1],e)&&y(B[2],e)}function g(e){var t=e.target,o=!1;if(document.URL.indexOf("www.youtube.com/watch")!=-1)do if(o=t.classList&&t.classList.contains("html5-video-controls"))break;while(t=t.parentNode);return o}function S(e){var t,o,n;return e*=z.pulseScale,e<1?t=e-(1-Math.exp(-e)):(o=Math.exp(-1),e-=1,n=1-Math.exp(-e),t=o+n*(1-o)),t*z.pulseNormalize}function x(e){return e>=1?1:e<=0?0:(1==z.pulseNormalize&&(z.pulseNormalize/=S(1)),S(e))}function k(e){for(var t in e)H.hasOwnProperty(t)&&(z[t]=e[t])}var D,M,T,E,C,H={frameRate:%d,animationTime:%d,stepSize:%d,pulseAlgorithm:!0,pulseScale:%d,pulseNormalize:%d,accelerationDelta:%d,accelerationMax:%d,keyboardSupport:!0,arrowScroll:%d,fixedBackground:!0,excluded:""},z=H,L=!1,O=!1,X={x:0,y:0},Y=!1,A=document.documentElement,B=[],N=/^Mac/.test(navigator.platform),K={left:37,up:38,right:39,down:40,spacebar:32,pageup:33,pagedown:34,end:35,home:36},P={37:1,38:1,39:1,40:1},R=[],j=!1,q=Date.now(),V=function(){var e=0;return function(t){return t.uniqueID||(t.uniqueID=e++)}}(),F={};if(window.localStorage&&localStorage.SS_deltaBuffer)try{B=localStorage.SS_deltaBuffer.split(",")}catch(e){}var I,_=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(e,t,o){window.setTimeout(e,o||1e3/60)}}(),W=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver,$=function(){var e;return function(){if(!e){var t=document.createElement("div");t.style.cssText="height:10000px;width:1px;",document.body.appendChild(t);var o=document.body.scrollTop;document.documentElement.scrollTop;window.scrollBy(0,3),e=document.body.scrollTop!=o?document.body:document.documentElement,window.scrollBy(0,-3),document.body.removeChild(t)}return e}}(),U=window.navigator.userAgent,G=/Edge/.test(U),J=/chrome/i.test(U)&&!G,Q=/safari/i.test(U)&&!G,Z=/mobile/i.test(U),ee=/Windows NT 6.1/i.test(U)&&/rv:11/i.test(U),te=Q&&(/Version\/8/i.test(U)||/Version\/9/i.test(U)),oe=(J||Q||ee)&&!Z;"onwheel"in document.createElement("div")?I="wheel":"onmousewheel"in document.createElement("div")&&(I="mousewheel"),I&&oe&&(m(I,r),m("mousedown",i),m("load",t)),k.destroy=o,window.SmoothScrollOptions&&k(window.SmoothScrollOptions),"function"==typeof define&&define.amd?define(function(){return k}):"object"==typeof exports?module.exports=k:window.SmoothScroll=k}();',
				intval( $this->settings['general']['frameRate'] ),
				intval( $this->settings['general']['animationTime'] ),
				intval( $this->settings['general']['stepSize'] ),
				intval( $this->settings['general']['pulseScale'] ),
				intval( $this->settings['general']['pulseNormalize'] ),
				intval( $this->settings['general']['accelerationDelta'] ),
				intval( $this->settings['general']['accelerationMax'] ),
				intval( $this->settings['general']['arrowScroll'] )
			);

			if( empty( $wp_filesystem ) ){
				require_once( ABSPATH .'/wp-admin/includes/file.php' );
				WP_Filesystem();
			}

			$wp_filesystem->put_contents( __DIR__ . '/js/wpmss.min.js', $content, FS_CHMOD_FILE );
		}

		function admin_options_page() {
			if( get_current_screen()->id != $this->plugin_admin_page ) return;
			$this->tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
			if( isset( $_POST['plugin_sent'] ) ){
				$this->settings[ $this->tab ] = $_POST;
				update_option( 'wpmss_settings', $this->settings );
				$this->save_as_js();
			} ?>
			<div class="wrap">
				<h2><?php _e( 'MouseWheel Smooth Scroll', 'wpmss' ); ?></h2>
				<?php if(isset($_POST['plugin_sent'])) echo '<div id="message" class="below-h2 updated"><p>'.__( 'Settings saved.' ).'</p></div>'; ?>
				<form method="post" action="<?php admin_url( 'options-general.php?page=' . basename( __FILE__ ) ); ?>">
					<input type="hidden" name="plugin_sent" value="1"><?php
					$this->plugin_admin_tabs( $this->tab );
					switch( $this->tab ):
						case 'general':
							$this->plugin_general_options();
							break;
						case 'info':
							$this->plugin_info_options();
							break;
					endswitch; ?>
				</form>
			</div><?php
		}
		
		function plugin_general_options(){ ?>
			<input type="hidden" name="timestamp" value="<?php echo time() ?>">
			<h3><?php _e( 'Feel free to experiment with these settings, you can simply reset them to defaults by deleting fields values', 'wpmss' ) ?></h3>
			<table class="form-table">
				<tr>
					<th colspan="2">
						<h3><?php _e( 'Scrolling Core', 'wpmss' ) ?></h3>
					</th>
				</tr>
				<tr>
					<th>
						<label for="q_field_1"><?php _e( 'frameRate', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="frameRate" placeholder="150" value="<?php echo $this->settings[ $this->tab ]['frameRate'] ?>" id="q_field_1">
						[Hz]
					</td>
				</tr>
				<tr>
					<th>
						<label for="q_field_2"><?php _e( 'animationTime', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="animationTime" placeholder="1000" value="<?php echo $this->settings[ $this->tab ]['animationTime'] ?>" id="q_field_2">
						[ms]
					</td>
				</tr>
				<tr>
					<th>
						<label for="q_field_3"><?php _e( 'stepSize', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="stepSize" placeholder="100" value="<?php echo $this->settings[ $this->tab ]['stepSize'] ?>" id="q_field_3">
						[px]
					</td>
				</tr>

				<tr>
					<th colspan="2">
						<h3><?php _e( 'Pulse (less tweakable)<br>ratio of "tail" to "acceleration"', 'wpmss' ) ?></h3>
					</th>
				</tr>
				<tr>
					<th>
						<label for="q_field_4"><?php _e( 'pulseScale', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="pulseScale" placeholder="4" value="<?php echo $this->settings[ $this->tab ]['pulseScale'] ?>" id="q_field_4">
					</td>
				</tr>
				<tr>
					<th>
						<label for="q_field_5"><?php _e( 'pulseNormalize', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="pulseNormalize" placeholder="1" value="<?php echo $this->settings[ $this->tab ]['pulseNormalize'] ?>" id="q_field_5">
					</td>
				</tr>

				<tr>
					<th colspan="2">
						<h3><?php _e( 'Acceleration', 'wpmss' ) ?></h3>
					</th>
				</tr>
				<tr>
					<th>
						<label for="q_field_6"><?php _e( 'accelerationDelta', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="accelerationDelta" placeholder="50" value="<?php echo $this->settings[ $this->tab ]['accelerationDelta'] ?>" id="q_field_6">
					</td>
				</tr>
				<tr>
					<th>
						<label for="q_field_7"><?php _e( 'accelerationMax', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="accelerationMax" placeholder="3" value="<?php echo $this->settings[ $this->tab ]['accelerationMax'] ?>" id="q_field_7">
					</td>
				</tr>

				<tr>
					<th colspan="2">
						<h3><?php _e( 'Keyboard Settings', 'wpmss' ) ?></h3>
					</th>
				</tr>
				<tr>
					<th>
						<label for="q_field_8"><?php _e( 'arrowScroll', 'wpmss' ) ?>:</label> 
					</th>
					<td>
						<input type="number" name="arrowScroll" placeholder="50" value="<?php echo $this->settings[ $this->tab ]['arrowScroll'] ?>" id="q_field_8">
						[px]
					</td>
				</tr>
			</table>
			<p class="submit"><input type="submit" class="button button-primary button-large" value="<?php _e('Save') ?>"></p><?php
		}
		
		function plugin_info_options(){ ?>
			<p><?php _e( 'Any ideas, problems, issues?', 'wpmss' ) ?></p>
			<p>Ing. Jakub Novák</p>
			<p><a href="mailto:info@kubiq.sk" target="_blank">info@kubiq.sk</a></p>
			<p><a href="http://kubiq.sk" target="_blank">https://kubiq.sk</a></p><?php
		}
	}
}

if( class_exists('wpmss') ){ 
	$wpmss = new wpmss();
}