const path = require('path');
const webpack = require('webpack');

module.exports = {
	mode: 'production',
	/*
  resolve: {
    alias: {
      jquery: "jquery/src/jquery"
    } 
  },
  */
	module: {
		rules: [
			{
				test: /\.(scss)$/,
				use: [
					{
						// Adds CSS to the DOM by injecting a `<style>` tag
						loader: 'style-loader',
					},
					{
						// Interprets `@import` and `url()` like `import/require()` and will resolve them
						loader: 'css-loader',
					},
					{
						// Loader for webpack to process CSS with PostCSS
						loader: 'postcss-loader',
						options: {
							plugins: function() {
								return [require('autoprefixer')];
							},
						},
					},
					{
						// Loads a SASS/SCSS file and compiles it to CSS
						loader: 'sass-loader',
					},
				],
			},
			{
				test: /\.css$/,
				loaders: ['style-loader', 'css-loader'],
			},
		],
	},
	plugins: [
		// Provides jQuery for other JS bundled with Webpack
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			pagemap: 'pagemap',
		}),
	],
	entry: {
		index: './src/index.js',
		general: './src/general.js',
		maps: './src/maps.js',
		viz: './src/viz.js',
	},
	output: {
		filename: '[name].bundle.js',
		path: path.resolve(__dirname, '../dist'),
	},
	/* not sure we want to do this yet
  optimization: {
    splitChunks: {
      chunks: "all"
    }
  }
  */
};
