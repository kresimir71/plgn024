import React from 'react';
import plugin from "../Plugin.js";
import { __ } from '@wordpress/i18n';
import InputTextTr from './InputTextTr';
import InputCheckboxTr from './InputCheckboxTr';
import { tweakStructureLevel2, tweakStructureLevel3, tweakStructureLevel4 } from './tweakStructure.js';
import { WithContext as ReactTags } from 'react-tag-input';
import Select from 'react-select';

const yourTextDomain = plugin().textDomain;

const DisplayExample2ModuleFormFields = ({ formData, setFormDataWrapper, error }) => {
    const active = formData.example2module.active.value;
    return (
        <>
	    <table className="form-table">
		<tbody>		
		    <InputCheckboxTr
			label={formData.example2module.active.displayText()}
			checked={active}
			onChange={(e) =>
			    setFormDataWrapper(
				tweakStructureLevel3(formData, "example2module", "active", "value", e.target.checked)
			    )
			}
			descriptionText={formData.example2module.active.descriptionText()}
			error={error["example2module.active"]}
		    />
		    <InputTextTr
			label={formData.example2module.watchEmails.displayText()}
			value={formData.example2module.watchEmails.value}
			onChange={(e) =>
			    setFormDataWrapper(tweakStructureLevel3(formData, "example2module", "watchEmails", "value", e.target.value))
			}
			descriptionText={formData.example2module.watchEmails.descriptionText()}
			error={error["example2module.watchEmails"]}
		    />		    
		    <ChatIdsInput
			formData={formData}
			setFormDataWrapper={setFormDataWrapper}
		    />
		</tbody>
	    </table>
        </>
    );
};

const ChatIdsInput = ({ formData, setFormDataWrapper }) => {
    const handleAddition = (tag) => {
	setFormDataWrapper(tweakStructureLevel3(formData, "example2module", "chatIds", "value", [...formData.example2module.chatIds.value, tag.text]));
    };

    const handleDelete = (i) => {
        const updatedChatIds = formData.example2module.chatIds.value.filter((_, index) => index !== i);
	setFormDataWrapper(tweakStructureLevel3(formData, "example2module", "chatIds", "value", updatedChatIds));
    };

    return (
        <tr className="form-field">
	    <th scope="row">
                <label>Chat Ids</label>
            </th>
            <td>
		
		<ReactTags
		    tags={formData.example2module.chatIds.value.map((channel, index) => ({ id: String(index), text: channel }))}
		    handleDelete={handleDelete}
		    handleAddition={handleAddition}
		    placeholder={__('Type and press enter to add', plugin().textDomain)}
		/>
            </td>
        </tr>
    );
};

export default DisplayExample2ModuleFormFields;


