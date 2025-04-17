import Guest from "@/Layouts/GuestLayout";
import BaseLayout from "@/Layouts/BaseLayout";
import { Head } from "@inertiajs/react";

const Home = () => {

    return (
        <BaseLayout>
            <Head title="home screen">
                <title>About - My app</title>
                <meta head-key="description" name="description" content="This is a page specific description" />
            </Head>
            <div className="flex w-full">
                <span>demo for home contentn</span>
            </div>
            <div className="flex w-full">
                <span>demo for home contentn</span>
            </div>
            <div className="flex w-full">
                <span>demo for home contentn</span>
            </div>
            <div className="flex w-full">
                <span>demo for home contentn</span>
            </div>
            <div className="flex w-full">
                <span>demo for home contentn</span>
            </div>
            <div className="flex w-full">
                <span>demo for home contentn</span>
            </div>
        </BaseLayout>
    )
}

export default Home;
