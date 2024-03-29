<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ACStarter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acstarter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }

	$browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

	return $classes;
}
add_filter( 'body_class', 'acstarter_body_classes' );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}


function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


/* GENERATE SITEMAP */
function generate_sitemap($menuName='top-menu',$pageWithCats=null) {
    global $wpdb;
    $lists = array();
    $menus = wp_get_nav_menu_items($menuName);
    $menu_orders = array();
    $menu_with_children = array();
    $navi_order = array();
    $custom_navs = array();
    $custom_nav_items = array();
    $is_child_of_custom_nav = array();

    if($menus) {
        $i=0;
        foreach($menus as $m) {
            $page_id = $m->object_id;
            $menu_title = $m->title;
            $page_url = $m->url;
            $post_parent = $m->post_parent;
            $post_name = $m->post_name;
            $nav_type = $m->type;
            $submenu = array();
            $navi_order[] = $page_id;
            $menu_item_parent = $m->menu_item_parent;

            if($nav_type=='custom') {
                $custom_nav_items[$page_id] = $m;
            }

            if($menu_item_parent>0) {
                if( $info = get_menu_data($menuName,$menu_item_parent) ) {
                    $info_nav_type = $info->type;
                    $lists[$menu_item_parent]['parent_id'] = $menu_item_parent;
                    $lists[$menu_item_parent]['parent_title'] = $info->title;
                    $lists[$menu_item_parent]['parent_url'] = $info->url;
                    $lists[$menu_item_parent]['children'][] = array(
                                    'id'=>$page_id,
                                    'title'=>$menu_title,
                                    'url'=>$page_url
                                );
                    if($info_nav_type=='custom') {
                        $is_child_of_custom_nav[$page_id] = $m;
                    }
                }
                
            } else {
                if($nav_type=='custom') {
                    $lists[$page_id]['parent_id'] = $page_id;
                    $lists[$page_id]['parent_title'] = $menu_title;
                    $lists[$page_id]['parent_url'] = $page_url;
                }
            } 

            if($post_parent) {
                $submenu = array(
                        'id'=>$page_id,
                        'title'=>$menu_title,
                        'url'=>$page_url
                    );
                $menu_with_children[$post_parent][$page_id] = $submenu;
            } else {
                $menu_orders[$page_id] = $menu_title;
            } 
            
            $i++;
        }
    }  

    
    $results = $wpdb->get_results( "SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent=0 ORDER BY post_title ASC", OBJECT );
    $childPages = $wpdb->get_results( "SELECT ID,post_title,post_parent as parent_id FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent>0 ORDER BY post_title ASC", OBJECT );
    $childrenList = array();
    $childrenAll = array();

    /* child pages */
    if($childPages) {
        foreach($childPages as $cp) {
            $pId = $cp->parent_id;
            $iD = $cp->ID;
            $childrenAll[$iD] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($iD)
                            );
            $childrenList[$pId][] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($cp->ID)
                            );
        }
    }

    

    if($results) {
        foreach($results as $row) {
            $id = $row->ID;
            $page_title = $row->post_title;
            $page_link = get_permalink($id);
        
            if($menu_orders) {
                $first_menu = array_values($menu_orders)[0];
                if($page_title=='Homepage' || $page_title=='Home') {
                    $page_title = $first_menu;
                }
                if(array_key_exists($id,$menu_orders)) {
                    $page_title = $menu_orders[$id];
                }
            }

            $lists[$id]['parent_id'] = $id;
            $lists[$id]['parent_title'] = $page_title;
            $lists[$id]['parent_url'] = $page_link;
            
            if($menu_with_children) {

                $ii_childrens = array();
                if(array_key_exists($id,$menu_with_children)) {
                    $ii_childrens = $menu_with_children[$id];
                    $lists[$id]['children'] = $ii_childrens;
                }

                /* Show children page even if does not exist on Menu dropdown */
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $cc_children = $childrenList[$id];
                    $exist_children = $lists[$id]['children'];
                    
                    foreach($cc_children as $cd) {
                        $x_id = $cd['id'];
                        if(!array_key_exists($x_id, $ii_childrens)) {
                            $addon[$x_id] = $cd;
                            $exist_children[$x_id] = $cd;
                        }
                    } 

                    $lists[$id]['children'] = $exist_children;
                }

            } else {
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $c_obj = $childrenList[$id];
                    $lists[$id]['children'] = $c_obj;
                }
            }


            if($pageWithCats) {
                foreach($pageWithCats as $p) {
                    $pageid = $p['id'];
                    $taxo = (isset($p['taxonomy']) && $p['taxonomy']) ? $p['taxonomy'] : '';
                    $post_type = (isset($p['post_type']) && $p['post_type']) ? $p['post_type'] : '';
                    if($pageid==$id) {
                        if($taxo) {
                            $o_terms = get_terms( array(
                                'taxonomy' => $taxo,
                                'hide_empty' => true,
                            ) );
                            if($o_terms){
                                foreach ($o_terms as $t) {
                                    $term_id = $t->term_id;
                                    $term_name = $t->name;
                                }
                                $lists[$id]['categories'] = $o_terms;
                            }
                        }
                        if($post_type) {
                            $args = array(
                                'posts_per_page'    => -1,
                                'post_type'         => $post_type,
                                'post_status'       => 'publish'  
                            );
                            $p_posts = get_posts($args);
                            if($p_posts) {
                                $p_children = array();
                                foreach($p_posts as $pp) {
                                    $p_children[] = array(
                                            'title'=>$pp->post_title,
                                            'url'=> get_permalink($pp->ID)
                                        );
                                }
                                $lists[$id]['children'] = $p_children;
                            }
                        }
                    }
                }
            }

        }   
    }

    if($lists && $custom_nav_items) {
        $the_meu_items = sort_array_items($lists, 'parent_title','ASC'); 
    } else {
        $the_meu_items = $list;
    }

    if($is_child_of_custom_nav) {
        $new_items = array();
        if($the_meu_items) {
            foreach($the_meu_items as $a) {
                $p_id = $a['parent_id'];
                if( !array_key_exists($p_id, $is_child_of_custom_nav) ) {
                    $new_items[] = $a;
                }
            }
        }
        return $new_items;  
    } else {
        return $the_meu_items;  
    }
    

    

}

function get_menu_data($menuName,$object_id) {
    $data = '';
    if($menuName && $object_id) {
        $menu_items = wp_get_nav_menu_items($menuName);
        if($menu_items) {
            foreach($menu_items as $m) {
                $o_id = $m->object_id;
                if($o_id==$object_id) {
                    $data = $m;
                    break;
                }
            }
        }
    }
    return $data;
}

function title_formatter($string) {
    if($string) {
        $parts = explode(' ',trim($string));
        $count_str = count($parts);
        $offset = ceil($count_str/2);
        $row_title = '<span>';
        $i=1; foreach($parts as $a) {
            $comma = ($i>1) ? ' ' : '';
            if($i<=$offset) {
                $row_title .= $comma . $a;
                if($i==$offset) {
                    $row_title .= '</span>';
                }
            } else {
                $row_title .= $comma . $a;
            }
            $i++;
        }
        $row_title = trim($row_title);
        $row_title = preg_replace('/\s+/', ' ', $row_title);
    } else {
        $row_title = '';
    }
    return $row_title;
}


function shortenText($string, $limit, $break = ".", $pad = "...") {
    if (strlen($string) <= $limit) return $string;
    
    if (false !== ($max = strpos($string, $break, $limit))) {
         
        if ($max < strlen($string) - 1) {
            
            $string = substr($string, 0, $max) . $pad;
            
        }
        
    }
    
    return $string;
}

/* Fixed Gravity Form Conflict Js */
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function get_page_id_by_template($fileName) {
    $page_id = 0;
    if($fileName) {
        $pages = get_pages(array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => $fileName.'.php'
        ));

        if($pages) {
            $row = $pages[0];
            $page_id = $row->ID;
        }
    }
    return $page_id;
}

function string_cleaner($str) {
    if($str) {
        $str = str_replace(' ', '', $str); 
        $str = preg_replace('/\s+/', '', $str);
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
        $str = strtolower($str);
        $str = trim($str);
        return $str;
    }
}


function sort_array_items($array, $key, $sort='DESC') {
    $sorter=array();
    $ret=array();
    $items = array();

    foreach($array as $k=>$v) {
        $str = string_cleaner($v[$key]);
        $index = $str.'_'.$k;
        $sorter[$index] = $v;
    }

    if($sort=='DESC') {
        krsort($sorter);
    } else {
        ksort($sorter);
    }

    foreach($sorter as $key=>$val) {
        $parts = explode('_',$key);
        $n = $parts[1];
        $items[$n] = $val;
    }
    return $items;
}


function format_phone_number($string) {
    if(empty($string)) return '';
    $append = '';
    if (strpos($string, '+') !== false) {
        $append = '+';
    }
    $string = preg_replace("/[^0-9]/", "", $string );
    $string = preg_replace('/\s+/', '', $string);
    return $append.$string;
}

function get_instagram_setup() {
    global $wpdb;
    $result = $wpdb->get_row( "SELECT option_value FROM $wpdb->options WHERE option_name = 'sb_instagram_settings'" );
    if($result) {
        $option = ($result->option_value) ? @unserialize($result->option_value) : false;
    } else {
        $option = '';
    }
    return $option;
}

function get_the_page_id($slug) {
    global $wpdb;
    $result = $wpdb->get_row( "SELECT ID FROM $wpdb->posts WHERE post_name = '".$slug."' AND post_status='publish'" );
    return ($result) ? $result->ID : 0;
}

function extract_emails_from($string){
  preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
  return $matches[0];
}

function email_obfuscator($string) {
    $output = '';
    if($string) {
        $emails_matched = ($string) ? extract_emails_from($string) : '';
        if($emails_matched) {
            foreach($emails_matched as $em) {
                $encrypted = antispambot($em,1);
                $replace = 'mailto:'.$em;
                $new_mailto = 'mailto:'.$encrypted;
                $string = str_replace($replace, $new_mailto, $string);
                $rep2 = $em.'</a>';
                $new2 = antispambot($em).'</a>';
                $string = str_replace($rep2, $new2, $string);
            }
        }
        $output = apply_filters('the_content',$string);
    }
    return $output;
}

function parse_external_url( $url = '', $internal_class = 'internal-link', $external_class = 'external-link') {

    $url = trim($url);

    // Abort if parameter URL is empty
    if( empty($url) ) {
        return false;
    }

    //$home_url = parse_url( $_SERVER['HTTP_HOST'] );     
    $home_url = parse_url( home_url() );  // Works for WordPress

    $target = '_self';
    $class = $internal_class;

    if( $url!='#' ) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {

            $link_url = parse_url( $url );

            // Decide on target
            if( empty($link_url['host']) ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } elseif( $link_url['host'] == $home_url['host'] ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } else {
                // Is an external link
                $target = '_blank';
                $class = $external_class;
            }
        } 
    }

    // Return array
    $output = array(
        'class'     => $class,
        'target'    => $target,
        'url'       => $url
    );

    return $output;
}

/* Blog Posts */
function get_post_blog_posts($e) {
    $content = '';
    $px1 = get_bloginfo('template_url') . '/images/px.png';
    $px2 = get_bloginfo('template_url') . '/images/px2.png';
    
    if(!$e) return false;

    $postId = $e->ID;
    $name = $e->post_title;
    $thumbId = get_post_thumbnail_id( $postId );
    $photo = wp_get_attachment_image_src($thumbId,'large');
    $bg = ($photo) ? ' style="background-image:url('.$photo[0].')"':'';
    $authorId = $e->post_author;

    $excerpt = get_the_content($postId);
    $excerpt = ($excerpt) ? strip_tags($excerpt) : '';
    $excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
    $pagelink = get_permalink($postId);
    $date = $e->post_date;
    $postdate = ($date) ? date('F j, Y',strtotime($date)) : ''; 

    $author = get_the_author($postId);
    $author_fullname = ($author) ? ucwords($author) : ''; 
    $author_firstname = get_the_author_meta('first_name',$authorId);
    $author_lastname = get_the_author_meta('last_name',$authorId);
    $fname =  array($author_firstname,$author_lastname);
    if( $fname && array_filter($fname) ) {
        $author_name = implode(" ", array_filter($fname) );
        $author_fullname = ucwords($author_name);
    }
    $teaminfo = get_field('teaminfo','user_' . $authorId);
    $disable_author = get_field('disable_link_to_author', 'user_' . $authorId );
    if($teaminfo) {
        $authorFull = $teaminfo->post_title;
        $bio_page = get_permalink($teaminfo->ID) . '#bio';
        
        // echo $disable_author;
        if( $disable_author == 'yes' ) {
            $author_fullname = $authorFull;
        } else {
            $author_fullname = '<a href="'.$bio_page.'">'.$authorFull.'</a>';
        }
    }

    ob_start(); ?>
    <div class="info animated fadeIn wow">
        <div class="pad">
            <div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
                <img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
            </div>
            <h3 class="posttitle"><?php echo $name; ?></h3>
            <?php if ( $author_fullname || $postdate ) { ?>
                <div class="author nt">
                    <?php if ($author_fullname) { ?>
                        <div class="dt">
                            Posted by: <strong style="text-transform: capitalize;"><?php echo $author_fullname ?></strong>
                        </div>
                    <?php } ?>
                    <?php if ($postdate) { ?>
                        <!-- <div class="dt">
                            on <span><?php //echo $postdate ?></span>
                        </div> -->
                    <?php } ?>
                </div>
            <?php } ?>
            
            <?php if ($excerpt) { ?>
            <p class="excerpt"><?php echo $excerpt ?></p>   
            <?php } ?>

            <div class="buttondiv">
                <a href="<?php echo $pagelink ?>#info">Read More</a>
            </div>
        </div>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

/* Newsletter Entries */
function get_post_newsletter_entries($e) {
    $content = '';
    $px1 = get_bloginfo('template_url') . '/images/px.png';
    $px2 = get_bloginfo('template_url') . '/images/px2.png';
    
    if(!$e) return false;

    $postId = $e->ID;
    $name = $e->post_title;
    $photo = get_field('image',$postId);
    $bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
    $author = get_the_author($postId);
    $excerpt = $e->post_content;
    $excerpt = ($excerpt) ? strip_tags($excerpt) : '';
    $excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
    $pagelink = get_permalink($postId);
    $issuedNum = get_field('issue',$postId);
    $issuedDate = get_field('date',$postId);

    ob_start(); ?>
    <div class="info animated fadeIn wow">
        <div class="pad">
            <div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
                <img src="<?php echo $px1 ?>" alt="" aria-hidden="true">
            </div>
            <h3 class="posttitle"><?php echo $name; ?></h3>
            <div class="author">
                <?php if ($issuedNum) { ?>
                    <div class="dt">
                        Issued #: <strong><?php echo $issuedNum ?></strong>
                    </div>
                <?php } ?>
                <?php if ($issuedDate) { ?>
                    <div class="dt">
                        Date: <span><?php echo $issuedDate ?></span>
                    </div>
                <?php } ?>
            </div>  
            <div class="buttondiv">
                <a href="<?php echo $pagelink ?>#info">Read More</a>
            </div>
        </div>
    </div>  
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

/* Press Room Posts */
function get_press_room_posts($e) {
    $content = '';
    $px1 = get_bloginfo('template_url') . '/images/px.png';
    $px2 = get_bloginfo('template_url') . '/images/px2.png';
    
    if(!$e) return false;

    $postId = $e->ID;
    $name = $e->post_title;
    $authorId = $e->post_author;
    $user = get_userdata($authorId);
    $author = ( isset($user->data->display_name) && $user->data->display_name ) ? $user->data->display_name : ''; 
    $excerpt = $e->post_content;
    $excerpt = ($excerpt) ? strip_tags($excerpt) : '';
    $excerpt = ($excerpt) ? shortenText($excerpt,50,' ','...') : '';
    $pagelink = get_permalink($postId);
    $date = $e->post_date;
    $postdate = ($date) ? date('F j, Y',strtotime($date)) : '';
    ob_start(); ?>
    <div class="info animated fadeIn wow">
        <div class="pad">
            <h3 class="posttitle"><?php echo $name; ?></h3>
            <?php if ( $postdate ) { ?>
                <div class="author nt">
                    <?php if ($postdate) { ?>
                        <div class="dt">
                            on <span><?php echo $postdate ?></span>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <p class="excerpt"><?php echo $excerpt ?></p>
            <div class="buttondiv">
                <a href="<?php echo $pagelink ?>#info">Read More</a>
            </div>
        </div>
    </div>  
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}


/* Press Room Posts */
function get_team_posts($e) {
    $content = '';
    $px1 = get_bloginfo('template_url') . '/images/px.png';
    $px2 = get_bloginfo('template_url') . '/images/px2.png';
    
    if(!$e) return false;

    $postId = $e->ID;
    $name = $e->post_title;
    $photo = get_field('image',$postId);
    $bg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
    $jobtitle = get_field('title',$postId);
    $excerpt = get_field('experience',$postId);
    $excerpt = ($excerpt) ? strip_tags($excerpt) : '';
    $excerpt = ($excerpt) ? shortenText($excerpt,120,' ',' [...]') : '';
    $pagelink = get_permalink($postId);
    ob_start(); ?>
    <div class="info">
        <div class="pad">
            <div class="photo <?php echo ($photo) ? 'yes':'noimage'?>"<?php echo $bg ?>>
                <img src="<?php echo $px2 ?>" alt="" aria-hidden="true">
            </div>
            <h3 class="name js-titles"><?php echo $name; ?></h3>
            <?php if ($jobtitle) { ?>
            <p class="jobtitle js-blocks"><?php echo $jobtitle ?></p> 
            <?php } ?>
            <?php if ($excerpt) { ?>
            <!-- <p class="excerpt"><?php //echo $excerpt ?></p> -->   
            

            <div class="buttondiv ">
                <a href="<?php echo $pagelink ?>#info">Read Bio</a>
            </div>
            <?php } ?>
        </div>
    </div>  
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
