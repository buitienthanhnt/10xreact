import { useForm, usePage } from "@inertiajs/react";
import PrimaryButton from "../PrimaryButton";
import InputError from "../InputError";
import { Transition } from "@headlessui/react";
import { Textarea } from "@material-tailwind/react";
import { useCallback, useEffect, useState } from "react";
import Urls from "@/network/Urls";

const CommentForm = (params) => {
	const [addSuccess, setAddSuccess] = useState(false);
	const { component, props: { auth: { user } }, scrollRegions, rememberedState, url
	} = usePage();

	const { data, setData, errors, reset, setError } = useForm({
		name: user?.name,
		email: user?.email,
		target_id: params.pageId,
		content: '',
		user_id: user?.id,
		parent_id: params?.parent_id,
	});

	const submit = useCallback((e) => {
		e.preventDefault();
		axios.post(Urls.addComment, data)
			.then(function (response) {
				setAddSuccess(true);
				reset();
			})
			.catch(function (error) {
				console.log('?????', error.response.data.message);
			});
	}, [reset, data]);

	useEffect(() => {
		if (addSuccess) {
			setTimeout(() => {
				setAddSuccess(false);
			}, 3000)
		}
	}, [addSuccess])

	if (user) {
		return (
			<div className="bg-white rounded-md p-2">
				<CommentUser></CommentUser>
				{addSuccess && <span className="font-semibold text-lg text-red-500">add success new comment</span>}
				<form action="" onSubmit={submit} className="mt-2 space-y-2">
					<div className="space-y-2">
						<Textarea
							variant="outlined"
							label="comment content"
							color={'black'}
							value={data.content}
							className="text-lg font-bold"
							style={{ fontSize: 18, fontWeight: 'bold', }}
							onChange={(e) => setData('content', e.target.value)}
						/>
						<InputError className="mt-2" message={errors.content} />
					</div>

					<div className="flex items-center justify-end gap-4">
						<PrimaryButton disabled={false}>Save</PrimaryButton>
						<Transition
							show={false}
							enter="transition ease-in-out"
							enterFrom="opacity-0"
							leave="transition ease-in-out"
							leaveTo="opacity-0"
						>
							<p className="text-sm text-gray-600">Saved.</p>
						</Transition>
					</div>
				</form>
			</div>
		)
	}

	return null;
}

const CommentUser = () => {
	const { props: { auth: { user } }, version, } = usePage();
	return (
		<div className="flex gap-x-3">
			<img src={user.profile_photo_path || user?.profile_photo_url} alt="" className="object-cover rounded-md w-[64px] h-[64px]" />
			<div>
				<span className="text-xl font-semibold">user name: {user?.name}</span>
				<h3 className="text-xl font-bold">email: {user?.email}</h3>
			</div>

		</div>
	)
}

export default CommentForm;