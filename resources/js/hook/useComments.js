import { getCommentList } from "@/query/comments"
import { useInfiniteQuery } from "@tanstack/react-query"
import { useCallback, useMemo, useState } from "react"

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

const commentInfoKey = 'commentInfo';
const useCommentInfo = (comment)=>{
	const [key, setKey] = useState('');

	const added = useMemo(()=>{
		const commentLike = localStorage.getItem(commentInfoKey+'_like')?.split("|") || [];
		const commentHeart = localStorage.getItem(commentInfoKey+'_heart')?.split("|") || [];
		const commentfire = localStorage.getItem(commentInfoKey+'_fire')?.split("|") || [];
		const commentStar = localStorage.getItem(commentInfoKey+'_star')?.split("|") || [];
		return {
			like: commentLike,
			heart: commentHeart,
			star: commentStar,
			fire: commentfire,
		}
	}, [key])

	const onAdd = useCallback((type)=>{
		const isAdded = added[type].includes(comment.id.toString());
		if (isAdded) {
			localStorage.setItem(commentInfoKey+'_'+type, added[type].filter(i => i!== comment.id.toString()).join('|'));
		}else{
			localStorage.setItem(commentInfoKey+'_'+type, [comment.id.toString(), ...added[type]].join('|'));
		}
		setKey(type+(isAdded ? '_add_' : '_remove_')+comment.id.toString());
	}, [added])

	return {
		...added,
		onAdd,
	}
}

export { useListComment, useCommentInfo }