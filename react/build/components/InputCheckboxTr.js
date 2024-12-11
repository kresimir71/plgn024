import React from 'react';
import plugin from "../Plugin.js";
const yourTextDomain = plugin().textDomain;
const InputCheckboxTr = ({
  label,
  checked,
  onChange,
  descriptionText,
  error
}) => {
  return <tr className="form-field">
	    <th scope="row">
		<label>
                    <input type="checkbox" checked={checked} onChange={onChange} />
                    {label}
		</label>
	    </th>
	    <td>
                {descriptionText && <p className="description">{descriptionText}</p>}
		{error && <div className="notice notice-error notice-alt">{error}</div>}
	    </td>
        </tr>;
};
export default InputCheckboxTr;