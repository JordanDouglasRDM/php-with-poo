const path = require('path');

module.exports = {
    mode: 'development', // ou 'production', dependendo do seu ambiente
    entry: './public/index.js',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'public/dist'),
    },
    resolve: {
        alias: {
            'sweetalert2': path.resolve(__dirname, 'node_modules/sweetalert2/dist/sweetalert2.js')
        }
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }
        ]
    }
};
