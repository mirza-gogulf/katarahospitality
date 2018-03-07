<?php
	global $ln_site_details, $wpdb, $blog_id;

	$updated = FALSE;
	$error = FALSE;

	$caro_title = "";
	$caro_sub_title = "";
	$caro_description = "";
	$caro_order = 0;
	$caro_site_id = $blog_id;
	$caro_image = "";

	//pre($_POST);
	//pre($_FILES);

	if ( isset( $_POST['submit'] ) )
    {
    	$_POST = stripslashes_deep( $_POST );

        // SET VALUES FROM FORM
        if(isset($_POST['caro_title']))
            $caro_title = $_POST['caro_title'];

        if(isset($_POST['caro_sub_title']))
            $caro_sub_title = $_POST['caro_sub_title'];

        if(isset($_POST['caro_description']))
            $caro_description = trim($_POST['caro_description']);

        if(isset($_POST['caro_order']))
            $caro_order = $_POST['caro_order'];

        if(isset($_POST['caro_site_id']))
            $caro_site_id = $_POST['caro_site_id'];

        // VALIDATE

        if ( empty( $caro_title ) )
        {
            $caro_title = '';
            $error = 'Please enter your carousel title.';
        }
        elseif ( empty( $caro_description ) )
        {
            $caro_description = "";
            $error = "Please enter the description.";
        }
        elseif ( $caro_order == "" )
        {
            $caro_order = 0;
            $error = "Please enter the display order.";
        }
        elseif ( ! is_numeric( $caro_order ) )
        {
            $error = "The display order must be a number";
        }
		elseif ( ! isset( $_FILES['caro_image']['name'] ) || ( $_FILES['caro_image']['name'] == '' ) )
        {
            $error = 'Please upload an image 535x320.';
        }

        if ( isset( $_FILES['caro_image'] ) && $_FILES['caro_image']['name'] != '' )
        {
            $extension = pathinfo($_FILES['caro_image']['name']);
            $extension = $extension['extension'];

            if ($_FILES['caro_image']['size'] > 10097152 || $_FILES['caro_image']['size'] <= 0)
            {
                $error = "File too large must be under 10 MB";
            }
            elseif($extension=='jpg' || $extension=='jpeg' || $extension=='gif')
            {
            	$size = getimagesize( $_FILES['caro_image']['tmp_name'] );

            	if ( $size[0] > 535 && $size[1] > 320 )
            	{
            		$resize = image_resize( $_FILES['caro_image']['tmp_name'], 535, 320, TRUE, NULL, NULL, 100 );
                	$file = wp_upload_bits( basename( $resize ), NULL, file_get_contents( $resize ) );
            	}
            	else
            	{
            		$file = wp_upload_bits( $_FILES['caro_image']['name'], NULL, file_get_contents( $_FILES['caro_image']['tmp_name'] ) );
            	}

                if ( isset( $file['url'] ) && $file['url'] != '' )
                {
                    $caro_image = $file['url'];
                }
                else
                {
                    $error = 'There was an error uploading your file';
                }
            }
            else
            {
                $error = "File either needs to be a JPG (.jpg, .jpeg) or a GIF (.gif)";
            }
        }

        if ( ! $error )
        {
        	$caro = array(
        		'caro_title' => $caro_title,
				'caro_sub_title' => $caro_sub_title,
				'caro_description' => $caro_description,
				'caro_order' => (int) $caro_order,
				'caro_site_id' => $caro_site_id,
				'caro_image' => $caro_image,
				'caro_datetime' => date( 'Y-m-d H:i:s' )
        	);

            global $wpdb;
            $wpdb->insert( 'kat_carousel', $caro );

            // RESET VALUES

            $url = admin_url( "admin.php?page=carousels" );
        	redirect($url);
        	exit;
        }
    }
?>
<div class="wrap" id="ad-manager">
	<div class="icon32" id="icon-themes"><br/>
	</div>
	<h2>Add New Carousel</h2>
		<div class="add-carousels">
			
			<?php if($updated) { ?>
				<div id="message" class="success fade">
					<p>Carousel has been added.</p>
				</div>
			<?php } ?>

			<?php if ( $error ) { ?>
				<div id="message" class="error fade" style="width:39.5em;">
					<p><?php echo $error; ?></p>
				</div>
			<?php } ?>

			<form action="" method="post" enctype="multipart/form-data">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for="caro_title">Title</label>
							</th>
							<td>
								<input name="caro_title" id="caro_title" class="regular-text" type="text" value="<?php echo $caro_title; ?>" />
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label for="caro_sub_title">Sub Title</label>
							</th>
							<td>
								<textarea name="caro_sub_title" id="caro_sub_title" cols="44" rows="2"><?php echo $caro_sub_title; ?></textarea>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label for="caro_description">Description</label>
							</th>
							<td>
								<textarea name="caro_description" id="caro_description" cols="44" rows="5"><?php echo $caro_description; ?></textarea>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label for="caro_order">Display Order</label>
							</th>
							<td>
								<input name="caro_order" id="caro_order" class="regular-text" type="text" value="<?php echo $caro_order; ?>" />
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label for="caro_image">Image ( 535x320 )</label>
							</th>
							<td>
								<input type="file" name="caro_image" id="caro_image" value="" />
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label for="caro_site_id">Site</label>
							</th>
							<td>
								
								<select id="caro_site_id" name="caro_site_id">


									<?php foreach( $ln_site_details as $site ) : ?>
										<option value="<?php echo $site->blog_id; ?>" <?php if ( $site->blog_id == $caro_site_id ) echo 'selected="selected"'; ?>><?php echo $site->blogname; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				
				
				<input type="hidden" name="action" value="add_carousel" />
				<p class="submit">
					<input type="submit" value="Save Carousel" class="button-primary" name="submit"/>
				</p>
			</form>
		</div>
</div>
<br class="clear"/>
<div class="clear">&nbsp;</div>