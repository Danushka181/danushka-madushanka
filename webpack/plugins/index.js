const webpack = require("webpack");
/**
 * External dependencies.
 */
const miniCssExtractPlugin = require("mini-css-extract-plugin");
const { VueLoaderPlugin } = require("vue-loader");

const plugins = [
	new miniCssExtractPlugin({
		filename: "../css/main.css",
	}),
	new VueLoaderPlugin(),
	new webpack.DefinePlugin({
		__VUE_OPTIONS_API__: true,
		__VUE_PROD_DEVTOOLS__: false,
	}),
];

module.exports = plugins;
