<?php
/*
Plugin Name: Custom Tag Cloud 
Author: Dion Papathanopoulos 
Description: Custom Tag Cloud.
Version:0.1
Text Domain:  Tagcloud
*/			 
		function myHelloWorld_init(){
		  register_sidebar_widget(__('Custom tag Cloud'), 'get_bot');     
		}
		add_action("plugins_loaded", "myHelloWorld_init");
 
		function tag_admin() {
			require_once('admin_4.php');
			require('./wp-blog-header.php');
		}
		
		add_action( 'wp_enqueue_scripts', 'add_my_stylesheet' );
		/**
		 * Enqueue plugin style-file
		 */
		function add_my_stylesheet() {
			wp_register_style( 'prefix-style', plugins_url('tag_cloud.css', __FILE__) );
			wp_enqueue_style( 'prefix-style' );
		}

		function tag_admin_actions() {
			add_options_page("Custom Tag Cloud", "Custom Tag Cloud", 'administrator', "tag_cloud_display_main", "tag_admin");
			
		}
		
		
		function get_bot(){	
		
					mysql_connect(get_option('dbhost'), get_option('dbuser'), get_option('dbpwd')) or
						die("Could not connect: " . mysql_error());
							mysql_select_db(get_option('dbname'));
						// previous version	
						//	$result = mysql_query("SELECT term_id,name FROM wp_terms where term_group = '1'");
							$result = mysql_query("
							SELECT wp_terms.term_id, wp_terms.name, wp_term_taxonomy.count
							FROM wp_terms
							LEFT JOIN wp_term_taxonomy
							ON wp_terms.term_id=wp_term_taxonomy.term_id
							where wp_terms.term_group = '1'");
							$title = '<center><span class="widget_title">Our Places</span></center>';
									echo $title;
							$tag_cloud .= '<div class="tag_cloud" >';
									while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
										$term_id = $row[0];
										$count = $row[2];
										
										switch ($count) {
											case 0: $count_tags = 3; break;
											case 1: $count_tags = 3; break;
											case 2: $count_tags = 3; break;
											case 3: $count_tags = 5; break;
											case 4: $count_tags = 5; break;
											case 5: $count_tags = 5; break;
											
											case 6:  $count_tags = 6; break;
											case 7:  $count_tags = 6; break;
											case 8:  $count_tags= 6; break;
											case 9:  $count_tags = 6; break;
											case 10: $count_tags = 6; break;
											
											case 11:  $count_tags = 7; break;
											case 12:  $count_tags = 7; break;
											case 13:  $count_tags= 7; break;
											case 14:  $count_tags = 7; break;
											case 15:  $count_tags = 7; break;
											
											case 16:  $count_tags = 8; break;
											case 17:  $count_tags = 8; break;
											case 18:  $count_tags= 8; break;
											case 19:  $count_tags = 8; break;
											case 20:  $count_tags = 8; break;
											
											case 21:  $count_tags = 9; break;
											case 22:  $count_tags = 9; break;
											case 23:  $count_tags= 9; break;
											case 24:  $count_tags = 9; break;
											case 25:  $count_tags = 9; break;
											
											case 26:  $count_tags = 10; break;
											case 27:  $count_tags = 10; break;
											case 28:  $count_tags= 11; break;
											case 29:  $count_tags = 11; break;
											case 30:  $count_tags = 11; break;
											
											default:
											   $count_tags = 2;
										}										
										get_taxonomy_id($term_id);				
											$tag_cloud.= '<a href="http://localhost/Machete/?tag='.$row[1].'"class="tagcloud-'.$count_tags.'" title="'.$count.' events">'.$row[1].' </a>';
									}
								$tag_cloud .= '</div>';
							echo $tag_cloud;
							mysql_free_result($result);
				}
		
		function get_taxonomy_id($term_id){
			mysql_connect(get_option('dbhost'), get_option('dbuser'), get_option('dbpwd')) or
						die("Could not connect: " . mysql_error());
							mysql_select_db(get_option('dbname'));
					$result = mysql_query("SELECT term_taxonomy_id from wp_term_taxonomy where term_id =".$term_id);
					while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
						$term_taxonomy_id = $row[0];
					//	printf('test_term_id'.$term_taxonomy_id.'until here');
									$result_2 = mysql_query("SELECT Count(*) FROM wp_term_relationships where term_taxonomy_id =".$term_id);
											while ($row = mysql_fetch_array($result_2, MYSQL_NUM)) {
												$count = $row[0];
												//	printf('test_term_id'.$count.'until here');
														mysql_query("UPDATE wp_term_taxonomy SET count=".$count." WHERE term_taxonomy_id=".$term_taxonomy_id);
														mysql_free_result($result_2);
											}
			//				return $term_id;
						}
				mysql_free_result($result);
			}
				
		add_action('admin_menu', 'tag_admin_actions');	
		add_action('activate_test/custom_tags.php', 'bot_install');
		?>
			
