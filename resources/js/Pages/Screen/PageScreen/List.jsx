import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head, router } from "@inertiajs/react";
import { Paginate, ListItem } from "@/Components/Custom";
import { DropdownMenu } from "@/Components/Custom/DropdownMenu";
import { useCallback } from "react";

const List = ({ current_page, last_page, data, links, filters }) => {
    if (!data) { return null; }

    return (
        <>
            <Head title="list page">
                {/* add css inline for page. */}
                <style>
                    {`.demo{background-color: red;}`}
                </style>
            </Head>
            <div className="space-y-2">
                <PageFilter filters={filters}></PageFilter>
                {data && <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-4">
                    {data.map((item, index) => {
                        return <ListItem key={index} item={item}></ListItem>
                    })}
                </div>}
                <Paginate pageSize={last_page} currentPage={current_page} links={links} url={window.location.href}></Paginate>
            </div>
        </>
    )
}

const PageFilter = ({ filters = [] }) => {
    const onChange = useCallback((type, item) => {
        router.get(window.location.href, {
            [type]: item.value
        });
    }, []);

    if (!filters.length) { return null; }

    return (
        <div className="bg-white rounded-sm">
            <Head>
                {/* add css inline component  */}
                <style>
                    {`.test-css{background-color: green;}`}
                </style>
            </Head>
            <div className="grid lg:flex w-full space-y-1 lg:space-y-0 lg:space-x-1">
                {filters.map(item => <DropdownMenu {...item} onChange={onChange}></DropdownMenu>)}
            </div>
        </div>
    )
}

List.layout = page => (
    <SingleLayout children={page} />
)

export default List
