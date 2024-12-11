import { useState } from '@wordpress/element';
import apiFetch from "@wordpress/api-fetch";
import plugin from "../Plugin.js";
import { __ } from '@wordpress/i18n';
import createFormFields from './formFieldsConfiguration';
import validateOnSubmit from './validation';
import DisplayTab from './DisplayTab';
import dataToPost from './dataToPost.js';

// redundant, just testing GET
import useFetchForGet from "./useFetchForGet.jsx";
const yourTextDomain = plugin().textDomain;
const Dashboard = () => {
  const [formData, setFormData] = useState(createFormFields(plugin().domData.savedSettings));
  const [isPending, setIsPending] = useState(false);
  const [error, setError] = useState({});
  const [saveSuccess, setSaveSuccess] = useState("");
  const pluginName = plugin().pluginName;

  // redundant, just testing GET
  const [refreshGet, setRefreshGet] = useState(0);
  const {
    dataFromGet,
    isPendingFromGet,
    errorFromGet
  } = useFetchForGet("/" + pluginName + '/v1/settings', refreshGet);
  const setFormDataWrapper = newFormData => {
    setSaveSuccess("");
    setFormData(newFormData);
  };
  const handleSubmit = e => {
    e.preventDefault();
    const {
      errors,
      cumulativeErrors
    } = validateOnSubmit(formData);
    setError(errors);
    if (cumulativeErrors.length > 0) {
      setError(prevError => ({
        ...prevError,
        _cumulative_error: cumulativeErrors.join('<br>')
      }));
      return;
    }
    setIsPending(true);
    apiFetch({
      path: '/' + pluginName + '/v1/settings',
      method: 'POST',
      data: dataToPost(formData)
    }).then(() => {
      setSaveSuccess(__('Settings saved successfully.', yourTextDomain));
      // redundant, just testing GET
      setRefreshGet(refreshGet + 1);
    }, err => {
      setError({
        _cumulative_error: __('Failed to save settings.', yourTextDomain)
      });
    }).catch(() => {
      setError({
        _cumulative_error: __('Failed to save settings.', yourTextDomain)
      });
    }).finally(() => {
      setIsPending(false);
    });
  };

  //Styling WP admin. thanks to: https://wpadmin.bracketspace.com/
  return <>

	    <form onSubmit={handleSubmit}>
		<DisplayTab formData={formData} setFormDataWrapper={setFormDataWrapper} error={error} />
		{isPending && <span className="spinner is-active"></span>}
		<button type="submit" className="button button-primary button-hero" disabled={isPending}>
		    {isPending ? __('Saving...', yourTextDomain) : __('Save Settings', yourTextDomain)}
		</button>

		<>{error._cumulative_error && <div className="notice notice-error notice-alt" dangerouslySetInnerHTML={{
          __html: error._cumulative_error
        }} />}</>
		<>{saveSuccess && <div className="notice notice-success notice-alt">{saveSuccess}</div>}</>
            </form>
            <hr></hr>
            <h4>Data from get is unused and redundant. It is here to show how it could also be done.</h4>
            <div>
		<div>errorFromGet: {errorFromGet != null ? errorFromGet : "NO ERROR"}</div>
		<div>isPendingFromGet: {isPendingFromGet ? "PENDING" : "NOT PENDING"}</div>
		<div>token and username: {dataFromGet != null ? dataFromGet.token + " " + dataFromGet.username : "NO DATA"}</div>
            </div>
        </>;
};
export default Dashboard;