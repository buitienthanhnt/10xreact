
import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head } from "@inertiajs/react";
import { useEffect } from "react";

export default function Detail({ page: {title, desciption, active}}) {
	useEffect(()=>{
	}, [])

	return (
		<SingleLayout>
            <Head title="chi tiết">

            </Head>
			<div>
				<p className="text-lg text-blue-500">{title}</p>
				<p className="text-xl text-orange-500" dangerouslySetInnerHTML={{ __html: desciption }}></p>
				<span className="text-sm font-bold text-green-700">trajng thai: {active}</span>
			</div>
		</SingleLayout>
	)
}
