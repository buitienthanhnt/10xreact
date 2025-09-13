import useRelatedPage from "@/hook/useRelatedPage";
import { Link } from "@inertiajs/react";

const RelatedPage = (props) => {
	const { pages } = useRelatedPage();

	if (!pages.length) {
		return null;
	}

	return (
		<div className="bg-white rounded-md p-1 py-2">
			<h3 className="text-lg text-orange-500 underline">Danh sách đã xem: </h3>
			<div className={`grid md:flex columns-${pages.length} md:columns-2 space-x-1 space-y-1`}>
				{pages.map((item, index) => {
					return <RelatedItem page={item} key={index}></RelatedItem>
				})}
			</div>
		</div>
	)
}

const RelatedItem = ({ page }) => {
	// line-clamp-2: so dong cua van ban
	// min-h-[3rem]: chieu cao toi thieu cua van ban; minHeight: '2lh' chieu cao toi thieu = 2 dong.
	return (
		<Link href={route('detail', { alias: page.alias })} className="flex-1 rounded p-2 space-y-1 text-md bg-blue-gray-50 block">
			<h3 className="font-semibold text-gray-900  rounded-sm line-clamp-2 md:min-h-[3rem]" style={{minHeight: '2lh'}}>{page.title}</h3>
			<img src={page.image_path} className="rounded-md"></img>
		</Link>
	)
}

export default RelatedPage;