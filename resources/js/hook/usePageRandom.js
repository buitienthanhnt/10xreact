import randomPages from "@/query/randomPages";
import { useQuery } from "@tanstack/react-query";

const usePageRandom = ()=>{
	const { isError, data, error, isFetching} = useQuery({
		queryKey: ['page-random', undefined],
		queryFn: () => randomPages(6),
	  })

	return {
		pages: data,
		isLoading: isFetching,
		isError,
		error,
	}
}

export default usePageRandom;