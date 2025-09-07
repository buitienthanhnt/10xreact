
import { ImageType, TextEditorType, TextType, VideoType } from "@/Components/PageContent";
import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head } from "@inertiajs/react";
import { useEffect } from "react";

export default function Detail({ page: { title, desciption, page_contents } }) {
	useEffect(() => {
	}, [])

	return (
		<SingleLayout>
			<Head title="chi tiết">

			</Head>
			<PageInfo title={title} desciption={desciption}></PageInfo>
			{!!page_contents.length && <PageContent pageContents={page_contents}></PageContent>}
		</SingleLayout>
	)
}

const PageInfo = ({ title, desciption }) => {
	return (
		<div className="bg-white dark:bg-gray-500 rounded-md p-1">
			<p className="text-xl font-bold text-blue-500">{title}</p>
			<p className="text-md text-gray-800 dark:text-white" dangerouslySetInnerHTML={{ __html: desciption }}></p>
			{/* <span className="text-sm font-bold text-green-700">trajng thai: {active}</span> */}
		</div>
	)
}

const PageContent = ({ pageContents }) => {
	return (
		<div className="bg-white  dark:bg-gray-500 rounded-md p-1 lg:px-2 mt-1">
			{pageContents.map(function (content, index) {
				let render;
				switch (content.type) {
					case 'text':
					case 'textarea':
						render = <TextType content={content} key={`content-${index}`}></TextType>
						break;
					case 'textEditor':
						render = <TextEditorType content={content} key={`content-${index}`}></TextEditorType>
						break;
					case 'file':
					case 'imageChoose':
						render = <ImageType content={content} key={`content-${index}`}></ImageType>
						break;
					case 'video':
						render = <VideoType content={content} key={`content-${index}`}></VideoType>
						break;
					default:
						render = (
							<div key={`content-${index}`}>
								{content.type}
							</div>
						)
						break;
				}
				return <>
				{render}
				{index< pageContents.length - 1 ? (<div className="h-[1px] bg-gray-400 my-0.5"></div>) : null}
				</>;
			})}
		</div>
	);
}
