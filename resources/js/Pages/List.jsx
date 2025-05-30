import SingleLayout from "@/Layouts/BuildLayout/SingleLayout"
import { Head, Link } from "@inertiajs/react"
import data from "@/data/listPage";
import { ArrowLeftIcon, ArrowRightIcon } from "@heroicons/react/24/solid";

const List = ({ currentPage, pageSize }) => {
    return (
        <>
            <Head title="list page"></Head>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-4">
                {data.map((item, index) => {
                    return <ListItem key={index} item={item}></ListItem>
                })}
            </div>
            <ListPaging pageSize={pageSize} currentPage={currentPage} link={route('cate', {category: 'thoi-su'})+'?a=12'}></ListPaging>
        </>
    )
}

List.layout = page => (
    <SingleLayout children={page} />
)

const ListItem = ({ item: { id, title, shortContent } }) => {
    return (
        <Link
            href={route('detail', { id: id })}
            // data={{page:1, size: 8}}
            className="scale-100 p-6 bg-white hover:ring-1 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
        >
            <div>
                <div className="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        strokeWidth="1.5"
                        className="w-7 h-7 stroke-red-500"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"
                        />
                    </svg>
                </div>

                <h2 className="mt-6 text-xl font-semibold text-gray-900 dark:text-white">
                    {title}
                </h2>

                <p className="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    {shortContent}
                </p>
            </div>

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                className="self-center shrink-0 stroke-red-500 w-6 h-6"
            >
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                />
            </svg>
        </Link>
    )
}

const ListPaging = ({ pageSize, currentPage, link }) => {
    if (pageSize === 1) {
        return null;
    }

    if (pageSize < 6) {
        return (
            <div className="justify-center content-center flex p-4 gap-x-2">
                {(() => {
                    const listPage = [];
                    for (let index = 1; index < pageSize; index++) {
                        listPage.push(<Link href={link} data={{
                            page: index,
                        }}>
                            <span
                                className={`p-2 px-4 bg-green-500 rounded-[20px] ${currentPage === index ? 'text-white' : ''} justify-center content-center text-xl font-bold hover:text-red-700`}
                            >{index}</span></Link>)
                    }
                    return listPage;
                })()}

            </div>
        )
    }

    return (
        <div className="justify-center content-center flex p-4 gap-x-2">
            {currentPage - 2 > 1 && <Link href={link}
                data={{
                    page: currentPage - 5 > 1 ? currentPage - 5 : 1
                }}>
                <div className="p-2 px-4 bg-green-500 rounded-[28px] justify-center content-center">
                    <ArrowLeftIcon className="h-7 w-5"></ArrowLeftIcon>
                </div>
            </Link>}

            {(() => {
                const listPage = [];
                for (let index = (currentPage - 2 < 1 ? 1 : currentPage - 2); index <= (currentPage + 2 > pageSize ? pageSize : currentPage + 2); index++) {
                    listPage.push(
                        <Link href={link} data={{
                            page: index,
                        }}>
                            <div className="p-2 px-4 bg-green-500 rounded-[28px] justify-center content-center">
                                <p className="text-xl hover:text-red-700" style={{
                                    color: index === currentPage ? 'white' : undefined
                                }}>{index}</p>
                            </div>
                        </Link>
                    )
                }
                return listPage;
            })()}

            {pageSize > currentPage + 2 && <Link href={link}
                data={{
                    page: currentPage + 5 <= pageSize ? currentPage + 5 : pageSize
                }}>
                <div className="flex p-2 px-4 bg-green-500 rounded-[28px] justify-center content-center items-center">
                    <ArrowRightIcon className="h-7 w-5"></ArrowRightIcon>
                </div>
            </Link>}
        </div>
    )
}

export default List
