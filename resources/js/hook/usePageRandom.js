import randomPages from "@/query/randomPages";
import { useQuery } from "@tanstack/react-query";

const usePageRandom = ()=>{
	const { isError, data, error, isFetching} = useQuery({
		queryKey: ['page-random', undefined],
		queryFn: randomPages,
	  })

	return {
		pages: data,
		isloadDing: isFetching,
		isError,
		error,
	}
}

export default usePageRandom;