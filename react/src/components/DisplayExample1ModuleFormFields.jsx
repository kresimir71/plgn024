import React from 'react';
import plugin from "../Plugin.js";
import { __ } from '@wordpress/i18n';
import InputTextTr from './InputTextTr';
import InputCheckboxTr from './InputCheckboxTr';
import { tweakStructureLevel2, tweakStructureLevel3, tweakStructureLevel4 } from './tweakStructure.js';
import { WithContext as ReactTags } from 'react-tag-input';
import Select from 'react-select';

const yourTextDomain = plugin().textDomain;

const DisplayExample1ModuleFormFields = ({ formData, setFormDataWrapper, error }) => {
    const active = formData.example1module.active.value;
    return (
        <>
	    <table className="form-table">
		<tbody>		
		    <InputCheckboxTr
			label={formData.example1module.active.displayText()}
			checked={active}
			onChange={(e) =>
			    setFormDataWrapper(
				tweakStructureLevel3(formData, "example1module", "active", "value", e.target.checked)
			    )
			}
			descriptionText={formData.example1module.active.descriptionText()}
			error={error["example1module.active"]}
		    />
		    <ChannelsInput
			formData={formData}
			setFormDataWrapper={setFormDataWrapper}
		    />
		    <SendWhenSelector
			formData={formData}
			setFormDataWrapper={setFormDataWrapper}
		    />
		</tbody>
	    </table>
        </>
    );
};

const ChannelsInput = ({ formData, setFormDataWrapper }) => {
    const handleAddition = (tag) => {
	setFormDataWrapper(tweakStructureLevel3(formData, "example1module", "channels", "value", [...formData.example1module.channels.value, tag.text]));
    };

    const handleDelete = (i) => {
        const updatedChannels = formData.example1module.channels.value.filter((_, index) => index !== i);
	setFormDataWrapper(tweakStructureLevel3(formData, "example1module", "channels", "value", updatedChannels));
    };

    return (
        <tr className="form-field">
	    <th scope="row">
                <label>Channels</label>
            </th>
            <td>
		
		<ReactTags
		    tags={formData.example1module.channels.value.map((channel, index) => ({ id: String(index), text: channel }))}
		    handleDelete={handleDelete}
		    handleAddition={handleAddition}
		    placeholder={__('Type and press enter to add', plugin().textDomain)}
		/>
            </td>
        </tr>
    );
};

const SendWhenSelector = ( {formData, setFormDataWrapper }) => {
    const options = formData.example1module.sendWhen.options.map(id => ({ value: id, label: `Send When ${id}` }));

    const handleChange = (selectedOptions) => {
	setFormDataWrapper(tweakStructureLevel3(formData, "example1module", "sendWhen", "value", selectedOptions.map(option => option.value)));
    };
    return (
	<tr className="form-field">
	    <th scope="row">
                <label>Send When</label>
            </th>
            <td>
		<Select
		    isMulti
		    options={options}
		    value={options.filter(option => formData.example1module.sendWhen.value.includes(option.value))}
		    onChange={handleChange}
		    placeholder={__('Select Send When', plugin().textDomain)}
		/>
            </td>
        </tr>
    );
};
export default DisplayExample1ModuleFormFields;


