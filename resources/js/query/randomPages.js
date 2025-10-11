import rApi from "@/network/rApi";
import Urls from "@/network/Urls";

/**
 * get ramdom pages.
 */
const randomPages = async (limit = 6) => {
	return await rApi.callRequest({
		url: Urls.pageRandom+ `?limit=${limit}`,
		method: 'GET',
	})
}

export default randomPages;