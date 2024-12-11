import React, { useState } from 'react';
import DisplayMainFormFields from './DisplayMainFormFields';
import DisplayExample1ModuleFormFields from './DisplayExample1ModuleFormFields';
import DisplayExample2ModuleFormFields from './DisplayExample2ModuleFormFields';
import DisplayAdvancedFormFields from './DisplayAdvancedFormFields';
import { __ } from '@wordpress/i18n'; // Translations for WordPress
import plugin from "../Plugin.js";
const yourTextDomain = plugin().textDomain;
const DisplayTab = ({
  formData,
  setFormDataWrapper,
  error
}) => {
  // State to manage the active tab
  const [activeTab, setActiveTab] = useState('main');

  // Function to handle tab click
  const handleTabClick = tab => {
    setActiveTab(tab);
  };
  return <div className="wrap">

            {/* Tab Navigation */}
            <h2 className="nav-tab-wrapper">
                <a href="#" className={`nav-tab ${activeTab === 'main' ? 'nav-tab-active' : ''}`} onClick={() => handleTabClick('main')}>
                    {__('Main Settings', plugin().textDomain)}
                </a>
                <a href="#" className={`nav-tab ${activeTab === 'advanced' ? 'nav-tab-active' : ''}`} onClick={() => handleTabClick('advanced')}>
                    {__('Advanced Settings', plugin().textDomain)}
                </a>
                <a href="#" className={`nav-tab ${activeTab === 'example1module' ? 'nav-tab-active' : ''}`} onClick={() => handleTabClick('example1module')}>
                    {__('Example 1 module Settings', plugin().textDomain)}
                </a>
                <a href="#" className={`nav-tab ${activeTab === 'example2module' ? 'nav-tab-active' : ''}`} onClick={() => handleTabClick('example2module')}>
                    {__('Example 2 module Settings', plugin().textDomain)}
                </a>
            </h2>

            {/* Tab Content */}
            <div className="tab-content">
                {activeTab === 'main' && <div>
                        <h3>{__('Main Settings', plugin().textDomain)}</h3>
			<DisplayMainFormFields formData={formData} setFormDataWrapper={setFormDataWrapper} error={error} />
                    </div>}
		
                {activeTab === 'advanced' && <div>
                        <h3>{__('Advanced Settings', plugin().textDomain)}</h3>
                        {/* Advanced settings form here */}
			<DisplayAdvancedFormFields formData={formData} setFormDataWrapper={setFormDataWrapper} error={error} />			
                    </div>}

                {activeTab === 'example1module' && <div>
                        <h3>{__('Example 1 Module Settings', plugin().textDomain)}</h3>
			<DisplayExample1ModuleFormFields formData={formData} setFormDataWrapper={setFormDataWrapper} error={error} />			
                    </div>}

                {activeTab === 'example2module' && <div>
                        <h3>{__('Example 2 Module Settings', plugin().textDomain)}</h3>
			<DisplayExample2ModuleFormFields formData={formData} setFormDataWrapper={setFormDataWrapper} error={error} />			

                    </div>}
            </div>
        </div>;
};
export default DisplayTab;