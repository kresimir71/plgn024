import { __ } from '@wordpress/i18n';
import plugin from "../Plugin.js";

const yourTextDomain = plugin().textDomain;

const createFormFields = (initialSettings) => ({
    username: {
        value: initialSettings.username || '',
        type: 'string',
        displayText: () => __('User name', yourTextDomain),
        descriptionText: () => __('Enter your unique username. It should be 3-30 characters long, starting with a letter.', yourTextDomain),
        validate: function () {
            const regex = /^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/;
            const valid = regex.test(this.value);
            const error = valid ? '' : __('Please enter a valid username, like AAAAA1.', yourTextDomain);
            return { valid, error };
        }
    },
    token: {
        value: initialSettings.token || '',
        type: 'string',
        displayText: () => __('Token', yourTextDomain),
        descriptionText: () => __('Enter the access token for secure authentication. It should be 3-30 characters long.', yourTextDomain),
        validate: function () {
            const regex = /^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/;
            const valid = regex.test(this.value);
            const error = valid ? '' : __('Please enter a valid token, like BBBBB2.', yourTextDomain);
            return { valid, error };
        }
    },
    boglemodule1: {
        active: {
            value: initialSettings.boglemodule1?.active || false,
            type: 'boolean',
            displayText: () => __('Boglemodule 1 active', yourTextDomain),
            descriptionText: () => __('Toggle to activate or deactivate Boglemodule 1.', yourTextDomain),
        },
        username: {
            value: initialSettings.boglemodule1?.username || '',
            type: 'string',
            displayText: () => __('Boglemodule 1 User name', yourTextDomain),
            descriptionText: () => __('Enter the username specific to Boglemodule 1 settings.', yourTextDomain),
            validate: function () {
                const regex = /^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/;
                const valid = regex.test(this.value);
                const error = valid ? '' : __('Please enter a valid username, like AAAAA1.', yourTextDomain);
                return { valid, error };
            }
        },
        token: {
            value: initialSettings.boglemodule1?.token || '',
            type: 'string',
            displayText: () => __('Boglemodule 1 Token', yourTextDomain),
            descriptionText: () => __('Enter the token specific to Boglemodule 1 for authentication purposes.', yourTextDomain),
            validate: function () {
                const regex = /^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/;
                const valid = regex.test(this.value);
                const error = valid ? '' : __('Please enter a valid token, like BBBBB2.', yourTextDomain);
                return { valid, error };
            }
        },
        boglemodule1option: {
            option: {
                value: initialSettings.boglemodule1?.boglemodule1option?.option || false,
                type: 'boolean',
                displayText: () => __('Option active', yourTextDomain),
                descriptionText: () => __('Enable or disable the specific option for Boglemodule 1.', yourTextDomain)
            },
            username: {
                value: initialSettings.boglemodule1?.boglemodule1option?.username || '',
                type: 'string',
                displayText: () => __('Option User name', yourTextDomain),
                descriptionText: () => __('Provide a username for the selected option within Boglemodule 1.', yourTextDomain),
                validate: function () {
                    const regex = /^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/;
                    const valid = regex.test(this.value);
                    const error = valid ? '' : __('Please enter a valid username, like AAAAA1.', yourTextDomain);
                    return { valid, error };
                }
            },
            token: {
                value: initialSettings.boglemodule1?.boglemodule1option?.token || '',
                type: 'string',
                displayText: () => __('Option Token', yourTextDomain),
                descriptionText: () => __('Provide a token for secure access to the option in Boglemodule 1.', yourTextDomain),
                validate: function () {
                    const regex = /^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/;
                    const valid = regex.test(this.value);
                    const error = valid ? '' : __('Please enter a valid token, like BBBBB2.', yourTextDomain);
                    return { valid, error };
                }
            }
        }
    },
    example1module: {
        active: {
            value: initialSettings.example1module?.active || false,
            type: 'boolean',
            displayText: () => __('Example1module active', yourTextDomain),
            descriptionText: () => __('Toggle to activate or deactivate Example1module.', yourTextDomain),
        },
        channels: {
            value: initialSettings.example1module?.channels || [],
            type: 'array',
        },	
        sendWhen: {
            value: initialSettings.example1module?.send_when || [],
            options: ['new', 'existing'],	    
            type: 'multi select array',
        },	
    },
    example2module: {
        active: {
            value: initialSettings.example2module?.active || false,
            type: 'boolean',
            displayText: () => __('Example2module active', yourTextDomain),
            descriptionText: () => __('Toggle to activate or deactivate Example2module.', yourTextDomain),
        },
        chatIds: {
            value: initialSettings.example2module?.chat_ids || [],
            type: 'array',
        },	
        watchEmails: {
            value: initialSettings.example2module?.watch_emails || [],
            type: 'string',
            displayText: () => __('Email', yourTextDomain),
            descriptionText: () => __('Enter the required email address.', yourTextDomain),
            validate: function () {
		// Regular expression for basic email validation
		const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		const valid = regex.test(this.value);
		const error = valid
		      ? ''
		      : __('Please enter a valid email address, like example@domain.com.', yourTextDomain);
		return { valid, error };
            }
        },	
    },
    advanced: {
        sendFilesByUrl: {
            value: initialSettings.advanced?.send_files_by_url || false,
            type: 'boolean',
            displayText: () => __('Send files by URL', yourTextDomain),
            descriptionText: () => __('Toggle to activate or deactivate.', yourTextDomain),
        },
        cleanUninstall: {
            value: initialSettings.advanced?.clean_uninstall || false,
            type: 'boolean',
            displayText: () => __('Clean uninstall', yourTextDomain),
            descriptionText: () => __('Clean plugin data when uninstalling plugin.', yourTextDomain),
        },
        enableLogs: {
            value: initialSettings.advanced?.enable_logs || [],
            options: ['api', 'example1module'],	    
            type: 'multi select array',
        },	
    }    
    
});

export default createFormFields;
