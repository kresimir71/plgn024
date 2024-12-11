import React from 'react';
import Dashboard from './components/Dashboard';
import { __ } from '@wordpress/i18n'; // Translations for WordPress
import plugin from "./Plugin.js";

const App = () => {
    return (
        <div>
            <h1>{__('Plugin Settings', plugin().textDomain)}</h1>
            <Dashboard />
        </div>
     );
}
export default App; 
