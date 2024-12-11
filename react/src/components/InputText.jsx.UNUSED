import React from 'react';

const InputText = ({ label, value, onChange, descriptionText, error }) => {
    return (
        <div className="form-field">
            <label>{label}</label>
            <input
                type="text"
                value={value}
                onChange={onChange}
            />
            {descriptionText && <p className="description">{descriptionText}</p>}	    
            {error && <div className="notice notice-error notice-alt">{error}</div>}
        </div>
    );
};

export default InputText;
