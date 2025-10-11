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
				<p className="font-semibold text-xl text-purple-400">{data.title}</p>
				<ImagePage source={data.image_path} className={'w-full h-96 md:h-[450px] object-center rounded-lg'}></ImagePage>
				<p className="">{data.desciption}</p>
				<Info pageId={data.id}></Info>
			</Link>
		</div>
	)
}

const WriterInfo = ({writer}) => {

	return (
		<Link href={`/writer/${writer.id}`} className="flex gap-x-4">
			<img src={writer.image_path} className={'w-20 h-20 md:w-28 md:h-28 rounded-full object-center'}></img>
			<div className="w-full px-2 items-end float-end self-end">
				<span className="font-bold text-xl">
					{writer.name}
				</span>
				<p className="text-xl font-semibold text-deep-purple-400">{writer.email}</p>
			</div>
		</Link>
	)
}

export { TopComment, WriterInfo };