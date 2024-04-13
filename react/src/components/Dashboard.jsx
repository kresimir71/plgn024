import { useState } from '@wordpress/element';
import apiFetch from "@wordpress/api-fetch";
import plugin from "../Plugin.js";

// redundant, just testing GET
import useFetchForGet from "./useFetchForGet.jsx"

const Dashboard = () => {

    /* The input from the plugin is fetched here */
    const [dataSettings, setDataSettings] = useState(plugin().domData.savedSettings);

    const [isPending, setIsPending] = useState(false);
    const [error, setError] = useState(null);
    const [errorUsername, setErrorUsername] = useState("");
    const [errorToken, setErrorToken] = useState("");
    const [saveSuccess, setSaveSuccess] = useState("");
    const pluginName = plugin().pluginName;

    // redundant, just testing GET
    const [refreshGet, setRefreshGet] = useState(0);
    const { dataFromGet, isPendingFromGet, errorFromGet } = useFetchForGet("/"+pluginName+'/v1/settings', refreshGet);

    function handleUsernameChange(event) {
	const { value } = event.target;
	setDataSettings(dataSettings => ({ ...dataSettings, ...{'username': value} }));

	setSaveSuccess("");
	
	if (!value.match(/^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/)) {
	    setErrorUsername('Please enter a valid username, like AAAAA1.');
	} else {
	    setErrorUsername('');
	}
    }

    function handleTokenChange(event) {
	const { value } = event.target;
	setDataSettings(dataSettings => ({ ...dataSettings, ...{'token': value} }));

	setSaveSuccess("");
	
	if (!value.match(/^[a-zA-Z][a-zA-Z0-9_]{3,30}[a-zA-Z0-9]$/)) {
	    setErrorToken('Please enter a valid token, like BBBBB2.');
	} else {
	    setErrorToken('');
	}
    }
    
    const handleSubmit = (e) => {
	e.preventDefault();

	setSaveSuccess("");
	if ( errorUsername == "" && errorToken == "" ){
	    setIsPending(true);
	    setError(null);
	    
	    setTimeout(() => {
		/* 	apiFetch takes care of nonce, nonce is not required
			https://wordpress.stackexchange.com/a/378192 
		*/
		apiFetch({ path:"/"+pluginName+'/v1/settings',
			   method: 'POST',
			   data:dataSettings,
			   //headers: {'X-WP-Nonce': myplugin.api.nonce}
			 }).then(
			     (data) => {
				 //console.log( 'dataFromRest1:', data );
				 setIsPending(false);
				 setError(null);
				 setSaveSuccess("SAVED!");
				 // redundant, just testing GET
				 setRefreshGet(refreshGet+1);
			     },
			     (error) => {
				 //console.log( 'errorFromRest1:', error );
				 setIsPending(false);
				 setError('Error while saving settings.');
			     }).catch(
				 error => {
				     console.error(error);
				     setIsPending(false);
				     setError('Error while saving settings.');
				 });
	    }, 2000);
	}
    }
    return (
        <div>
          <h3>Main Settings</h3>
	  <form onSubmit={handleSubmit}>
            <label>Username:</label>
            <input 
              type="text" 
              value={dataSettings.username}
              onChange={(e) => handleUsernameChange(e)}
              ></input>
	    <div>{errorUsername}</div>
	    <hr></hr>
            <label>Token:</label>
            <input 
	      type="text" 
	      value={dataSettings.token}
	      onChange={(e) => handleTokenChange(e)}
	      ></input>
	    <div>{errorToken}</div>
	    <hr/>
	    <button>{isPending ? "SAVING ..." : "SAVE"}</button>
	    <div>{errorUsername+" "+errorToken}</div>
	    <div>{error != null ? error : ""}</div>
	    <div>{saveSuccess}</div>		
	  </form>
	  <hr></hr>
	  <h4>Data from get is unused and redundant. It is here to show how it could also be done.</h4>
	  <div>
	    <div>errorFromGet: {errorFromGet != null ? errorFromGet : "NO ERROR"}</div>
	    <div>isPendingFromGet: {isPendingFromGet  ? "PENDING" : "NOT PENDING"}</div>
	    <div>token and username: {dataFromGet !=null ? dataFromGet.token+" "+ dataFromGet.username : "NO DATA"}</div>
	  </div>
        </div>
    );
}
export default Dashboard;
