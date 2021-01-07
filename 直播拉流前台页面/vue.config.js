const webpack = require("webpack");

module.exports = {
  lintOnSave: false,

  productionSourceMap: false,
  publicPath: "./",
  configureWebpack: {
    plugins: [
      new webpack.ProvidePlugin({
        $: "jquery",

        jQuery: "jquery",

        "window.jQuery": "jquery",

        Popper: ["popper.js", "default"],
      }),
    ],
  },
};
