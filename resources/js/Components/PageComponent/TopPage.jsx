import { Link } from "@inertiajs/react"
import { ImagePage } from "../Custom"

// http://adoc.dev/storage/photos/shares/global/Dao-le-15_090718_084835.jpg
const hit = {
	"id": 11,
	"title": "Hé lộ những điều bất thường khiến FIFA nghi ngờ cầu thủ nhập tịch Malaysia",
	"alias": "ldbd-malaysia-chinh-thuc-thua-nhan-sai-sot-trong-qua-trinh-nhap-tich",
	"active": "hoạt động",
	"desciption": "demo for test 1 23",
	"image_path": "http://adoc.dev/storage/photos/shares/global/Dao-le-15_090718_084835.jpg",
	"deleted_at": null,
	"created_at": "2025-08-11T16:03:38.000000Z",
	"updated_at": "2025-08-14T15:23:35.000000Z",
	"writer": 41
}

export function TopPage(props) {
	return (
		<div className="bg-white p-1 rounded-md md:grid grid-cols-3 gap-1 space-y-1 md:space-y-0">
			<div className="col-span-2">
				<PrimaryPage page={props?.hot || hit}></PrimaryPage>
			</div>
			<div className="col-span-1">
				<SecondPages></SecondPages>
			</div>
		</div>
	)
}

const PrimaryPage = ({ page }) => {
	return (
		<Link className="relative flex h-full" style={{ backgroundImage: page.image_path }} href={route('detail', { alias: page.alias })}>
			<ImagePage source={page.image_path} className={'w-full h-auto rounded-md'}>
			</ImagePage>
			<p className="absolute bottom-10 left-2 md:left-8 line-clamp-2 font-semibold text-3xl text-orange-500">{page.title}</p>
		</Link>
	)
}
// http://adoc.dev/storage/photos/shares/global/vu-thuy-quynh-4-0-1726370672.jpg
const second = [
	{
		"id": 41,
		"title": "test timeline update 2",
		"alias": "test-timeline-update2",
		"active": "ho\u1ea1t \u0111\u1ed9ng",
		"desciption": null,
		"image_path": "http://adoc.dev/storage/photos/shares/global/Dao-le-15_090718_084835.jpg",
		"writer": 43
	},
	{
		"id": 44,
		"title": "test video 2",
		"alias": "test-video2",
		"active": "ho\u1ea1t \u0111\u1ed9ng",
		"desciption": "Kh\u00e1m Ph\u00e1 \u0110\u1ecba Ph\u1ee7: B\u00ean Trong 18 T\u1ea7ng \u0110\u1ecba Ng\u1ee5c C\u00f3 G\u00ec ?",
		"image_path": "http://adoc.dev/storage/photos/shares/global/vu-thuy-quynh-4-0-1726370672.jpg",
		"updated_at": "2025-09-27T05:52:36.000000Z",
		"writer": 30
	},
];
// https://tailwindcss.com/docs/grid-auto-rows
const SecondPages = ({ pages }) => {
	return (
		<div className="md:grid grid-cols-1 grid-rows-2 space-y-1 h-full">
			{second.map((page, index) => {
				return (
					<Link 
						className="bg-blue-gray-500 rounded-md relative grid-rows-1 flex justify-center items-center" 
						key={`second-${index}`} 
						href={route('detail', { alias: page.alias })}
					>
						<p className="absolute bottom-10 left-2 md:left-4 line-clamp-2 font-semibold text-2xl text-green-600">{page.title}</p>
						<ImagePage source={page.image_path} className={'w-full h-auto rounded-md'}></ImagePage>
					</Link>
				)
			})}
		</div>
	)
}