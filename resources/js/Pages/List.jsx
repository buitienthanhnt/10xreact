import SingleLayout from "@/Layouts/BuildLayout/SingleLayout"
import { Head } from "@inertiajs/react"

const List = () => {
	return (
		<>
		<Head title="list page"></Head>
			<h1>Welcome 123</h1>
			<p>Hello welcome to your first Inertia app!</p>
		</>
	)
}

List.layout = page => (
	<SingleLayout children={page}/>
)

export default List