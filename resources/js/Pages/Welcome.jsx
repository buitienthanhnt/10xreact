import { DupVideos, GalleryList, HomeDemo, HomeTime, PageInfo, RandomHorizon, SuggetVertical, TimeList } from '@/Components/Custom';
import Banner from '@/Components/Custom/Banner';
import { TopPage } from '@/Components/PageComponent';
import SingleLayout from '@/Layouts/BuildLayout/SingleLayout';
import { Link, Head, } from '@inertiajs/react';

export default function Welcome({ auth, laravelVersion, phpVersion, videos, banner, timeLine }) {

    return (
        <SingleLayout>
            <>
                <Head title="trang chủ">
                    <meta name="author" content="thanhnt for developer" />
                    <meta name='group' content='develop web react laravel'></meta>
                    <link href='' rel='stylesheet'></link>
                    <script></script>
                </Head>
                <div className="sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"> {/* relative sm:flex  */}
                    <HomeAuth auth={auth}></HomeAuth>
                    <div className="space-y-2 p-6 lg:p-8"> {/* max-w-7xl mx-auto  p-6 lg:p-8  */}
                        <HomeTime></HomeTime>
                        <TopPage></TopPage>
                        <DupVideos items={videos}></DupVideos>
                        <HomeDemo></HomeDemo>
                        <Banner page={banner}></Banner>
                        <PageInfo laravelVersion={laravelVersion} phpVersion={phpVersion}></PageInfo>
                        <RandomHorizon></RandomHorizon>
                        <SuggetVertical pageId={banner.id} title={'Giới thiệu'}></SuggetVertical>
                        <GalleryList></GalleryList>
                        <TimeList items={timeLine}></TimeList>
                    </div>
                </div>
                <HomeStyle></HomeStyle>
            </>
        </SingleLayout>
    );
}

function HomeAuth({ auth }) {
    return (
        <div className="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            {auth.user ? (
                <Link
                    href={route('dashboard')}
                    className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >
                    Dashboard
                </Link>
            ) : (
                <>
                    <Link
                        href={route('login')}
                        className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >
                        Log in
                    </Link>

                    <Link
                        href={'home'}
                        className="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >
                        Home page
                    </Link>

                    <Link
                        href={route('register')}
                        className="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >
                        Register
                    </Link>

                    <a className='m-2 bg-green-400 rounded-lg p-1 px-2 dark:text-white hover:text-blue-500' href={route('login')}>A to login</a>
                </>
            )}
        </div>
    )
}

const HomeStyle = () => {
    return (
        <style>{`
            html {scroll-behavior: smooth;}
            .bg-dots-darker {
                    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
            }
            @media (prefers-color-scheme: dark) {
                .dark\\:bg-dots-lighter {
                    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
                }
            }
            .player-wrapper {
                position: relative;
                padding-top: 177.76%; /* 1095 / 616 = 1.7776 */
            }
            .react-player {
                position: absolute;
                top: 0;
                left: 0;
            }
        `}</style>
    )
}