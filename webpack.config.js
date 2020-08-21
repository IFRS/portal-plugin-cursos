const webpack = require('webpack');
const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

const config = {
  entry: {
    index: './src/index.js',
  },
  output: {
    path: path.resolve(__dirname, 'js'),
    filename: '[name].js',
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
      },
      {
        test: /\.js$/,
        use: ['babel-loader', 'source-map-loader'],
        exclude: /node_modules/,
      },
    ]
  },
  resolve: {
    extensions: [
      '.js',
      '.vue',
    ],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
    },
  },
  plugins: [
    new VueLoaderPlugin(),
    // new BundleAnalyzerPlugin({
    //   analyzerMode: 'static',
    //   openAnalyzer: false,
    // }),
  ],
  optimization: {
    runtimeChunk: 'single',
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          chunks: 'all',
        },
      },
    },
  },
};

module.exports = config;
