const path                 = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const isProduction         = 'production' === process.env.NODE_ENV;
const { VueLoaderPlugin } = require('vue-loader')
const webpack = require('webpack');


// Set the build prefix.
let prefix = isProduction ? '.min' : '';

const config = {
	entry: {
		main: './assets/js/main.js',
		admin: './assets/js/admin.js',
	},
	output: {
		filename: `[name]${prefix}.js`,
		path: path.resolve(__dirname, 'dist')
	},
	mode: process.env.NODE_ENV,
	module: {
		rules: [
			{
				test: /\.vue$/,
				loader: 'vue-loader'
			},
			{
				test: /\.js$/,
				loader: 'babel-loader',
				options: {
					presets: [
						[
							"@babel/preset-env"
						]
					]
				}
			},
			{
				test: /\.s[ac]ss$/i,
				use: [
					'vue-style-loader',
					MiniCssExtractPlugin.loader,
					'css-loader',
					'sass-loader',
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [
									require('postcss-import'),
									require('tailwindcss')('tailwind.js'),
									require('postcss-nested'),
									require('autoprefixer'),
								]
							}
						}
					}
				],
			},
		]
	},
	plugins: [
		new VueLoaderPlugin(),
		new MiniCssExtractPlugin(),
		new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
	],
	resolve: {
		alias: {
			vue: process.env.NODE_ENV == 'production' ? 'vue/dist/vue.min.js' : 'vue/dist/vue.js'
		}
	}
}
module.exports = config