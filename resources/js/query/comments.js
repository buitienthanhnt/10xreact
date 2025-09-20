import rApi from "@/network/rApi"
import Urls from "@/network/Urls";

const getCommentList = async (targetId, parent_id, page = 1) => {
	const response = await rApi.callRequest({
		url: Urls.getComments,
		method: 'GET',
		params: {
			page: page,
			targetId: targetId,
			type: null,
			parent_id: parent_id,
		}
	});

	return response;
}
export { getCommentList }
