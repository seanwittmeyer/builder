const HtmlWebPackPlugin = require('html-webpack-plugin');
//const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const webpack = require('webpack');
const path = require('path');

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
				test: /\.(sa|sc|c)ss$/,
				use: [
					/*
		  {
            loader: MiniCssExtractPlugin.loader
          },
		  */
					{
						// Adds CSS to the DOM by injecting a `<style>` tag
						loader: 'style-loader',
					},
					{
						loader: 'css-loader',
					},
					{
						loader: 'postcss-loader',
						options: {
							plugins: function() {
								return [require('autoprefixer')];
							},
						},
					},
					{
						loader: 'sass-loader',
						options: {
							implementation: require('sass'),
						},
					},
				],
			},
			{
				test: /\.(png|jpe?g|gif|svg)$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: '[name].[ext]',
							outputPath: 'dist/images',
						},
					},
				],
			},
			{
				test: /\.(woff|woff2|ttf|otf|eot)$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: '[name].[ext]',
							outputPath: 'dist/fonts',
						},
					},
				],
			},
		],
	},
	plugins: [
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			pagemap: 'pagemap',
		}),
		/*
	new MiniCssExtractPlugin({
      filename: "[name].css"
    }),
	*/
		new HtmlWebPackPlugin({
			inject: true,
			template: `./src/index.html`,
			filename: 'index.html',
		}),
	],
	entry: {
		index: './src/index.js',
		general: './src/general.js',
		maps: './src/maps.js',
		viz: './src/viz.js',
		//editor: './src/contenttools.js',
	},
	output: {
		filename: 'dist/[name].bundle.js',
		path: path.resolve(__dirname, '../'),
	},
	/* not sure we want to do this yet
  optimization: {
    splitChunks: {
      chunks: "all"
    }
  }
  */
};
