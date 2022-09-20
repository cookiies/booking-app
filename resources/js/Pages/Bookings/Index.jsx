import React from "react";
import Authenticated from "@/Layouts/Authenticated";
import { Head, InertiaLink, usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

export default function Index(props) {
    const { auth, errors, bookings } = props

    return (
        <Authenticated
            auth={auth}
            errors={errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Bookings</h2>}
        >
        <>
            <Head title="Bookings" />
            <div>
                {/* <pre>{JSON.stringify(props, null, 2)}</pre> */}
            </div>

            

            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
                <div className="flex items-center justify-between mb-6">
                    <InertiaLink
                        className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                        href={route("bookings.create")}
                    >
                        Create Booking
                    </InertiaLink>
                </div>
                <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table className="w-full">

                        <thead className="text-white bg-gray-600">
                            <tr className="font-bold text-center">
                                <th className="px-6 pt-5 pb-4">#</th>
                                <th className="px-6 pt-5 pb-4">Title</th>
                                <th className="px-6 pt-5 pb-4">Start</th>
                                <th className="px-6 pt-5 pb-4">End</th>
                                <th className="px-6 pt-5 pb-4">User</th>
                                <th className="px-6 pt-5 pb-4">Created At</th>
                                <th className="px-6 pt-5 pb-4">Updated At</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            {bookings.map(({ id, title, start, end, user_id, created_at, updated_at }) => (
                                <tr key={id} className="">
                                    <th className="p-1 text-center border-t">{id}</th>
                                    <td className="p-1 text-center border-t">{title}</td>
                                    <td className="p-1 text-center border-t">{start}</td>
                                    <td className="p-1 text-center border-t">{end}</td>
                                    <td className="p-1 text-center border-t">{user_id}</td>
                                    <td className="p-1 text-center border-t">{created_at}</td>
                                    <td className="p-1 text-center border-t">{updated_at}</td>
                                </tr>
                            ))}
                            {bookings.length === 0 && (
                                <tr>
                                    <td className="px-6 py-4 border-t" colSpan="7">No Bookings found.</td>
                                </tr>
                            )}
                        </tbody>

                    </table>
                </div>
            </div>
        </>
        </Authenticated>
    );
}
