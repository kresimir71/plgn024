const defaults = require('@wordpress/scripts/config/webpack.config');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
    ...defaults,
    externals: {
	react: 'React',
	'react-dom': 'ReactDOM',
    },
    output: {
        filename: 'front.js',
    },
    plugins: [
        ...defaults.plugins.map(plugin => {
            if (plugin instanceof MiniCssExtractPlugin) {
                return new MiniCssExtractPlugin({
                    filename: 'front.css',
                });
            }
            if (plugin instanceof CleanWebpackPlugin) {
                return new CleanWebpackPlugin({
		    cleanOnceBeforeBuildPatterns: [
			'front.asset.php',
			'front.css',
			'front.js'
		    ],
		});
	    }
            return plugin;
        }),	
    ],    
};
