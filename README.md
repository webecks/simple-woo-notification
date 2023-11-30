# WooCommerce Add to Cart Notification Popup Plugin

## Description

The WooCommerce Add to Cart Notification Popup plugin is designed to enhance the shopping experience on your WooCommerce-powered online store. This lightweight plugin provides immediate feedback to customers when they add items to their cart by displaying a customizable notification popup.

With seamless integration across all themes, this plugin ensures that users are aware of their cart actions without disrupting the shopping process. The intuitive admin panel allows for easy customization of the popup's appearance and behavior, making it a versatile tool for any WooCommerce store.

## Features

- **Custom Admin Page**: Easily configure the plugin settings from a dedicated admin page within your WordPress dashboard.
- **Flexible Layout Options**:
  - Display the product image within the popup content on the left side.
  - Use the product image as the popup background.
- **Display Position**: Choose to display the notification popup at the top or bottom of the page.
- **Auto Close Functionality**: Set a custom duration for the popup to close automatically after a certain number of seconds.
- **Display Conditions**: Fine-tune where the popup appears with multiple select options, including:
  - All pages
  - Shop Archive
  - Shop Archive Categories (product categories)
  - Shop Archive Tags (product tags)
  - Shop Archive Product Attributes
  - Single Products
- **Filter for Customization**: Developers can further customize the 'Close After (seconds)' option with a custom PHP snippet via a provided filter.

## Installation

1. Download the plugin zip file.
2. Go to your WordPress Dashboard and navigate to `Plugins` > `Add New`.
3. Click on `Upload Plugin` and choose the downloaded zip file.
4. Activate the plugin after the installation completes.

## Configuration

After installation, configure the plugin by following these steps:

1. Navigate to the custom admin page added to your WordPress dashboard by the plugin.
2. Adjust the layout options to fit your desired popup style.
3. Set the display position to either the top or bottom of the page.
4. Define the duration for the popup to auto-close in seconds.
5. Choose the display conditions to specify on which pages the popup should appear.
6. Save your changes, and the plugin will start working with the defined settings.

## Screenshot
![image](https://github.com/webecks/simple-woo-notification/assets/18439793/a0b5737e-b698-4a1a-a377-1b24840af1ef)


## Usage

Once configured, the plugin will automatically display a notification popup whenever a customer adds a product to their cart. The popup will show according to the defined settings without any additional actions required.

## Custom PHP Snippet Filter

For developers looking to introduce custom behavior, the plugin provides a filter to change the auto-close duration programmatically. Add a custom PHP snippet to your theme's `functions.php` file or a site-specific plugin:

```php
add_filter('woocommerce_add_to_cart_notification_popup_auto_close_seconds', 'custom_auto_close_seconds');

function custom_auto_close_seconds($seconds) {
    // Set your custom duration in seconds
    return 10; // Example: close after 10 seconds
}
```

## Support

For support, please [open an issue](https://github.com/your-username/woocommerce-add-to-cart-notification-popup/issues) on GitHub and describe the problem you are facing in detail.

## Contributions

Contributions are welcome! If you would like to contribute, please fork the repository and submit a pull request with your proposed changes.

## License

The WooCommerce Add to Cart Notification Popup plugin is open-sourced software licensed under the [GPLv2 license](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html).

Remember to replace `your-username` with your actual GitHub username in the support section's link.
