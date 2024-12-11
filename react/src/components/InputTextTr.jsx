import React from 'react';

const InputTextTr = ({ label, value, onChange, descriptionText, error }) => {
    return (
        <tr className="form-field">
	    <th scope="row">
                <label>{label}</label>
            </th>
            <td>
                <input
                    type="text"
                    value={value}
                    onChange={onChange}
                />
                {descriptionText && <p className="description">{descriptionText}</p>}
                {error && <div className="notice notice-error notice-alt">{error}</div>}
            </td>
        </tr>
    );
};

export default InputTextTr;
