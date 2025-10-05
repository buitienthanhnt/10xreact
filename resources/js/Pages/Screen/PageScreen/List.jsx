import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head, router } from "@inertiajs/react";
import { Paginate, ListItem, GalleryList, TimeList } from "@/Components/Custom";
import { DropdownMenu } from "@/Components/Custom/DropdownMenu";
import { useCallback, useMemo } from "react";
import Banner from "@/Components/Custom/Banner";
import { ArrowPathIcon } from "@heroicons/react/24/solid";
import {TopPage, HorizonList, PageSmList, DupList} from "@/Components/PageComponent";

const List = ({ current_page, last_page, data, links, filters, randoms, deXuat }) => {
    if (!data) { return null; }

    return (
        <>
            <Head title="list page">
                {/* add css inline for page.(<Head> tag must be in: <> tag; not in <div> tag) */}
                <style>
                    {`.demo{background-color: red;}`}
                </style>
            </Head>
            <div className="space-y-2">
                <TopPage></TopPage>
                <PageFilter filters={filters}></PageFilter>
                {data && <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-4">
                    {data.map((item, index) => {
                        return <ListItem key={index} item={item}></ListItem>
                    })}
                </div>}
                <Paginate pageSize={last_page} currentPage={current_page} links={links} url={window.location.href}></Paginate>
                <Banner layout={''} page={randoms[2]}></Banner>
                <PageSmList items={randoms}></PageSmList>
                <HorizonList items={deXuat}></HorizonList>
                <GalleryList items={deXuat.slice(3, 5)}></GalleryList>
                <TimeList></TimeList>
            </div>
        </>
    )
}

const PageFilter = ({ filters = [] }) => {
    /**
     * action for select filter item.
     */
    const onChange = useCallback((type, item) => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get(type) == item.value) {
            // remove filter param.
            router.get(window.location.href, {
                [type]: undefined,
                page: undefined, // reset page
            });
            return;
        }
        router.get(window.location.href, {
            [type]: item.value,
            page: undefined, // reset page
        });
    }, []);

    const isSelectedFilter = useMemo(() => {
        const selected = filters.filter(filter => filter.data.filter(i => i.selected).length);
        return !!selected.length;
    }, [])

    const onReset = useCallback(() => {
        router.get(window.location.pathname,);
        return;
    }, [])

    if (!filters.length) { return null; }

    return (
        <>
            <Head>
                {/* add css inline component  */}
                <style>
                    {`.test-css{background-color: green;}`}
                </style>
            </Head>
            <div className="bg-white rounded-sm space-y-1">
                {isSelectedFilter && <div className="flex justify-end p-1 px-2">
                    <ArrowPathIcon className="h-6 w-6" onClick={onReset}></ArrowPathIcon>
                </div>
                }
                <div className="grid lg:flex w-full space-y-1 lg:space-y-0 lg:space-x-1">
                    {filters.map((item, index) => <DropdownMenu {...item} onChange={onChange} key={`item.${index}`}></DropdownMenu>)}
                </div>
            </div>
        </>
    )
}

List.layout = page => (
    <SingleLayout children={page} />
)

export default List
