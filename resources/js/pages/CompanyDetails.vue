
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Company, type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps<{
    company: {
        data: Company
    },
}>();

const company = props.company.data;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
    {
        title: company.name,
        href: '/companies/' + company.id,
    },
];

</script>

<template>
    <Head :title="company.name" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-start gap-4 p-8">
            <h1 class="text-xl font-bold">Company Details</h1>
            <Link 
                :href="`/companies/${company.id}/edit`"
                class="bg-blue-500 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-600"
            >
                Edit
            </Link>
            <div>
                <span class="font-semibold">Name:</span>
                <span class="ml-2">{{ company.name }}</span>
            </div>
            <div>
                <span class="font-semibold">ABN:</span>
                <span class="ml-2">{{ company.abn }}</span>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <span class="ml-2">{{ company.email }}</span>
            </div>
            <div>
                <span class="font-semibold">Address:</span>
                <span class="ml-2">{{ company.address }}</span>
            </div>
            <div class="flex flex-col gap-4 items-start">
                <h2>
                    <span class="font-semibold">Employees</span>
                    <span class="text-sm text-gray-500 ml-1">(Click an employee name to view details)</span>
                </h2>
                <Link 
                    :href="`/companies/${company.id}/employees/new`"
                    class="bg-blue-500 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-600"
                >
                    Create New
                </Link>
                <div class="flex flex-col gap-2">
                    <Link
                        v-for="employee in company.employees"
                        :key="employee.id"
                        :href="`/companies/${company.id}/employees/${employee.id}`"
                        class="text-sm hover:underline"
                    >
                        {{ employee.firstName }} {{ employee.lastName }} ({{ employee.email }})
                    </Link>
                </div>
            </div>
        </div> 
    </AppLayout>

</template>