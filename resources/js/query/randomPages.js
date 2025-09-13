import rApi from "@/network/rApi";
import Urls from "@/network/Urls";

/**
 * get ramdom pages.
 */
const randomPages = async () => {
	return await rApi.callRequest({
		url: Urls.pageRandom,
		method: 'GET',
	})
}

export default randomPages;