import React from 'react';
import plugin from "../Plugin.js";
import { __ } from '@wordpress/i18n';
import InputTextTr from './InputTextTr';
import InputCheckboxTr from './InputCheckboxTr';
import { tweakStructureLevel2, tweakStructureLevel3, tweakStructureLevel4 } from './tweakStructure.js';
import { WithContext as ReactTags } from 'react-tag-input';
import Select from 'react-select';

const yourTextDomain = plugin().textDomain;

const DisplayAdvancedFormFields = ({ formData, setFormDataWrapper, error }) => {
    return (
        <>
	    <table className="form-table">
		<tbody>		
		    <InputCheckboxTr
			label={formData.advanced.sendFilesByUrl.displayText()}
			checked={formData.advanced.sendFilesByUrl.value}
			onChange={(e) =>
			    setFormDataWrapper(
				tweakStructureLevel3(formData, "advanced", "sendFilesByUrl", "value", e.target.checked)
			    )
			}
			descriptionText={formData.advanced.sendFilesByUrl.descriptionText()}
			error={error["advanced.sendFilesByUrl"]}
		    />
		    <InputCheckboxTr
			label={formData.advanced.cleanUninstall.displayText()}
			checked={formData.advanced.cleanUninstall.value}
			onChange={(e) =>
			    setFormDataWrapper(
				tweakStructureLevel3(formData, "advanced", "cleanUninstall", "value", e.target.checked)
			    )
			}
			descriptionText={formData.advanced.cleanUninstall.descriptionText()}
			error={error["advanced.cleanUninstall"]}
		    />
		    <EnableLogsSelector
			formData={formData}
			setFormDataWrapper={setFormDataWrapper}
		    />
		</tbody>
	    </table>
        </>
    );
};

const EnableLogsSelector = ( {formData, setFormDataWrapper }) => {
    const options = formData.advanced.enableLogs.options.map(id => ({ value: id, label: `Enable log for ${id}` }));

    const handleChange = (selectedOptions) => {
	setFormDataWrapper(tweakStructureLevel3(formData, "advanced", "enableLogs", "value", selectedOptions.map(option => option.value)));
    };
    return (
	<tr className="form-field">
	    <th scope="row">
                <label>Select Logs</label>
            </th>
            <td>
		<Select
		    isMulti
		    options={options}
		    value={options.filter(option => formData.advanced.enableLogs.value.includes(option.value))}
		    onChange={handleChange}
		    placeholder={__('No Logs Enabled', plugin().textDomain)}
		/>
            </td>
        </tr>
    );
};
export default DisplayAdvancedFormFields;


