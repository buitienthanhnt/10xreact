import { HandThumbUpIcon, HeartIcon, LinkIcon } from "@heroicons/react/24/solid";
import { useCallback, useMemo, useState } from "react";
import { Rating } from "@material-tailwind/react";
// import { router } from '@inertiajs/react'
// import axios from "axios";
// import rApi from "@/network/rApi";

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
		}) : [pageId, ...listChecked];
		/**
		 * gán giá trị vào bộ nhớ cục bộ trình duyệt.
		 */
		localStorage.setItem(key, newListChecked.join('|'));
		setAction(newListChecked.join('|'));
	}, [pageId]);

	// const onSelectType = useCallback( async ()=>{
	// sẽ không dùng được các phương thức của inertia để gọi yêu cầu tĩnh vì nó luôn luôn cần trả về 1 Inertia thành phần
	// router.get('/test/json', {}, {
	// 	preserveState: true,
	// 	onSuccess: (params)=>{
	// 		console.log('===>', params);
	// 	}
	// })
	// cho nên khi cần gọi yêu cầu tĩnh thì ta phải dùng fetch hoặc axios.
	// 1. fetch:
	// const data = await fetch('/test/json');
	// const val = await data.json();
	// 2. axios:
	// const data = await axios.get('/test/json');
	// console.log('====================================');
	// console.log(data.data);
	// 3. use custom axios network api:
	// let data;
	// try {
	// 	data = await rApi.callRequest({
	// 		url: '/test/json',
	// 		method: 'GET',
	// 	}); // json response data by server. 
	// } catch (error) {
	// 	data = error.data.message; // string
	// }
	// console.log('====================================');
	// console.log(data);
	// }, [])

	return (<div className="bg-white rounded-md p-4 justify-between flex items-center">
		<Rating value={4} readonly/>
		<div className="justify-end flex gap-2">
			{typeInfo.map(function (type, index) {
				return (
					<div className="bg-orange-200 p-1 rounded-full" onClick={() => { onPressItem(type) }} key={`info-${index}`} style={{ backgroundColor: checkSelected(type) ? 'rgb(149, 210, 250)' : '' }}>
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
			})}</div>
	</div>)
}