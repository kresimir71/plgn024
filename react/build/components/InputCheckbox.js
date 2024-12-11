import React from 'react';
const InputCheckbox = ({
  label,
  checked,
  onChange,
  descriptionText,
  error
}) => {
  return <div className="form-field">
            <label>
                <input type="checkbox" checked={checked} onChange={onChange} />
                {label}
            </label>
            {descriptionText && <p className="description">{descriptionText}</p>}
            {error && <div className="notice notice-error notice-alt">{error}</div>}
        </div>;
};
export default InputCheckbox;