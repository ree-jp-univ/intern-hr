const path = require('path');

module.exports = {
    entry: './fuel/app/views/edit/editor.jsx',
    output: {
        path: path.resolve(__dirname, 'public/assets/js/react'),
        filename: 'editor.js',
        // publicPath: 'assets/js/react/',
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                },
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader'],
            },
        ],
    },
    resolve: {
        extensions: ['.js', '.jsx'],
    },
    devServer: {
        static: {
            directory: path.join(__dirname, 'public'),
        },
        devMiddleware: { 
            publicPath: 'http://localhost:9000/assets/js/react/',
        },
        open: true,
        port: 9000,
        hot: true,
    },
};
