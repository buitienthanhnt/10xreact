import { useCenterCategory } from "@/hook/useCategory";
import GalleryList from "./GalleryList";

const CenterCategory = ()=>{
	const {data, isFetching} = useCenterCategory();
	if (isFetching || !data) {
		return;
	}

	return <GalleryList data={data}></GalleryList>
}

export {CenterCategory};