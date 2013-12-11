
<?php  
    if($_POST['tag_form'] == 'Y') {  
        //Form data sent  
        $dbhost = $_POST['dbhost'];  
        update_option('dbhost', $dbhost);  
        $dbname = $_POST['dbname'];  
        update_option('dbname', $dbname);  
        $dbuser = $_POST['dbuser'];  
        update_option('dbuser', $dbuser);  
        $dbpwd = $_POST['dbpwd'];  
        update_option('dbpwd', $dbpwd);  
   //     $prod_img_folder = $_POST['oscimp_prod_img_folder'];  
 //       update_option('oscimp_prod_img_folder', $prod_img_folder);  
 //       $store_url = $_POST['oscimp_store_url'];  
 //       update_option('oscimp_store_url', $store_url);  
        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
        <?php  
    } else {  
		$dbhost = get_option('dbhost');  
        $dbname = get_option('dbname');  
        $dbuser = get_option('dbuser');  
        $dbpwd = get_option('dbpwd');  
    }  
?>

	<div class="wrap">
			<?php    echo "<h2>" . __( 'Custom Tag Cloud Display Options', 'oscimp_trdom' ) . "</h2>"; ?>
			<form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="tag_form" value="Y">
				<?php    echo "<h4>" . __( 'Tag Database Settings', 'oscimp_trdom' ) . "</h4>"; ?>
				<p><?php _e("Database host: " ); ?><input type="text" name="dbhost" value="<?php echo $dbhost; ?>" size="20"></p>
				<p><?php _e("Database name: " ); ?><input type="text" name="dbname" value="<?php echo $dbname; ?>" size="20"></p>
				<p><?php _e("Database user: " ); ?><input type="text" name="dbuser" value="<?php echo $dbuser; ?>" size="20"></p>
				<p><?php _e("Database password: " ); ?><input type="password" name="dbpwd" value="<?php echo $dbpwd; ?>" size="20"></p>
				<hr />
				<p class="submit">
				<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
			


