
import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { useEffect } from "react";

export default function Detail({ page: {title, desciption, active}}) {
	useEffect(()=>{
	}, [])

	return (
		<SingleLayout>
			<div>
				<p className="text-lg text-blue-500">{title}</p>
				<p className="text-xl text-orange-500" dangerouslySetInnerHTML={{ __html: desciption }}></p>
				<span className="text-sm font-bold text-green-700">trajng thai: {active}</span>
			</div>
		</SingleLayout>
	)
}