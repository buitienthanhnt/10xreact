
export default function Baselayout({ children }) {
	return (
		<div className="min-h-screen first-line:container mx-auto p-2 dark:bg-gray-300 bg-gray-100 full-height justify-between">
			{children}
		</div>
	)
}
