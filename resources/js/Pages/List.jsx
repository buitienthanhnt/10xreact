import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head } from "@inertiajs/react";
import {Paginate, ListItem} from "@/Components/Custom";

const List = ({ current_page, last_page, data, links }) => {
    if (!data) {
        return null;
    }

    return (
        <>
            <Head title="list page"></Head>
            {data && <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-4">
                {data.map((item, index) => {
                    return <ListItem key={index} item={item}></ListItem>
                })}
            </div>}
            <Paginate pageSize={last_page} currentPage={current_page} links={links} url={window.location.href}></Paginate>
        </>
    )
}

List.layout = page => (
    <SingleLayout children={page} />
)

export default List
