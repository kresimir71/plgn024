// import App from "./App";
// import { render } from '@wordpress/element';
// import plugin from "./Plugin.js";

// import './style/main.scss';

// render(<App />, document.getElementById(plugin().pluginName+'-settings'));


import App from "./App";
import { createRoot } from 'react-dom/client';
import plugin from "./Plugin.js";
import './style/main.scss';

const rootElement = document.getElementById(plugin().pluginName + '-settings');
const root = createRoot(rootElement); // Create a root
root.render(<App />); // Render your app
