import { Link } from "@inertiajs/react";

const Tags = ({ tags }) => {
    if (!tags.length) {
        return null;
    }

    return (
        <div className="space-x-1 md:space-x-2 flex p-1 py-2 bg-white">
            {tags.map(function (tag, index) {
                return (
                    <Link href={route('tag', {value: tag.key})} className="bg-blue-gray-500 px-2 py-1 rounded-md hover:bg-light-green-600" key={`tag-${index}`}>{tag.value}</Link>
                )
            })}
        </div>
    )
}

export default Tags;
