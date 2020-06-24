# Site Customizer

Registers some theme options in the customizer


### Theme Settings

##### Site Identity
* Mobile Logo
* Footer Logo

#### Image
* Default Featured Image fallback

##### Site Branding
* Typography (Google Fonts)
** Outputs CSS variables --heading-font-family, --subheading-font-family, --body-font-family, --heading-font-weight, --subheading-font-weight, --body-font-weight, --body-font-weight-bold

##### Header & Footer 
* Copyright Text (next to copyright year)
* Additional Footer Text (like address, etc)
* Additional Header Text
* Phone Number
* Display Search Bar in header

##### Social Sharing
* Reorderable social media icon links 
* Includes Font Awesome
* Optional RSS Feed icon

#### Special Pages
* Set custom 404 error page
* Display Search Bar in error page


### Helper Functions
`the_mtm_header_logo( $class = 'header-logo', $size = 'medium_large' )`
Output header logo inside image tag, with link to homepage. Optionally specify image size and class. Falls back to Site Name if nothing is entered.

`the_mtm_mobile_logo( $class = 'header-logo-mobile', $size = 'medium' )`
Output mobile logo inside image tag, with link to homepage. Optionally specify image size and class.

`the_mtm_header_text()`
Outputs header text if any exists

`the_mtm_footer_logo()`
Outputs footer logo inside image tag, with link to homepage. Optionally specify image size and class. Shows nothing if nothing is entered.


`the_mtm_footer_copyright()`
Outputs copyright text with year and date

`the_mtm_footer_text()`
Outputs footer text if any exists


`mtm_get_social_media()`
Outputs social icons with custom classes based on social network URL. Needs to be echoed
Also shortcode `[social_icons]`

`mtm_get_phone_number()`
Outputs linked phone number with phone icon. Needs to be echoed


`the_mtm_post_thumbnail( $size = 'full', $class = '', $link = true, $attr ='' )`
Outputs the post thumbnail inside a `<figure>` with a permalink to the post, with fallback for the default image

`the_mtm_post_thumbnail_inline( $size = 'full', $class = '', $link = true, $attr ='' )`
Outputs the post thumbnail inside a `<figure>` with a permalink to the post, with fallback for first inline image, then the default image
