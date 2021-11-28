const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    mode: "development", // production || development
    devtool: 'inline-source-map',
    entry: {
        index: './src/index.js'
    },
    output: {
        filename: 'js/[name].bundle.js',
        path: path.join(__dirname, 'public', 'dist'),
        clean: true,
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/style.bundle.css',
        })
    ],
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', {
                                useBuiltIns: "usage",
                                corejs: 3,
                                targets: "> 0.25%, not dead",
                            }]
                        ]
                    }
                }
            },
            {
                test: /\.s?css$/,
                use: [
                    MiniCssExtractPlugin.loader, 'css-loader', "sass-loader","postcss-loader"
                ],
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
            },
        ]
    },
    devServer: {
        static: {
            directory: path.join(__dirname, "./public/dist"),
        },
        compress: true,
        hot: true,
        port: 4000,
        devMiddleware: {
            index: true,
            mimeTypes: { 'text/html': ['phtml'] },
            publicPath: '/publicPathForDevServe',
            serverSideRender: true,
            writeToDisk: true,
        },
    },
};
