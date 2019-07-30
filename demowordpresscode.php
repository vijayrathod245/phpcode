/* Js file */

function widget_contact_form() {
 jQuery('#franchiseContactCart').addClass('showContactForm');
}

function reCreateList() {
    $ = jQuery;
    $(".fdCartItems").html("");
    $("#contactCartInfo").hide();
    $("#fdCartEmpty2").show();
    var addButtonc = $(".addToCart");
    addButtonc.attr("data-status", "remove");
    addButtonc.removeClass("green_bg");
    addButtonc.html("Add to Request List");
  var select_busi = '';
    $.each(document.cookie.split(/; */), function () {

        var splitCookie = this.split('=');

        if (splitCookie[0].indexOf('fdTitle') > -1) {
            var id = splitCookie[0];
            var name = decodeURIComponent(splitCookie[1]);
            var listCart = '<div id="loop' + id + '" class="fdCartItem wide"><p><input id="chkRemoveloop' + id + '" type="checkbox" name="chkRemoveloop' + id + '" class="remove_item" data-list_id="' + id + '" checked="checked" ><label id="lblRemove" for="chkRemoveloop' + id + '"><i class="glyphicon glyphicon-remove">X</i></label><span class="fdName">' + name + '</span></p></div>';
            $(".fdCartItems").prepend(listCart);
            var parClass = $("#" + id).parents(".fd_listing");
            var addButton = parClass.find(".addToCart");
            addButton.attr("data-status", "add");
            addButton.addClass("green_bg");
            addButton.html("Added to list");
            $("#fdCartEmpty2").hide();
            $("#contactCartInfo").show();
          select_busi += name +"|";
         

        }

    });
  jQuery("input[name='select_businessfranchiseusa']").val(select_busi);
}
jQuery(document).ready(function ($) {
	//alert("Hello");
    reCreateList();
    $(document).on("change", ".remove_item", function () {
        var ischecked = $(this).is(':checked');
        if (!ischecked) {
            var id = $(this).attr("data-list_id");
            Cookies.remove(id);
            reCreateList();
        }
    });
    $(document).on("submit", ".form_class_search_data", function () {
        
        var BookingForm = jQuery(this).serialize();
        jQuery.ajax({
            type: "POST",
            url: MBAjax.ajaxurl,
            data: BookingForm,
            success: function (data) {
               jQuery(".franchise_post_block").html(data);
            }
        });
        return false;
    });
    $(document).on("click", ".addToCart", function () {

        var element = $(this);
        var id = element.attr("data-title_id");
        var status = element.attr("data-status");
        if (status == "add") {
            Cookies.remove(id);
            element.attr("data-status", "remove");
            element.removeClass("green_bg");
            element.html("Add to Request List");
            reCreateList();
        } else {
            element.attr("data-status", "add");
            element.addClass("green_bg");
            element.html("Added to list");

            var name = $("#" + id).html();
            Cookies.set(id, name);
            reCreateList();
        }

    });
});

/* Js file end */

/* Function file */

<?php
/*
  Copyright 2012 DIYthemes, LLC. Patent pending. All rights reserved.
  License: DIYthemes Software License Agreement
  License URI: https://diythemes.com/thesis/rtfm/software-license-agreement/
 */
/**
* Define a constant path to our single template folder
*/
/*define(SINGLE_PATH, TEMPLATEPATH . '/single');*/
require_once(TEMPLATEPATH . '/thesis.php');
global $thesis; // explicit global declaration for WP-CLI compatibility
$thesis = new thesis;
/*
  WARNING: This file will be overwritten during Thesis updates.
  If you wish to add your own PHP customizations, you should use
  your current SkinÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢s custom.php file:

  /wp-content/thesis/skins/your-current-skin/custom.php

  or the Thesis master.php file:

  /wp-content/thesis/master.php

  For reference, the custom.php file applies only to your current Skin, but
  the master.php file applies to your site, regardless of the current Skin.
 */

function wpb_adding_scripts() {
    wp_enqueue_style('theme-override', get_template_directory_uri() . '/css/style.css', array(), '0.1.0', 'all');

    wp_register_script('my_cookie_script', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', array('jquery'), '1.1', true);
    wp_enqueue_script('my_cookie_script');
    wp_register_script('my_bfc_script', get_template_directory_uri() . '/js/businessfranchiseusa_script.js?kk', array('jquery'), '1.1', true);
    wp_localize_script('my_bfc_script', 'MBAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('my_bfc_script');
  
 wp_register_script('my_cookie11_script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.js', array('jquery'), '1.1', true);
  wp_register_script('my_cookie1122_script', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js', array('jquery'), '1.1', true);
 
}

add_action('wp_enqueue_scripts', 'wpb_adding_scripts', 999);

/* CPT */
add_action('init', 'codex_franchise_init');

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_franchise_init() {
    $labels = array(
        'name' => _x('Franchises', 'post type general name', 'your-plugin-textdomain'),
        'singular_name' => _x('Franchise', 'post type singular name', 'your-plugin-textdomain'),
        'menu_name' => _x('Franchises', 'admin menu', 'your-plugin-textdomain'),
        'name_admin_bar' => _x('Franchise', 'add new on admin bar', 'your-plugin-textdomain'),
        'add_new' => _x('Add New', 'franchise', 'your-plugin-textdomain'),
        'add_new_item' => __('Add New Franchise', 'your-plugin-textdomain'),
        'new_item' => __('New Franchise', 'your-plugin-textdomain'),
        'edit_item' => __('Edit Franchise', 'your-plugin-textdomain'),
        'view_item' => __('View Franchise', 'your-plugin-textdomain'),
        'all_items' => __('All Franchises', 'your-plugin-textdomain'),
        'search_items' => __('Search Franchises', 'your-plugin-textdomain'),
        'parent_item_colon' => __('Parent Franchises:', 'your-plugin-textdomain'),
        'not_found' => __('No franchise found.', 'your-plugin-textdomain'),
        'not_found_in_trash' => __('No franchise found in Trash.', 'your-plugin-textdomain')
    );

    $args = array(
        'labels' => $labels, 
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'franchise'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );
register_post_type('franchise', $args);
    // Now register the taxonomy

    register_taxonomy('franchises', array('franchise'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'franchise'),
    ));

    
}

add_filter('widget_text', 'do_shortcode');
add_shortcode('franchise_post', 'all_franchise_post');
add_action('wp_ajax_all_franchise_post', 'all_franchise_post_ajax');
add_action('wp_ajax_nopriv_all_franchise_post', 'all_franchise_post_ajax');

function all_franchise_post_ajax() {
  all_franchise_post($args="");
}
function all_franchise_post($args) {
  //turn on output buffering to capture script output
  
    ob_start();
    //global $post, $paged;
    ?>
    <article>

        <?php
        $argmnt = array(
            'posts_per_page' => -1,
            'post_type' => 'franchise',
          	'order'     => 'DESC',
        );
        $cat_franchise = array();
        if (isset($_POST['franchiseCategory']) && !empty($_POST['franchiseCategory'])) {
            array_push($cat_franchise, $_POST['franchiseCategory']);
        }
        if (isset($_POST['franchiselocation']) && !empty($_POST['franchiselocation'])) {
            array_push($cat_franchise, $_POST['franchiselocation']);
        }
  if (isset($args['franchise_category']) && !empty($args['franchise_category'])) {
    $my_category = get_term_by( 'slug', $args['franchise_category'], 'franchises' );
            array_push($cat_franchise, $my_category->term_id);
  
        }
  
        if (!empty($cat_franchise)) {
            $argmnt['tax_query'][] = array('taxonomy' => 'franchises',
                'field' => 'term_id',
                'terms' => $cat_franchise
            );
        }
	 if (isset($_POST['franchiseCategoryCapital']) && !empty($_POST['franchiseCategoryCapital'])) {	
       $argmnt['meta_query'][] = array(
                'key'       => 'price',
                'compare'   => '<=',
                'value'     => $_POST['franchiseCategoryCapital'],
                'type'      => 'numeric'
            );

     }
  	

        
        $the_query = new WP_Query($argmnt);
        ?>

        <div class="all-category franchise_new_set">
            <div class="category-txt">

                <?php
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        ?>

                        <div class="one-first fd_listing">
                            <div class="franchise-post-img">
                              <a href="<?php echo get_post_permalink(); ?>"> <?php the_post_thumbnail('category-images'); ?></a>
                            </div>
                            <div class="franchise-post-content">
                                <p class="desc"><a href="<?php echo get_post_permalink(); ?>"><span id="fdTitle<?php the_ID(); ?>" class="fdTitle"><?php the_title(); ?></span></a></p>
                                <p><?php echo get_the_excerpt(); ?></p>

                                <div id="requestbtn" style="float: right;"><p class="capital abtest_mincapitalrequired "><span class="capReq">Capital Required: </span><span class="fdCapRequired"><?php echo money_format_set(get_field('price'))?></span></p>
                                    <a class="addToCart" name="hlAddFranchiseToCart_3689" data-title_id="fdTitle<?php the_ID(); ?>" data-status="remove">Add to Request List</a>
                                    <select id="mySelectorozo" style="display: none;"><option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>

        </div>
        <div class="cate-pagination"><?php echo paginate_links($argmnt); ?> </div>
    </article>
    <?php
    wp_reset_postdata();
    wp_reset_query();
   $content = ob_get_clean();
   if (isset($_POST['action']) && !empty($_POST['action'])) {
     echo $content;
          exit;
        }
 

    return $content;
}
add_filter('style_loader_tag', 'myplugin_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'myplugin_remove_type_attr', 10, 2);

function myplugin_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
/* Form Code */
function money_format_set($number) {
setlocale(LC_MONETARY, 'en_US');
return money_format('%(#10n', $number) . "\n";
}
add_shortcode('form_info', 'add_search_form');

function add_search_form($args) {

    //turn on output buffering to capture script output
    ob_start();

    include('filter_form.php');

    $content = ob_get_clean();

    return $content;
}
add_shortcode('widget_contact_form', 'widget_contact_form');

function widget_contact_form($args) {

    //turn on output buffering to capture script output
    ob_start();

   ?>

<div id="franchiseContactCart" class="bootstrap-shim rightWrap fdCartBox wide" style="left: auto;">
<div class="fdCartTitle">
<h2>Franchise Request List</h2>
<p class="fdCartCount"><em>Max 20 Franchises</em></p>

</div>
<div id="fdCartEmpty2" class="fdEmptyCartSubmit fdCartEmpty">
<div class="arrow"><!--   --></div>
Select up to <strong>20 franchises</strong> that you want to learn more about!

</div>
<div class="fdCartContent">
<p class="fdContactCart_selectedFranchiseCount"><span id="lblSelectedFranchiseCount">2</span> Selected Franchise(s)</p>

<div id="ctl00_Content_franchiseSearchResults_FranchiseContactCart_fdCartItems3" class="fdCartItems"></div>
<div id="contactCartInfo" class="fdCartContactInfo">
<div class="fdCartContactInfo_container">[erforms id="2794"]</div>
<div id="fdCartGetMoreInfo">
<div id="fdCartGetMoreInfo">

<a href="JavaScript:void(0)" onclick="widget_contact_form()" id="hlGetMoreInfo" title="Request FREE Info">Request FREE Info</a>
<div class="arrowWrap"></div>
</div>
<div class="arrowWrap"></div>
</div>
</div>
</div>
</div>
<?php

    $content = ob_get_clean();

    return $content;
}

function home_pagecustom() {
/* check to see if homepage. has to happen inside the function */
if (is_single())  {
?>
...Your custom layout goes here...
<?php } }

/* Now we tell Thesis to use the home page custom template */

remove_action('thesis_hook_custom_template', 'thesis_custom_template_sample');
add_action('thesis_hook_custom_template', 'home_pagecustom');


/*function get_custom_post_type_template( $single_template ) {
	global $post;
echo "ffff";
  exit;
  if ( 'franchise' === $post->post_type ) {
		$single_template = dirname( _FILE_ ) . '/single.php';
	}

	return $single_template;
}
add_filter( 'single_template', 'get_custom_post_type_template' );
*/
function franchise_post_btn(){
   ob_start();
  global $post;
  ?>
<div class="fd_listing"> <span id="fdTitle<?php echo $post->ID; ?>" class="fdTitle"><?php echo $post->post_title; ?></span>
                            
                            <div id="requestbtn" style="float: right;">
                                    <a class="addToCart" name="hlAddFranchiseToCart_3689" data-title_id="fdTitle<?php echo $post->ID; ?>" data-status="remove">Add to Request List</a>
                                    
                                </div>
                        </div>
<?php
 $content = ob_get_clean();

    return $content;
}

add_shortcode('franchise_post_btn', 'franchise_post_btn');
?>

/* Function file end */

/ * Custom form  * /

<?php
//print_r($args['franchise_category']);

//print_r($atts);

?>
<div class="elementor-element elementor-element-d6ed046 elementor-widget elementor-widget-text-editor" data-id="d6ed046" data-element_type="widget" data-widget_type="text-editor.default">
   <div class="elementor-widget-container">
      <div class="elementor-text-editor elementor-clearfix">
        
        <style>
.dropbtn {
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
width:97%;

}
.dropbtn1{
	display:none;          
}
.dropdown-content {
  display: none;
  padding:10px;
  background-color: #f1f1f1;
  /*min-width: 160px;*/
  min-width:100%;
  overflow: auto;
  transition: height 3500ms ease-in-out, opacity 2500ms ease-in-out;
  height:auto;
  z-index: 9999;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block; transition: height 3.5s ease-in-out,opacity 2.5s ease-in-out; }
          .hide{
          display:none; }
          
.rotate {

  -moz-transform: rotate(180deg);

  -webkit-transform: rotate(180deg);

  transform: rotate(180deg);

}
          
        
    

</style>
       
       
        <script>
         
         
          function myFunction() {
            //alert('Hello');
              document.getElementById("myDropdown").classList.toggle("show");
          // var v = document.getElementById("p"); 
          //v.classList.add("rotate")
            var element = document.getElementById("p");
   				element.classList.toggle("rotate");
           
            }
            
            // Close the dropdown if the user clicks outside of it
            window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
            
                }
            }
            }
            
         /*function myFunction1() {
            //alert('Hello');
              document.getElementById("about").classList.toggle("show");
          // var v = document.getElementById("p"); 
          //v.classList.add("rotate")
            var element = document.getElementById("p");
   				element.classList.toggle("rotate");
                 var el = document.getElementById(obj);
              el.style.display = 'none';
           
            }
            
            // Close the dropdown if the user clicks outside of it
            window.onclick = function (event) {
            if (!event.target.matches('.dropbtn1')) {
                var dropdowns = document.getElementsByClassName("dropdown-content1");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
            
                }
            }
            }*/
            
         </script> 
       

         <div class="dropdown">
            <button style="background:none; float:left;" onclick="myFunction()"  class="dropbtn">
              <a style="background:none; padding:0 !important" id="franchiseModifyTrigger" class="dropbtn" data-target="#refineSearchOptions" href="javascript:void(0)">
            <i id = "p" class="fa fa-chevron-down"></i> Modify <span class="hidden-phone">Your Search</span>
            </a></button>
            <button style="background:none" onclick="myFunction1()"  class="dropbtn1">
              <a style="background:none; padding:0 !important" id="franchiseModifyTrigger" class="dropbtn" data-target="#refineSearchOptions" href="javascript:void(0)">
            <i id = "p" class="fa fa-chevron-down"></i><span class="hidden-phone">Franchise Info</span>
            </a></button>
           <div id="about" class="dropdown-content">
             <h4>Buy a Franchise in California</h4>
             <p>California became known as the golden state because of the 1848 gold rush, but today any business owner would think it’s called the golden state because of its business-friendly environment. California consistently ranks higher than the national average in terms of percentage of the population that starts a new business. However, for those who are looking to buy a business, not start a new one, it can be a good idea to buy franchises for sale in California.
              With such a long and beautiful coastline where people can vacation and show off their beach bodies, it’s no wonder that tourism and fitness franchises are popular in California. Of course, there are plenty of other franchise categories that thrive in the state, as well.
              Even though buying any business can be daunting, there are some safety nets when choosing to buy a franchise in California. Buyers are able to plug into a successful, existing business model without having to build from scratch. At the same time, they can get the independence often associated with being a small franchise owner. Many times, people find they don’t need a lot of up-front capital or business experience to buy a franchise. The process is often much cheaper than starting a new business, and franchisors are usually happy to train buyers to be able to effectively run their branches. No wonder franchises are more likely to succeed than start-up businesses.
              The path to buying a franchise is pretty clear already, what with California’s lovely weather, scenery, and entrepreneurial spirit, as well as the protective cushion that franchises provide.</p>
           
           </div>
            <form method="post" class="form_class_search_data">
                <input type="hidden" name="action" value="all_franchise_post"/>
               <div id="myDropdown" style="position: relative; overflow: hidden;" class="dropdown-content ">
                  <div id="refineSearchOptions" class="sr-dropdown-content franchise-modify-search" style="position: relative;overflow: hidden;display: block;">
                     <div class="franchise-modify-search_inner">
                        <div class="dropdown">
                           <div class="flexbox">
                              <select name="franchiseCategory" id="" class="ddlCategory franchise-modify-ddl">
                                 <option selected="selected" value="">
                                    All Categories
                                 </option>
                                 <?php
                                //print_r();
                                    $taxonomyName = "franchises";
                                    $franchisesargs = array(
                                        'parent' => 151,
                                        'orderby' => 'slug',
                                        'hide_empty' => false
                                    );
                                    $franchisesterms = get_terms($taxonomyName, $franchisesargs);
                                    
                                    foreach ($franchisesterms as $franchisesterm) {
                                      
                                      if($franchisesterm->slug == $args['franchise_category']){
                                        
                                        echo "<option selected value='" . $franchisesterm->term_id .  "'>$franchisesterm->name</option>";
                                      }else{
                                      
                                         echo "<option value='" . $franchisesterm->term_id .  "'>$franchisesterm->name</option>";
                                      }
                                    }
                                    ?>
                              </select>
                              <select name="franchiselocation" id="" class="ddlStatesclass franchise-modify-ddl">
                                 <option value="">
                                    All US States
                                 </option>
                                 <?php
                                    $locationargs = array(
                                        'parent' => 152,
                                        'orderby' => 'slug',
                                        'hide_empty' => false
                                    );
                                    $locationterms = get_terms($taxonomyName, $locationargs);
                                    
                                    foreach ($locationterms as $locationterm) {
                                        echo "<option value='" . $locationterm->term_id . "'>$locationterm->name</option>";
                                    }
                                    ?>
                              </select>
                            
                              <select name="franchiseCategoryCapital" id="ctl00_Content_franchiseSearchResults_FilterBox_ddlAvailableCapital" class="ddlCapital franchise-modify-ddl no-right-margin">
                                 <option selected="selected" value="">
                                    Capital to Invest
                                 </option>
                            
                                 <option value="25000">
                                    Up to $25,000
                                 </option>
                                 <option value="50000">
                                    Up to $50,000
                                 </option>
                                 <option value="100000">
                                    Up to $100,000
                                 </option>
                                 <option value="250000">
                                    Up to $250,000
                                 </option>
                                 <option value="500000">
                                    Up to $500,000
                                 </option>
                                 <option value="1000000">
                                    Up to $1,000,000
                                 </option>
                                 <option value="5000000">
                                    Up to $5,000,000
                                 </option>
                              </select>
                           </div>
                           <button type="submit" class="btn-cookie-location btn-primary franchise-modify-btn">Search</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

/* Custom form end */