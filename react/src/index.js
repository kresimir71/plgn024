import App from "./App";
import { render } from '@wordpress/element';
import plugin from "./Plugin.js";

import './style/main.scss';

render(<App />, document.getElementById(plugin().pluginName+'-settings'));
