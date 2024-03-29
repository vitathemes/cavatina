# Cavatina - [Demo](https://demo.vitathemes.com/cavatina/)

Cavatina is a minimal & mobile-first theme. The best choice for people who want to introduce their projects.

![Home Page](screenshot.png)

## Features

- Sass for stylesheets
- Compatible with [Contact Form 7](https://wordpress.org/plugins/contact-form-7/)
- Theme options built directly into WordPress native live theme customizer
- Responsive design
- Cross-browser compatibility
- Custom Google WebFonts
- Child themes support
- Developer friendly extendable code
- Translation ready (with .POT files included)
- SEO optimized
- GNU GPL version 3.0 licensed
- Support 1 level menu
- …and much more

See a working example at [demo.vitathemes.com/cavatina](https://demo.vitathemes.com/cavatina/).

## Theme installation

1. Simply install as a normal WordPress theme and activate.
2. In your admin panel, navigate to `Appearance > Customize`.
3. Put the finishing touches on your website by adding a logo, typography settings, custom colors and etc.
4. You can enable projects post-type by activing libwp plugin that is recommended at the top.
5. After libWp plugin activated go to `Settings > Permalink` and select `Post name` (\*this option is recommended) radio button and save the changes.
6. Projects post-type is now available at your dashboard under the `Posts`.
7. For adding custom page-templates (Like Home or contact page) go to pages on the WordPress dashboard click on `Pages` create new page and in `Page Atrributes` panel select page template that you want.
8. Also for Create a gallery in projects you have to active `ACF` and `ACF Photo Gallery Field` after that Custom fields are available at projects edit pages.

## Theme structure

```shell
themes/cavatina/                 # → Root of your theme
│── assets/                      # → Theme internal assets
│   ├── css/                     # → Compressed css file
│   ├── fonts/                   # → Theme default fonts ( Customizable from kirki )
│   ├── images/                  # → Theme compressed images
│   ├── js/                      # → Theme Minified javascript files
│   └── src/                     # → Theme source files
├── inc/                         # → Theme functions
│   ├── tgmpa/                   # → Tgmpa plugin recommendation
│   ├── customizer.php           # → All codes related to WordPress Customizer (We use Kirki Framework)
│   ├── template-functions.php   # → Custom template tweaks
│   └── template-tags.php        # → Custom template tags
│   └── setup.php                # → Theme Setup
├── language/                    # → Theme Language files
├── page-template/               # → Theme Part files (Include) - Pages
├── template-parts/              # → Theme Part files (Include)
├── node_modules/                # → Node.js packages
├── package.json                 # → Node.js dependencies and scripts
```

## Theme setup

Edit `functions.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

## Theme development

- Run `npm install` from the theme directory to install dependencies
- Change `cavatina.local/` to your local address in `gulpfile.js`
- Run `gulp` from the root of theme directory and it's starting to watch any changes in scss files from the `sass` folder

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](CONTRIBUTING.md) to help you get started.

## License

Cavatina is licensed under [GNU GPL](LICENSE).

## ❤️ Sponsors
<a href="" target="_blank"><img width="200" src="https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.png"/></a>

Want to become a sponsor? you can sponsor & support VitaThemes by providing our team your service for free!
