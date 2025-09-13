import usePageRandom from "@/hook/usePageRandom";
import { Link } from "@inertiajs/react";

const Propose = () => {
	const { pages, isloadDing, isError } = usePageRandom();

	if (isloadDing) {
		return (
			<div>
				<p>isLoadding</p>
			</div>
		)
	}
	
	return (
		<div className="bg-white p-1 rounded-sm md:rounded-md space-y-1">
			<p className="text-xl text-blue-gray-600 underline font-bold">Nội dung đề xuất:</p>
			<div className="">
				{pages.map((page, index) => <Link href={route('detail', { alias: page.alias })} className="text-lg text-blue-600 ml-2 block" key={`random-${index}`}>{page.title}</Link>)}
			</div>
		</div>
	)
}

export default Propose;