/**********************
 // This facility is unused and redundant. It is here to show how it could also be done.
 **************************/

import { useState, useEffect } from 'react';
import apiFetch from "@wordpress/api-fetch";
import plugin from "../Plugin.js";

const yourTextDomain = plugin().textDomain;

const useFetchForGet = (url,refresh) => {
    const [dataFromGet, setDataFromGet] = useState(null);
    const [isPendingFromGet, setIsPendingForGet] = useState(true);
    const [errorFromGet, setErrorFromGet] = useState(null);

    useEffect(() => {
	const abortCont = new AbortController();

      	apiFetch({ path:url,
		   method: 'GET',
		 })
	    .then(
		(data) => {
		    setIsPendingForGet(false);
		    setDataFromGet(data);
		    setErrorFromGet(null);

		    //console.log( 'dataFromGet:', data );
		},
		(error) => {
		    console.log( 'errorFromGet:', error );
	       	    setIsPendingForGet(false);
		    setErrorFromGet(__('Error during GET request', yourTextDomain));
		})
	    .catch(err => {
		if (err.name === 'AbortError') {
		    console.log('fetch aborted')
		} else {
		    setIsPendingForGet(false);
		    setErrorFromGet(err.message);
		}
	    })
	// abort the fetch
	return () => abortCont.abort();
    }, [url, refresh])

    return { dataFromGet, isPendingFromGet, errorFromGet };
}

export default useFetchForGet;
