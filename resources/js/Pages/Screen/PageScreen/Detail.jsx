import { Head } from "@inertiajs/react";
import RelatedPage from "@/Components/Custom/RelatedPage";
import { ImageType , TextEditorType, TextType, VideoType, TextAreaType } from "@/Components/PageContent";
import { InpageCategory, Tags, Info, Propose, CommentForm, CommentList} from "@/Components/PageComponent";
import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";

export default function Detail({ page: { title, desciption, page_contents, tags, categories, id } }) {

    return (
        <SingleLayout>
            <Head title="chi tiết">
            </Head>
            <div className="grid gap-y-1">
                <PageInfo title={title} desciption={desciption}></PageInfo>
                <PageContent pageContents={page_contents}></PageContent>
                <Info info={{}} pageId={id}></Info>
                <Tags tags={tags}></Tags>
                <InpageCategory categories={categories}></InpageCategory>
                <CommentList></CommentList>
                <CommentForm pageId={id}></CommentForm>
                <RelatedPage></RelatedPage>
                <Propose></Propose>
            </div>
        </SingleLayout>
    )
}

const PageInfo = ({ title, desciption }) => {
    return (
        <div className="bg-white dark:bg-gray-500 rounded-md p-1">
            <p className="text-xl font-bold text-blue-500">{title}</p>
            <p className="text-md text-gray-800 dark:text-white" dangerouslySetInnerHTML={{ __html: desciption }}></p>
        </div>
    )
}

const PageContent = ({ pageContents }) => {
    if (!pageContents.length) {
        return (<div className="flex bg-white p-2 justify-center items-center">
            <h3 className="text-orange-500 underline font-italic font-semibold">Not content here!</h3>
        </div>);
    }

    return (
        <div className="bg-white  dark:bg-gray-500 rounded-md p-1 lg:px-2 mt-1">
            {pageContents.map(function (content, index) {
                let render;
                switch (content.type) {
                    case 'text':
                        render = <TextType content={content}></TextType>
                        break;
                    case 'textarea':
                        render = <TextAreaType content={content}></TextAreaType>
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
