import { getCommentList } from "@/query/comments"
import { useInfiniteQuery } from "@tanstack/react-query"

// https://tanstack.com/query/v4/docs/framework/react/reference/useInfiniteQuery
// https://tanstack.com/query/latest/docs/framework/react/reference/infiniteQueryOptions
const useListComment = ({ type, targetId, enabled, parent_id}) => {
	const {
		data,
		error,
		fetchNextPage,
		hasNextPage,
		isFetching,
		isFetchingNextPage,
		status,
	} = useInfiniteQuery({
		queryKey: ['comment', type, targetId, parent_id],
		queryFn: ({ pageParam = 1 }) => getCommentList(targetId, parent_id, pageParam),
		initialPageParam: 1,
		getNextPageParam: (lastPage, pages, ) => {
			if (lastPage.current_page < lastPage.last_page) {
				return lastPage.current_page + 1
			}
			return undefined;
		},
		retry: false,
		enabled: enabled,
		staleTime: 0, //cache time
		refetchOnWindowFocus: false,
		refetchOnMount: true,
	})

	return {
		data: data ? data.pages.map(item => item.data).flat() : null,
		error,
		fetchNextPage,
		hasNextPage, isFetching, isFetchingNextPage, status
	}
}

export { useListComment }