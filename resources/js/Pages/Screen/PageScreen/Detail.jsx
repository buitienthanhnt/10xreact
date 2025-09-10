
import { ImageType, InpageCategory, Tags, TextEditorType, TextType, VideoType } from "@/Components/PageContent";
import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head } from "@inertiajs/react";
import { useEffect } from "react";

export default function Detail({ page: { title, desciption, page_contents, tags, categories } }) {
    useEffect(() => {
    }, [])

    return (
        <SingleLayout>
            <Head title="chi tiết">
            </Head>
            <PageInfo title={title} desciption={desciption}></PageInfo>
            <PageContent pageContents={page_contents}></PageContent>
            <Tags tags={tags}></Tags>
            <InpageCategory categories={categories}></InpageCategory>
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
    if (!pageContents) {
        return null;
    }

    return (
        <div className="bg-white  dark:bg-gray-500 rounded-md p-1 lg:px-2 mt-1">
            {pageContents.map(function (content, index) {
                let render;
                switch (content.type) {
                    case 'text':
                    case 'textarea':
                        render = <TextType content={content}></TextType>
                        break;
                    case 'textEditor':
                        render = <TextEditorType content={content}></TextEditorType>
                        break;
                    case 'file':
                    case 'imageChoose':
                        render = <ImageType content={content}></ImageType>
                        break;
                    case 'video':
                        render = <VideoType content={content}></VideoType>
                        break;
                    default:
                        render = (
                            <div>
                                {content.type}
                            </div>
                        )
                        break;
                }
                return <div key={`content-${index}`}>
                    {render}
                    {index < pageContents.length - 1 ? (<div className="h-[1px] bg-gray-400 my-0.5"></div>) : null}
                </div>;
            })}
        </div>
    );
}
