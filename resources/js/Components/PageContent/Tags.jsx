import { Link } from "@inertiajs/react";

const Tags = ({ tags }) => {
    if (!tags) {
        return null;
    }

    return (
        <div className="space-x-1 md:space-x-2 flex p-1">
            {tags.map(function (tag, index) {
                return (
                    <Link href="" className="bg-blue-gray-500 px-2 py-1 rounded-md hover:bg-light-green-600" key={`tag-${index}`}>{tag.value}</Link>
                )
            })}
        </div>
    )
}

export default Tags;
