import TopPageLayout from "@/Layouts/BuildLayout/TopPageLayout";
import { Head, Link } from "@inertiajs/react";

export default function Docs({ categories }) {

    if (!categories) {
        return null;
    }

    return (
        <TopPageLayout>
            <Head>
                <title>danh mục</title>
            </Head>
            <div className="flex-wrap bg-white rounded-lg">
                {categories.map(function (category, index) {
                    return <Link href={route('category', {category: category.alias})} className="inline-block bg-gray-700 px-3 py-2 rounded-md m-2" key={index}>
                        <span className="text-lg font-bold text-white">{category.name}</span>
                    </Link>
                })}
            </div>
        </TopPageLayout>
    )
}
