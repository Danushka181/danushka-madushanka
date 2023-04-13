/**
 * Load dependencies.
*/
const path = require("path");
const loaders = require("./loaders");
const plugins = require("./plugins");

const isDev = (process.env.NODE_ENV = "development");

let config = {
	entry: {
		main: path.resolve(__dirname, "../src/index.js"),
	},
	devtool: isDev ? "inline-source-map" : false,
	mode: process.env.NODE_ENV,
	module: {
		rules: loaders,
	},
	plugins,
	output: {
		path: path.resolve(__dirname, "../dist/js"),
		filename: "[name].js",
	},
	optimization: {
		minimize: true,
	},
};

// Add dev server only for development mode and not for production.
if (isDev) {
	config.devServer = {
		devMiddleware: {
			writeToDisk: true,
		},
		hot: true,
		headers: { "Access-Control-Allow-Origin": "*" },
		allowedHosts: "all",
		host: "test.local", // updated host name
		port: 8887,
		proxy: {
			"/dist": {
				target: "http://test.local", // update target URL to match new host name
				pathRewrite: {
					"^/dist": "",
				},
			},
		},
	};
}

module.exports = config;
