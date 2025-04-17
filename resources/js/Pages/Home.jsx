import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head, Link } from "@inertiajs/react";

const Home = () => {
  const appName = "laravel10r";

  return (
    <SingleLayout>
      <Head>
        <title>Home layout</title>
      </Head>
      <div className="p-1">
        <span className="text-lg text-green-400 font-bold">Chao mung den voi: {appName}</span>
        <p>day la phan noi dung chua cac khoi cua home content</p>
        <Link href={route('detail')} className="text-xl font-semibold text-blue-gray-200 hover:text-green-600">go to detail</Link>
      </div>
    </SingleLayout>
  )
}

export default Home;