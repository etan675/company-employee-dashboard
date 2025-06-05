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
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4 text-lg">
            <div class="font-semibold">Total Companies: {{ companiesCount }}</div>
            <div class="font-semibold">Total Employees: {{ employeesCount }}</div>
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-center gap-4">
                    <h2>
                        <span class="font-semibold">Companies</span>
                        <span class="text-sm text-gray-500 ml-1">(Click a company name to view details)</span>
                    </h2>
                    <!-- TODO: link to create company page -->
                    <button 
                        class="border border-[currentColor] rounded-lg px-4 py-2 text-sm cursor-pointer hover:text-gray-500 dark:hover:text-gray-400"
                        @click="() => {}"
                    >
                        Create New
                    </button>
                </div>
                <div class="flex flex-col gap-2 items-start">
                    <!-- TODO: Add link to company details page -->
                    <Link
                        v-for="company in companies.data"
                        :key="company.id"
                        :href="''"
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
