import { getCenterCategory } from "@/query/category";
import { useQuery } from "@tanstack/react-query";

const useCenterCategory = ()=>{
	const query = useQuery({
		queryKey: ['centerCategory'],
		queryFn: getCenterCategory,
	})
	return {...query};
}

export {useCenterCategory}