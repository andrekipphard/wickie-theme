
# Wickie WordPress Theme

Wickie is a custom WordPress theme that uses Bootstrap for layout and components.

## Features
- Modern, responsive design using Bootstrap
- Custom SCSS structure for easy styling
- Node.js-based build process

## Installation

1. Clone or download this repository into your WordPress `wp-content/themes` directory.
2. Run the following command to install dependencies:

	```sh
	npm install
	```

3. Build your CSS (if not done automatically):

	```sh
	npm run build
	# or
	npm run watch
	```

4. Activate the "Wickie" theme in your WordPress admin.


## Development

- This theme uses SCSS (Sass) for all styles. Edit `.scss` files in `assets/css/` for custom styles.
- After editing SCSS, run the build process (`npm run build` or `npm run watch`) to generate the compiled CSS.
- Bootstrap is included via npm and imported in the main SCSS file.
- Only the compiled `main.css` should be enqueued in WordPress.

## Notes
- Do not commit or push the `node_modules/` directory (it is excluded via `.gitignore`).
- To add or update Bootstrap, run `npm install bootstrap`.
