import { Link } from "@inertiajs/react";

const InpageCategory = ({ categories }) => {
    if (!categories) {
        return;
    }

    // https://accreditly.io/articles/webkit-box-explained
    // https://viblo.asia/p/mot-vai-thu-thuat-css-ma-chinh-frontend-co-the-con-chua-biet-phan-8-OeVKBDaJlkW
    return (
        <div>
            <p className='text-xl underline'>Danh sach chu de:</p>
            <div
                className='gap-2 overflow-x-scroll flex-row py-2'
                style={{
                    display: '-webkit-box',
                }}>
                {categories.map((item, index) => {
                    return <p
                        key={index.toString()}
                        className='bg-green-400 p-1 px-2 justify-center items-center rounded-md' >
                        <Link
                            href={route('list', { category: item.id })}
                            className='hover:text-red-400 hover:underline text-lg text-white'>{item.name}</Link>
                    </p>
                })}
            </div>
        </div>
    )
}

export default InpageCategory;
