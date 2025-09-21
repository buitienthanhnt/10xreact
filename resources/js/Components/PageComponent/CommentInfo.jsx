
import { useCommentInfo } from '@/hook/useComments';
import { FireIcon, HandThumbUpIcon, HeartIcon, StarIcon } from '@heroicons/react/24/solid';

const CommentInfo = ({ comment }) => {
	const { like, heart, star, fire, onAdd } = useCommentInfo(comment);
	return (
		<div className="flex space-x-3">
			<HandThumbUpIcon color={like.includes(comment.id.toString()) ? '#27add6' : 'gray'} className="h-5 w-5" onClick={() => onAdd('like')}></HandThumbUpIcon>
			<HeartIcon color={heart.includes(comment.id.toString()) ? 'red' : 'gray'} className="h-5 w-5" onClick={() => onAdd('heart')}></HeartIcon>
			<StarIcon color={star.includes(comment.id.toString()) ? 'orange' : 'gray'} className="h-5 w-5" onClick={() => onAdd('star')}></StarIcon>
			<FireIcon color={fire.includes(comment.id.toString()) ? 'red' : 'gray'} className="h-5 w-5" onClick={() => onAdd('fire')}></FireIcon>
		</div>
	)
}

export default CommentInfo;