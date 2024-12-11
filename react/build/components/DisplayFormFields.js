import React from 'react';
import InputTextTr from './InputTextTr';
import InputCheckboxTr from './InputCheckboxTr';
import { tweakStructureLevel2, tweakStructureLevel3, tweakStructureLevel4 } from './tweakStructure.js';
const DisplayFormFields = ({
  formData,
  setFormDataWrapper,
  error
}) => {
  const active = formData.boglemodule1.active.value;
  const optionActive = formData.boglemodule1.boglemodule1option.option.value;
  return <>
	    <table className="form-table">
		<tbody>
		    <InputTextTr label={formData.username.displayText()} value={formData.username.value} onChange={e => setFormDataWrapper(tweakStructureLevel2(formData, "username", "value", e.target.value))} descriptionText={formData.username.descriptionText()} error={error.username} />

		    <InputTextTr label={formData.token.displayText()} value={formData.token.value} onChange={e => setFormDataWrapper(tweakStructureLevel2(formData, "token", "value", e.target.value))} descriptionText={formData.token.descriptionText()} error={error.token} />
		    <InputCheckboxTr label={formData.boglemodule1.active.displayText()} checked={active} onChange={e => setFormDataWrapper(tweakStructureLevel3(formData, "boglemodule1", "active", "value", e.target.checked))} descriptionText={formData.boglemodule1.active.descriptionText()} error={error["boglemodule1.active"]} />

		    {active && <InputTextTr label={formData.boglemodule1.username.displayText()} value={formData.boglemodule1.username.value} onChange={e => setFormDataWrapper(tweakStructureLevel3(formData, "boglemodule1", "username", "value", e.target.value))} descriptionText={formData.boglemodule1.username.descriptionText()} error={error["boglemodule1.username"]} />}
		    {active && <InputTextTr label={formData.boglemodule1.token.displayText()} value={formData.boglemodule1.token.value} onChange={e => setFormDataWrapper(tweakStructureLevel3(formData, "boglemodule1", "token", "value", e.target.value))} descriptionText={formData.boglemodule1.token.descriptionText()} error={error["boglemodule1.token"]} />}
		    {active && <InputCheckboxTr label={formData.boglemodule1.boglemodule1option.option.displayText()} checked={optionActive} onChange={e => setFormDataWrapper(tweakStructureLevel4(formData, "boglemodule1", "boglemodule1option", "option", "value", e.target.checked))} descriptionText={formData.boglemodule1.boglemodule1option.option.descriptionText()} error={error["boglemodule1.boglemodule1option.option"]} />}
		    {active && optionActive && <InputTextTr label={formData.boglemodule1.boglemodule1option.username.displayText()} value={formData.boglemodule1.boglemodule1option.username.value} onChange={e => setFormDataWrapper(tweakStructureLevel4(formData, "boglemodule1", "boglemodule1option", "username", "value", e.target.value))} descriptionText={formData.boglemodule1.boglemodule1option.username.descriptionText()} error={error["boglemodule1.boglemodule1option.username"]} />}
		    {active && optionActive && <InputTextTr label={formData.boglemodule1.boglemodule1option.token.displayText()} value={formData.boglemodule1.boglemodule1option.token.value} onChange={e => setFormDataWrapper(tweakStructureLevel4(formData, "boglemodule1", "boglemodule1option", "token", "value", e.target.value))} descriptionText={formData.boglemodule1.boglemodule1option.token.descriptionText()} error={error["boglemodule1.boglemodule1option.token"]} />}
		</tbody>
	    </table>
        </>;
};
export default DisplayFormFields;