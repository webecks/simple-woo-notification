<?php defined( 'ABSPATH' ) || exit; ?>

<div class="wrap">
	<h1><?php esc_html_e( 'Cart Popup Settings', 'swcp' ); ?></h1>
	<p class="subsubsub" style="float:none">&nbsp;</p>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="swcp-wrapper">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php esc_html_e( 'Layout', 'swcp' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><?php esc_html_e( 'Layout', 'swcp' ); ?></legend>
							<label>
								<input type="radio" name="layout" value="image_not_bg" <?php checked( $settings['layout'], 'image_not_bg' ); ?>>
								<span><?php esc_html_e( 'Product image within the content', 'swcp' ); ?></span>
							</label>
							<br>
							<label>
								<input type="radio" name="layout" value="image_bg" <?php checked( $settings['layout'], 'image_bg' ); ?>>
								<span><?php esc_html_e( 'Product image as a background', 'swcp' ); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Position', 'swcp' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><?php esc_html_e( 'Position', 'swcp' ); ?></legend>
							<label>
								<input type="radio" name="position" value="top" <?php checked( $settings['position'], 'top' ); ?>>
								<span><?php esc_html_e( 'Top', 'swcp' ); ?></span>
							</label>
							<br>
							<label>
								<input type="radio" name="position" value="bottom" <?php checked( $settings['position'], 'bottom' ); ?>>
								<span><?php esc_html_e( 'Bottom', 'swcp' ); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Close after', 'swcp' ); ?></th>
					<td>
						<input type="number" name="close" value="<?php echo esc_attr( $settings['close'] ); ?>" class="small-text" step="1" min="1">
						<small><?php esc_html_e( 'seconds', 'swcp' ); ?></small>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Display Conditions', 'swcp' ); ?></th>
					<td>
						<select name="pages[]" multiple size="7">
							<option
								value="all"<?php echo in_array( 'all', $settings['pages'], true ) ? ' selected' : ''; ?>
							><?php esc_attr_e( 'All Pages', 'swcp' ); ?></option>
							<option
								value="shop_archive"<?php echo in_array( 'shop_archive', $settings['pages'], true ) ? ' selected' : ''; ?>
							><?php esc_attr_e( 'Shop Archive', 'swcp' ); ?></option>
							<option
								value="shop_categories"<?php echo in_array( 'shop_categories', $settings['pages'], true ) ? ' selected' : ''; ?>
							><?php esc_attr_e( 'Shop Archive Categories', 'swcp' ); ?></option>
							<option
								value="shop_tags"<?php echo in_array( 'shop_tags', $settings['pages'], true ) ? ' selected' : ''; ?>
							><?php esc_attr_e( 'Shop Archive Tags', 'swcp' ); ?></option>
							<option
								value="shop_attribs"<?php echo in_array( 'shop_attribs', $settings['pages'], true ) ? ' selected' : ''; ?>
							><?php esc_attr_e( 'Shop Archive Product Attributes', 'swcp' ); ?></option>
							<option
								value="single_products"<?php echo in_array( 'single_products', $settings['pages'], true ) ? ' selected' : ''; ?>
							><?php esc_attr_e( 'Single Products', 'swcp' ); ?></option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
<?php wp_nonce_field( 'swcp_cart_popup_settings' ); ?>

			<input type="hidden" name="action" value="swcp_cart_popup_settings">
			<button type="submit" class="button button-primary"><?php esc_html_e( 'Save Changes', 'swcp' ); ?></button>
		</p>
	</form>
</div>