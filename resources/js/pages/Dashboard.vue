<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Company, type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    companiesCount: number,
    employeesCount: number,
    companies: {
        data: Company[],
    }
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-8">
            <div class="font-semibold">Total Companies: {{ companiesCount }}</div>
            <div class="font-semibold">Total Employees: {{ employeesCount }}</div>
            <div class="flex flex-col gap-4 items-start">
                <h2>
                    <span class="font-semibold">Companies List</span>
                    <span class="text-sm text-gray-500 ml-1">(Click a company name to view details)</span>
                </h2>
                <Link 
                    :href="'/companies/new'"
                    class="bg-blue-500 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-600"
                >
                    Create New
                </Link>
                <div class="flex flex-col gap-2 items-start">
                    <Link
                        v-for="company in companies.data"
                        :key="company.id"
                        :href="`/companies/${company.id}`"
                        class="text-sm hover:underline"
                    >
                        <span>{{ company.name }}</span>
                        <span class="ml-1">(no. of employees: {{ company.employees.length }})</span>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
