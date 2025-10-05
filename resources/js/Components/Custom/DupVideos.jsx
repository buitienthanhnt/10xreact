import React from "react";
import ImagePage from "./ImagePage";
import { PlayCircleIcon } from "@heroicons/react/24/solid";
import { Link } from "@inertiajs/react";

const DupVideos = ({ items }) => {
	// http://img.youtube.com/vi/XSBQJ3bVJ0U/maxresdefault.jpg
	// aspect-[7/9]: tỷ lệ kích thước chiều cao và chiều ngang của thành phần.
	// absolute center: absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2

	return (
		<div className="p-1 bg-white grid grid-cols-2 gap-4 rounded-md">
			{items.map((item, index) => <VideoBanner item={item} key={`video-${index}`}></VideoBanner>)}
		</div>
	)
}

const VideoBanner = ({ item: {id, page_contents, title, alias} }) => {
	return (
		<Link className="col-span-1 bg-white rounded-md flex relative justify-center items-center" href={route('detail', {alias})}>
			<ImagePage source={`https://img.youtube.com/vi/${page_contents[0].value}/maxresdefault.jpg`} className='w-full aspect-[7/9] rounded-md'></ImagePage>
			<p className="absolute bottom-0 left-0 bg-[#925ccc3b] w-full p-1 font-semibold text-xl text-orange-800 rounded-t-md">{title}</p>
			<div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
				<PlayCircleIcon width={80} height={80} color="red"></PlayCircleIcon>
			</div>
		</Link>
	)
}

export default DupVideos