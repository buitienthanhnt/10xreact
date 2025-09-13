import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import List from "./List";

const PageByTag = (props) => {
	const { pages } = props;

	return (
		<SingleLayout>
			<head>
				<title>tag: {props.tag}</title>
			</head>
			<div className="space-y-1">
				<h2 className="bg-white rounded-md p-2 font-semibold text-xl text-blue-600">tim theo tag: {props.tag}</h2>
				<List {...pages}></List>
			</div>
		</SingleLayout>
	)
}

export default PageByTag;