import SingleLayout from "@/Layouts/BuildLayout/SingleLayout";
import { Head, Link, router } from '@inertiajs/react';
import { Button } from "@material-tailwind/react";
import { useState } from "react";

const Detail = ({ value }) => {
  const [url, setUrl] = useState('');
  return (
    <SingleLayout>
      <Head>
        <title>detail page</title>
      </Head>
      <div>
        <span>noi dung detail</span>
        <h2 className="text-green-700 font-bold">{value}</h2>
        <Link href="home" className="text-xl hover:text-orange-500 font-medium hover:underline" data={{ id: 12, name: 'tahmahand' }}>
          go to home page layout</Link>

        <Link href={''} className="underline hover:text-blue-gray-700 block"> demo to generate url
        </Link>

        <p className="text-xl font-bold hover:text-blue-600 underline">{url}</p>

        <div className="space-x-1">
          <Button onClick={() => {
            console.log('====================================');
            // setUrl(route('login'));
            console.log(route().has('login'));
            // console.log(router.get('home'));
          }}>
            view url
          </Button>
          <Link href={route("list", {id: 223})}>
            <Button>go to List page</Button></Link>
        </div>
      </div>
    </SingleLayout>
  )
}

export default Detail;