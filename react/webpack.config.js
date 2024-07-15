const defaults = require('@wordpress/scripts/config/webpack.config');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
    ...defaults,
    externals: {
        react: 'React',
        'react-dom': 'ReactDOM',
    },
    plugins: [
        ...defaults.plugins.map(plugin => {
            if (plugin instanceof CleanWebpackPlugin) {
                return new CleanWebpackPlugin({
                    cleanOnceBeforeBuildPatterns: [
                        'index.asset.php',
                        'index.css',
                        'index.js'
                    ],
                });
            }
            return plugin;
        }),
    ],

};
