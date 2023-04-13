const miniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
	test: /\.css$/,
	use: [miniCssExtractPlugin.loader, "style-loader", "vue-style-loader", "css-loader"],
};
