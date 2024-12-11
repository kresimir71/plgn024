
const validateSingleField = (validationResult, errors, cumulativeErrors, fieldPath) => {
    const { valid, error } = validationResult;
    if (!valid) {
        errors[fieldPath] = error;
        cumulativeErrors.push(error);
    }
};

const validateOnSubmit = (formData) => {
    let errors = {};
    let cumulativeErrors = [];

    validateSingleField(formData.username.validate(), errors, cumulativeErrors, "username");
    validateSingleField(formData.token.validate(), errors, cumulativeErrors, "token");

    if (formData.boglemodule1.active.value) {
        validateSingleField(formData.boglemodule1.username.validate(), errors, cumulativeErrors, "boglemodule1.username");
        validateSingleField(formData.boglemodule1.token.validate(), errors, cumulativeErrors, "boglemodule1.token");

        if (formData.boglemodule1.boglemodule1option.option.value) {
            validateSingleField(formData.boglemodule1.boglemodule1option.username.validate(), errors, cumulativeErrors, "boglemodule1.boglemodule1option.username");
            validateSingleField(formData.boglemodule1.boglemodule1option.token.validate(), errors, cumulativeErrors, "boglemodule1.boglemodule1option.token");
        }
    }
    if (formData.example2module.active.value) {    
	validateSingleField(formData.example2module.watchEmails.validate(), errors, cumulativeErrors, "example2module.watchEmails");
    }
    return { errors, cumulativeErrors };
};

export default validateOnSubmit;

