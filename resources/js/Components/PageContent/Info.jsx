import { HandThumbUpIcon, HeartIcon, LinkIcon } from "@heroicons/react/24/solid";
import { useCallback, useMemo, useState } from "react";

const typeInfo = ['like', 'heart', 'link'];

/**
 * Sử dụng: localStorage để lưu trữ các bài viết đã thích.
 */
export default function Info({ pageId }) {
	const [action, setAction] = useState('');
	const checkedInfo = useMemo(() => {
		let saved = {};
		typeInfo.map((t) => {
			/**
			 * lấy thông tin đã lưu trữ trong bộ nhớ cục bộ
			 */
			const data = localStorage.getItem(`page-info-${t}`);
			saved[t] = data ? data.split('|') : [];
		})
		return saved;
	}, [action]);

	/**
	 * kiểm tra xem đã thêm vào bộ nhớ cục bộ hay chưa.
	 */
	const checkSelected = useCallback((type) => {
		return checkedInfo[type].includes(pageId.toString());
	}, [pageId, checkedInfo]);

	const onPressItem = useCallback((type) => {
		const key = `page-info-${type}`;
		const checked = localStorage.getItem(key);
		const listChecked = checked ? checked.split('|') : [];
		let newListChecked = listChecked.includes(pageId.toString()) ? listChecked.filter(function (i) {
			return i !== pageId.toString();
		}) : [...listChecked, pageId];
		/**
		 * gán giá trị vào bộ nhớ cục bộ trình duyệt.
		 */
		localStorage.setItem(key, newListChecked.join('|'));
		setAction(newListChecked.join('|'));
	}, [pageId]);

	return (<div className="bg-white rounded-md p-4 justify-end flex gap-2">
		{typeInfo.map(function (type, index) {
			return (
				<div className="bg-orange-200 p-1 rounded-full" onClick={() => { onPressItem(type) }} key={`info-${index}`} style={{ backgroundColor: checkSelected(type) ? 'violet' : '' }}>
					{(() => {
						switch (type) {
							case 'like':
								return <HandThumbUpIcon className="h-6 w-6" color="red"></HandThumbUpIcon>
								break;
							case 'heart':
								return <HeartIcon className="h-6 w-6" color="red"></HeartIcon>;
							case 'link':
								return <LinkIcon className="h-6 w-6" color="red"></LinkIcon>;
							default:
								return null;
						}
					})()}
				</div>
			);
		})}
	</div>)
}