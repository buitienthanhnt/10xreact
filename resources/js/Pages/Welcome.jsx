import GoldChart from '@/Components/ChartComponent/GoldChart';
import VietLotChart from '@/Components/ChartComponent/VietLotChart';
import { CenterCategory, DupVideos, HomeDemo, HomeTime, ImagePage, PageInfo, RandomHorizon, SuggetVertical, TimeList, TopComment } from '@/Components/Custom';
import Banner from '@/Components/Custom/Banner';
import { TopPage } from '@/Components/PageComponent';
import { ListSke } from '@/Components/Skeleton';
import SingleLayout from '@/Layouts/BuildLayout/SingleLayout';
import { Link, Head, WhenVisible, usePage, Deferred, } from '@inertiajs/react';
import React from "react";
import Slider from "react-slick";
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
                        <div className='grid grid-cols-3 gap-1'>
                            <div className='col-span-3 md:col-span-2'>
                                <TopComment></TopComment>
                            </div>
                            <div className='col-span-0 md:col-span-1 bg-white justify-center flex p-1 rounded-md'>
                                <span className='text-black font-bold text-xl'>Quảng cáo!</span>
                            </div>
                        </div>
                        <HomeDemo></HomeDemo>
                        <Banner page={banner}></Banner>
                        <PageInfo laravelVersion={laravelVersion} phpVersion={phpVersion}></PageInfo>
                        <RandomHorizon></RandomHorizon>
                        <GoldChart></GoldChart>
                        <SuggetVertical pageId={banner.id} title={'Giới thiệu'}></SuggetVertical>
                        <CenterCategory></CenterCategory>
                        {/* Dùng WhenVisible thì data sẽ được gọi khi đối tượng được hiển thị  */}
                        <SwipeToSlide></SwipeToSlide>
                        <VietLotChart></VietLotChart>
                        <WhenVisible data={['timeLine']} fallback={() => <ListSke></ListSke>}>
                            <TimeList items={timeLine}></TimeList>
                        </WhenVisible>
                        <TestDef></TestDef>
                        <HomeVideos></HomeVideos>
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

function SwipeToSlide() {
    const { props: { swipeList } } = usePage();

    // https://taynamsolution.vn/chuyen-muc/tin-tuc/page/2/
    // padding between slider item
    /* the slides */
    // .slick-slide {margin: 0 27px;}
    /* the parent */
    // .slick-list {margin: 0 -27px;}
    const settings = {
        centerMode: window.innerWidth < 720 ? true : false,
        centerPadding: "60px",
        infinite: true,
        dots: true,
        slidesToShow: window.innerWidth < 720 ? 1 : 3,
        swipeToSlide: true,
        arrows: false,
        afterChange: function (index) {
            // console.log(
            //     `Slider Changed to: ${index + 1}, background: #222; color: #bada55`
            // );
        }
    };

    return (
        <Deferred data="swipeList" fallback={() => <ListSke></ListSke>}>
            <style>
                {".slick-slide > div { margin: 0 8px;}"}
            </style>
            {swipeList && <div className="slider-container bg-white p-2 md:pb-8 rounded-lg space-y-2 shadow-xl">
                <p className='font-semibold text-2xl text-blue-700 flex bg-white'>
                    Danh sách ngẫu nhiên:
                </p>
                <Slider {...settings}>
                    {swipeList.map((item, index) => <SliderItem key={`sli-${index}`} item={item}></SliderItem>)}
                </Slider>
            </div>}
        </Deferred>
    );
}

function SliderItem({ item }) {
    return (
        <Link href={route('detail', { alias: item.alias })} prefetch className='bg-green-300 h-48 md:h-72 flex rounded-md justify-center items-center relative'>
            <ImagePage source={item.image_path} className={'w-full h-full rounded-md'}></ImagePage>
            <div className='absolute bg-[#c2dbeb99] left-0 bottom-0 px-2 pl-1 py-1 rounded-sm min-h-[56px]'>
                <p className='font-semibold text-md md:text-xl line-clamp-2 hover:text-white'>
                    {item.title}
                </p>
            </div>
        </Link>
    )
}

function TestDef() {
    const { props: { testDef } } = usePage();

    return (
        <Deferred data="testDef" fallback={() => <ListSke></ListSke>}>
            {testDef && <ul className="list-disc list-inside bg-white rounded-md p-1">
                {testDef.map((page, index) =>
                    <Link href={route('detail', { alias: page.alias })} key={`random-${index}`}>
                        <li className="text-lg ml-2 hover:underline hover:text-light-blue-600">
                            {page.title}
                        </li>
                    </Link>
                )}
            </ul>}
        </Deferred>
    )
}

function HomeVideos(params) {
    const key = 'videos';
    const { props } = usePage();

    return (
        <WhenVisible data={key} fallback={() => <ListSke></ListSke>}>
            {props[key] && <DupVideos items={props[key]}></DupVideos>}

            <Deferred data="swipeList" fallback={() => <ListSke></ListSke>}>
                {props.swipeList && <div className="slider-container bg-white p-2 md:pb-8 rounded-lg space-y-2 shadow-xl">
                    <p className='font-semibold text-2xl text-blue-700 flex bg-white'>
                        Danh sách ngẫu nhiên:
                    </p>
                    {props.swipeList.map((i, index) => {
                        return <p key={index}>{i.title}</p>
                    })}
                </div>}
            </Deferred>
        </WhenVisible>
    )
}