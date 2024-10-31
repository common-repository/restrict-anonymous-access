=== Restrict Anonymous Access ===
Contributors: cleuenberg
Donate link: https://paypal.me/Lnet
Tags: user access, restrict content, capabilities, access-control
Requires at least: 
Tested up to: 6.3.1
Stable tag: 1.2
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Adds a shortcode to restrict content from anonymous users.

== Description ==

This plugin helps you to hide certain parts of your content like a paragraph or an image etc. to logged-out users or users of any other role with just a simple shortcode.

Customize the shortcode in order to display a special note to your users, apply custom CSS classes for your own design or hide the restricted parts completely.

Features:

*   text within shortcode `[member][/member]` is not visible to anonymous users
*   hide content based on user roles (subscriber, contributor, author, editor, admin)
*   restricted text can be replaced with info text box
*   info text can be customized
*	comes with a handy TinyMCE button for quick access

https://youtu.be/n3M4C4aktuU

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/restrict-anonymous-access` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the shortcode `[member][/member]` in any post, page or custom post type in order to hide content from anonymous users. Important: Please use "Classic" block element if you are using Gutenberg.
4. Optional parameters are `showinfo="0"` to hide the info message, `infotext="Your custom info for anons."` and `class="my-custom-css-class"` for adding CSS class to the info box.
5. Use parameter `role="[subscriber|contributor|author|editor|admin|your-custom-role]"`, e.g. `role="editor"` to hide content from users below editor capabilities. 

== Screenshots ==

1. Inserted the shortcode in WordPress content editor.
2. Front-end view with anonymous user, content is hidden and info message shown instead.
3. Front-end view with logged-in user, content is shown.

== Changelog ==

= 1.2 =
* Added compatibility to custom user roles.
* Added HTML support for infotext parameter.

= 1.1 =
* Added optional user role based content restriction.

= 1.0.3 =
* Tested with WordPress 4.8.
* Fixed: Text output with paragraph tag (wpautop).

= 1.0.2 =
* Initial release for WordPress plugin directory.