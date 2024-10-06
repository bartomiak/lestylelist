const toml = require('toml');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
// const { VueLoaderPlugin } = require('vue-loader')
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
			// {
			//     test: /\.vue$/,
			//     loader: 'vue-loader'
			// },
		],
	},
	plugins: [
		// make sure to include the plugin!
		// new VueLoaderPlugin(),
		new MiniCssExtractPlugin()
	]
};
