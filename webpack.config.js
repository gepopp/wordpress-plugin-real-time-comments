const path                 = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const isProduction         = 'production' === process.env.NODE_ENV;

// Set the build prefix.
let prefix = isProduction ? '.min' : '';

const config = {
	entry: {
		main: './assets/js/main.js',
	},
	output: {
		filename: `[name]${prefix}.js`,
		path: path.resolve(__dirname, 'dist')
	},
	mode: process.env.NODE_ENV,
	module: {
		rules: [
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
				use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader',
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
	plugins: [new MiniCssExtractPlugin()]
}
module.exports = config