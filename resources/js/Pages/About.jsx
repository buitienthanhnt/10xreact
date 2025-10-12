import { PageSmItem } from "@/Components/PageComponent";
import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { InfiniteScroll, router } from "@inertiajs/react";

export default function About({ pages }) {

	const filter = (role) => {
		router.visit(route('about'), {
			data: { ...role },
			//   only: ['pages'],
			reset: ['pages'], // reset attr để các giá trị sau khi lọc sẽ được đặt lại mà không bị gộp.
		})
	}

	const clear = () => {
		router.visit(route('about'), {
			reset: ['pages'],
		})
	}

	return (
		<SingleLayout>
			<div className="space-y-2">
				<p className="font-extrabold text-2xl text-blue-500 bg-white rounded-md p-2">Danh sách bài viết tập trung:</p>
				<div className="grid grid-cols-5 gap-2">
					<div className="bg-white rounded-md p-2 col-span-3">
						<InfiniteScroll data="pages" className="space-y-1" >
							{pages.data.map(page => (
								<PageSmItem key={page.id} item={page}></PageSmItem>
							))}
						</InfiniteScroll>
					</div>
					<div className="col-span-2 bg-white rounded-md gap-2 p-2">
						<div className="flex flex-wrap gap-2 fixed">
							<button className="bg-blue-gray-400 rounded-md p-2" onClick={() => filter({ cat: 9 })}>thời sự</button>
							<button className="bg-blue-gray-400 rounded-md p-2" onClick={() => filter({ cat: 10 })}>trong nước</button>
							<button className="bg-red-400 rounded-md p-2" onClick={clear}>clear</button>
							<button className="bg-green-600 rounded-md p-2 text-white" onClick={clear}>save</button>
							<button className="bg-purple-400 rounded-md p-2" onClick={() => filter({ cat: 11 })}>xã hội</button>
							<button className="bg-orange-400 rounded-md p-2" onClick={() => filter({ cat: 12 })}>quốc tế</button>
						</div>
					</div>
				</div>
			</div>
		</SingleLayout>
	)
}