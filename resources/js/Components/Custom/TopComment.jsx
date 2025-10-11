import React from "react";
import ImagePage from "./ImagePage";
import { useTopComment } from "@/hook/useComments";
import { Info } from "../PageComponent";
import { Link } from "@inertiajs/react";

// color of tailwin css.
// https://www.material-tailwind.com/docs/react/colors
const TopComment = () => {
	const {data, isError, isFetched, isFetching, isLoading, isRefetching, isPending, error} = useTopComment();

	if (isFetching || isLoading || !data) {
		return null;
	}

	return (
		<div className="bg-white p-1 rounded-md grid gap-y-2">
			<WriterInfo writer={data.writer}></WriterInfo>
			<Link className="p-1 space-y-1" href={route('detail', {alias: data.alias})}>
				<p className="font-semibold text-xl text-black">{data.title}</p>
				<p className="italic text-base font-semibold text-gray-800">{data.desciption}</p>
				<ImagePage source={data.image_path} className={'w-full h-96 md:h-[450px] object-center rounded-lg'}></ImagePage>
				<Info pageId={data.id}></Info>
			</Link>
		</div>
	)
}

const WriterInfo = ({writer}) => {

	return (
		<Link href={`/writer/${writer.id}`} className="flex gap-x-4">
			<div className="w-20 h-20 md:w-32 md:h-32 flex items-center justify-center rounded-full bg-blue-gray-700">
				<img src={writer.image_path} className={'h-full w-full rounded-full object-cover'}></img>
			</div>
			<div className="px-2 self-end">
				<span className="font-bold text-xl">
					{writer.name}
				</span>
				<p className="text-xl font-semibold text-deep-purple-400">{writer.email}</p>
			</div>
		</Link>
	)
}

export { TopComment, WriterInfo };