### V 1.26
  * Fixed "About" section not showing up in the customizer
  * Moved some WP Default panels to the 'Theme Options' Panel.

### V 1.25
   * Fixed translation issues in search.php
   * Updated Grunt process for building .POT files to include POEedit headers in our .POT file as well as add team translator support links

### V 1.24
   * Fixed preloader script from loading in the customizer window (black screen of death should be gone now)
   * Updated languages/.pot file
   * Fixed two more non-internationalized strings in search.php
   * Re-generated all .min, .min.js.map files with, added banner type comments
   * Updated Gruntfile.js with more tasks (you can get this from the mirror GitHub account)

### V 1.23
    * Removed from inc/custom-header.php the fallback get_custom_header(); it's not needed since WordPress 3.4 (it's in core)
    * Properly prefixed widgets/*.php with {theme_slug}
    * Added wp_reset_postdata() && wp_reset_query() to widgets/widget-latest-posts.php
    * Fixed a small bug that was affecting certain PHP files; sprintf function was missing the %s in 2 cases.
    * get_template_part('sections/section', 'header'); was missing from 404.php, added it now
    * Changed the way the shop link is added by the pixova_lite_fallback_cb(); It only gets added now IF WooCommerce is already active (as a plugin).

### V1.22
    * Increased number of possible testimonials from 2 -> 5
    * Increased number of possible team members from 2 -> 5
    * Added function to fix responsive videos
    * Replaced in-lined comments fetching code with function; visible in inc/extras.php (pixova_lite_get_number_of_comments)
    * Renamed customizer panel from General Options to Theme Options
    * Found two more non-internationalized strings

### V1.21
    * Two strings weren't translated.

### V1.20
    * Made all strings translatable in the theme
    * Fixed a few strings that weren't available for translation.

### V1.19
    * Made TGMPA plugin install notices to be dismissable
    * Updated QueryLoader2 jQuery plugin from v2.0 to v.3.0.16
    * Fixed a small JS error
    * Fallback widget titles are now translatable
    * Fixed a few strings that were hardcoded and not available for translation
    * Header was missing from author.php archive
    * Prefixed panel names in inc/customizer.php with {theme_slug}

### V1.18
    * Moved wp_footer() before </body> tag
    * Added comments form on pages

### V.17
     * Removed /plugins/ folder; now CF7 is installed through TGMPA from WP repo
     * Added proper link to documentation
     * Removed FlickR widget because it's plugin territory.
     * Removed customizer setting that allowed an user to set how many posts should be displayed in the latest-news.php section, bypassing the core get_option('posts_per_page') option
     * Replaced all images with CC0 GPL ones
     * Updated readme.txt
     * Added editor-style.min.css

### V1.16
    * Removed Oxygen Google Fonts (was only being used on some headings)
    * Added editor styles for certain elements (headings, paragraphs & blockquotes)
    * Added Custom Google Fonts in Editor
    * Created a new folder -> /accesibility/; Laying the ground work for making this theme accesibility-ready
    * Added some backwards compatibility functions (functions taken directly from twentyfifteen) that won't allow the customizer to run OR the theme to be activated IF the WP version installed is < 4.1
    * Fixed a small bug by which Google Fonts weren't protocol less
    * Added doc-block PHP comments
    * Added a function to dequeue the site preloader when we're in the customizer

### V 1.15
    * Fixed a small bug where the page title might not show up if WooCommerce wasn't installed
    * Fixed a even smaller bug with a typo in a variable.
    * Updated search template

### V 1.14
    * Updated readme.txt with link to header image & attribution
    * Removed up-selling messages on the homepage (up-sell is now only done in the admin area)
    * Removed some unused image sizes
    * Prefixed EVERYTHING
    * Minified CSS
    * Optimised images
    * Minified JS
    * Added active_callback in the customizer for the CF7 section (section isn't displayed anymore if the plugin isn't active); The user can choose to NOT display the contact area.

### V 1.13
	* Updated Screenshot 

### V 1.12    
    * Added author info box (end of the post)
    * Added author archive type (author.php)
    * Fixed a few CSS bugs
    * Updated readme
    * Linked the author name with the author archive

### V 1.11
    * Added sanitization callbacks for custom controls used in the front-end (files affected: sections/* && widgets/*)
    * Removed wp_link_pages from home, index, archive, page-templates/sidebar-left, page-templates/sidebar-right, content-single & 404 files (replaced with custom pagination function)
    * Fixed a small bug in inc/customizer.php that was causing the pie chart headings to display all in one panel (instead of each in their own panels)
    * Fixed a small bug with: pixova_litechild_manage_woocommerce_styles() * now it only fires IF WooCommerce is installed & active
    * Moved the WooCommerce stylesheet rules into it's own stylesheet (layout/css/pixova-woocommerce.css); only gets loaded if WooCommerce is installed & active
    * Added /shop/ link to the pixova_litefallback_cb function
    * Made translatable a handful of hard-coded text strings

### v 1.10    
    * Updated text strings to advertise the inclusion of WooCommerce Support
        ** affected files: customizer.php & sections/section-intro.php
    * Updated all links to the premium version of the theme to include the 10% discount coupon.
    * Updated changelog for previous version; forgot to mention the addition of two new page templates: left / right sidebar pages


### V 1.0.9
    * Changed text domain from macho-lite to pixova-lite.
    * Updated /languages/pixova-lite.pot & /languages/pixova-lite.mo to include all strings.
    * Updated theme screenshot * using a better cropped version.
    * Added blank index.html files in each theme folder ( to prevent direct access ).
    * Added CSS comments in rtl.css.
    * Updated readme with Google Fonts licensing.
    * Updated layout/scripts.js to add animations for team, news & about sections.
    * Updated layout/scripts.js with isMobile() function.
    * Updated layout/scripts.js * parallax is now enabled only when user is not visiting from a mobile device.
    * Updated sections/section-about.php * depending on the number of charts displayed, the mark-up changes to always have the pie charts centered.
    * Updated sections/section-works.php * depending on the number of projects displayed, the mark-up changes to always have the projects centered.
    * Updated sections/section-news.php * depending on the number of news displayed, the mark-up changes to always have the news centered.
    * Updated sections/section-testimonials.php * depending on the number of testimonials, the mark-up changes. If there's only one testimonial, we're not adding the mark-up required for the carousel (the JS script that builds the carousel, first looks for the css class * if it finds it, it fires).
    * Added fall-back for the quick nav widget (footer.php).
    * Pagination was missing from archive.php
    * Replaced code that was outputting only category name with WP default code that outputs the category list elements & links to them.
    * Updated sections/header-single.php and replaced old code that was only displaying category name / number of comments with links on them; now they're linked properly.
    * Added default fall-back for blog sidebar widgets, in case there's no widgets added to it (initial WP / theme install)
    * Updated widgets/widget-about-sm, widgets/widget-flickr, widgets/widget-latest-posts & widgets-widget-social-icons with new PHP 5 constructs.
    * Updated widgets/widget-latest-posts code (removed unused variables / calls); added proper styling in style.css.
    * Updated HTML mark-up & added proper closing comments (comments for closing mark-up tags: divs, spans, p, etc).
    * Added single post navigation: you can now navigate between posts directly from the single view.
    * Searched & Replaced all text-domains strings -> from 'macho' to -> 'pixova-lite'.
    * Added sanitization / escaping functions to bundled widgets (all widgets have been affected by this change).
    * Added WooCommerce Support
    * Updated instructions.txt with WooCommerce support

### V 1.0.8 
    * Removed some extra code from customizer.php (some files were being loaded for nothing)
    * Renamed pixova_literegisters to pixova_litecustomizer_js_load
    * Moved & improved the title_tag fallback function (from functions.php to extras.php).
    * Split-up the sections/section-header.php into two different files: section-header.php & section-intro.php, now when the visibility for section intro is turned off, you still get to keep your nav menu.
    * Fixed a bug with the nav menu not showing up on select pages.
    * Fixed a bug where the logo wasn't linking properly & the image logo string wasn't present in all header files.
    * Added pagination for index.php, search.pgp & tag.php files.
    * Updated content.php mark-up.
    * Updated customizer.php with improver up-selling controls.
    * Updated "upgrade now" link to feature a 10% discount on theme purchase.
    * Added pixova-pro.css for customizer styling (file in enqueued in customizer.php * end of file).
    * Updated TGMPA from 2.5.1 to 2.5.2
    * Removed template-tags.php and moved functions to inc/extras.php
    
### V 1.0.7
    * Changed header-bg.jpg image to match WordPress.org theme license image usage (all images must be CC0 licensed)
    * Changed layout/images/team/ images for the same reason as above.
    * Changed layout/images/testimonials/ images for the same reason as above.
    * Changed layout/images/recent-works/recent-works-2-270x426.jpg for the same reason as above
    * Renamed layout/images/recent-works/ images to recent-works-1, 2, 3 & 4 
        * Affected files by this change: customizer.php & sections/section-works.php
    * Updated readme.txt with proper image licenses

### V 1.0.6
    * Added pagination on home.php (don't know how this got uploaded without pagination)
    * Removed some variables from functions.php that were left there from the premium version of the theme.
    * Removed some functions from scripts.php that belonged to the premium version of the theme.
    * Added fallback for wp_nav_menu.
    * Added fallback in case theme doesn't have support for title_tag.
    * Fixed some conditionals in functions.php that prevented the smooth scroll & wow JS scripts to be loaded.
    * Prefixed all functions with pixova_lite
    * Prefixed all custom control classes with MT_
    * Wrapped all custom control classes in if clauses checking if classes already exists (class_exists).
    * Re-enabled title_tag & static front page sections in customizer (previous version had them disabled).
    * Removed favicon, since WP 4.3 is getting support for site icons.
    * Added license.txt
    * Updated screenshot.png to account for HiDPI screens (was 600 x 450, now it's 880 x 660).
    * Updated search.php to include sidebar & featured post image.
    * Updated tag.php to include sidebar & featured post image.
    * Removed RSS feed link from /widgets/widget-social-icons.php
    * Created a new header for pages.
    * Styled the 404.php page.
    * Minified main stylesheet (style.min.css) * for development version, check style.css
    * Added missing comments for functions / classes
    * Renamed readme.txt to instructions.txt
    * Added proper theme readme.txt
    * Removed fonts/glyphicons & linea fonts
    * Added JetPack support

### V 1.0.5
    * Added default text for logo in customizer.php (text_logo variable).
    * Added default widgets in the footer using the_widget (replacement for old code that was importing & placing widgets in the sidebar by reading a JSON config file).
    * Added conditionals so that mark-up isn't displayed unless strings have values in them (example: blockquote on the front page).
    * Added Theme links in the footer as well as to WordPress.org :)
    * Updated CF7 plugin to version 4.2.1 from 4.2.0.
    * Fixed a bug with the randomized header images that prevented images uploaded to actually be randomly displayed.
    * Updated readme.txt.
    * Fixed a few typos in the changelog :)

### V 1.0.4
    * Re-worked how TGMPA works; instead of forcing activation of the CF7 plugin, it's now recommending it.
    * Re-worked how the custom CF7 control works, if the plugin isn't installed a message is shown instructing the user to install it.
    * Added defaults for about section (title / sub-title).
    * Removed widget importer functions / classes.
    * Removed /demo-content/ since it's not allowed to import content upon theme activation (will re-work this in a future plugin).
    * Added default fallback for testimonial images, in case the client doesn't add any.

### V 1.0.3
	* Updated TGMPA plugin from 2.4.1 to 2.5.0
	* Changed the way front-page.php handles the content display.
	* Replaced include with require_once.
	* Updated the widget importer code to run only once. A theme mod setting is now set, after the demo-content/widgets.json file has been parsed successfully and the widgets have been imported.
	* Fixed image alignments and added margin-top/bottom of 10px for better aesthetics.
	* Styled image captions.
	* Fixed an overflow issue on single post pages.
	* Added featured images to blog posts.
	* Added sidebar to single blog posts.

### V 1.0.2
	* Fixed some strings that had non-printable characters in them.
	* Fixed some translatable strings that had links hard-coded in them.

### V 1.0.1
    * Updated screenshot.png
    * Updated Theme / Author URI in style.css
    * Updated CSS styling for sticky posts.

### V 1.0.0
    * Initial release.