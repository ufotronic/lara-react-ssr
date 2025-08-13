import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';
import {Feature, PaginatedData} from "@/types";
import FeatureItem from "@/Components/FeatureItem";

export default function Index({features}: {features: PaginatedData<Feature>}) {
  return (
    <AuthenticatedLayout
      header={
        <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
          Features
        </h2>
      }
    >
      <Head title="Features"/>

      <div className="mb-8">
        <Link href={route('feature.create')} className="inline-flex items-center" >

          Create new Feature

        </Link>
      </div>



          {features.data.map(feature => (

            <FeatureItem feature={feature} key={feature.id}/>

          ))}


    </AuthenticatedLayout>
  );
}
