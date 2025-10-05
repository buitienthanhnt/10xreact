import { usePageSugget } from "@/hook/usePageSugget";
import { PageSmList } from "../PageComponent";

const SuggetVertical = ({pageId, title})=>{
	const {pages, isLoading} = usePageSugget(pageId);

	if (isLoading || !pages) {
		return;
	}

	return(
		<PageSmList items={pages} title={title}></PageSmList>
	)
}

export {SuggetVertical};