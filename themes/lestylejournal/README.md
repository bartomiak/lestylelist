### LeStyleJournal official Wordpress theme

To compile tailwind run:

`npx tailwindcss -i ./tailwind.css -o ./style.css --watch`

To run yarn 

`npm run dev`

To build scripts

`npm run build`


add `webpack.config.js`

```js
const toml = require( 'toml' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const { VueLoaderPlugin } = require('vue-loader')
const MiniCssExtractPlugin = require('mini-css-extract-plugin');



module.exports = {
	...defaultConfig,
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /.toml/,
				type: 'json',
				parser: {
					parse: toml.parse,
				},
			},
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
		],
	},
    plugins: [
        // make sure to include the plugin!
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin()
    ]
};

```

than

```js
const app = Vue.createApp(Search)
app.mount('#vue')
```

add content to `tailwind.config.js` to work with php and vue files

```js
content: ["./**/*.php", "./**/*.vue"],
```